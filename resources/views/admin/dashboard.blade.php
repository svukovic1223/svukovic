@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Admin Panel - Dashboard</h1>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Broj proizvoda</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $brojProizvoda }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tshirt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Broj narudžbina</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $brojNarudzbina }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mesečni prihod</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $mesecniPrihod }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Broj narudžbina po danima</h6>
                    </div>
                    <div class="card-body">
                        <div id="chartContainer" style="height: 400px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', { packages: ['corechart', 'line'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Dan');
            data.addColumn('number', 'Narudžbine');

            data.addRows([
                @foreach($narudzbinePoDanima as $narudzbina)
                    ['{{ $narudzbina->dan }}', {{ $narudzbina->broj }}],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Broj narudžbina po danima',
                    subtitle: 'Narudžbine tokom nedelje'
                },
                hAxis: { title: 'Dan' },
                vAxis: { title: 'Broj narudžbina' },
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chartContainer'));
            chart.draw(data, options);
        }
    </script>
@endsection
