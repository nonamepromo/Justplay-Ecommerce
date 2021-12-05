

    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Registered Users Countries Count"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,

                    indexLabel: "{label} {y}",
                    dataPoints: [
                        {y: <?php echo $getUserCountries[0]['count']; ?>, label: "<?php echo $getUserCountries[0]['country'];?>"},
                        {y: <?php echo $getUserCountries[1]['count']; ?>, label: "<?php echo $getUserCountries[1]['country'];?>"},
                        {y: <?php echo $getUserCountries[2]['count']; ?>, label: "<?php echo $getUserCountries[2]['country'];?>"}
                        ]
                }]
            });
            chart.render();

        }
    </script>
    @extends('layouts.adminLayout.admin_design')
    @section('content')


    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url ('admin/dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="">Users</a> <a href="" class="current">View Users Countries Charts</a> </div>
            @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
            @endif
            @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
            @endif
            <h1>Users</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>View Users Countries Graph</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection

