<div class="section section-1 section even">
    <div class="aiplaneNameHeader">Выбран самолет: @{{ a.name }}</div>

    <div class="calculatorMain">

    <div class="tablesContainer section1-inner" id="section1-inner">

        <table v-if="credit" class="table">
            <thead>
            <tr class="row">
                <th class="title" colspan="2">Расчет кредита:</th>
            </tr>
            </thead>
            <tbody>
            <tr class="row">
                <td class="item">Размер финансирования:</td>
                <td>
                    <input class="item value bordered"  :class="{errorValue: isCorrectCrSize}" v-model="cr_size">

                </td>
            </tr>
            <tr class="row">
                <td class="item">Первоначальный взнос клиента:</td>
                <td>
                    <input class="item value bordered" type="text" data-type="cr_first"
                                                      :class="{errorValue: isCorrectCrFirst}"
                           v-model="cr_first" @focus="inputFocus">
                </td>
            </tr>
            <tr class="row">
                <td class="item">Срок кредита:</td>
                <td>
                    <input class="item value bordered" type="text" data-type="cr_srok"
                           v-model.number="cr_srok" @focus="inputFocus">
                </td>
            </tr>

            <tr class="row">
                <td class="item">Процент по кредиту:</td>
                <td>
                    <input class="item value bordered" type="text" data-type="cr_srok"
                           :class="{errorValue: isCorrectCrPercent}"
                           v-model.number="cr_percent" @focus="inputFocus">
                </td>
            </tr>
			      <tr class="row">
                <td class="item">Комиссия за выдачу:</td>
                <td>
                    <input class="item value bordered" type="text" data-type="cr_comission"

                           v-model.number="cr_comission" @focus="inputFocus">
                </td>
            </tr>
            <tr class="row">
                <td class="item">Тело Кредита(USD):</td>
                <td class="item value">
                    @{{pay_telo| numberFormat}}
                </td>
            </tr>

            <tr class="row">
                <td class="item">Тело Кредита(EUR):</td>
                <td class="item value">
                    @{{pay_telo_EUR| numberFormat}}
                </td>
            </tr>

            <tr class="row">
                <td class="item">Размер ежеквартального платеж(USD):</td>
                <td class="item value">
                    @{{pay_kvartal| numberFormat}}
                </td>
            </tr>

            <tr class="row">
                <td class="item">Размер ежеквартального платеж(EUR):</td>
                <td class="item value">
                    @{{pay_kvartal_EUR| numberFormat}}
                </td>
            </tr>
            <tr class="row">
                <td class="item">Финальный платеж(USD):</td>
                <td class="item value">
                    @{{pay_sum| numberFormat}}
                </td>
            </tr>
            <tr class="row">
                <td class="item">Финальный платеж(EUR):</td>
                <td class="item value">
                    @{{pay_sum_EUR| numberFormat}}
                </td>
            </tr>
            <tr class="row">
                <td class="item">Курс USD:</td>
                <td class="item value">
                    @{{ cours_USD }}
                </td>
            </tr>
            <tr class="row">
                <td class="item">Курс EUR:</td>
                <td class="item value">
                    @{{ cours_EUR }}
                </td>
            </tr>
            </tbody>
        </table>
    <!-- <div class="container"> -->
      <!-- <div class="leftColumn"> -->
        <table class="tableMainInfo tableType1 table">
            <thead>
            <tr class="row">
                <th class="title" colspan="2">Основная информация по самолету:</th>
                <td style="display: none" class="title" data-type="a_id">@{{ a.id }}</td>
            </tr>
            </thead>
            <tbody>
            <tr class="row">
                <td class="item">Год выпуска/ввода в експлуатацию:</td>
                <td class="item value">@{{ a.year }}</td>
            </tr>
            <tr class="row">
                <td class="item">Максимальный срок службы (лет):</td>
                <td class="item value">@{{ a.avr_years_service }}</td>
            </tr>
            <tr class="row">
                <td class="item">Возможна експлуатация до (год):</td>
                <td class="item value">@{{ max_expluatation_year }}</td>
            </tr>
            <tr class="row">
                <td class="item">Сегодня (год):</td>
                <td class="item value">@{{ currentYear }}</td>
            </tr>
            <tr class="row">
                <td class="item">Срок возможной експлуатации (лет):</td>
                <td class="item value">@{{ posible_expluatation }}</td>
            </tr>
            <tr class="row">
                <td class="item">Стоимость судна (USD):</td>
                <td class="item value">@{{ a.price | numberFormat }}</td>
            </tr>
            </tbody>
        </table>
      <!-- </div>
      <div class="rightColumn"> -->
        <table class="tableMainInfo tableType1 table">
            <thead>
            <tr class="row">
                <th class="title" colspan="2">Техническая информация по самолету:</th>
            </tr>
            </thead>
            <tbody>
            <tr class="row">
                <td class="item">Вес MTOW (kg):</td>
                <td class="item value">@{{ a.mtow | numberFormat }}</td>
            </tr>
            <tr class="row">
                <td class="item">Max. кол-во топлива на борту (литры):</td>
                <td class="item value">@{{ a.fuel_weight | numberFormat }}</td>
            </tr>
            <tr class="row">
                <td class="item">Max. круизная скорость (km/h):</td>
                <td class="item value">@{{ a.normal_cruising_speed | numberFormat }}</td>
            </tr>
            <tr class="row">
                <td class="item">Дальность полета при полной загрузке (km):</td>
                <td class="item value">@{{ a.practical_range | numberFormat }}</td>
            </tr>
            <tr class="row">
                <td class="item">Потребление топлива в круизе (litr/hour):</td>
                <td class="item value">@{{ fuel_consum_km | numberFormat }}</td>
            </tr>
            <tr class="row">
                <td class="item">Потребление топлива в круизе (litr/100km):</td>
                <td class="item value">@{{ fuel_consum_hour | numberFormat }}</td>
            </tr>

            </tbody>
        </table>
      <!-- </div> -->
    <!-- </div> -->
      </div>
    </div>
</div>
