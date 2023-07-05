@extends('layouts.admin')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let monthLabel = ["ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.",
"ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
</script>

<!-- Small boxes (Stat box) -->
<div class="row">
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><span>&#3647;</span>{{number_format($totalIncome)}}</h3>
                <p>ยอดขายทั้งหมด</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <p class="small-box-footer"> &nbsp;</p>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
            <h3>{{number_format($productCount)}} ชิ้น</h3>

            <p>จำนวนสินค้าที่ขายได้ทั้งหมด</p>
            </div>
            <div class="icon">
            <i class="ion ion-stats-bars"></i>
            </div>
            <p class="small-box-footer"> &nbsp;</p>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
            <h3>{{number_format($orderCount)}} รายการ</h3>

            <p>จำนวนรายการสั่งซื้อทั้งหมด</p>
            </div>
            <div class="icon">
            <i class="ion ion-bag"></i>
            </div>
            <p class="small-box-footer"> &nbsp;</p>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
        <h3>{{number_format($customerCount)}} คน</h3>

        <p>จำนวนลูกค้าทั้งหมด</p>
        </div>
        <div class="icon">
        <i class="ion ion-person-add"></i>
        </div>
        <p class="small-box-footer"> &nbsp;</p>
    </div>
    </div>
    <!-- ./col -->
</div>



<div class="row">
    <div class="col-md-6"> 
           

        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">ยอดการขายรายเดือน</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">            
            
            <canvas id="bar_chart" style="height: 250px; width: 100%;"></canvas>
            <script>
                var ctx = document.getElementById('bar_chart').getContext('2d');
                var bar_chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: monthLabel,
                        datasets: [{
                            label: 'ปี {{date("Y")+543}}',
                            data: '{{json_encode($monthlyAmountData1)}}',
                            backgroundColor: '#f9bc07',
                            borderColor    : '#f9bc07',
                            borderWidth: 1
                        },{
                            label: 'ปี {{date("Y")+542}}',
                            data: '{{json_encode($monthlyAmountData2)}}',
                            backgroundColor: '#ced4da',
                            borderColor    : '#ced4da',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                display      : true,
                                lineWidth    : '4px',
                                color        : 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                display  : true,
                                gridLines: {
                                    display: false
                                },
                                }],
                        }
                    }
                });

            </script>
          </div>
 
        </div>        
    </div>    
    
    <div class="col-md-6">
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">จำนวนสินค้าที่ขายได้รายเดือน</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
                <canvas id="bar_chart2" style="height: 250px; width: 100%;"></canvas>
                <script>
                var ctx2 = document.getElementById('bar_chart2').getContext('2d');
                var bar_chart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: monthLabel,
                        datasets: [{
                            label: 'ปี {{date("Y")+543}}',
                            data: '{{json_encode($monthlyQuantityData1)}}',
                            backgroundColor: '#007bff',
                            borderColor    : '#007bff',
                            borderWidth: 1
                        },{
                            label: 'ปี {{date("Y")+542}}',
                            data: '{{json_encode($monthlyQuantityData2)}}',
                            backgroundColor: '#ced4da',
                            borderColor    : '#ced4da',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                display      : true,
                                lineWidth    : '4px',
                                color        : 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            xAxes: [{
                                display  : true,
                                gridLines: {
                                    display: false
                                },
                                }],
                        }
                    }
                });
                </script>                
                
            </div>
          </div>

        </div>
    </div>  

</div>   

<div class="row">
    <div class="col-md-6">    
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">5 อันดับสินค้าที่มียอดการซื้อสูงสุด</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
                
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                <script>           
                    var Top5AmountLabel = JSON.parse('<?=json_encode($Top5AmountLabel,JSON_UNESCAPED_UNICODE)?>');         
                    var Top5AmountData = JSON.parse('<?=json_encode($Top5AmountData)?>');

                    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                        var donutData        = {
                        labels: Top5AmountLabel,
                        datasets: [
                            {
                            data: Top5AmountData,
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                            }
                        ]
                        }
                        var donutOptions     = {
                        maintainAspectRatio : false,
                        responsive : true,
                        }
                        //Create pie or douhnut chart
                        // You can switch between pie and douhnut using the method below.
                        new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                        })                    
                </script>  

            </div>
          </div>
          <!-- /.card-body -->
        </div>        
    </div>    
    

    <div class="col-md-6">    
        <div class="card card-light">
          <div class="card-header">
            <h3 class="card-title">5 อันดับสินค้าที่มีจำนวนการซื้อสูงสุด</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">   

                <canvas id="donutChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                <script>           
                    var top5QuantityLabel = JSON.parse('<?=json_encode($top5QuantityLabel,JSON_UNESCAPED_UNICODE)?>');         
                    var top5QuantityData = JSON.parse('<?=json_encode($top5QuantityData)?>');

                    var donutChartCanvas = $('#donutChart2').get(0).getContext('2d')
                        var donutData        = {
                        labels: top5QuantityLabel,
                        datasets: [
                            {
                            data: top5QuantityData,
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                            }
                        ]
                        }
                        var donutOptions     = {
                        maintainAspectRatio : false,
                        responsive : true,
                        }
                        //Create pie or douhnut chart
                        // You can switch between pie and douhnut using the method below.
                        new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                        })                    
                </script>

            </div>
          </div>
          <!-- /.card-body -->
        </div>        
    </div>      


</div>  

@endsection 

