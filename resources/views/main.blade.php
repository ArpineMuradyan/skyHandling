<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sky Handling</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ URL::asset('css/index.min.css') }}">
</head>

<body id="mainPage">
	<noscript id="noscript">
		Для корректной работы сайта браузер должен поддерживать JavaScript.
	</noscript>

	<div id="initData">
		@foreach ($airplanes as $airplane)
			<input type="hidden" name="{{ "el-".$loop->index}}" value="{{ $airplane->toJson() }}">
		@endforeach
	</div>
	<input id="params" type="hidden" value="{{ $params->toJson() }}">

	<div id="header" class="header">
		<div class="header__wrapper">
			<div class="header__left">
				<div class="header__data header__data-0 active">
					<div class="header__text">Sky Handling</div>
					<div class="header__subtext">DOC Calculator (Direct Operating Costs Analysis)</div>
				</div>
				<div class="header__data header__data-1">
					<div class="header__text">Этап №1</div>
					<div class="header__subtext">Проверка информации по cамолету</div>
				</div>
				<div class="header__data header__data-2">
					<div class="header__text">Этап №2</div>
					<div class="header__subtext">Капитальные затраты</div>
				</div>
				<div class="header__data header__data-3">
					<div class="header__text">Этап №3</div>
					<div class="header__subtext">Фиксированные затраты</div>
				</div>
				<div class="header__data header__data-4">
					<div class="header__text">Этап №4</div>
					<div class="header__subtext">Данные о рейсе и Переменные затраты</div>
				</div>
				<div class="header__data header__data-5">
					<div class="header__text">Этап №5</div>
					<div class="header__subtext">Итоговая Стоимость Проекта</div>
				</div>
			</div>
			<div class="header__right">
				<div class="header__linkTo header__linkToDemo"><a style="color: rgba(255,255,255,.4);" href="http://docc.space/demo/index.html">New Version</a></div>
				<div class="header__linkTo header__linkToGoogleSheets">Создать Excel</div>
				<div class="header__linkTo header__linkToDB">База данных</div>
				<div class="header__linkTo header__linkToPDF">Создать PDF</div>
				<div class="header__linkTo header__linkOpenPDF">Скачать PDF</div>
				<button class="hamburger hamburger--squeeze" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
		</div>
	</div>

	<main id="container">
		@include('tab1',[		'courses'=>$courses]		)
		@include('tab2')
	</main>

	<div id="overlay" class="overlay">
		<div class="overlay__wrapper">
			<div class="popup">
				<div class="popup__close"></div>
				<div class="popup__header">Выберите нужный вариант расчета:</div>
				<div class="popup__scenaries">
					<div class="popup__scenario">
						<div class="popup__scenarioInner" data-index="1">
							<div class="popup__scenarioName">Сценарий №1</div>
							<div class="popup__scenarioDesc">самолет куплен</div>
							<div class="popup__scenarioBtn">Рассчитать <span class="popup__scenarioArrow">></span></div>
						</div>
					</div>
					<div class="popup__scenario" data-index="2">
						<div class="popup__scenarioInner">
							<div class="popup__scenarioName">Сценарий №2</div>
							<div class="popup__scenarioDesc">cамолет куплен<br>в кредит</div>
							<div class="popup__scenarioBtn">Рассчитать <span class="popup__scenarioArrow">></span></div>
						</div>
					</div>
					<div class="popup__scenario">
						<div class="popup__scenarioInner" data-index="3">
							<div class="popup__scenarioName">Сценарий №3</div>
							<div class="popup__scenarioDesc">самолет взят<br>в аренду</div>
							<div class="popup__scenarioBtn">Рассчитать <span class="popup__scenarioArrow">></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ URL::asset('js/vue.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery-3.4.1.min.js') }}"></script>
	<script src="{{ URL::asset('js/slick.min.js') }}"></script>
	<script src="{{ URL::asset('js/chart.min.js') }}"></script>
	<script src="{{ URL::asset('js/jspdf.min.js') }}"></script>
	<script src="{{ URL::asset('js/html2canvas.min.js') }}"></script>

	<script src="{{ URL::asset('js/index2.min.js') }}"></script>
<script>
	let params = {};
let on = $('.header__linkToGoogleSheets').on('click',function (e) {
	e.preventDefault();
	params = {};
	$('.valueCell input').each(function(i,v){
		params[$(v).data('type')]= $(v).val();
	})
	$('td.valueCell').each(function(i,v){
		params[$(v).data('type')]= $(v).text();
	});
	let jsonparam = JSON.stringify(params);
	console.log(params.dopsummm,jsonparam );
	 $.ajax({
		url: "/generateSheet",
		method: "POST",
		type: 'POST',
		dataType:"json",
		data: params  ,
	}).done(function( msg ) {
		  location.href = msg.link;

	 }).fail(function( jqXHR, textStatus ) {
		// alert( "Request failed: " + textStatus );
	});
console.log(params)
// console.log($(v).data('type'),$(v).val())
});

</script>
</body>

</html>
