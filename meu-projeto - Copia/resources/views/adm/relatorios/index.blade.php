@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📊 Gráfico de Horas por Aluno</h2>

    <label for="turmaSelect">Selecione a turma:</label>
    <select id="turmaSelect" class="form-control mb-3">
        <option value="">Selecione uma turma</option>
        @foreach ($turmas as $turma)
        <option value="{{ $turma->id }}">
            {{ $turma->ano }} - {{ $turma->curso->nome }} ({{ $turma->curso->nivel->nome }})
        </option>
        @endforeach
    </select>

    <div id="grafico" style="width: 100%; height: 500px;"></div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });

    document.getElementById('turmaSelect').addEventListener('change', function() {
        let turmaId = this.value;
        if (!turmaId) return;

        fetch("{{ route('relatorios.grafico') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    turma_id: turmaId
                })
            })
            .then(response => response.json())
            .then(data => {
                google.charts.setOnLoadCallback(function() {
                    let chartData = [
                        ['Aluno', 'Horas']
                    ];
                    data.forEach(item => {
                        chartData.push([item.nome, item.horas]);
                    });

                    var dataTable = google.visualization.arrayToDataTable(chartData);
                    var options = {
                        title: 'Horas Aprovadas por Aluno',
                        legend: {
                            position: 'none'
                        },
                        hAxis: {
                            title: 'Aluno'
                        },
                        vAxis: {
                            title: 'Horas'
                        }
                    };

                    var chart = new google.visualization.ColumnChart(document.getElementById('grafico'));
                    chart.draw(dataTable, options);
                });
            });
    });
</script>
@endsection