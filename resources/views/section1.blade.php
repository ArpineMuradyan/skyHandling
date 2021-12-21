<div class="section section-1 section even">
    <div class="aiplaneNameHeader aiplaneNameHeaderf">Выбран самолет: @{{ a.name }}</div>


    <div class="tablesContainer section1-inner" id="section1-inner">


        <table v-if="credit" class="tableCredit tableType1 table">
            <thead>
            <tr class="table__row">
                <th class="table__th" colspan="2">Расчет кредита:</th>
            </tr>
            </thead>
            <tbody>
            <tr class="table__row">
                <td class="table__cell labelCell">Размер финансирования:</td>
                <td class="table__cell valueCell">
                    <input class="cellValueInput table__cellValueInput"  :class="{errorValue: isCorrectCrSize}" v-model="cr_size">

                </td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Первоначальный взнос клиента:</td>
                <td class="table__cell valueCell">
                    <input class="cellValueInput table__cellValueInput" type="text" data-type="cr_first"
                                                      :class="{errorValue: isCorrectCrFirst}"
                           v-model="cr_first" @focus="inputFocus">
                </td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Срок кредита:</td>
                <td class="table__cell valueCell">
                    <input class="cellValueInput table__cellValueInput" type="text" data-type="cr_srok"
                           v-model.number="cr_srok" @focus="inputFocus">
                </td>
            </tr>

            <tr class="table__row">
                <td class="table__cell labelCell">Процент по кредиту:</td>
                <td class="table__cell valueCell">
                    <input class="cellValueInput table__cellValueInput" type="text" data-type="cr_srok"
                           :class="{errorValue: isCorrectCrPercent}"
                           v-model.number="cr_percent" @focus="inputFocus">
                </td>
            </tr>
			<tr class="table__row">
                <td class="table__cell labelCell">Комиссия за выдачу:</td>
                <td class="table__cell valueCell">
                    <input class="cellValueInput table__cellValueInput" type="text" data-type="cr_comission"

                           v-model.number="cr_comission" @focus="inputFocus">
                </td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Тело Кредита(USD):</td>
                <td class="table__cell valueCell">
                    @{{pay_telo| numberFormat}}
                </td>
            </tr>

            <tr class="table__row">
                <td class="table__cell labelCell">Тело Кредита(EUR):</td>
                <td class="table__cell valueCell">
                    @{{pay_telo_EUR| numberFormat}}
                </td>
            </tr>

            <tr class="table__row">
                <td class="table__cell labelCell">Размер ежеквартального платеж(USD):</td>
                <td class="table__cell valueCell">
                    @{{pay_kvartal| numberFormat}}
                </td>
            </tr>

            <tr class="table__row">
                <td class="table__cell labelCell">Размер ежеквартального платеж(EUR):</td>
                <td class="table__cell valueCell">
                    @{{pay_kvartal_EUR| numberFormat}}
                </td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Финальный платеж(USD):</td>
                <td class="table__cell valueCell">
                    @{{pay_sum| numberFormat}}
                </td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Финальный платеж(EUR):</td>
                <td class="table__cell valueCell">
                    @{{pay_sum_EUR| numberFormat}}
                </td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Курс USD:</td>
                <td class="table__cell valueCell">
                    @{{ cours_USD }}
                </td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Курс EUR:</td>
                <td class="table__cell valueCell">
                    @{{ cours_EUR }}
                </td>
            </tr>
            </tbody>
        </table>


        <table class="tableMainInfo tableType1 table">
            <thead>
            <tr class="table__row">
                <th class="table__th" colspan="2">Основная информация по самолету:</th>
                <td style="display: none" class="valueCell" data-type="a_id">@{{ a.id }}</td>
            </tr>
            </thead>
            <tbody>
            <tr class="table__row">
                <td class="table__cell labelCell">Год выпуска/ввода в експлуатацию:</td>
                <td class="table__cell valueCell">@{{ a.year }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Максимальный срок службы (лет):</td>
                <td class="table__cell valueCell">@{{ a.avr_years_service }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Возможна експлуатация до (год):</td>
                <td class="table__cell valueCell">@{{ max_expluatation_year }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Сегодня (год):</td>
                <td class="table__cell valueCell">@{{ currentYear }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Срок возможной експлуатации (лет):</td>
                <td class="table__cell valueCell">@{{ posible_expluatation }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Стоимость судна (USD):</td>
                <td class="table__cell valueCell">@{{ a.price | numberFormat }}</td>
            </tr>
            </tbody>
        </table>

        <table class="tableTechInfo tableType1 table">
            <thead>
            <tr class="table__row">
                <th class="table__th" colspan="2">Техническая информация по самолету:</th>
            </tr>
            </thead>
            <tbody>
            <tr class="table__row">
                <td class="table__cell labelCell">Вес MTOW (kg):</td>
                <td class="table__cell valueCell">@{{ a.mtow | numberFormat }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Max. кол-во топлива на борту (литры):</td>
                <td class="table__cell valueCell">@{{ a.fuel_weight | numberFormat }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Max. круизная скорость (km/h):</td>
                <td class="table__cell valueCell">@{{ a.normal_cruising_speed | numberFormat }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Дальность полета при полной загрузке (km):</td>
                <td class="table__cell valueCell">@{{ a.practical_range | numberFormat }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Потребление топлива в круизе (litr/hour):</td>
                <td class="table__cell valueCell">@{{ fuel_consum_km | numberFormat }}</td>
            </tr>
            <tr class="table__row">
                <td class="table__cell labelCell">Потребление топлива в круизе (litr/100km):</td>
                <td class="table__cell valueCell">@{{ fuel_consum_hour | numberFormat }}</td>
            </tr>

            </tbody>
        </table>
    </div>
</div>