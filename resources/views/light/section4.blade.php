<div class="section section-4 odd calculatorMain">
	<div class="aiplaneNameHeader"></div>
	<div class="tablesContainer section4-inner" id="section4-inner">
		<div class="tablesContainer__left">
			<table class="tableFlightData tableType1 table">
				<thead>
					<tr class="table__row row">
						<th class="table__th title" colspan="2">Данные о рейсе:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row row">
						<td class="table__cell labelCell item">Укажите дальность маршрута (km):</td>
						<td class="table__cell valueCell justify-content-end">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="route_distance" v-model.number="route_distance" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item">Стоимость аеропортовых сервисов (USD):</td>
						<td class="table__cell valueCell justify-content-end">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="airport_services_cost" v-model.number="airport_services_cost" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item">Укажите стоимость топлива (USD/litr):</td>
						<td class="table__cell valueCell justify-content-end">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="fuel_cost" v-model.number="fuel_cost" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>

				</tbody>
			</table>

			<table class="tableRecyclingProgram tableType1 table">
				<thead>
					<tr class="table__row row">
						<th class="table__th title" colspan="2">Программа утилизации</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row row">
						<td class="table__cell labelCell item">Двигатель (за лётный час)</td>
						<td class="table__cell valueCell justify-content-end">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="engine_hour_price" v-model.number="engine_hour_price" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item">Авионика (за лётный час)</td>
						<td class="table__cell valueCell justify-content-end">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="avionics_hour_price" v-model.number="avionics_hour_price" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item">Планер (за лётный час)</td>
						<td class="table__cell valueCell justify-content-end">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="glider_hour_price" v-model.number="glider_hour_price" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>

				</tbody>
			</table>

			<table class="tableFlightExpenses tableType2 tableSumm">
				<thead class="table">
					<tr class="table__row row">
						<th class="table__th table__th-first title th" colspan="2">Затраты на совершение рейса:</th>
					</tr>
				</thead>
				<tbody class="table">
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Длительность полета (minutes):</td>
						<td class="table__cell valueCell item value" data-type="duration_summ">@{{ duration_summ | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Стоимость навигационных затрат (USD):</td>
						<td class="table__cell valueCell item value" data-type="aeroNavigation_summ">@{{ aeroNavigation_summ | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Стоимость топлива (USD):</td>
						<td class="table__cell valueCell item value" data-type="fuel_need_summ_fuel_cost">@{{ fuel_need_summ * fuel_cost | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Стоимость аеропортовых сервисов (USD):</td>
						<td class="table__cell valueCell item value" data-type="airport_services_cost">@{{ airport_services_cost | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Программа утилизации (USD):</td>
						<td class="table__cell valueCell item value" data-type="utilization_programm">@{{ utilization_programm | numberFormat }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="table__row row summWrapper bordered">
						<td class="table__cell labelCell br-lb item">
							<div class="title text-start">Стоимость всего полета (USD):</div>
						</td>
						<td class="table__cell valueCell br-rb item" data-type="flight_cost">
							<div class="summ">@{{ flight_cost | numberFormat }}</div>
						</td>
					</tr>
					<tr class="table__row table__row-second row summWrapper">
						<td class="table__cell labelCell item text-start">
							<div class="title">Стоимость часа полета (USD):</div>
						</td>
						<td class="table__cell valueCell item" data-type="flight_hour_cost">
							<div class="summ">@{{ flight_hour_cost | numberFormat }}</div>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="tablesContainer__right">
			<table class="tableNavigationVosts tableType2 tableSumm">
				<thead class="table">
					<tr class="table__row row">
						<th class="table__th table__th-first title th" colspan="3">Навигационные затраты:</th>
					</tr>
				</thead>
				<tbody class="table">
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">AeroNavigation_R:</td>
						<td class="table__cell valueCell item value">@{{ aeroNavigation_R | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell br-lb item text-start">AeroNavigation_r:</td>
						<td class="table__cell valueCell br-rb item value">@{{ aeroNavigation_r | numberFormat }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="table__row row summWrapper">
						<td class="table__cell labelCell item">
							<div class="title text-start">Total (USD)</div>
						</td>
						<td class="table__cell valueCell item">
							<div class="summ">@{{ aeroNavigation_summ | numberFormat }}</div>
						</td>
					</tr>
				</tfoot>
			</table>

			<table class="tableCruiseModeTechInfo tableType2 table">
				<thead>
					<tr class="table__row row">
						<th class="table__th title text-start th" colspan="2">Техническая информация по судну в режиме круиза:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Max. круизная скорость (km/h):</td>
						<td class="table__cell valueCell item value">@{{ normal_cruising_speed | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Дальность полета при полной загрузке</td>
						<td class="table__cell valueCell item value">@{{ practical_range | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Потребление топлива в круизе (litr/100km):</td>
						<td class="table__cell valueCell item value">@{{ fuel_consum_km | numberFormat }}</td>
					</tr>
				</tbody>
			</table>

			<table class="tableRequiredFuelAmount tableType2 tableSumm">
				<thead class="table">
					<tr class="table__row row">
						<th class="table__th table__th-first br-rt title th" colspan="5">Таблица рассчета кол. топлива для совершения рейса</th>
						<th class="table__th modCell2"></th>
					</tr>
				</thead>
				<tbody class="table">
					<tr class="table__row bg-transparent row">
						<td class="table__cell labelCell item"></td>
						<td class="table__cell labelCell item">WarmUp&Navi</td>
						<td class="table__cell labelCell item">Take-Off</td>
						<td class="table__cell labelCell item">Cruise</td>
						<td class="table__cell labelCell item">Landing</td>
						<td class="table__cell labelCell modCell1 br-rt item">Total</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Engine Load %:</td>
						<td class="table__cell valueCell item value" data-type="warm_up_nav" >@{{ warm_up_nav | numberFormat }}%</td>
						<td class="table__cell valueCell item value" data-type="take_off" >@{{ take_off | numberFormat }}%</td>
						<td class="table__cell valueCell item value" data-type="cruise" >@{{ cruise | numberFormat }}%</td>
						<td class="table__cell valueCell item value" data-type="landing" >@{{ landing | numberFormat }}%</td>
						<td class="table__cell valueCell modCell1 item value" data-type="engine_load_summ" >@{{ engine_load_summ | numberFormat }}%</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell item text-start">Duration, min:</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="duration_warm_up" v-model.number="duration_warm_up" @change="inputChange" @focus="inputFocus">
						</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="duration_take_off" v-model.number="duration_take_off" @change="inputChange" @focus="inputFocus">
						</td>
						<td class="table__cell valueCell item value"  data-type="duration_cruise" >@{{ duration_cruise | numberFormat }}</td>
						<td class="table__cell valueCell item value"  data-type="duration_landing" >@{{ duration_landing | numberFormat }}</td>
						<td class="table__cell valueCell modCell1 item value"  data-type="duration_summ" >@{{ duration_summ | numberFormat }}</td>
					</tr>
					<tr class="table__row row">
						<td class="table__cell labelCell br-lb item text-start">Fuel Needed Litres:</td>
						<td class="table__cell valueCell item value"  data-type="fuel_need_warm_up">@{{ fuel_need_warm_up | numberFormat }}</td>
						<td class="table__cell valueCell item value"  data-type="fuel_need_take_off">@{{ fuel_need_take_off | numberFormat }}</td>
						<td class="table__cell valueCell item value"  data-type="fuel_need_cruise">@{{ fuel_need_cruise | numberFormat }}</td>
						<td class="table__cell valueCell item value"  data-type="fuel_need_landing">@{{ fuel_need_landing | numberFormat }}</td>
						<td class="table__cell valueCell modCell1 br-rb item value" data-type="fuel_need_summ" >@{{ fuel_need_summ | numberFormat }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="table__row row summWrapper">
						<td class="table__cell labelCell item">
							<div class="title text-start">Total (USD)
						</td>
						<td class="table__cell valueCell item"  data-type="fuel_need_warm_up_fuel_cost" >
							<div class="summ">@{{ fuel_need_warm_up * fuel_cost | numberFormat }}</div>
						</td>
						<td class="table__cell valueCell item"  data-type="fuel_need_take_off_fuel_cost" >
							<div class="summ">@{{ fuel_need_take_off * fuel_cost | numberFormat }}</div>
						</td>
						<td class="table__cell valueCell item"  data-type="fuel_need_cruise_fuel_cost" >
							<div class="summ">@{{ fuel_need_cruise * fuel_cost | numberFormat }}</div>
						</td>
						<td class="table__cell valueCell item"  data-type="fuel_need_landing_fuel_cost" >
							<div class="summ">@{{ fuel_need_landing * fuel_cost | numberFormat }}</div>
						</td>
						<td class="table__cell valueCell item"  data-type="fuel_need_summ_fuel_cost" >
							<div class="summ">@{{ fuel_need_summ * fuel_cost | numberFormat }}</div>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>

	</div>

</div>
