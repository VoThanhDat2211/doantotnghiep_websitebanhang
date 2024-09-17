@extends('admin/layouts/layout')
@section('admin-content')
    <!-- //market-->
    <style>
        .market-update-gd {
            margin-bottom: 28px;
        }
    </style>
    <div class="market-updates">
        <div class=" col-md-6 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-2 market-update-right">
                    <i class="fa fa-eye"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Visitors</h4>
                    <h3>13,500</h3>
                    {{--  <p>Other hand, we denounce</p>  --}}
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class=" col-md-6 market-update-gd">
            <div class="market-update-block clr-block-1">
                <div class="col-md-2 market-update-right">
                    <i class="fa fa-users"></i>
                </div>
                <div class="col-md-6 market-update-left">
                    <h4>Khách Hàng</h4>
                    <h3>{{ priceFormat($quantityCustomer) }}</h3>
                    {{--  <p>Other hand, we denounce</p>  --}}
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class=" col-md-6 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-2 market-update-right">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Doanh Thu T9/2024</h4>
                    <h3>{{ priceFormat($revenue) }}</h3>
                    {{--  <p>Other hand, we denounce</p>  --}}
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class=" col-md-6 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-2 market-update-right">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Số Đơn Hàng T9/2024</h4>
                    <h3>{{ priceFormat($quantityOrder) }}</h3>
                    {{--  <p>Other hand, we denounce</p>  --}}
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    // thong ke doanh thu va so luong don hang theo nam
    <div class="row">
        <div class="container  text-center mb-5" style="width: 60%;margin-top:50px">
            <span class="fs-1"><b>SỐ LIỆU THỐNG KÊ NĂM:</b> </span> <select id="year-select" class="p-1 fs-1"
                onchange="onChange()">
                <option>2024</option>
            </select>
        </div>
        <div class="container mt-3" id="chart1" style="width: 70%">
            <canvas id="myChart1">
            </canvas>

        </div>
    </div>
   <script>
    let massPopChart;
        let massPopChart2;
        async function onChange() {

            document.getElementById('chart1').style.display = 'block';
            document.getElementById('chart2').style.display = 'block';
            let yearSelected = document.getElementById('year-select').value;
            let countData = [];
            let revenueData = [];
            try {
                let response = await axios.post("/admin/get-chart", {
                    year: yearSelected
                });
                countData = response.data.countOrderByMonthsOfYear;
                revenueData = response.data.totalRevenueByMonthsOfYear
                let myChart1 = document.getElementById('myChart1').getContext('2d');

                if (massPopChart) {
                    massPopChart.destroy();
                }
                if (massPopChart2) {
                    massPopChart2.destroy();
                }
                // Global Options
                Chart.defaults.global.defaultFontFamily = 'Lato';
                Chart.defaults.global.defaultFontSize = 18;
                Chart.defaults.global.defaultFontColor = '#777';


                massPopChart = new Chart(myChart1, {
                    type: 'bar',
                    data: {
                        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                        datasets: [{
                            label: 'Doanh thu',
                            data: revenueData,
                            //backgroundColor:'green',
                            backgroundColor: [
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)',
                                'rgba(23, 76, 144, 0.9)'
                            ],
                            borderWidth: 1,
                            borderColor: '#777',
                            hoverBorderWidth: 3,
                            hoverBorderColor: '#000'
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Tổng doanh thu',
                            fontSize: 25
                        },
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                fontColor: '#000'
                            }
                        },
                        layout: {
                            padding: {
                                left: 50,
                                right: 0,
                                bottom: 0,
                                top: 0
                            }
                        },
                        tooltips: {
                            enabled: true,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    return data.datasets[tooltipItem.datasetIndex].label + ': ' +
                                        Number(tooltipItem.yLabel).toLocaleString('vi-VN');
                                }
                            }
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function(value) {
                                        return value.toLocaleString('vi-VN');
                                    }
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Doanh thu (VND)',
                                    position: 'bottom'
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Tháng',
                                    position: 'end'
                                },
                                gridLines: {
                                    offsetGridLines: true
                                }
                            }]
                        },
                    }
                });


                let myChart2 = document.getElementById('myChart2').getContext('2d');
                massPopChart2 = new Chart(myChart2, {
                    type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                    data: {
                        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                        datasets: [{
                            label: 'Số đơn hàng',
                            data: countData,
                            //backgroundColor:'green',
                            backgroundColor: [
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)',
                                'rgba(254,196,1, 0.9)'
                            ],
                            borderWidth: 1,
                            borderColor: '#777',
                            hoverBorderWidth: 3,
                            hoverBorderColor: '#000'
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Tổng đơn hàng',
                            fontSize: 25
                        },
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                fontColor: '#000'
                            }
                        },
                        layout: {
                            padding: {
                                left: 50,
                                right: 0,
                                bottom: 0,
                                top: 0
                            }
                        },
                        tooltips: {
                            enabled: true
                        },
                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Số đơn hàng', // Tiêu đề cho trục tung
                                    position: 'top'
                                }
                            }],
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Tháng' // Tiêu đề cho trục hoành
                                }
                            }]
                        },
                        hover: {
                            mode: null
                        },
                    }
                });


            } catch (error) {
                console.log(error);
                // Xử lý lỗi ở đây
            }


        }

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
   </script>

    <!-- //market-->
    <div class="row">
        <div class="panel-body">
            <div class="col-md-12 w3ls-graph">
                <!--agileinfo-grap-->
                <div class="agileinfo-grap">
                    <div class="agileits-box">
                        <header class="agileits-box-header clearfix">
                            <h3>Visitor Statistics</h3>
                            <div class="toolbar">
                            </div>
                        </header>
                        <div class="agileits-box-body clearfix">
                            <div id="hero-area"></div>
                        </div>
                    </div>
                </div>
                <!--//agileinfo-grap-->
            </div>
        </div>
    </div>
    <div class="agil-info-calendar">
        <!-- calendar -->
        <div class="col-md-6 agile-calendar">
            <div class="calendar-widget">
                <div class="panel-heading ui-sortable-handle">
                    <span class="panel-icon">
                        <i class="fa fa-calendar-o"></i>
                    </span>
                    <span class="panel-title"> Calendar Widget</span>
                </div>
                <!-- grids -->
                <div class="agile-calendar-grid">
                    <div class="page">

                        <div class="w3l-calendar-left">
                            <div class="calendar-heading">

                            </div>
                            <div class="monthly" id="mycalendar"></div>
                        </div>

                        <div class="clearfix"> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //calendar -->
        <div class="col-md-6 w3agile-notifications">
            <div class="notifications">
                <!--notification start-->

                <header class="panel-heading">
                    Notification
                </header>
                <div class="notify-w3ls">
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span>
                                    send you a mail </li>
                                <li class="pull-right notification-time">1 min ago</li>
                            </ul>
                            <p>
                                Urgent meeting for next proposal
                            </p>
                        </div>
                    </div>
                    <div class="alert alert-danger">
                        <span class="alert-icon"><i class="fa fa-facebook"></i></span>
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span>
                                    mentioned you in a post </li>
                                <li class="pull-right notification-time">7 Hours Ago</li>
                            </ul>
                            <p>
                                Very cool photo jack
                            </p>
                        </div>
                    </div>
                    <div class="alert alert-success ">
                        <span class="alert-icon"><i class="fa fa-comments-o"></i></span>
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender">You have 5 message unread</li>
                                <li class="pull-right notification-time">1 min ago</li>
                            </ul>
                            <p>
                                <a href="#">Anjelina Mewlo, Jack Flip</a> and <a href="#">3 others</a>
                            </p>
                        </div>
                    </div>
                    <div class="alert alert-warning ">
                        <span class="alert-icon"><i class="fa fa-bell-o"></i></span>
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender">Domain Renew Deadline 7 days ahead</li>
                                <li class="pull-right notification-time">5 Days Ago</li>
                            </ul>
                            <p>
                                Next 5 July Thursday is the last day
                            </p>
                        </div>
                    </div>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-envelope-o"></i></span>
                        <div class="notification-info">
                            <ul class="clearfix notification-meta">
                                <li class="pull-left notification-sender"><span><a href="#">Jonathan Smith</a></span>
                                    send you a mail </li>
                                <li class="pull-right notification-time">1 min ago</li>
                            </ul>
                            <p>
                                Urgent meeting for next proposal
                            </p>
                        </div>
                    </div>

                </div>

                <!--notification end-->
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!-- tasks -->
    <div class="agile-last-grids">
        <div class="col-md-4 agile-last-left">
            <div class="agile-last-grid">
                <div class="area-grids-heading">
                    <h3>Monthly</h3>
                </div>
                <div id="graph7"></div>
                <script>
                    Morris.Area({
                        element: 'graph7',
                        data: [{
                                x: '2013-03-30 22:00:00',
                                y: 3,
                                z: 3
                            },
                            {
                                x: '2013-03-31 00:00:00',
                                y: 2,
                                z: 0
                            },
                            {
                                x: '2013-03-31 02:00:00',
                                y: 0,
                                z: 2
                            },
                            {
                                x: '2013-03-31 04:00:00',
                                y: 4,
                                z: 4
                            }
                        ],
                        xkey: 'x',
                        ykeys: ['y', 'z'],
                        labels: ['Y', 'Z']
                    });
                </script>

            </div>
        </div>
        <div class="col-md-4 agile-last-left agile-last-middle">
            <div class="agile-last-grid">
                <div class="area-grids-heading">
                    <h3>Daily</h3>
                </div>
                <div id="graph8"></div>
                <script>
                    /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
                    var day_data = [{
                            "period": "2016-10-01",
                            "licensed": 3407,
                            "sorned": 660
                        },
                        {
                            "period": "2016-09-30",
                            "licensed": 3351,
                            "sorned": 629
                        },
                        {
                            "period": "2016-09-29",
                            "licensed": 3269,
                            "sorned": 618
                        },
                        {
                            "period": "2016-09-20",
                            "licensed": 3246,
                            "sorned": 661
                        },
                        {
                            "period": "2016-09-19",
                            "licensed": 3257,
                            "sorned": 667
                        },
                        {
                            "period": "2016-09-18",
                            "licensed": 3248,
                            "sorned": 627
                        },
                        {
                            "period": "2016-09-17",
                            "licensed": 3171,
                            "sorned": 660
                        },
                        {
                            "period": "2016-09-16",
                            "licensed": 3171,
                            "sorned": 676
                        },
                        {
                            "period": "2016-09-15",
                            "licensed": 3201,
                            "sorned": 656
                        },
                        {
                            "period": "2016-09-10",
                            "licensed": 3215,
                            "sorned": 622
                        }
                    ];
                    Morris.Bar({
                        element: 'graph8',
                        data: day_data,
                        xkey: 'period',
                        ykeys: ['licensed', 'sorned'],
                        labels: ['Licensed', 'SORN'],
                        xLabelAngle: 60
                    });
                </script>
            </div>
        </div>
        <div class="col-md-4 agile-last-left agile-last-right">
            <div class="agile-last-grid">
                <div class="area-grids-heading">
                    <h3>Yearly</h3>
                </div>
                <div id="graph9"></div>
                <script>
                    var day_data = [{
                            "elapsed": "I",
                            "value": 34
                        },
                        {
                            "elapsed": "II",
                            "value": 24
                        },
                        {
                            "elapsed": "III",
                            "value": 3
                        },
                        {
                            "elapsed": "IV",
                            "value": 12
                        },
                        {
                            "elapsed": "V",
                            "value": 13
                        },
                        {
                            "elapsed": "VI",
                            "value": 22
                        },
                        {
                            "elapsed": "VII",
                            "value": 5
                        },
                        {
                            "elapsed": "VIII",
                            "value": 26
                        },
                        {
                            "elapsed": "IX",
                            "value": 12
                        },
                        {
                            "elapsed": "X",
                            "value": 19
                        }
                    ];
                    Morris.Line({
                        element: 'graph9',
                        data: day_data,
                        xkey: 'elapsed',
                        ykeys: ['value'],
                        labels: ['value'],
                        parseTime: false
                    });
                </script>

            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
    <!-- //tasks -->
    <div class="agileits-w3layouts-stats">
        <div class="col-md-4 stats-info widget">
            <div class="stats-info-agileits">
                <div class="stats-title">
                    <h4 class="title">Browser Stats</h4>
                </div>
                <div class="stats-body">
                    <ul class="list-unstyled">
                        <li>GoogleChrome <span class="pull-right">85%</span>
                            <div class="progress progress-striped active progress-right">
                                <div class="bar green" style="width:85%;"></div>
                            </div>
                        </li>
                        <li>Firefox <span class="pull-right">35%</span>
                            <div class="progress progress-striped active progress-right">
                                <div class="bar yellow" style="width:35%;"></div>
                            </div>
                        </li>
                        <li>Internet Explorer <span class="pull-right">78%</span>
                            <div class="progress progress-striped active progress-right">
                                <div class="bar red" style="width:78%;"></div>
                            </div>
                        </li>
                        <li>Safari <span class="pull-right">50%</span>
                            <div class="progress progress-striped active progress-right">
                                <div class="bar blue" style="width:50%;"></div>
                            </div>
                        </li>
                        <li>Opera <span class="pull-right">80%</span>
                            <div class="progress progress-striped active progress-right">
                                <div class="bar light-blue" style="width:80%;"></div>
                            </div>
                        </li>
                        <li class="last">Others <span class="pull-right">60%</span>
                            <div class="progress progress-striped active progress-right">
                                <div class="bar orange" style="width:60%;"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 stats-info stats-last widget-shadow">
            <div class="stats-last-agile">
                <table class="table stats-table ">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>PRODUCT</th>
                            <th>STATUS</th>
                            <th>PROGRESS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Lorem ipsum</td>
                            <td><span class="label label-success">In progress</span></td>
                            <td>
                                <h5>85% <i class="fa fa-level-up"></i></h5>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Aliquam</td>
                            <td><span class="label label-warning">New</span></td>
                            <td>
                                <h5>35% <i class="fa fa-level-up"></i></h5>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Lorem ipsum</td>
                            <td><span class="label label-danger">Overdue</span></td>
                            <td>
                                <h5 class="down">40% <i class="fa fa-level-down"></i></h5>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Aliquam</td>
                            <td><span class="label label-info">Out of stock</span></td>
                            <td>
                                <h5>100% <i class="fa fa-level-up"></i></h5>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Lorem ipsum</td>
                            <td><span class="label label-success">In progress</span></td>
                            <td>
                                <h5 class="down">10% <i class="fa fa-level-down"></i></h5>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Aliquam</td>
                            <td><span class="label label-warning">New</span></td>
                            <td>
                                <h5>38% <i class="fa fa-level-up"></i></h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection
