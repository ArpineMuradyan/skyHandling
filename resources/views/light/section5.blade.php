<div class="section section-5 even calculatorMain">
	<div class="aiplaneNameHeader"></div>
	<div class="tablesContainer section5-final">
		<div class="section5-inner" id="section5-inner">
			<div class="tablesContainer-1" id="table5-1">
				<table class="table5-1 tableType2 tableSumm">
					<tbody class="table">
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Укажите количество часов налета в месяц:</td>
							<td class="table__cell valueCell justify-content-end">
								<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="flying_hours" v-model.number="flying_hours_per_month" @change="inputChange" @input="flyingHoursChange" @focus="inputFocus">
							</td>
						</tr>
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Сумма переменных затрат в месяц (USD):</td>
							<td class="table__cell valueCell item value"  data-type="variable_costs_month">@{{ variable_costs_month | numberFormat }}</td>
						</tr>
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Срок проекта (лет):</td>
							<td class="table__cell valueCell item value"  data-type="lifetime_project" >@{{ lifetime | numberFormat }}</td>
						</tr>
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Срок проекта (мес.):</td>
							<td class="table__cell valueCell item value" data-type="lifetime_project12">@{{ lifetime * 12 | numberFormat }}</td>

					</tbody>
					<tfoot>
						<tr class="table__row row summWrapper">
							<td class="table__cell labelCell item text-start">
								<div class="title">Итоговая себестоимость летного часа (USD):</div>
							</td>
							<td class="table__cell valueCell item" data-type="total_costs_hour">
								<div class="summ">@{{ total_costs_hour | numberFormat }}</div>
							</td>
						</tr>
					</tfoot>
				</table>

				<table class="table5-2 tableType2 tableSumm">
					<thead class="table">
						<tr class="table__row row">
							<th class="table__th table__th-first title">Вид затрат</th>
							<th class="table__th gr item">Весь период</th>
							<th class="table__th item">Год</th>
							<th class="table__th item">Месяц</th>
							<th class="table__th item">Час</th>
						</tr>
					</thead>
					<tbody class="table">
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Капитальные затраты:</td>
							<td class="table__cell valueCell gr item value" data-type="amount_of_capital_costs" >@{{ amount_of_capital_costs | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="amount_of_capital_costsy">@{{ amount_of_capital_costs / lifetime | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="amount_of_capital_costsm">@{{ capital_costs_month | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="amount_of_capital_costsh">@{{ capital_costs_hour | numberFormat }}</td>
						</tr>
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Фиксированные затраты:</td>
							<td class="table__cell valueCell gr item value" data-type="fixed_amount_of_capital_costs"  >@{{ fixed_costs_year * lifetime | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="fixed_amount_of_capital_costsy" >@{{ fixed_costs_year | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="fixed_amount_of_capital_costsm" >@{{ fixed_costs_month | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="fixed_amount_of_capital_costsh" >@{{ fixed_costs_hour | numberFormat }}</td>
						</tr>
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Переменные затраты:</td>
							<td class="table__cell valueCell gr item value" data-type="variable_amount_of_capital_costs"  >@{{ variable_costs_month * 12 * lifetime | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="variable_amount_of_capital_costsy" >@{{ variable_costs_month * 12 | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="variable_amount_of_capital_costsm" >@{{ variable_costs_month | numberFormat }}</td>
							<td class="table__cell valueCell item value"    data-type="variable_amount_of_capital_costsh" >@{{ variable_costs_hour | numberFormat }}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="table__row summWrapper">
							<td class="table__cell labelCell item text-start">
								<div class="title">Total (USD)</div>
							</td>
							<td class="table__cell valueCell item"  data-type="total_amount_of_capital_costs"  >
								<div class="summ">@{{ total_costs | numberFormat }}</div>
							</td>
							<td class="table__cell valueCell item"  data-type="total_amount_of_capital_costsy" >
								<div class="summ">@{{ total_costs_month * 12 | numberFormat }}</div>
							</td>
							<td class="table__cell valueCell item"  data-type="total_amount_of_capital_costsm" >
								<div class="summ">@{{ total_costs_month | numberFormat }}</div>
							</td>
							<td class="table__cell valueCell item"  data-type="total_amount_of_capital_costsh" >
								<div class="summ">@{{ total_costs_hour | numberFormat }}</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="tablesContainer-2">
				<table class="table5-3 tableType2 tableSumm">
					<tbody class="table">
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Укажите % доходности с 1 летного часа:</td>
							<td class="table__cell valueCell justify-content-end">
								<input class="cellValueInput table__cellValueInput item value bordered" type="text" data-type="flying_hour_profitability" v-model.number="flying_hour_profitability" @change="inputChange" @focus="inputFocus">
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="table__row summWrapper">
							<td class="table__cell labelCell item text-start">
								<div class="title">Итоговая себестоимость летного часа (USD):</div>
							</td>
							<td class="table__cell valueCell item" data-type="revenue_from_flight_hour" >
								<div class="summ">@{{ revenue_from_flight_hour | numberFormat }}</div>
							</td>
						</tr>
					</tfoot>
				</table>

				<table class="table5-4 tableType2 tableSumm">
					<tbody class="table">
						<tr class="table__row row">
							<td class="table__cell labelCell item text-start">Итоговая стоимость летного часа (USD):</td>
							<td class="table__cell valueCell color-1 item value" data-type="total_flight_hour_cost"  >@{{ total_flight_hour_cost | numberFormat }}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="table__row summWrapper">
							<td class="table__cell labelCell color-1 item text-start">
								<div class="title">Прогнозитруемый доход в мес. (USD):</div>
							</td>
							<td class="table__cell valueCell color-1 item"  data-type="forecasted_income_month" >
								<div class="summ">@{{ forecasted_income_month | numberFormat }}</div>
							</td>
						</tr>
					</tfoot>
				</table>

				<table class="table5-5 tableType2 table">
					<tbody>
						<tr class="table__row row">
							<td class="table__cell labelCell color-1 item text-start">Прогнозируемый чистый доход в мес. (USD):</td>
							<td class="table__cell valueCell color-1 item value" data-type="predicted_net_income_month" >@{{ predicted_net_income_month | numberFormat }}</td>
						</tr>
					</tbody>
					<tfoot>
						<tr class="table__row row">
							<td class="table__cell labelCell color-1 item text-start">Точка безубыточности (мес):</td>
							<td class="table__cell valueCell color-1 item value" data-type="roi" >@{{ total_costs / forecasted_income_month | numberFormat }}</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="section5-charts">
				<div class="chartMonthsWrapper">
					<canvas id="chartMonths"></canvas>
				</div>
			</div>
			<div class="section5-charts">
				<div class="chartWrapper">
					<canvas id="chartYears" width="900" height="300"></canvas>
				</div>
			</div>
		</div>


		<div style="display:none;">
			<div class="tableAllExpenses">
				<div class="row tableHeader">
					<div class="labelCell">Затраты:</div>
					<div class="cell">Весь Период</div>
					<div class="cell">Год</div>
					<div class="cell">Месяц</div>
					<div class="cell">Час</div>
				</div>
				<div class="row">
					<div class="labelCell">Капитальные затраты:</div>
					<div class="cell bg64 color2">@{{ amount_of_capital_costs | numberFormat }}</div>
					<div class="cell bg64">@{{ amount_of_capital_costs / lifetime | numberFormat }}</div>
					<div class="cell bg64">@{{ capital_costs_month | numberFormat }}</div>
					<div class="cell">@{{ capital_costs_hour | numberFormat }}</div>
				</div>
				<div class="row">
					<div class="labelCell">Фиксированные затраты:</div>
					<div class="cell bg64 color2">@{{ fixed_costs_year * lifetime | numberFormat }}</div>
					<div class="cell bg64">@{{ fixed_costs_year | numberFormat }}</div>
					<div class="cell bg64">@{{ fixed_costs_month | numberFormat }}</div>
					<div class="cell">@{{ fixed_costs_hour | numberFormat }}</div>
				</div>
				<div class="row">
					<div class="labelCell">Переменные затраты:</div>
					<div class="cell bg64">@{{ variable_costs_month * 12 * lifetime | numberFormat }}</div>
					<div class="cell bg64">@{{ variable_costs_month * 12 | numberFormat }}</div>
					<div class="cell bg64 color2">@{{ variable_costs_month | numberFormat }}</div>
					<div class="cell">@{{ variable_costs_hour | numberFormat }}</div>
				</div>
				<div class="row tableFooter">
					<div class="labelCell cell">Total (USD)</div>
					<div class="cell color1">@{{ total_costs | numberFormat }}</div>
					<div class="cell">@{{ total_costs_month * 12 | numberFormat }}</div>
					<div class="cell">@{{ total_costs_month | numberFormat }}</div>
					<div class="cell color1">@{{ total_costs_hour | numberFormat }}</div>
				</div>
			</div>
			<div class="reportTableWrapper">
				<div class="reportTable">
					<div class="row bb thead">
						<div class="cell">№ Периода (месяц)</div>
						<div class="cell">Capital</div>
						<div class="cell">Fixed</div>
						<div class="cell">Variable</div>
						<div class="cell">Profit</div>
						<div class="cell">Total Balance</div>
						<div class="cell">Status</div>
					</div>
					<div class="row bb">
						<div class="cell">0</div>
						<div class="cell">@{{amount_of_capital_costs | numberFormat}}</div>
						<div class="cell">@{{fixed_costs_year * lifetime | numberFormat}}</div>
						<div class="cell">@{{variable_costs_month * 12 * lifetime | numberFormat}}</div>
						<div class="cell">@{{predicted_net_income_month * 12 * lifetime | numberFormat}}</div>
						<div class="cell">@{{-total_costs | numberFormat}}</div>
						<div class="cell"></div>
					</div>
					<div class="row" v-for="(value, i) in table1Data">
						<div class="cell">@{{ i + 1 }}</div>
						<div class="cell bg90">@{{ capital_costs_month | numberFormat }}</div>
						<div class="cell bg90">@{{ fixed_costs_month | numberFormat }}</div>
						<div class="cell bg90">@{{ variable_costs_month | numberFormat }}</div>
						<div class="cell bg90">@{{ predicted_net_income_month | numberFormat }}</div>
						<div class="cell">@{{ value | numberFormat }}</div>
						<div class="cell" :class="statusColor(value)">@{{ value <= 0 ? 'Negative' : 'Positive' }}</div>
					</div>
				</div>
				<div class="reportTable">
					<div class="row bb thead">
						<div class="cell">№ Периода (месяц)</div>
						<div class="cell">Окупаемость по додам</div>
					</div>
					<div class="row" v-for="(value, i) in table2Data">
						<div class="cell">@{{ i  }}</div>
						<div class="cell bg90">@{{ value | numberFormat }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="prnt_pdf"></div>
