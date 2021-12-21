<div class="section section-3 even">
	<div class="aiplaneNameHeader"></div>
	<div class="tablesContainer section3-inner" id="section3-inner">
		<table class="tableCrewSalary tableType2 table">
			<thead>
				<tr class="table__row">
					<th class="table__th table__th-first">Зарплата экипажа</th>
					<th class="table__th">Год</th>
					<th class="table__th">Месяц</th>
					<th class="table__th">Час</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table__row">
					<td class="table__cell labelCell">Командир №1</td>
					<td class="table__cell valueCell" data-type="salary_leader112">@{{ (salary_leader1 * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="salary_leader1" v-model.number="salary_leader1" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="salary_leader1h">@{{ (salary_leader1 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Командир №2</td>
					<td class="table__cell valueCell" data-type="salary_leader212">@{{ (salary_leader2 * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="salary_leader2" v-model.number="salary_leader2" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="salary_leader2h">@{{ (salary_leader2 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">2-й Пилот</td>
					<td class="table__cell valueCell" data-type="salary_pilot212">@{{ (salary_pilot2 * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="salary_pilot2" v-model.number="salary_pilot2" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="salary_pilot2h">@{{ (salary_pilot2 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Проводник</td>
					<td class="table__cell valueCell" data-type="salary_conductor12">@{{ (salary_conductor * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="salary_conductor" v-model.number="salary_conductor" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="salary_conductorh">@{{ (salary_conductor / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell br-lb">Инженер</td>
					<td class="table__cell valueCell" data-type="salary_engineer12">@{{ (salary_engineer * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="salary_engineer" v-model.number="salary_engineer" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell br-rb"  data-type="salary_engineerh">@{{ (salary_engineer / flying_hours_per_month) | numberFormat }}</td>
				</tr>
			</tbody>
			<tfoot>
				<tr class="table__row">
					<td class="table__cell labelCell">Total (USD)</td>
					<td class="table__cell valueCell" data-type="salarySum12" >@{{ (salarySum * 12) | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="salarySum"   >@{{ salarySum | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="salarySumh" >@{{ (salarySum / flying_hours_per_month) | numberFormat }}</td>
				</tr>
			</tfoot>
		</table>

		<table class="tableInsurance tableType2 table">
			<thead>
				<tr class="table__row">
					<th class="table__th table__th-first">Страховка</th>
					<th class="table__th">Год</th>
					<th class="table__th">Месяц</th>
					<th class="table__th">Час</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table__row">
					<td class="table__cell labelCell">Ответственность 3-х лиц</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="insurance_responsibility" v-model.number="insurance_responsibility" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="insurance_responsibilitym"  >@{{ (insurance_responsibility / 12) | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="insurance_responsibilityh" >@{{ (insurance_responsibility / 12 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Экипаж</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="insurance_crew" v-model.number="insurance_crew" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell"  data-type="insurance_crewm">@{{ (insurance_crew / 12) | numberFormat }}</td>
					<td class="table__cell valueCell"  data-type="insurance_crewh">@{{ (insurance_crew / 12 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">КАСКО</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="insurance_kasko" v-model.number="insurance_kasko" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell"  data-type="insurance_kaskom" >@{{ (insurance_kasko / 12) | numberFormat }}</td>
					<td class="table__cell valueCell"  data-type="insurance_kaskoh" >@{{ (insurance_kasko / 12 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Франшиза</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="insurance_franchise" v-model.number="insurance_franchise" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell"  data-type="insurance_franchisem" >@{{ (insurance_franchise / 12) | numberFormat }}</td>
					<td class="table__cell valueCell"  data-type="insurance_franchiseh" >@{{ (insurance_franchise / 12 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">AirCraft Service</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="insurance_aircraft_service" v-model.number="insurance_aircraft_service" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="insurance_aircraft_servicem">@{{ (insurance_aircraft_service / 12) | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="insurance_aircraft_serviceh">@{{ (insurance_aircraft_service / 12 / flying_hours_per_month) | numberFormat }}</td>
				</tr>

			</tbody>
			<tfoot>
				<tr class="table__row">
					<td class="table__cell labelCell">Total (USD)</td>
					<td class="table__cell valueCell"  data-type="insuranceSum12">@{{ insuranceSum | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="insuranceSumm">@{{ (insuranceSum / 12) | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="insuranceSumh">@{{ (insuranceSum / 12 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
			</tfoot>
		</table>

		<table class="tableCrewSalary tableType2 table">
			<thead>
				<tr class="table__row">
					<th class="table__th table__th-first">Дополнительные расходы</th>
					<th class="table__th">Год</th>
					<th class="table__th">Месяц</th>
					<th class="table__th">Час</th>
				</tr>
			</thead>
			<tbody>
				<tr class="table__row">
					<td class="table__cell labelCell">Аэронавигационные карты:</td>
					<td class="table__cell valueCell" data-type="nav_aeronautical_charts12">@{{ (nav_aeronautical_charts * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_aeronautical_charts" v-model.number="nav_aeronautical_charts" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="nav_aeronautical_chartsh">@{{ (nav_aeronautical_charts / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Поддержание летной годности</td>
					<td class="table__cell valueCell" data-type="nav_airworthiness12">@{{ (nav_airworthiness * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_airworthiness" v-model.number="nav_airworthiness" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="nav_airworthinessh">@{{ (nav_airworthiness / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Программа планирования</td>
					<td class="table__cell valueCell" data-type="nav_planning_program12">@{{ (nav_planning_program * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_planning_program" v-model.number="nav_planning_program" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="nav_planning_programh">@{{ (nav_planning_program / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Связь</td>
					<td class="table__cell valueCell" data-type="nav_communication12">@{{ (nav_communication * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_communication" v-model.number="nav_communication" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="nav_communicationh">@{{ (nav_communication / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Менеджмент:</td>
					<td class="table__cell valueCell" data-type="nav_management12">@{{ (nav_management * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_management" v-model.number="nav_management" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="nav_managementh">@{{ (nav_management / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Суточные, поездки, проживание:</td>
					<td class="table__cell valueCell" data-type="nav_daily_travel_accommodation12">@{{ (nav_daily_travel_accommodation * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_daily_travel_accommodation" v-model.number="nav_daily_travel_accommodation" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="nav_daily_travel_accommodationh">@{{ (nav_daily_travel_accommodation / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell">Crue training (v1)</td>
					<td class="table__cell valueCell" data-type="nav_crue_training12">@{{ (nav_crue_training * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_crue_training" v-model.number="nav_crue_training" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell" data-type="nav_crue_trainingh">@{{ (nav_crue_training / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row">
					<td class="table__cell labelCell br-lb">Crue training (v2)</td>
					<td class="table__cell valueCell" data-type="nav_crue_training212">@{{ (nav_crue_training2 * 12) | numberFormat }}</td>
					<td class="table__cell valueCell">
						<input class="cellValueInput table__cellValueInput" type="text" data-type="nav_crue_training2" v-model.number="nav_crue_training2" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="table__cell valueCell br-rb" data-type="nav_crue_training2h">@{{ (nav_crue_training2 / flying_hours_per_month) | numberFormat }}</td>
				</tr>
			</tbody>
			<tfoot>
				<tr class="table__row">
					<td class="table__cell labelCell br-lb">Total (USD)</td>
					<td class="table__cell valueCell" data-type="navSum12" >@{{ (navSum * 12) | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="navSumm" >@{{ navSum | numberFormat }}</td>
					<td class="table__cell valueCell br-rb" data-type="navSumh">@{{ (navSum / flying_hours_per_month) | numberFormat }}</td>
				</tr>
				<tr class="table__row table__row-second">
					<td class="table__cell labelCell">Grate Total (USD)</td>
					<td class="table__cell valueCell" data-type="dopsumm12" >@{{ grate_total_year | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="dopsummm" >@{{ (salarySum + (insuranceSum / 12) + navSum ) | numberFormat }}</td>
					<td class="table__cell valueCell" data-type="dopsummh" >@{{ ((salarySum + (insuranceSum / 12) + navSum ) / flying_hours_per_month) | numberFormat }}</td>
				</tr>
			</tfoot>
		</table>
	</div>

</div>