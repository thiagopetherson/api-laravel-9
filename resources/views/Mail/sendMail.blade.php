<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="description" content="Descrição do meu email">
</head>
    <div>
        <h2>Notificação de Email</h2>
        <span>Nome do Produto: <b>{{$name}}</b></span><br>
        <span>Valor do Produto: <b>{{$value}}</b></span><br>
        <span>Status do Produto: <b>{{ $active == 1 ? 'Ativo' : 'Inativo' }}</b></span><br>
        <span>Loja: <b>{{$store}}</b></span><br>
        <span>Email que seria notificado: <b>{{$email}}</b></span>     
    </div>
</html>


