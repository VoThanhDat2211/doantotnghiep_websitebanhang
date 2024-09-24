@extends('admin/layouts/layout')
@section('admin-content')
    <!-- //market-->
    <style>
        .market-update-gd {
            margin-bottom: 28px;
        }

        .agile-last-grids {
            margin-top: 60px;
        }

        .agile-Updating-grids, .agile-bottom-grid, .agile-last-grid {
            background: #fff;
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
    {{--  thong ke doanh thu va so luong don hang theo nam  --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="container text-center mb-5" style="width: 60%;margin-top:50px">
                <span class="fs-1"><b>SỐ LIỆU THỐNG KÊ NĂM:</b> </span>
                <select id="year-select" class="p-1 fs-1">
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="container mt-3" id="chart1" style="width: 100%; margin-top: 20px">
                <canvas id="myChart1"></canvas>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="container mt-3" id="chart1" style="width: 100%; margin-top: 20px">
                <canvas id="myChart2"></canvas>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script>
        let massPopChart;
        let massPopChart2;

        async function createChart(yearSelected) {
            let countData = [];
            let revenueData = [];
            try {
                let response = await axios.get("/api/get-statistic-by-year", {
                    params: {
                        year: yearSelected
                    }
                });
                countData = response.data.countOrderByMonthsOfYear;
                revenueData = response.data.totalRevenueByMonthsOfYear;
                console.log(countData);
                console.log(revenueData);
            } catch (error) {
                console.log(error);
            }
            if (massPopChart) {
                massPopChart.data.datasets[0].data = revenueData;
                massPopChart.update();
            } else {
                massPopChart = new Chart($('#myChart1'), {
                    type: 'bar',
                    data: {
                        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                        datasets: [{
                            label: 'Doanh thu',
                            data: revenueData,
                            backgroundColor: 'rgba(23, 76, 144, 0.9)',
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
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng',
                                    position: 'end'
                                },
                                grid: {
                                    offset: true
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString('vi-VN');
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Doanh thu (VND)',
                                    position: 'bottom'
                                }
                            }
                        }
                    }
                });
            }

            if (massPopChart2) {
                massPopChart2.data.datasets[0].data = countData;
                massPopChart2.update();
            } else {
                let myChart2 = document.getElementById('myChart2').getContext('2d');
                massPopChart2 = new Chart(myChart2, {
                    type: 'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                    data: {
                        labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                        datasets: [{
                            label: 'Số đơn hàng',
                            data: countData,
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
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tháng', // Tiêu đề cho trục hoành
                                    position: 'end'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Số đơn hàng', // Tiêu đề cho trục tung
                                    position: 'top'
                                }
                            }
                        },
                        hover: {
                            mode: null
                        },
                    }
                });

            }


        }
            $(document).ready(function() {
                var yearSelectElement = $('#year-select');
                var currentYear = new Date().getFullYear();
                var startYear = currentYear - 5;
                let yearSelect = currentYear;
                yearSelectElement.append($('<option  selected/>').val(`${currentYear}`).text(`${currentYear}`));

                for (var i = currentYear - 1; i > startYear; i--) {
                    yearSelectElement.append($('<option />').val(i).text(i));
                }

                $('#year-select').on('change', function() {
                yearSelect = $('#year-select').val();
                createChart(yearSelect);
            });
                 createChart(yearSelect);
            });

            
    </script>



    <!-- tasks -->
    <div class="agile-last-grids">
        <div class="col-md-6 agile-last-left agile-last-right">
            <div class="agile-last-grid">
                <div class="area-grids-heading">
                    <h3>Doanh Thu Hàng Năm</h3>
                </div>
                <div id="graph9"></div>
                <script>
                    let revenueByYearArray = @json($revenueByYearArray);
                    const revenueByYear = Object.entries(revenueByYearArray).map(([key, value]) => {
                        const obj = {};
                        obj['elapsed'] = key;
                        obj['value'] = value
                        return obj;
                    });

                    console.log(revenueByYear);
                    var day_data = revenueByYear;
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

        <div class="col-md-6 agile-last-left agile-last-right">
            <div class="agile-last-grid">
                <div class="area-grids-heading">
                    <h3>Số Đơn Hàng Hàng Năm</h3>
                </div>
                <div id="graph10"></div>
                <script>
                    let orderNumberByYearArray = @json($orderNumberByYearArray);
                    const orderNumberByYear = Object.entries(orderNumberByYearArray).map(([key, value]) => {
                        const obj = {};
                        obj['elapsed'] = key;
                        obj['value'] = value
                        return obj;
                    });

                    console.log(orderNumberByYear);
                    var day_data = orderNumberByYear;
                    Morris.Line({
                        element: 'graph10',
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
    <script>
        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
@endsection
