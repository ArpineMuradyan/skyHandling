<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Google_Service_Sheets_BatchUpdateSpreadsheetRequest;
use Google_Service_Sheets_BatchUpdateSpreadsheetResponse;
use Google_Service_Sheets_Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Revolution\Google\Sheets\Facades\Sheets;

class MainTableController extends Controller
{
    public function index(Request $request)
    {

        $airplanes = Airplane::all();
        $params = DB::table('params')->get();
        $coursesjson = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
        $coursesjson = \json_decode($coursesjson,true);
        $courses=[];
        foreach ($coursesjson as $cours) {
            $courses[$cours['ccy']] = $cours;
        }

        return view("main", compact('airplanes', 'params','courses'));
    }

    public function index2(Request $request)
    {

        $airplanes = Airplane::all();
        $params = DB::table('params')->get();
        $coursesjson = file_get_contents('https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5');
        $coursesjson = \json_decode($coursesjson,true);
        $courses=[];
        foreach ($coursesjson as $cours) {
            $courses[$cours['ccy']] = $cours;
        }

        return view("light.main", compact('airplanes', 'params','courses'));
    }

    public function changeInput(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        switch ($data["type"]) {
            case 'name':
                $newValue = $data["newValue"];
                break;
            case 'year':
                $newValue = (int)$data["newValue"];
                if ($newValue < 0) $newValue = 0;
                break;
            default:
                $newValue = round(floatval($data["newValue"]), 2);
                if ($newValue < 0) $newValue = 0;
        }

        Airplane::where(["id" => $data["id"]])
            ->update([
                $data["type"] => $newValue
            ]);

        return "ok";
    }

    public function addAirplane()
    {

        $id = Airplane::insertGetId([
            "name" => ''
        ]);

        return Airplane::find($id)->toJson();
    }

    public function removeAirplane(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $res = Airplane::destroy($data["id"]);
        if ($res) {
            return "ok";
        } else {
            return "err";
        }
    }

    private function generateSheets($params)
    {

        $id = $params['a_id'];
        $airplane = Airplane::findOrFail($id);
        $spreadsheetId = '1C7UAYE566Kp8C3By8qIFvKFTEUOQm2MAe8jkcX_ZfZ8';
        $sh = Sheets::spreadsheet($spreadsheetId);

        $listName = $airplane->name . ' ' . date('d.m H:i:s');

        /** @var \Revolution\Google\Sheets\Sheets $sheets */
        $sheet = Sheets::sheet($listName);
        $sh->addsheet($listName);
        $lists = $sheet->sheetList();
        $listId = array_search($listName, $lists);

        $section1 = [
            [''],
            [''],
            ['Основная информация по самолету:',],
            ['Год выпуска/ввода в експлуатацию:', $airplane->year],
            ['Максимальный срок службы (лет):', $airplane->avr_years_service],
            ['Возможна експлуатация до (год):', $airplane->year + $airplane->avr_years_service],
            ['Сегодня (год)', date('Y')],
            ['Срок возможной експлуатации (лет):', $airplane->year + $airplane->avr_years_service - date('Y') + 1],
            ['Стоимость судна (USD)', $airplane->price],
            ['', ''],
            ['Техническая информация по самолету:',],
            ['Вес MTOW (kg):', $airplane->mtow],
            ['Max. кол-во топлива на борту (литры):', $airplane->fuel_weight],
            ['Max. круизная скорость (km/h):', $airplane->normal_cruising_speed],
            ['Дальность полета при полной загрузке (km)', $airplane->practical_range],
            ['Потребление топлива в круизе (litr/hour)', $airplane->getFuelConsumHour()],
            ['Потребление топлива в круизе (litr/100km)', $airplane->getFuelConsumKm()],
        ];
        Sheets::sheet($listName)->range('A1:B18')->update($section1);
        $section2 = [
            ['Срок експлуатации самолета',],
            ['Планируемый срок експлуатации (лет)', $params['lifetime']],
            ['Конечный год експлуатации', $params['end_lifetime']],
            ['Динамика амортизации судна', ''],
            ['Суммарный % амортизации', $params['depreciation_percentage']],
            ['Период амортизации', $params['depreciation_period']],
            ['Конечный год макc. еффекта утилизации', $params['end_effective_year']],
            ['Max. еффект в год', $params['max_effect_per_year']],
            ['Еффект в год', $params['effect_per_year']],
        ];

        Sheets::sheet($listName)->range('A19:B28')->update($section2);
        $section3 = [
            ['Выбран самолет: ' . $airplane->name,],
            ['', '',],
            ['Зарплата экипажа', 'Месяц',],
            ['Командир №1', $params['salary_leader1']],
            ['Командир №2', $params['salary_leader2']],
            ['2-й Пилот', $params['salary_pilot2']],
            ['Проводник', $params['salary_conductor'],],
            ['Инженер', $params['salary_engineer'],],
            ['Total (USD) ', $params['salarySum'],],
            [''],
            ['Страховка', 'Месяц',],
            ['Ответственность 3-х лиц', $params['insurance_responsibilitym']],
            ['Экипаж', $params['insurance_crewm'],],
            ['КАСКО', $params['insurance_kaskom'],],
            ['Франшиза', $params['insurance_franchisem'],],
            ['AirCraft Service', $params['insurance_aircraft_servicem'],],
            ['Total (USD) ', $params['insuranceSumm']],
            [''],
            ['Дополнительные расходы', 'Месяц',],
            ['Аэронавигационные карты', $params['nav_aeronautical_charts'],],
            ['Поддержание летной годности', $params['nav_airworthiness']],
            ['Программа планирования', $params['nav_planning_program'],],
            ['Связь', $params['nav_communication'],],
            ['Менеджмент', $params['nav_management'],],
            ['Суточные, поездки , проживание', $params['nav_daily_travel_accommodation'],],
            ['Crue training (v1)', $params['nav_crue_training']],
            ['Crue training (v2)', $params['nav_crue_training2']],
            ['Total (USD) ', $params['navSumm'],],
            ['Grate Total (USD)', $params['dopsummm']],

        ];

        Sheets::sheet($listName)->range('D1:F30')->update($section3);

        $section4 = [
            ['Затраты на совершение рейса',],
            ['Длительность полета (minutes)', $params['duration_summ']],
            ['Стоимость навигационных затрат (USD)', $params['aeroNavigation_summ']],
            ['Стоимость топлива (USD)', $params['fuel_need_summ_fuel_cost']],
            ['Стоимость аеропортовых сервисов (USD)', $params['dopsumm12']],
            ['Программа утилизации (USD)', $params['utilization_programm']],
            ['Стоимость всего полета (USD)', $params['flight_cost']],
            ['Стоимость часа полета (USD)', $params['flight_hour_cost']],

            ['', ''],
            ['Таблица рассчета кол. топлива для совершения рейса', ''],
            ['', 'WarmUpNavi', 'Take-Off', 'Cruise', 'Landing', 'Total'],
            ['Engine Load %', $params['warm_up_nav'], $params['take_off'], $params['cruise'], $params['landing'], $params['engine_load_summ']],
            ['Duration, min', $params['duration_warm_up'], $params['duration_take_off'], $params['duration_cruise'], $params['duration_landing'], $params['duration_summ']],
            ['Fuel Needed Litres', $params['fuel_need_warm_up'], $params['fuel_need_take_off'], $params['fuel_need_cruise'], $params['fuel_need_landing'], $params['fuel_need_summ']],
            ['Total (USD)', $params['fuel_need_warm_up_fuel_cost'], $params['fuel_need_take_off_fuel_cost'], $params['fuel_need_cruise_fuel_cost'], $params['fuel_need_landing_fuel_cost'], $params['fuel_need_summ_fuel_cost']],
        ];

        Sheets::sheet($listName)->range('G3:L30')->update($section4);

        $section5 = [
            ['Количество часов налета в месяц', $params['flying_hours']],
            ['Сумма переменных затрат в месяц (USD)', $params['variable_costs_month']],
            ['Срок проекта (лет)', $params['lifetime_project']],
            ['Срок проекта (мес)', $params['lifetime_project12']],
            ['Итоговая себестоимость летного часа (USD)', $params['total_costs_hour']],
            [],
            ['Вид затрат', 'Весь период', 'Год', 'Месяц', 'Час'],
            ['Капитальные затраты', $params['amount_of_capital_costs'], $params['amount_of_capital_costsy'], $params['amount_of_capital_costsm'], $params['amount_of_capital_costsh']],
            ['Фиксированные затраты', $params['fixed_amount_of_capital_costs'], $params['fixed_amount_of_capital_costsy'], $params['fixed_amount_of_capital_costsm'], $params['fixed_amount_of_capital_costsh']],
            ['Переменные затраты', $params['variable_amount_of_capital_costs'], $params['variable_amount_of_capital_costsy'], $params['variable_amount_of_capital_costsm'], $params['variable_amount_of_capital_costsh']],
            ['Total (USD)', $params['total_amount_of_capital_costs'], $params['total_amount_of_capital_costsy'], $params['total_amount_of_capital_costsm'], $params['total_amount_of_capital_costsh']],
            ['', '', '', '', ''],
            ['% доходности с 1 летного часа', $params['flying_hour_profitability']],
            ['Итоговая стоимость летного часа (USD)', $params['revenue_from_flight_hour']],
            ['Прогнозируемый чистый доход в мес. (USD)', $params['predicted_net_income_month']],
            ['Итоговая себестоимость летного часа (USD)', $params['total_costs_hour']],
            ['Прогнозитруемый доход в мес. (USD)', $params['forecasted_income_month']],
            ['Точка безубыточности (мес)', $params['roi']],

        ];


        Sheets::sheet($listName)->range('G19:L36')->update($section5);

        $this->sheetsFormat($sheet, $spreadsheetId, $listId);

        return 'https://docs.google.com/spreadsheets/d/' . $spreadsheetId . '/edit#gid=' . $listId;
    }

    public function sheetsFormat($sheet, $spreadsheetId, $listId)
    {

        $req = $this->getGoogleRequestHeader($listId);
        $requests = [
            $this->getGoogleRequestMerge($listId),
            new Google_Service_Sheets_Request([

                'mergeCells' => [
                    // Диапазон, который будет затронут
                    'range' => [
                        "sheetId" => $listId,
                        'startRowIndex' => 0,
                        'endRowIndex' => 1,
                        'startColumnIndex' => 3,
                        'endColumnIndex' => 6,
                    ],
                    'mergeType' => 'MERGE_ALL',
                ]
            ]),
            new Google_Service_Sheets_Request([
                'repeatCell' => [
                    "fields" => "UserEnteredFormat(textFormat,horizontalAlignment)",
                    // Диапазон, который будет затронут
                    "range" => [
                        "sheetId" => $listId,
                        "startRowIndex" => 0,
                        "endRowIndex" => 1,
                        "startColumnIndex" => 3,
                        "endColumnIndex" => 6
                    ],

                    // Формат отображения данных
                    // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#CellFormat
                    "cell" => [
                        "userEnteredFormat" => [
                            // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#HorizontalAlign
                            "horizontalAlignment" => "CENTER",

                            "textFormat" => [
                                "bold" => true,
                                "underline" => true,
                                "fontSize" => 30,
                            ]
                        ]
                    ],
                ],

//            "fields" => "UserEnteredFormat(backgroundColor,horizontalAlignment,padding,textFormat)"

            ]),
            $this->getGoogleRequestMerge($listId, 3, 1),
            $this->getGoogleRequestMerge($listId, 11, 1),
            $this->getGoogleRequestMerge($listId, 19, 1),
            $this->getGoogleRequestMerge($listId, 22, 1),
            $this->getGoogleRequestMerge($listId, 3, 7),

            $this->getGoogleRequestBorder($listId, 0, 1, 3, 6),
            $this->getGoogleRequestBorder($listId, 2, 9, 0, 2),
            $this->getGoogleRequestBorder($listId, 10, 11, 0, 2),
            $this->getGoogleRequestBorder($listId, 11, 17, 0, 2),
            $this->getGoogleRequestBorder($listId, 18, 27, 0, 2),

            $this->getGoogleRequestBorder($listId, 2, 9, 3, 5),
            $this->getGoogleRequestBorder($listId, 10, 17, 3, 5),
            $this->getGoogleRequestBorder($listId, 18, 29, 3, 5),


            $this->getGoogleRequestBorder($listId, 2, 10, 6, 8),
            $this->getGoogleRequestBorder($listId, 12, 17, 6, 12),
            $this->getGoogleRequestBorder($listId, 18, 23, 6, 8),
            $this->getGoogleRequestBorder($listId, 24, 29, 6, 11),
            $this->getGoogleRequestBorder($listId, 24, 29, 6, 11),


            $this->getGoogleRequestColor($listId, 0, 1, 3, 6, '#cfe2f3'),
            $this->getGoogleRequestColor($listId, 2, 3, 0, 2),
            $this->getGoogleRequestColor($listId, 10, 11, 0, 2),
            $this->getGoogleRequestColor($listId, 18, 19, 0, 2),
            $this->getGoogleRequestColor($listId, 21, 22, 0, 2),


            $this->getGoogleRequestColor($listId, 2, 3, 3, 4),
            $this->getGoogleRequestColor($listId, 2, 3, 4, 5, '#fff2cc'),
            $this->getGoogleRequestColor($listId, 10, 11, 3, 4),
            $this->getGoogleRequestColor($listId, 10, 11, 4, 5, '#fff2cc'),
            $this->getGoogleRequestColor($listId, 18, 19, 3, 4),
            $this->getGoogleRequestColor($listId, 18, 19, 4, 5, '#fff2cc'),

            $this->getGoogleRequestColor($listId, 2, 3, 6, 7),
            $this->getGoogleRequestColor($listId, 11, 12, 6, 7),
            $this->getGoogleRequestColor($listId, 12, 13, 7, 12, '#fff2cc'),
            $this->getGoogleRequestColor($listId, 18, 19, 6, 8),
            $this->getGoogleRequestColor($listId, 24, 25, 6, 11),

            $this->getGoogleRequestColor($listId, 24, 25, 6, 7),
            $this->getGoogleRequestColor($listId, 24, 25, 7, 11, '#fff2cc'),

            $this->getGoogleRequestColor($listId, 8, 9, 3, 4, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 8, 9, 4, 5, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 16, 17, 3, 4, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 16, 17, 4, 5, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 16, 17, 3, 4, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 16, 17, 4, 5, '#b6d7a8'),


            $this->getGoogleRequestColor($listId, 27, 28, 3, 4, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 27, 28, 4, 5, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 28, 29, 3, 4, '#93c47d'),
            $this->getGoogleRequestColor($listId, 28, 29, 4, 5, '#93c47d'),
//----------
            $this->getGoogleRequestColor($listId, 8, 9, 6, 7, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 8, 9, 7, 8, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 9, 10, 6, 7, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 9, 10, 7, 8, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 16, 17, 6, 7, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 16, 17, 7, 12, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 22, 23, 6, 7, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 22, 23, 7, 8, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 28, 29, 6, 7, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 28, 29, 7, 11, '#b6d7a8'),

            $this->getGoogleRequestColor($listId, 31, 35, 6, 7, '#d9ead3'),
            $this->getGoogleRequestColor($listId, 31, 35, 7, 8, '#b6d7a8'),
            $this->getGoogleRequestColor($listId, 35, 36, 6, 8, '#93c47d'),
            $req,

            new Google_Service_Sheets_Request([
                "autoResizeDimensions" => [
                    "dimensions" => [
                        "sheetId" => $listId,
                        "dimension" => "COLUMNS",
                        "startIndex" => 0,
                        "endIndex" => 13
                    ]
                ]]),
        ];

        $batchUpdateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => $requests
        ]);

        $sheet->getService()->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);
    }

    private function getGoogleRequestHeader($listId)
    {
        return new Google_Service_Sheets_Request([
            'repeatCell' => [
                "fields" => "UserEnteredFormat(textFormat,horizontalAlignment)",
                // Диапазон, который будет затронут
                "range" => [
                    "sheetId" => $listId,
                    "startRowIndex" => 2,
                    "endRowIndex" => 38,
                    "startColumnIndex" => 0,
                    "endColumnIndex" => 13
                ],

                // Формат отображения данных
                // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#CellFormat
                "cell" => [
                    "userEnteredFormat" => [
                        // Фон (RGBA)
                        // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#Color
//                        "backgroundColor" => [
////                            "green" => 1,
////                                "red" => 1
//                        ],
                        // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#HorizontalAlign
                        "horizontalAlignment" => "LEFT",
                        // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#padding
//                        "padding" => [
//                            "left" => 10,
//                            "bottom" => 50,
//                            "right" => 30,
//                            "top" => 11
//                        ],
                        // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#textformat
                        "textFormat" => [
//                            "bold" => true,
                            "fontSize" => 14,
                        ]
                    ]
                ],
            ],

        ]);
    }

    private function getGoogleRequestColor($listId, $startRow = 1, $endRow = 1, $startCol = 1, $endCol = 1, $color = '#ffe599')
    {


        list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");

        return new Google_Service_Sheets_Request([
            'repeatCell' => [
                "fields" => "UserEnteredFormat(backgroundColor)",
                // Диапазон, который будет затронут
                "range" => [
                    "sheetId" => $listId,
                    "startRowIndex" => $startRow,
                    "endRowIndex" => $endRow,
                    "startColumnIndex" => $startCol,
                    "endColumnIndex" => $endCol
                ],

                // Формат отображения данных
                // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#CellFormat
                "cell" => [
                    "userEnteredFormat" => [
                        // Фон (RGBA)
                        // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#Color
                        "backgroundColor" => [
                            "green" => $g / 255,
                            "red" => $r / 255,
                            'blue' => $b / 255
                        ],

                    ]
                ],
            ],
        ]);
    }

    private function getGoogleRequestBorder($listId, $startRow = 1, $endRow = 1, $startCol = 1, $endCol = 1)
    {


        return new Google_Service_Sheets_Request([

            'updateBorders' => [
                // Диапазон, который будет затронут
                "range" => [
                    "sheetId" => $listId,
                    "startRowIndex" => $startRow,
                    "endRowIndex" => $endRow,
                    "startColumnIndex" => $startCol,
                    "endColumnIndex" => $endCol
                ],
                "top" => [
                    "style" => "SOLID",
                    "width" => 1,
                    "color" => [
                        "red" => 0.0,
                        "green" => 0.0,
                        "blue" => 0.0
                    ],
                ]
                ,
                "left" => [
                    "style" => "SOLID",
                    "width" => 1,
                    "color" => [
                        "red" => 0.0,
                        "green" => 0.0,
                        "blue" => 0.0
                    ],
                ],
                "right" => [
                    "style" => "SOLID",
                    "width" => 1,
                    "color" => [
                        "red" => 0.0,
                        "green" => 0.0,
                        "blue" => 0.0
                    ],
                ],

                "bottom" => [
                    "style" => "SOLID",
                    "width" => 1,
                    "color" => [
                        "red" => 0.0,
                        "green" => 0.0,
                        "blue" => 0.0
                    ],
                ],
                "innerHorizontal" => [
                    "style" => "SOLID",
                    "width" => 1,
                    "color" => [
                        "red" => 0.0,
                        "green" => 0.0,
                        "blue" => 0.0
                    ],
                ],
                "innerVertical" => [
                    "style" => "SOLID",
                    "width" => 1,
                    "color" => [
                        "red" => 0.0,
                        "green" => 0.0,
                        "blue" => 0.0
                    ],
                ],

            ]

        ]);
    }

    private function getGoogleRequestMerge($listId, $r = 1, $c = 1)
    {


        return new Google_Service_Sheets_Request([

            'mergeCells' => [
                // Диапазон, который будет затронут
                'range' => [
                    "sheetId" => $listId,
                    'startRowIndex' => ($r - 1),
                    'endRowIndex' => $r,
                    'startColumnIndex' => ($c - 1),
                    'endColumnIndex' => ($c + 1),
                ],
                'mergeType' => 'MERGE_ALL',
            ]
        ]);
    }

    public function generateSheet(Request $request)
    {
        $params = $request->all();

        $url = $this->generateSheets($params);
        return response()->json(['link' => $url]);
    }
}
