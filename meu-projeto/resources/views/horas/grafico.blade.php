@extends('layouts.app')

@section('title', 'Gráfico de Horas por Aluno')

@section('content')
<div class="d-flex justify-content-between align-items-center">
    <h1>Gráfico de Horas Cumpridas por Aluno</h1>
    <a href="{{ route('dashboard') }}" class="button">Voltar</a>
</div>

<div id="chart_div" style="width: 100%; height: 500px;"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Aluno', 'Horas Cumpridas'],
      @foreach($dadosGrafico as $aluno => $horas)
        ['{{ $aluno }}', {{ $horas }}],
      @endforeach
    ]);

    var options = {
      title: 'Horas Complementares por Aluno',
      legend: { position: 'none' },
      hAxis: {
        title: 'Aluno'
      },
      vAxis: {
        title: 'Horas'
      },
      colors: ['#5A9']
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

@endsection
