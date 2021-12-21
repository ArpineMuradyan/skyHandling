<div class="section section-2 section  odd">
	<div class="aiplaneNameHeader"></div>
	<div class="tablesContainer">

		<div class="tablesContainerInner section2-inner" id="section2-inner">
			<table class="tableLifetime tableType1 table">
				<thead>
					<tr class="table__row">
						<th class="table__th" colspan="2">Срок експлуатации самолета:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row">
						<td class="table__cell labelCell">Планируемый срок експлуатации (лет):</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" :class="{errorValue: isCorrectExpluatation}" type="text" data-type="lifetime" v-model.number="lifetime" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Конечный год експлуатации:</td>
						<td class="table__cell valueCell" data-type="end_lifetime" >@{{ end_expluatation_year }}</td>
					</tr>
				</tbody>
			</table>
	
			<table class="tableDepreciationDynamics tableType1 table">
				<thead>
					<tr class="table__row">
						<th class="table__th" colspan="2">Динамика амортизации судна:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table__row">
						<td class="table__cell labelCell">Укажите суммарный % амортизации:</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="depreciation_percentage" v-model.number="depreciation_percentage" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Укажите период амортизации:</td>
						<td class="table__cell valueCell">
							<input class="cellValueInput table__cellValueInput" type="text" data-type="depreciation_period" v-model.number="depreciation_period" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Конечный год макc. еффекта утилизации:</td>
						<td class="table__cell valueCell" data-type="end_effective_year" >@{{ end_effective_year }}</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Max. еффект в год:</td>
						<td class="table__cell valueCell" data-type="max_effect_per_year" >@{{ max_effect_per_year | numberFormat }}%</td>
					</tr>
					<tr class="table__row">
						<td class="table__cell labelCell">Еффект в год:</td>
						<td class="table__cell valueCell" data-type="effect_per_year" >@{{ effect_per_year | numberFormat }}%</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
</div>