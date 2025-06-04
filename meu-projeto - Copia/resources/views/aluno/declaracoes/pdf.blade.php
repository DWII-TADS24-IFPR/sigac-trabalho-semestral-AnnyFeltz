<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Declaração de Horas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { margin: 30px; }
        .titulo { font-size: 20px; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="titulo">Declaração de Atividades Complementares</div>

        <p>Declaramos que <strong>{{ $declaracao->aluno->name }}</strong> realizou a atividade:</p>

        <ul>
            <li><strong>Atividade:</strong> {{ $declaracao->comprovante->atividade }}</li>
            <li><strong>Categoria:</strong> {{ $declaracao->comprovante->categoria->nome }}</li>
            <li><strong>Carga horária:</strong> {{ $declaracao->comprovante->horas }} horas</li>
            <li><strong>Data:</strong> {{ \Carbon\Carbon::parse($declaracao->data)->format('d/m/Y') }}</li>
        </ul>

        <br><br>
        <p>Hash de verificação: <code>{{ $declaracao->hash }}</code></p>

        <br><br>
        <p>_________________________<br>Coordenação</p>
    </div>
</body>
</html>
