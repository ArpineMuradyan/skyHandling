<div class="section section-2 section  odd">
	<div class="aiplaneNameHeader"></div>
	<div class="tablesContainer">
		<div class="calculatorMain">
		
		<div class="tablesContainerInner section2-inner" id="section2-inner">
			<table class="tableLifetime tableType1 table">
				<thead>
					<tr class="row">
						<th class="title" colspan="2">Срок експлуатации самолета:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="row">
						<td class="item">Планируемый срок експлуатации (лет):</td>
						<td>
							<input class="item value bordered" :class="{errorValue: isCorrectExpluatation}" type="text" data-type="lifetime" v-model.number="lifetime" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="row">
						<td class="item">Конечный год експлуатации:</td>
						<td class="item value" data-type="end_lifetime" >@{{ end_expluatation_year }}</td>
					</tr>
				</tbody>
			</table>

			<table class="tableDepreciationDynamics tableType1 table">
				<thead>
					<tr class="row">
						<th class="title" colspan="2">Динамика амортизации судна:</th>
					</tr>
				</thead>
				<tbody>
					<tr class="row">
						<td class="item">Укажите суммарный % амортизации:</td>
						<td>
							<input class="item value bordered" type="text" data-type="depreciation_percentage" v-model.number="depreciation_percentage" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="row">
						<td class="item">Укажите период амортизации:</td>
						<td>
							<input class="item value bordered" type="text" data-type="depreciation_period" v-model.number="depreciation_period" @change="inputChange" @focus="inputFocus">
						</td>
					</tr>
					<tr class="row">
						<td class="item">Конечный год макc. еффекта утилизации:</td>
						<td class="item value" data-type="end_effective_year" >@{{ end_effective_year }}</td>
					</tr>
					<tr class="row">
						<td class="item">Max. еффект в год:</td>
						<td class="item value" data-type="max_effect_per_year" >@{{ max_effect_per_year | numberFormat }}%</td>
					</tr>
					<tr class="row">
						<td class="item">Еффект в год:</td>
						<td class="item value" data-type="effect_per_year" >@{{ effect_per_year | numberFormat }}%</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	</div>
</div>
