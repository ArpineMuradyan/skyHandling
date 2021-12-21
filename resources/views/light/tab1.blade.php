<div id="tab1" class="tab tab1">
	<!-- <div class="mainTableBtns">
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
	<div class="mainTableWrapper"> -->
	<div class="mainList">
		<div class="container">
	<div class="tableWrapper">
		<div class="topWrapper">
			<div class="inputWrapper">
				<input type="text" class="searchInput" placeholder="Search" />
			</div>
			<div class="d-flex">
				<div id="buttonAdd" class="addAircraftWrapper mr-10"  @click="addAirplane">
					<div class="icon">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="25"
							height="47"
							viewBox="0 0 25 47"
						>
							<text
								id="_"
								data-name="+"
								transform="translate(0 38)"
								fill="#9095a8"
								font-size="35.637"
								font-family="SegoeUI, Segoe UI"
							>
								<tspan x="0" y="0">+</tspan>
							</text>
						</svg>
					</div>
					<div class="name">Add aircraft</div>
				</div>
				<div id="buttonEdit" class="addAircraftWrapper mr-10"  @click="tableEdit">
					<div class="icon">
						<svg
							xmlns="http://www.w3.org/2000/svg"
							width="16"
							height="16"
							fill="#9095A8"
							class="bi bi-gear-fill"
							viewBox="0 0 16 16">
						  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
						</svg>
						<!-- <svg
							xmlns="http://www.w3.org/2000/svg"
							width="25"
							height="47"
							viewBox="0 0 25 47"
						>
							<text
								id="_"
								data-name="+"
								transform="translate(0 38)"
								fill="#9095a8"
								font-size="35.637"
								font-family="SegoeUI, Segoe UI"
							>
								<tspan x="0" y="0">+</tspan>
							</text>
						</svg> -->
					</div>
					<div class="name">Edit aircraft</div>
				</div>
				<div id="buttonBack" class="addAircraftWrapper"  @click="removeAirplane">
				<div class="icon">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="16"
						height="16"
						fill="#9095A8"
						class="bi bi-x"
						viewBox="0 0 16 16">
					  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg>
					<!-- <svg
						xmlns="http://www.w3.org/2000/svg"
						width="20"
						height="40"
						fill="#9095A8"
						class="bi bi-gear-fill"
						viewBox="0 0 16 16">
					  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
					</svg> -->
					<!-- <svg
						xmlns="http://www.w3.org/2000/svg"
						width="25"
						height="47"
						viewBox="0 0 25 47"
					>
						<text
							id="_"
							data-name="+"
							transform="translate(0 38)"
							fill="#9095a8"
							font-size="35.637"
							font-family="SegoeUI, Segoe UI"
						>
							<tspan x="0" y="0">+</tspan>
						</text>
					</svg> -->
				</div>
				<div class="name">Delete aircraft</div>
			</div>
		</div>
		</div>
		<table class="table">
				<tr class="tr">
					<td class="td">Aircraft Name</td>
					<td class="td">Год выпуска</td>
					<td class="td">Стоимость, USD</td>
					<td class="td">MTOW (kg)</td>
					<td class="td">Avr. years of service</td>
					<td class="td">Вес топлива (litres)</td>
					<td class="td">Крейсерская скорость (km/h)</td>
					<td class="td">Практическая дальность (km)</td>
					<td class="td">Warm Up & Navigations</td>
					<td class="td">Take-Off</td>
					<td class="td">Cruise</td>
					<td class="td">Landing</td>
					<td class="td">Fuel Consumption in Cruise Speed (L/hour)</td>
					<td class="td">Fuel Consumption in Cruise Speed (L/100km)</td>
					<!-- <td class="td"></td> -->
				</tr>
				<tr class="tr" :class="{active:i == selected}" v-for="(airplane, i) in airplanes" :data-index="airplane.id" @click="setActive(i, $event)">
					<td class="td">
						<div class="mainTable__aNameWrapper" v-show="!isEditing">
							<!-- <label class="cellValue">@{{ airplane.name }}</label> -->
							<a href="" class="nameWrapper">
								<div class="statusPoint active"></div>
								<div class="name">@{{ airplane.name }}</div>
								<img src="img/arrow.svg" alt="" class="arrow" />
							</a>
							<div class="mainTable__arrow" :data-index="i" @click="getScenaries"></div>
						</div>

						<input class="cellValueInput tab1_value" type="text" data-type="name"
							v-model.trim="airplane.name" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.year }}</label>
						<input class="cellValueInput tab1_value" type="text" data-type="year"
							v-model.number="airplane.year" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.price | numberFormat }}</label>
						<input class="cellValueInput tab1_value" type="text" data-type="price"
							v-model.number="airplane.price" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.mtow | numberFormat }}</label>
						<input class="cellValueInput tab1_value" type="text" data-type="mtow"
							v-model.number="airplane.mtow" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.avr_years_service | numberFormat }}</label>
						<input class="cellValueInput tab1_value" type="text" data-type="avr_years_service"
							v-model.number="airplane.avr_years_service" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.fuel_weight | numberFormat }}</label>
						<input class="cellValueInput tab1_value" type="text" data-type="fuel_weight"
							v-model.number="airplane.fuel_weight" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.normal_cruising_speed | numberFormat }}</label>
						<input class="cellValueInput tab1_value" type="text" data-type="normal_cruising_speed"
							v-model.number="airplane.normal_cruising_speed" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.practical_range | numberFormat }}</label>
						<input class="cellValueInput tab1_value" type="text" data-type="practical_range"
							v-model.number="airplane.practical_range" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.warm_up_nav | numberFormat }}%</label>
						<input class="cellValueInput tab1_value" type="text" data-type="warm_up_nav"
							v-model.number="airplane.warm_up_nav" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.take_off | numberFormat }}%</label>
						<input class="cellValueInput tab1_value" type="text" data-type="take_off"
							v-model.number="airplane.take_off" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.cruise | numberFormat }}%</label>
						<input class="cellValueInput tab1_value" type="text" data-type="cruise"
							v-model.number="airplane.cruise" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						<label class="cellValue" v-show="!isEditing">@{{ airplane.landing | numberFormat }}%</label>
						<input class="cellValueInput tab1_value" type="text" data-type="landing"
							v-model.number="airplane.landing" v-show="isEditing" @change="inputChange" @focus="inputFocus">
					</td>
					<td class="td">
						@{{ (airplane.fuel_weight * 100 / airplane.practical_range) | numberFormat }}
					</td>
					<td class="td">
						@{{ (airplane.normal_cruising_speed * airplane.fuel_weight / airplane.practical_range) | numberFormat }}
					</td>
				</tr>
		</table>
	</div>

</div>
</div>
</div>
