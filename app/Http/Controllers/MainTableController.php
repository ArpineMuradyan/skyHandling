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
            ['???????????????? ???????????????????? ???? ????????????????:',],
            ['?????? ??????????????/?????????? ?? ????????????????????????:', $airplane->year],
            ['???????????????????????? ???????? ???????????? (??????):', $airplane->avr_years_service],
            ['???????????????? ???????????????????????? ???? (??????):', $airplane->year + $airplane->avr_years_service],
            ['?????????????? (??????)', date('Y')],
            ['???????? ?????????????????? ???????????????????????? (??????):', $airplane->year + $airplane->avr_years_service - date('Y') + 1],
            ['?????????????????? ?????????? (USD)', $airplane->price],
            ['', ''],
            ['?????????????????????? ???????????????????? ???? ????????????????:',],
            ['?????? MTOW (kg):', $airplane->mtow],
            ['Max. ??????-???? ?????????????? ???? ?????????? (??????????):', $airplane->fuel_weight],
            ['Max. ???????????????? ???????????????? (km/h):', $airplane->normal_cruising_speed],
            ['?????????????????? ???????????? ?????? ???????????? ???????????????? (km)', $airplane->practical_range],
            ['?????????????????????? ?????????????? ?? ???????????? (litr/hour)', $airplane->getFuelConsumHour()],
            ['?????????????????????? ?????????????? ?? ???????????? (litr/100km)', $airplane->getFuelConsumKm()],
        ];
        Sheets::sheet($listName)->range('A1:B18')->update($section1);
        $section2 = [
            ['???????? ???????????????????????? ????????????????',],
            ['?????????????????????? ???????? ???????????????????????? (??????)', $params['lifetime']],
            ['???????????????? ?????? ????????????????????????', $params['end_lifetime']],
            ['???????????????? ?????????????????????? ??????????', ''],
            ['?????????????????? % ??????????????????????', $params['depreciation_percentage']],
            ['???????????? ??????????????????????', $params['depreciation_period']],
            ['???????????????? ?????? ??????c. ?????????????? ????????????????????', $params['end_effective_year']],
            ['Max. ???????????? ?? ??????', $params['max_effect_per_year']],
            ['???????????? ?? ??????', $params['effect_per_year']],
        ];

        Sheets::sheet($listName)->range('A19:B28')->update($section2);
        $section3 = [
            ['???????????? ??????????????: ' . $airplane->name,],
            ['', '',],
            ['???????????????? ??????????????', '??????????',],
            ['???????????????? ???1', $params['salary_leader1']],
            ['???????????????? ???2', $params['salary_leader2']],
            ['2-?? ??????????', $params['salary_pilot2']],
            ['??????????????????', $params['salary_conductor'],],
            ['??????????????', $params['salary_engineer'],],
            ['Total (USD) ', $params['salarySum'],],
            [''],
            ['??????????????????', '??????????',],
            ['?????????????????????????????? 3-?? ??????', $params['insurance_responsibilitym']],
            ['????????????', $params['insurance_crewm'],],
            ['??????????', $params['insurance_kaskom'],],
            ['????????????????', $params['insurance_franchisem'],],
            ['AirCraft Service', $params['insurance_aircraft_servicem'],],
            ['Total (USD) ', $params['insuranceSumm']],
            [''],
            ['???????????????????????????? ??????????????', '??????????',],
            ['?????????????????????????????????? ??????????', $params['nav_aeronautical_charts'],],
            ['?????????????????????? ???????????? ????????????????', $params['nav_airworthiness']],
            ['?????????????????? ????????????????????????', $params['nav_planning_program'],],
            ['??????????', $params['nav_communication'],],
            ['????????????????????', $params['nav_management'],],
            ['????????????????, ?????????????? , ????????????????????', $params['nav_daily_travel_accommodation'],],
            ['Crue training (v1)', $params['nav_crue_training']],
            ['Crue training (v2)', $params['nav_crue_training2']],
            ['Total (USD) ', $params['navSumm'],],
            ['Grate Total (USD)', $params['dopsummm']],

        ];

        Sheets::sheet($listName)->range('D1:F30')->update($section3);

        $section4 = [
            ['?????????????? ???? ???????????????????? ??????????',],
            ['???????????????????????? ???????????? (minutes)', $params['duration_summ']],
            ['?????????????????? ?????????????????????????? ???????????? (USD)', $params['aeroNavigation_summ']],
            ['?????????????????? ?????????????? (USD)', $params['fuel_need_summ_fuel_cost']],
            ['?????????????????? ???????????????????????? ???????????????? (USD)', $params['dopsumm12']],
            ['?????????????????? ???????????????????? (USD)', $params['utilization_programm']],
            ['?????????????????? ?????????? ???????????? (USD)', $params['flight_cost']],
            ['?????????????????? ???????? ???????????? (USD)', $params['flight_hour_cost']],

            ['', ''],
            ['?????????????? ???????????????? ??????. ?????????????? ?????? ???????????????????? ??????????', ''],
            ['', 'WarmUpNavi', 'Take-Off', 'Cruise', 'Landing', 'Total'],
            ['Engine Load %', $params['warm_up_nav'], $params['take_off'], $params['cruise'], $params['landing'], $params['engine_load_summ']],
            ['Duration, min', $params['duration_warm_up'], $params['duration_take_off'], $params['duration_cruise'], $params['duration_landing'], $params['duration_summ']],
            ['Fuel Needed Litres', $params['fuel_need_warm_up'], $params['fuel_need_take_off'], $params['fuel_need_cruise'], $params['fuel_need_landing'], $params['fuel_need_summ']],
            ['Total (USD)', $params['fuel_need_warm_up_fuel_cost'], $params['fuel_need_take_off_fuel_cost'], $params['fuel_need_cruise_fuel_cost'], $params['fuel_need_landing_fuel_cost'], $params['fuel_need_summ_fuel_cost']],
        ];

        Sheets::sheet($listName)->range('G3:L30')->update($section4);

        $section5 = [
            ['???????????????????? ?????????? ???????????? ?? ??????????', $params['flying_hours']],
            ['?????????? ???????????????????? ???????????? ?? ?????????? (USD)', $params['variable_costs_month']],
            ['???????? ?????????????? (??????)', $params['lifetime_project']],
            ['???????? ?????????????? (??????)', $params['lifetime_project12']],
            ['???????????????? ?????????????????????????? ?????????????? ???????? (USD)', $params['total_costs_hour']],
            [],
            ['?????? ????????????', '???????? ????????????', '??????', '??????????', '??????'],
            ['?????????????????????? ??????????????', $params['amount_of_capital_costs'], $params['amount_of_capital_costsy'], $params['amount_of_capital_costsm'], $params['amount_of_capital_costsh']],
            ['?????????????????????????? ??????????????', $params['fixed_amount_of_capital_costs'], $params['fixed_amount_of_capital_costsy'], $params['fixed_amount_of_capital_costsm'], $params['fixed_amount_of_capital_costsh']],
            ['???????????????????? ??????????????', $params['variable_amount_of_capital_costs'], $params['variable_amount_of_capital_costsy'], $params['variable_amount_of_capital_costsm'], $params['variable_amount_of_capital_costsh']],
            ['Total (USD)', $params['total_amount_of_capital_costs'], $params['total_amount_of_capital_costsy'], $params['total_amount_of_capital_costsm'], $params['total_amount_of_capital_costsh']],
            ['', '', '', '', ''],
            ['% ???????????????????? ?? 1 ?????????????? ????????', $params['flying_hour_profitability']],
            ['???????????????? ?????????????????? ?????????????? ???????? (USD)', $params['revenue_from_flight_hour']],
            ['???????????????????????????? ???????????? ?????????? ?? ??????. (USD)', $params['predicted_net_income_month']],
            ['???????????????? ?????????????????????????? ?????????????? ???????? (USD)', $params['total_costs_hour']],
            ['?????????????????????????????? ?????????? ?? ??????. (USD)', $params['forecasted_income_month']],
            ['?????????? ???????????????????????????? (??????)', $params['roi']],

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
                    // ????????????????, ?????????????? ?????????? ????????????????
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
                    // ????????????????, ?????????????? ?????????? ????????????????
                    "range" => [
                        "sheetId" => $listId,
                        "startRowIndex" => 0,
                        "endRowIndex" => 1,
                        "startColumnIndex" => 3,
                        "endColumnIndex" => 6
                    ],

                    // ???????????? ?????????????????????? ????????????
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
                // ????????????????, ?????????????? ?????????? ????????????????
                "range" => [
                    "sheetId" => $listId,
                    "startRowIndex" => 2,
                    "endRowIndex" => 38,
                    "startColumnIndex" => 0,
                    "endColumnIndex" => 13
                ],

                // ???????????? ?????????????????????? ????????????
                // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#CellFormat
                "cell" => [
                    "userEnteredFormat" => [
                        // ?????? (RGBA)
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
                // ????????????????, ?????????????? ?????????? ????????????????
                "range" => [
                    "sheetId" => $listId,
                    "startRowIndex" => $startRow,
                    "endRowIndex" => $endRow,
                    "startColumnIndex" => $startCol,
                    "endColumnIndex" => $endCol
                ],

                // ???????????? ?????????????????????? ????????????
                // https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets#CellFormat
                "cell" => [
                    "userEnteredFormat" => [
                        // ?????? (RGBA)
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
                // ????????????????, ?????????????? ?????????? ????????????????
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
                // ????????????????, ?????????????? ?????????? ????????????????
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
