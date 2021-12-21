$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(".hamburger").click(function () {
		$(this).toggleClass("is-active");

		if($(this).is(".is-active")){
			$(this).siblings(".header__linkTo").addClass("active");
		} else {
			$(this).siblings(".header__linkTo").removeClass("active");
		}
	});


	// window.scrollTo(0, 0);
	var stage = 0;
	var header = $("#header .header__left");

	var slick = $("#container");
	slick.slick({
		arrows: false,
		infinite: false,
		swipe: true,
		// speed: 300,
		arrows: false,
		// touchMove: false,
		// adaptiveHeight: true,
		// prevArrow: $("#buttonPrev"),
		// nextArrow: $("#buttonNext"),
	});

	slick.on('beforeChange', function(event, slick, currentSlide, nextSlide){
		header
			.find(".active").removeClass("active").end()
			.find(".header__data-" + nextSlide).addClass("active");
	});

	$(document).keydown(function(e) {
		switch(e.which) {
			case 37: // left
				slick.slick('slickPrev');
			break;
			case 39: // right
				slick.slick('slickNext');
			break;
			default: return;
		}
		e.preventDefault();
	});

	$(".header__linkToDB").click(function () {
		slick.slick('slickGoTo', 0);
		$(this).removeClass("active")
			.siblings(".hamburger").removeClass("is-active");
	});

	$(".popup__close").click(function () {
		$("#overlay").hide();
	});

	var params = JSON.parse($("#params").val())[0];
	Vue.filter('numberFormat', number_format);

	var table = new Vue({
		el: "#tab1",
		data: {
			airplanes: getAirplanes(),
			isEditing: false,
			selected: undefined,
		},
		methods: {
			tableEdit: function () {
				this.isEditing = !this.isEditing;
				this.selected = undefined;
			},
			inputChange: function (e) {
				var target = $(e.target),
					data = {
						id: target.parent().parent().data("index"),
						newValue: target.val(),
						type: target.data("type")
					};
				$.post("/changeInput", JSON.stringify(data))
					.done(function (response) {
						if (response == "ok") {
							target.removeClass("error");
						} else {
							target.addClass("error");
						}
					}).fail(function () {
						target.addClass("error");
					});
			},
			inputFocus: inputFocus,
			addAirplane: function () {
				var o = this;
				$.post("/addAirplane", {})
					.done(function (response) {
						o.airplanes.push(JSON.parse(response));
					}).fail(function () {});
			},
			removeAirplane: function () {
				if(this.selected !== undefined){
					var o = this;
					$.post("/removeAirplane", JSON.stringify({
							id: this.airplanes[o.selected].id
						}))
						.done(function (response) {
							if (response == "ok") {
								o.airplanes.splice(o.selected, 1);
								o.selected = undefined;
							}
						}).fail(function () {});
				}
			},
			setActive: function (i, e) {
				if(this.isEditing || $(e.target).is(".mainTable__arrow")) return;
				if(this.selected === i){
					this.selected = undefined;
				} else {
					this.selected = i;
				}
			},
			getScenaries: function (e) {
				var target = $(e.target);
				$("#overlay").show()
				.find(".popup__scenario").each(function(){
					$(this).data("index", target.data("index"));
				});
			},
		},
	});


	var airplane = new Vue({
		el: ".section-1",
		data: {
			a: table.airplanes[0],
			currentYear: new Date().getFullYear(),
		},
		methods: {
			// changeAirplane: function (e) {
			// 	this.a = table.airplanes[e.target.value];
			// }
		},
		computed: {
			max_expluatation_year: function () {
				return parseInt(this.a.year) + parseInt(this.a.avr_years_service);
			},
			posible_expluatation: function () {
				return this.max_expluatation_year - this.currentYear + 1;
			},
			fuel_consum_hour: function () {
				return this.a.fuel_weight * 100 / this.a.practical_range;
			},
			fuel_consum_km: function () {
				return this.a.normal_cruising_speed * this.a.fuel_weight / this.a.practical_range;
			},
			airplanes: function () {
				return table.airplanes;
			}
		},
	});
	
	$(".popup__scenario").click(function () {
			airplane.a = table.airplanes[$(this).data("index")];
			$("#overlay").hide();
			slick.slick('slickNext');
			// $("#tab2").show();
	});

	var tableLifetime = new Vue({
		el: ".tableLifetime",
		data: {
			lifetime: params.lifetime
		},
		methods: {
			inputChange: paramUpdate,
		},
		computed: {
			isCorrectExpluatation: function () {
				return this.lifetime > airplane.a.avr_years_service;
			},
			end_expluatation_year: function () {
				var temp = parseInt(airplane.currentYear) + parseInt(this.lifetime);
				return temp;
				// return airplane.max_expluatation_year <= temp ? airplane.max_expluatation_year : temp;
			},
		}
	});

	var flyingHoursPerMonth = new Vue({
		el: "#flyingHoursPerMonth",
		data: {
			flying_hours_per_month: params.flying_hours
		},
		methods: {
			inputChange: paramUpdate,
		},
	});

	var stage2 = new Vue({
		el: ".tableDepreciationDynamics",
		data: {
			depreciation_percentage: params.depreciation_percentage,
			depreciation_period: params.depreciation_period,
		},
		computed: {
			end_effective_year: function () {
				return airplane.a.year + parseInt(this.depreciation_period);
			},
			effect_per_year: function () {
				return (100 - parseInt(this.depreciation_percentage)) / (airplane.a.avr_years_service - parseInt(this.depreciation_period));
			},
			max_effect_per_year: function () {
				return parseInt(this.depreciation_percentage) / parseInt(this.depreciation_period);
			},
			amount_of_capital_costs: function () {
				var airplaneCost = airplane.a.price,
					amortizationPercentMax = airplaneCost / 100 * this.max_effect_per_year,
					amortizationPercent = airplaneCost / 100 * this.effect_per_year,
					temp = parseInt(airplane.currentYear) + parseInt(tableLifetime.lifetime),
					lastCycle = airplane.max_expluatation_year <= temp ? airplane.max_expluatation_year : temp;
					
				for (i = airplane.currentYear + 1; i <= lastCycle; i++) {
					var amortization = i <= this.end_effective_year ? amortizationPercentMax : amortizationPercent;
					airplaneCost -= amortization;
				}
				return airplane.a.price - airplaneCost;
			},
		},
		methods: {
			inputChange: paramUpdate,
			inputFocus: inputFocus,
		}
	});

	var stage3 = new Vue({
		el: ".section-3",
		data: {
			salary_leader1: params.salary_leader1,
			salary_leader2: params.salary_leader2,
			salary_pilot2: params.salary_pilot2,
			salary_conductor: params.salary_conductor,
			salary_engineer: params.salary_engineer,

			insurance_responsibility: params.insurance_responsibility,
			insurance_crew: params.insurance_crew,
			insurance_kasko: params.insurance_kasko,
			insurance_franchise: params.insurance_franchise,
			insurance_aircraft_service: params.insurance_aircraft_service,

			nav_aeronautical_charts: params.nav_aeronautical_charts,
			nav_airworthiness: params.nav_airworthiness,
			nav_planning_program: params.nav_planning_program,
			nav_communication: params.nav_communication,
			nav_management: params.nav_management,
			nav_daily_travel_accommodation: params.nav_daily_travel_accommodation,
			nav_crue_training: params.nav_crue_training,
			nav_crue_training2: params.nav_crue_training2,
		},
		computed: {
			salarySum: function () {
				return parseFloat(this.salary_leader1) +
					parseFloat(this.salary_leader2) + parseFloat(this.salary_pilot2) +
					parseFloat(this.salary_conductor) + parseFloat(this.salary_engineer);
			},
			insuranceSum: function () {
				return parseFloat(this.insurance_responsibility) +
					parseFloat(this.insurance_crew) + parseFloat(this.insurance_kasko) +
					parseFloat(this.insurance_franchise) + parseFloat(this.insurance_aircraft_service);

			},
			navSum: function () {
				return parseFloat(this.nav_aeronautical_charts) +
					parseFloat(this.nav_airworthiness) + parseFloat(this.nav_planning_program) +
					parseFloat(this.nav_communication) + parseFloat(this.nav_management) +
					parseFloat(this.nav_daily_travel_accommodation) + parseFloat(this.nav_crue_training) +
					parseFloat(this.nav_crue_training2);

			},
			flying_hours_per_month: function () {
				return flyingHoursPerMonth.flying_hours_per_month;
			},
			grate_total_year: function () {
				return ((this.salarySum * 12) + this.insuranceSum + (this.navSum * 12));
			},
		},
		methods: {
			inputChange: paramUpdate,
			inputFocus: inputFocus,
		}
	});

	var stage4 = new Vue({
		el: ".section-4",
		data: {
			route_distance: params.route_distance,
			airport_services_cost: params.airport_services_cost,
			fuel_cost: params.fuel_cost,

			engine_hour_price: params.engine_hour_price,
			avionics_hour_price: params.avionics_hour_price,
			glider_hour_price: params.glider_hour_price,

			duration_warm_up: params.duration_warm_up,
			duration_take_off: params.duration_take_off,
		},
		methods: {
			inputChange: paramUpdate,
			inputFocus: inputFocus,
		},
		computed: {
			aeroNavigation_R: function () {
				return 7.56 * airplane.a.mtow / 100;
			},
			aeroNavigation_r: function () {
				return 45.56 * this.route_distance * Math.sqrt(airplane.a.mtow / 1000 / 50) / 100;
			},
			aeroNavigation_summ: function () {
				return this.aeroNavigation_R + this.aeroNavigation_r;
			},
			engine_load_summ: function () {
				return ((this.warm_up_nav * this.duration_warm_up) +
					(this.take_off * this.duration_take_off) +
					(this.cruise * this.duration_cruise) +
					(this.landing * this.duration_landing)) / this.duration_summ;
			},
			duration_cruise: function () {
				return this.route_distance * 60 / this.normal_cruising_speed;
			},
			duration_landing: function () {
				return this.duration_cruise >= 60 ? 20 : 10;
			},
			duration_summ: function () {
				return parseFloat(this.duration_warm_up) + parseFloat(this.duration_take_off) +
					parseFloat(this.duration_cruise) + parseFloat(this.duration_landing);
			},
			fuel_need_warm_up: function () {
				return this.fuel_consum_km * this.warm_up_nav * this.duration_warm_up / 60 / 100;
			},
			fuel_need_take_off: function () {
				return this.fuel_consum_km * this.take_off * this.duration_take_off / 60 / 100;
			},
			fuel_need_cruise: function () {
				return this.fuel_consum_km * this.cruise * this.duration_cruise / 60 / 100;
			},
			fuel_need_landing: function () {
				return this.fuel_consum_km * this.landing * this.duration_landing / 60 / 100;
			},
			fuel_need_summ: function () {
				return parseFloat(this.fuel_need_warm_up) + parseFloat(this.fuel_need_take_off) +
					parseFloat(this.fuel_need_cruise) + parseFloat(this.fuel_need_landing);
			},
			utilization_programm: function () {
				return (parseFloat(this.engine_hour_price) +
					parseFloat(this.avionics_hour_price) +
					parseFloat(this.glider_hour_price)) / 60 * this.duration_summ;
			},
			flight_cost: function () {
				return this.aeroNavigation_summ + (this.fuel_need_summ * this.fuel_cost) +
					parseFloat(this.airport_services_cost) + this.utilization_programm;
			},
			flight_hour_cost: function () {
				return this.flight_cost * 60 / this.duration_summ;
			},
			warm_up_nav: function () {
				return airplane.a.warm_up_nav;
			},
			take_off: function () {
				return airplane.a.take_off;
			},
			cruise: function () {
				return airplane.a.cruise;
			},
			landing: function () {
				return airplane.a.landing;
			},
			normal_cruising_speed: function () {
				return airplane.a.normal_cruising_speed;
			},
			practical_range: function () {
				return airplane.a.practical_range;
			},
			fuel_consum_km: function () {
				return airplane.fuel_consum_km;
			}
		},
	});

	var chartYears = null;
	var chartMonths = null;

	var stage5 = new Vue({
		el: ".section5-final",
		data: {
			flying_hours_per_month: flyingHoursPerMonth.flying_hours_per_month,
			flying_hour_profitability: params.flying_hour_profitability,
		},
		methods: {
			inputChange: paramUpdate,
			inputFocus: inputFocus,
			flyingHoursChange: function(e) {
				flyingHoursPerMonth.flying_hours_per_month = $(e.target).val();
			},
			statusColor: function(value){
				if(value <= 0){
					return 'negative';
				} else {
					return 'positive';
				}
			}
		},
		computed: {
			lifetime: function () {
				return tableLifetime.lifetime;
			},
			revenue_from_flight_hour: function () {
				return this.total_costs_hour / 100 * this.flying_hour_profitability;
			},
			total_flight_hour_cost: function () {
				return this.total_costs_hour + this.revenue_from_flight_hour;
			},
			forecasted_income_month: function () {
				return this.total_flight_hour_cost * flyingHoursPerMonth.flying_hours_per_month;
			},
			predicted_net_income_month: function () {
				return this.forecasted_income_month - this.total_costs_month;
			},
			amount_of_capital_costs: function () {
				return stage2.amount_of_capital_costs;
			},
			capital_costs_hour: function () {
				return this.capital_costs_month / flyingHoursPerMonth.flying_hours_per_month;
			},
			capital_costs_month: function () {
				return stage2.amount_of_capital_costs / tableLifetime.lifetime / 12;
			},
			fixed_costs_year: function () {
				return stage3.grate_total_year;
			},
			fixed_costs_month: function () {
				return stage3.grate_total_year / 12;
			},
			fixed_costs_hour: function () {
				return stage3.grate_total_year / 12 / flyingHoursPerMonth.flying_hours_per_month;
			},
			variable_costs_hour: function () {
				return stage4.flight_hour_cost;
			},
			variable_costs_month: function () {
				return stage4.flight_hour_cost * flyingHoursPerMonth.flying_hours_per_month;
			},
			total_costs_hour: function () {
				return this.capital_costs_hour + this.fixed_costs_hour + this.variable_costs_hour;
			},
			total_costs_month: function () {
				return this.total_costs_hour * flyingHoursPerMonth.flying_hours_per_month;
			},
			total_costs: function () {
				return this.total_costs_month * 12 * this.lifetime;
			},
			table1Data: function(){
				var result = [];
				var total = -this.total_costs;
				var temp = [total.toFixed(2)];
				var profit = this.total_costs_month + this.forecasted_income_month - this.total_costs_month;
				for(i = 0; i < this.lifetime * 12; i++){
					total += profit;
					result.push(total.toFixed(2));
				}
				changeChart(chartMonths, temp.concat(result));
				return result;
			},
			table2Data: function(){
				var total = -this.total_costs.toFixed(2);
				var result = [total];
				var profit = this.forecasted_income_month * 12;
				for(i = 0; i < this.lifetime; i++){
					total += profit;
					result.push(total.toFixed(2));
				}

				changeChart(chartYears, result);
				return result;
			},
		}
	});

	Chart.defaults.global.defaultFontColor = "#fff";
	chartYears = new Chart($("#chartYears"), {
		type: 'bar',
		data: {
			labels: [],
			datasets: [{
				label: 'Окупаемость',
				data: [],
				backgroundColor:'#1d1f2f',
				borderColor: '#20f2ad',
				borderWidth: 2,
				padding: 20
			}]
		},
		options: {
			title: {
				display:true,
				text: 'Окупаемость по годам',
				fontSize: 30,
				fontColor: '#20f2ad',
				fontStyle: 'bold'
			},
			legend:{
				display:false,
			},
		},
		plugins: [{
			beforeInit: function(chart, options) {
				if(!chart.data.labels.length){
					var labels = [];
					for (i = 0; i < stage5.table2Data.length; i++){
						labels.push(i);
					}
					chart.data.labels = labels;
					chart.data.datasets[0].data = stage5.table2Data;
				}
			},
		}]
	});
	var chartMonths = new Chart($("#chartMonths"), {
		type: 'bar',
		responsive: true,
		data: {
			labels: [],
			datasets: [{
				label: 'Окупаемость',
				data: [],
				backgroundColor:'#1d1f2f',
				borderColor: '#20f2ad',
				borderWidth: 2,
				padding: 20,
			}]
		},
		options: {
			maintainAspectRatio: false,
			title: {
				display:true,
				text: 'Окупаемость по месяцам',
				fontSize: 30,
				fontColor: '#20f2ad',
				fontStyle: 'bold'
			},
			legend:{
				display:false,
			}
		},
		plugins: [{
			beforeInit: function(chart, options) {
				if(!chart.data.labels.length){
					var temp = [-stage5.total_costs.toFixed(2)];
						temp = temp.concat(stage5.table1Data);
					var labels = [];
					for (i = 0; i < stage5.table1Data.length; i++){
						labels.push(i);
					}
					chart.data.labels = labels;
					chart.data.datasets[0].data = temp;
				}
			},
		}]
	});

	$("#initData").remove();

	$(".header__linkToPDF").click(function(){
		$(".chartMonthsWrapper, .chartWrapper").addClass("toPDF");
		getPDF();
		$(".chartMonthsWrapper, .chartWrapper").removeClass("toPDF");
	});
});

function getPDF(){
 
	var HTML_Width = $(".section5-inner").width();
	var HTML_Height = $(".section5-inner").height();
	var top_left_margin = 0;
	var PDF_Width = HTML_Width + (top_left_margin*2);
	var PDF_Height = (PDF_Width * 1.5) + (top_left_margin*2);
	console.log(HTML_Width + " + " + HTML_Height);
	// if(HTML_Height >= HTML_Width){
	// 	var PDF_Width = HTML_Width;
	// 	var PDF_Height = HTML_Height;
		var orientation = "portrait";
	// } else {
	// 	var PDF_Width = HTML_Height;
	// 	var PDF_Height = HTML_Width *4;
	// 	var orientation = "landscape";
	// }
	// console.log(orientation);

	var canvas_image_width = HTML_Width;
	var canvas_image_height = HTML_Height;
	
	var totalPDFPages = Math.ceil(HTML_Height/PDF_Height)-1;




	html2canvas($(".section5-inner")[0],{
		allowTaint:true,
		backgroundColor: "#2b2c3b"
	}).then(function(canvas) {
	var canvasContext = canvas.getContext('2d');

	// console.log(canvas.height+"  "+canvas.width);

	var imgData = canvas.toDataURL("image/png", 1.0);
	var pdf = new jsPDF(orientation, 'pt', [PDF_Width, PDF_Height]);
	pdf.setFillColor("#2b2c3b");
	pdf.rect(0, 0, PDF_Width, PDF_Height, "F");
	pdf.addImage(imgData, 'png', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);

	for (var i = 1; i <= totalPDFPages; i++) {
		pdf.addPage(PDF_Width, PDF_Height);
		pdf.addImage(imgData, 'png', top_left_margin, -(PDF_Height*i)+(top_left_margin*4), canvas_image_width, canvas_image_height);
	}

	pdf.save("SkyHandling.pdf");

	});

	};

function changeChart(chart, val){
	if (chart !== null){
		var labels = [];
		for (i = 0; i < val.length; i++){
			labels.push(i);
		}
		chart.data.labels = labels;
		chart.data.datasets[0].data = val;
		chart.update();
	}
};

function getAirplanes() {
	var airplanes = [];
	$("#initData input").each(function () {
		airplanes.push(JSON.parse($(this).val()));
	});

	return airplanes;
}

function paramUpdate(e) {
	var target = $(e.target),
		data = {
			newValue: target.val(),
			type: target.data("type")
		};
	$.post("/changeParam", JSON.stringify(data))
		.done(function (response) {
			if (response == "ok") {
				target.removeClass("error");
			} else {
				target.addClass("error");
			}
		}).fail(function () {
			target.addClass("error");
		});
}

function number_format(number, decimals, dec_point, thousands_sep) {
	var i, j, kw, kd, km;

	// input sanitation & defaults
	if (isNaN(decimals = Math.abs(decimals))) {
		decimals = 2;
	}
	if (dec_point == undefined) {
		dec_point = ",";
	}
	if (thousands_sep == undefined) {
		thousands_sep = " ";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

	if ((j = i.length) > 3) {
		j = j % 3;
	} else {
		j = 0;
	}

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	//kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


	return km + kw + kd;
}

function inputFocus(e){
	$(e.target).val("");
}