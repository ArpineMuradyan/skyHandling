<div class="section section-4 odd">
	<div class="aiplaneNameHeader"></div>
	<div class="tablesContainer section4-inner" id="section4-inner">
		<div class="tablesContainer__left">
			<table class="tableFlightData tableType1 table">
				<thead>
					<tr class="table__row">
						<th class="table__th" colspan="2">Данные о рейсе:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row">
						<td class="table__cell labelCell">Укажите дальность маршрута (km):</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="route_distance" v-model.number="route_distance" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Стоимость аеропортовых сервисов (USD):</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="airport_services_cost" v-model.number="airport_services_cost" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Укажите стоимость топлива (USD/litr):</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="fuel_cost" v-model.number="fuel_cost" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>

				</tbody>
			</table>

			<table class="tableRecyclingProgram tableType1 table">
				<thead>
					<tr class="table__row">
						<th class="table__th" colspan="2">Программа утилизации</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row">
						<td class="table__cell labelCell">Двигатель (за лётный час)</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="engine_hour_price" v-model.number="engine_hour_price" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Авионика (за лётный час)</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="avionics_hour_price" v-model.number="avionics_hour_price" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Планер (за лётный час)</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="glider_hour_price" v-model.number="glider_hour_price" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>

				</tbody>
			</table>

			<table class="tableFlightExpenses tableType2 table">
				<thead>
					<tr class="table__row">
						<th class="table__th table__th-first" colspan="2">Затраты на совершение рейса:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row">
						<td class="table__cell labelCell">Длительность полета (minutes):</td>
						<td class="table__cell valueCell" data-type="duration_summ">@{{ duration_summ | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Стоимость навигационных затрат (USD):</td>
						<td class="table__cell valueCell" data-type="aeroNavigation_summ">@{{ aeroNavigation_summ | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Стоимость топлива (USD):</td>
						<td class="table__cell valueCell" data-type="fuel_need_summ_fuel_cost">@{{ fuel_need_summ * fuel_cost | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Стоимость аеропортовых сервисов (USD):</td>
						<td class="table__cell valueCell" data-type="airport_services_cost">@{{ airport_services_cost | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Программа утилизации (USD):</td>
						<td class="table__cell valueCell" data-type="utilization_programm">@{{ utilization_programm | numberFormat }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="table__row">
						<td class="table__cell labelCell br-lb">Стоимость всего полета (USD):</td>
						<td class="table__cell valueCell br-rb" data-type="flight_cost">@{{ flight_cost | numberFormat }}</td>
					</tr>
					<tr class="table__row table__row-second">
						<td class="table__cell labelCell">Стоимость часа полета (USD):</td>
						<td class="table__cell valueCell" data-type="flight_hour_cost">@{{ flight_hour_cost | numberFormat }}</td>
					</tr>
				</tfoot>
			</table>
		</div>

		<div class="tablesContainer__right">
			<table class="tableNavigationVosts tableType2 table">
				<thead>
					<tr class="table__row">
						<th class="table__th table__th-first" colspan="2">Навигационные затраты:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row">
						<td class="table__cell labelCell">AeroNavigation_R:</td>
						<td class="table__cell valueCell">@{{ aeroNavigation_R | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell br-lb">AeroNavigation_r:</td>
						<td class="table__cell valueCell br-rb">@{{ aeroNavigation_r | numberFormat }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="table__row">
						<td class="table__cell labelCell">Total (USD)</td>
						<td class="table__cell valueCell">@{{ aeroNavigation_summ | numberFormat }}</td>
					</tr>
				</tfoot>
			</table>

			<table class="tableCruiseModeTechInfo tableType1 table">
				<thead>
					<tr class="table__row">
						<th class="table__th" colspan="2">Техническая информация по судну в режиме круиза:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row">
						<td class="table__cell labelCell">Max. круизная скорость (km/h):</td>
						<td class="table__cell valueCell">@{{ normal_cruising_speed | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Дальность полета при полной загрузке</td>
						<td class="table__cell valueCell">@{{ practical_range | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Потребление топлива в круизе (litr/100km):</td>
						<td class="table__cell valueCell">@{{ fuel_consum_km | numberFormat }}</td>
					</tr>
				</tbody>
			</table>

			<table class="tableRequiredFuelAmount tableType2 table">
				<thead>
					<tr class="table__row">
						<th class="table__th table__th-first br-rt" colspan="5">Таблица рассчета кол. топлива для совершения рейса</th>
						<th class="table__th modCell2"></th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row bg-transparent">
						<td class="table__cell labelCell"></td>
						<td class="table__cell labelCell">WarmUp&Navi</td>
						<td class="table__cell labelCell">Take-Off</td>
						<td class="table__cell labelCell">Cruise</td>
						<td class="table__cell labelCell">Landing</td>
						<td class="table__cell labelCell modCell1 br-rt">Total</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Engine Load %:</td>
						<td class="table__cell valueCell" data-type="warm_up_nav" >@{{ warm_up_nav | numberFormat }}%</td>
						<td class="table__cell valueCell" data-type="take_off" >@{{ take_off | numberFormat }}%</td>
						<td class="table__cell valueCell" data-type="cruise" >@{{ cruise | numberFormat }}%</td>
						<td class="table__cell valueCell" data-type="landing" >@{{ landing | numberFormat }}%</td>
						<td class="table__cell valueCell modCell1" data-type="engine_load_summ" >@{{ engine_load_summ | numberFormat }}%</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Duration, min:</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="duration_warm_up" v-model.number="duration_warm_up" @change="inputChange" @focus="inputFocus">
						</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="duration_take_off" v-model.number="duration_take_off" @change="inputChange" @focus="inputFocus">
						</td>
						<td class="table__cell valueCell"  data-type="duration_cruise" >@{{ duration_cruise | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="duration_landing" >@{{ duration_landing | numberFormat }}</td>
						<td class="table__cell valueCell modCell1"  data-type="duration_summ" >@{{ duration_summ | numberFormat }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell br-lb">Fuel Needed Litres:</td>
						<td class="table__cell valueCell"  data-type="fuel_need_warm_up">@{{ fuel_need_warm_up | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="fuel_need_take_off">@{{ fuel_need_take_off | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="fuel_need_cruise">@{{ fuel_need_cruise | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="fuel_need_landing">@{{ fuel_need_landing | numberFormat }}</td>
						<td class="table__cell valueCell modCell1 br-rb" data-type="fuel_need_summ" >@{{ fuel_need_summ | numberFormat }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="table__row">
						<td class="table__cell labelCell">Total (USD)</td>
						<td class="table__cell valueCell"  data-type="fuel_need_warm_up_fuel_cost" >@{{ fuel_need_warm_up * fuel_cost | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="fuel_need_take_off_fuel_cost" >@{{ fuel_need_take_off * fuel_cost | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="fuel_need_cruise_fuel_cost" >@{{ fuel_need_cruise * fuel_cost | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="fuel_need_landing_fuel_cost" >@{{ fuel_need_landing * fuel_cost | numberFormat }}</td>
						<td class="table__cell valueCell"  data-type="fuel_need_summ_fuel_cost" >@{{ fuel_need_summ * fuel_cost | numberFormat }}</td>
					</tr>
				</tfoot>
			</table>
		</div>
		
	</div>

</div>