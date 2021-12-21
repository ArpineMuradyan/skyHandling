<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- <meta charset="UTF-8" />
    <meta name="description" content="" /> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SkyHandling</title>
  </head>

  <body>
    <noscript id="noscript">
  		Для корректной работы сайта браузер должен поддерживать JavaScript.
  	</noscript>
    <div class="header">
      <div class="container">
        <a href="/" class="logoWrapper">
          <div class="logo">SkyHandling</div>
          <div class="subtitle">
            DOC Calculator (Direct Operating Costs Analysis)
          </div>
        </a>
        <div class="name">Gulfstream G150</div>
        <div class="navbar">
          <a href="/calculator.html" class="button">Calculator</a>
          <a href="" class="button">Create report</a>
        </div>
      </div>
    </div>
    <div class="mainList">
      <div class="container">
        <div class="tableWrapper">
          <div class="topWrapper">
            <div class="inputWrapper">
              <input type="text" class="searchInput" placeholder="Search" />
            </div>
            <div class="addAircraftWrapper">
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
          </div>
          <div class="table">
            <div class="tr">
              <div class="td">Aircraft Name</div>
              <div class="td">Год выпуска</div>
              <div class="td">Стоимость, USD</div>
              <div class="td">MTOW (kg)</div>
              <div class="td">Avr. years of service</div>
              <div class="td">Вес топлива (litres)</div>
              <div class="td">Крейсерская скорость (km/h)</div>
              <div class="td">Практическая дальность (km)</div>
              <div class="td">Warm Up & Navigations</div>
              <div class="td">Take-Off</div>
              <div class="td">Cruise</div>
              <div class="td">Landing</div>
              <div class="td">Fuel Consumption in Cruise Speed (L/hour)</div>
              <div class="td">Fuel Consumption in Cruise Speed (L/100km)</div>
              <div class="td"></div>
            </div>
            <div class="tr">
              <div class="td">
                <a href="" class="nameWrapper">
                  <div class="statusPoint active"></div>
                  <div class="name">Gulfstream GIV</div>
                  <img src="img/arrow.svg" alt="" class="arrow" />
                </a>
              </div>
              <div class="td">2016</div>
              <div class="td">100 000 000</div>
              <div class="td">5 300</div>
              <div class="td">15</div>
              <div class="td">765</div>
              <div class="td">685</div>
              <div class="td">1019</div>
              <div class="td">15%</div>
              <div class="td">150%</div>
              <div class="td">70%</div>
              <div class="td">50%</div>
              <div class="td">75.07</div>
              <div class="td">142.54</div>
              <div class="td">
                <div class="editeWrapper">
                  <div class="edite">
                    <svg
                      data-name="Компонент 1 – 1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <defs>
                        <clipPath id="clip-path">
                          <path
                            id="Color_Overlay"
                            data-name="Color Overlay"
                            d="M1781,275h12v12h-12Z"
                            fill="#9095a8"
                          />
                        </clipPath>
                      </defs>
                      <g
                        id="Группа_масок_1"
                        data-name="Группа масок 1"
                        transform="translate(-1781 -275)"
                        clip-path="url(#clip-path)"
                      >
                        <g
                          id="_001-draw"
                          data-name="001-draw"
                          transform="translate(1781 275)"
                        >
                          <path
                            id="Контур_3"
                            data-name="Контур 3"
                            d="M7.462,2.022,9.9,4.463,3.724,10.642,1.284,8.2Zm4.293-.589L10.667.345a1.08,1.08,0,0,0-1.526,0L8.1,1.388l2.441,2.441,1.216-1.216A.832.832,0,0,0,11.755,1.433ZM.007,11.632a.278.278,0,0,0,.336.33l2.72-.66L.623,8.862Z"
                            fill="#9095a8"
                          />
                        </g>
                      </g>
                    </svg>
                  </div>
                  <div class="delete">
                    <svg
                      id="Сгруппировать_1"
                      data-name="Сгруппировать 1"
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <path
                        id="Контур_2"
                        data-name="Контур 2"
                        d="M7.322,6.016l4.487-4.487a.658.658,0,0,0,0-.928L11.415.208a.658.658,0,0,0-.928,0L6,4.694,1.513.208a.658.658,0,0,0-.928,0L.192.6a.657.657,0,0,0,0,.928L4.679,6.016.192,10.5a.658.658,0,0,0,0,.928l.393.393a.658.658,0,0,0,.928,0L6,7.337l4.487,4.487a.651.651,0,0,0,.464.192h0a.651.651,0,0,0,.464-.192l.393-.393a.658.658,0,0,0,0-.928Z"
                        transform="translate(0 -0.016)"
                        fill="#9095a8"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="tr">
              <div class="td">
                <a href="" class="nameWrapper">
                  <div class="statusPoint"></div>
                  <div class="name">Gulfstream GIV</div>
                  <img src="img/arrow.svg" alt="" class="arrow" />
                </a>
              </div>
              <div class="td">2016</div>
              <div class="td">100 000 000</div>
              <div class="td">5 300</div>
              <div class="td">15</div>
              <div class="td">765</div>
              <div class="td">685</div>
              <div class="td">1019</div>
              <div class="td">15%</div>
              <div class="td">150%</div>
              <div class="td">70%</div>
              <div class="td">50%</div>
              <div class="td">75.07</div>
              <div class="td">142.54</div>
              <div class="td">
                <div class="editeWrapper">
                  <div class="edite">
                    <svg
                      data-name="Компонент 1 – 1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <defs>
                        <clipPath id="clip-path">
                          <path
                            id="Color_Overlay"
                            data-name="Color Overlay"
                            d="M1781,275h12v12h-12Z"
                            fill="#9095a8"
                          />
                        </clipPath>
                      </defs>
                      <g
                        id="Группа_масок_1"
                        data-name="Группа масок 1"
                        transform="translate(-1781 -275)"
                        clip-path="url(#clip-path)"
                      >
                        <g
                          id="_001-draw"
                          data-name="001-draw"
                          transform="translate(1781 275)"
                        >
                          <path
                            id="Контур_3"
                            data-name="Контур 3"
                            d="M7.462,2.022,9.9,4.463,3.724,10.642,1.284,8.2Zm4.293-.589L10.667.345a1.08,1.08,0,0,0-1.526,0L8.1,1.388l2.441,2.441,1.216-1.216A.832.832,0,0,0,11.755,1.433ZM.007,11.632a.278.278,0,0,0,.336.33l2.72-.66L.623,8.862Z"
                            fill="#9095a8"
                          />
                        </g>
                      </g>
                    </svg>
                  </div>
                  <div class="delete">
                    <svg
                      id="Сгруппировать_1"
                      data-name="Сгруппировать 1"
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <path
                        id="Контур_2"
                        data-name="Контур 2"
                        d="M7.322,6.016l4.487-4.487a.658.658,0,0,0,0-.928L11.415.208a.658.658,0,0,0-.928,0L6,4.694,1.513.208a.658.658,0,0,0-.928,0L.192.6a.657.657,0,0,0,0,.928L4.679,6.016.192,10.5a.658.658,0,0,0,0,.928l.393.393a.658.658,0,0,0,.928,0L6,7.337l4.487,4.487a.651.651,0,0,0,.464.192h0a.651.651,0,0,0,.464-.192l.393-.393a.658.658,0,0,0,0-.928Z"
                        transform="translate(0 -0.016)"
                        fill="#9095a8"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="tr">
              <div class="td">
                <a href="" class="nameWrapper">
                  <div class="statusPoint"></div>
                  <div class="name">Gulfstream GIV</div>
                  <img src="img/arrow.svg" alt="" class="arrow" />
                </a>
              </div>
              <div class="td">2016</div>
              <div class="td">100 000 000</div>
              <div class="td">5 300</div>
              <div class="td">15</div>
              <div class="td">765</div>
              <div class="td">685</div>
              <div class="td">1019</div>
              <div class="td">15%</div>
              <div class="td">150%</div>
              <div class="td">70%</div>
              <div class="td">50%</div>
              <div class="td">75.07</div>
              <div class="td">142.54</div>
              <div class="td">
                <div class="editeWrapper">
                  <div class="edite">
                    <svg
                      data-name="Компонент 1 – 1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <defs>
                        <clipPath id="clip-path">
                          <path
                            id="Color_Overlay"
                            data-name="Color Overlay"
                            d="M1781,275h12v12h-12Z"
                            fill="#9095a8"
                          />
                        </clipPath>
                      </defs>
                      <g
                        id="Группа_масок_1"
                        data-name="Группа масок 1"
                        transform="translate(-1781 -275)"
                        clip-path="url(#clip-path)"
                      >
                        <g
                          id="_001-draw"
                          data-name="001-draw"
                          transform="translate(1781 275)"
                        >
                          <path
                            id="Контур_3"
                            data-name="Контур 3"
                            d="M7.462,2.022,9.9,4.463,3.724,10.642,1.284,8.2Zm4.293-.589L10.667.345a1.08,1.08,0,0,0-1.526,0L8.1,1.388l2.441,2.441,1.216-1.216A.832.832,0,0,0,11.755,1.433ZM.007,11.632a.278.278,0,0,0,.336.33l2.72-.66L.623,8.862Z"
                            fill="#9095a8"
                          />
                        </g>
                      </g>
                    </svg>
                  </div>
                  <div class="delete">
                    <svg
                      id="Сгруппировать_1"
                      data-name="Сгруппировать 1"
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <path
                        id="Контур_2"
                        data-name="Контур 2"
                        d="M7.322,6.016l4.487-4.487a.658.658,0,0,0,0-.928L11.415.208a.658.658,0,0,0-.928,0L6,4.694,1.513.208a.658.658,0,0,0-.928,0L.192.6a.657.657,0,0,0,0,.928L4.679,6.016.192,10.5a.658.658,0,0,0,0,.928l.393.393a.658.658,0,0,0,.928,0L6,7.337l4.487,4.487a.651.651,0,0,0,.464.192h0a.651.651,0,0,0,.464-.192l.393-.393a.658.658,0,0,0,0-.928Z"
                        transform="translate(0 -0.016)"
                        fill="#9095a8"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="tr">
              <div class="td">
                <a href="" class="nameWrapper">
                  <div class="statusPoint"></div>
                  <div class="name">Gulfstream GIV</div>
                  <img src="img/arrow.svg" alt="" class="arrow" />
                </a>
              </div>
              <div class="td">2016</div>
              <div class="td">100 000 000</div>
              <div class="td">5 300</div>
              <div class="td">15</div>
              <div class="td">765</div>
              <div class="td">685</div>
              <div class="td">1019</div>
              <div class="td">15%</div>
              <div class="td">150%</div>
              <div class="td">70%</div>
              <div class="td">50%</div>
              <div class="td">75.07</div>
              <div class="td">142.54</div>
              <div class="td">
                <div class="editeWrapper">
                  <div class="edite">
                    <svg
                      data-name="Компонент 1 – 1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <defs>
                        <clipPath id="clip-path">
                          <path
                            id="Color_Overlay"
                            data-name="Color Overlay"
                            d="M1781,275h12v12h-12Z"
                            fill="#9095a8"
                          />
                        </clipPath>
                      </defs>
                      <g
                        id="Группа_масок_1"
                        data-name="Группа масок 1"
                        transform="translate(-1781 -275)"
                        clip-path="url(#clip-path)"
                      >
                        <g
                          id="_001-draw"
                          data-name="001-draw"
                          transform="translate(1781 275)"
                        >
                          <path
                            id="Контур_3"
                            data-name="Контур 3"
                            d="M7.462,2.022,9.9,4.463,3.724,10.642,1.284,8.2Zm4.293-.589L10.667.345a1.08,1.08,0,0,0-1.526,0L8.1,1.388l2.441,2.441,1.216-1.216A.832.832,0,0,0,11.755,1.433ZM.007,11.632a.278.278,0,0,0,.336.33l2.72-.66L.623,8.862Z"
                            fill="#9095a8"
                          />
                        </g>
                      </g>
                    </svg>
                  </div>
                  <div class="delete">
                    <svg
                      id="Сгруппировать_1"
                      data-name="Сгруппировать 1"
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <path
                        id="Контур_2"
                        data-name="Контур 2"
                        d="M7.322,6.016l4.487-4.487a.658.658,0,0,0,0-.928L11.415.208a.658.658,0,0,0-.928,0L6,4.694,1.513.208a.658.658,0,0,0-.928,0L.192.6a.657.657,0,0,0,0,.928L4.679,6.016.192,10.5a.658.658,0,0,0,0,.928l.393.393a.658.658,0,0,0,.928,0L6,7.337l4.487,4.487a.651.651,0,0,0,.464.192h0a.651.651,0,0,0,.464-.192l.393-.393a.658.658,0,0,0,0-.928Z"
                        transform="translate(0 -0.016)"
                        fill="#9095a8"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
            <div class="tr">
              <div class="td">
                <a href="" class="nameWrapper">
                  <div class="statusPoint active"></div>
                  <div class="name">Gulfstream GIV</div>
                  <img src="img/arrow.svg" alt="" class="arrow" />
                </a>
              </div>
              <div class="td">2016</div>
              <div class="td">100 000 000</div>
              <div class="td">5 300</div>
              <div class="td">15</div>
              <div class="td">765</div>
              <div class="td">685</div>
              <div class="td">1019</div>
              <div class="td">15%</div>
              <div class="td">150%</div>
              <div class="td">70%</div>
              <div class="td">50%</div>
              <div class="td">75.07</div>
              <div class="td">142.54</div>
              <div class="td">
                <div class="editeWrapper">
                  <div class="edite">
                    <svg
                      data-name="Компонент 1 – 1"
                      xmlns="http://www.w3.org/2000/svg"
                      xmlns:xlink="http://www.w3.org/1999/xlink"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <defs>
                        <clipPath id="clip-path">
                          <path
                            id="Color_Overlay"
                            data-name="Color Overlay"
                            d="M1781,275h12v12h-12Z"
                            fill="#9095a8"
                          />
                        </clipPath>
                      </defs>
                      <g
                        id="Группа_масок_1"
                        data-name="Группа масок 1"
                        transform="translate(-1781 -275)"
                        clip-path="url(#clip-path)"
                      >
                        <g
                          id="_001-draw"
                          data-name="001-draw"
                          transform="translate(1781 275)"
                        >
                          <path
                            id="Контур_3"
                            data-name="Контур 3"
                            d="M7.462,2.022,9.9,4.463,3.724,10.642,1.284,8.2Zm4.293-.589L10.667.345a1.08,1.08,0,0,0-1.526,0L8.1,1.388l2.441,2.441,1.216-1.216A.832.832,0,0,0,11.755,1.433ZM.007,11.632a.278.278,0,0,0,.336.33l2.72-.66L.623,8.862Z"
                            fill="#9095a8"
                          />
                        </g>
                      </g>
                    </svg>
                  </div>
                  <div class="delete">
                    <svg
                      id="Сгруппировать_1"
                      data-name="Сгруппировать 1"
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      viewBox="0 0 12 12"
                    >
                      <path
                        id="Контур_2"
                        data-name="Контур 2"
                        d="M7.322,6.016l4.487-4.487a.658.658,0,0,0,0-.928L11.415.208a.658.658,0,0,0-.928,0L6,4.694,1.513.208a.658.658,0,0,0-.928,0L.192.6a.657.657,0,0,0,0,.928L4.679,6.016.192,10.5a.658.658,0,0,0,0,.928l.393.393a.658.658,0,0,0,.928,0L6,7.337l4.487,4.487a.651.651,0,0,0,.464.192h0a.651.651,0,0,0,.464-.192l.393-.393a.658.658,0,0,0,0-.928Z"
                        transform="translate(0 -0.016)"
                        fill="#9095a8"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="paginator">
      <div class="container">
        <select name="items" id="items">
          <option value="15">15</option>
          <option value="30">30</option>
        </select>
        <div class="paginatorWrapper">
          <div class="name">Page:</div>
          <div class="page">1</div>
          <div class="dots">...</div>
          <div class="page">6</div>
          <div class="page">7</div>
          <div class="page active">8</div>
          <div class="page">9</div>
          <div class="page">10</div>
          <div class="dots">...</div>
          <div class="page">25</div>
        </div>
        <div class="pagesFound">25 pages found</div>
      </div>
    </div>
  </body>
</html>
