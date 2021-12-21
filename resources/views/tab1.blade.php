<div id="tab1" class="tab tab1">
	<div class="mainTableBtns">
		<div id="buttonAdd" class="mainTableButton" @click="addAirplane">
			<div class="mainTableButton-add"></div>
		</div>
		<div id="buttonEdit" class="mainTableButton" @click="tableEdit">
			<div class="mainTableButton-edit"></div>
		</div>
		<div id="buttonBack" class="mainTableButton" @click="removeAirplane">
			<div class="mainTableButton-remove"></div>
		</div>
	</div>

	<input type="hidden"  id="curs-USD" value="{{$courses['USD']['sale']}}">
	<input type="hidden"  id="curs-EUR" value="{{$courses['EUR']['sale']}}">
	<div class="mainTableWrapper">
		<table id="mainTable" class="mainTable">
			<tbody>
				<tr class="mainTable__row">
					<td class="mainTable__imgHeaderCell"></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">Aircraft name</div></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">Год выпуска</div></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">Стоимость, USD</div></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">MTOW (kg)</div></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">Avr. Years<br> of Service</div></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">Вес топлива<br> (litres)</div></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">Нормальная<br> крейсерская<br> скорость (km/h)</div></td>
					<td class="mainTable__th color-1"><div class="mainTable__thContainer">Практическая<br> дальность (km):</div></td>
					<td class="mainTable__th color-2"><div class="mainTable__thContainer">Warm Up & <br>Navigations</div></td>
					<td class="mainTable__th color-2"><div class="mainTable__thContainer">Take-Off</div></td>
					<td class="mainTable__th color-2"><div class="mainTable__thContainer">Cruise</div></td>
					<td class="mainTable__th color-2"><div class="mainTable__thContainer">Landing</div></td>
					<td class="mainTable__th color-3"><div class="mainTable__thContainer">Fuel Consumption in<br> Cruise Speed litr/100km</div></td>
					<td class="mainTable__th color-3"><div class="mainTable__thContainer">Fuel Consumption in<br> Cruise Speed litr/hour</div></td>
				</tr>
				<tr class="mainTable__row mainTable__rowAirplane" :class="{active:i == selected}" v-for="(airplane, i) in airplanes" :data-index="airplane.id" @click="setActive(i, $event)">
					<td class="mainTable__imgCell">
						<div class="mainTable__photo"></div>
					</td>
					<td class="mainTable__aName">
						<div class="mainTable__aNameWrapper" v-show="!isEditing">
							<label class="cellValue">@{{ airplane.name }}</label>
							<div class="mainTable__arrow" :data-index="i" @click="getScenaries"></div>
						</div>

						<input class="cellValueInput" type="text" data-type="name"
							v-model.trim="airplane.name" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.year }}</label>
						<input class="cellValueInput" type="text" data-type="year"
							v-model.number="airplane.year" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.price | numberFormat }}</label>
						<input class="cellValueInput" type="text" data-type="price"
							v-model.number="airplane.price" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.mtow | numberFormat }}</label>
						<input class="cellValueInput" type="text" data-type="mtow"
							v-model.number="airplane.mtow" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.avr_years_service | numberFormat }}</label>
						<input class="cellValueInput" type="text" data-type="avr_years_service"
							v-model.number="airplane.avr_years_service" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.fuel_weight | numberFormat }}</label>
						<input class="cellValueInput" type="text" data-type="fuel_weight"
							v-model.number="airplane.fuel_weight" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.normal_cruising_speed | numberFormat }}</label>
						<input class="cellValueInput" type="text" data-type="normal_cruising_speed"
							v-model.number="airplane.normal_cruising_speed" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.practical_range | numberFormat }}</label>
						<input class="cellValueInput" type="text" data-type="practical_range"
							v-model.number="airplane.practical_range" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.warm_up_nav | numberFormat }}%</label>
						<input class="cellValueInput" type="text" data-type="warm_up_nav"
							v-model.number="airplane.warm_up_nav" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.take_off | numberFormat }}%</label>
						<input class="cellValueInput" type="text" data-type="take_off"
							v-model.number="airplane.take_off" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.cruise | numberFormat }}%</label>
						<input class="cellValueInput" type="text" data-type="cruise"
							v-model.number="airplane.cruise" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.landing | numberFormat }}%</label>
						<input class="cellValueInput" type="text" data-type="landing"
							v-model.number="airplane.landing" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="mainTable__cell headBg-1 third">
						@{{ (airplane.fuel_weight * 100 / airplane.practical_range) | numberFormat }}</td>
					<td class="mainTable__cell headBg-1 third">
						@{{ (airplane.normal_cruising_speed * airplane.fuel_weight / airplane.practical_range) | numberFormat }}
					</td>
				</tr>
			</tbody>
		</table>
	</div>


</div>
