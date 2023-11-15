<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite('resources/js/app.js')
    <title>Document</title>
</head>
<body>
<a href="{{route('home')}}" class="d-block text-center">Домашняя страница</a>
<div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>IP:PORT</th>
            <th>Type</th>
            <th>Location</th>
            <th>Proxy kind</th>
            <th>Proxy work</th>
            <th>Timeout</th>
            <th>Ip</th>
        </tr>
        </thead>
        <tbody>
        @foreach($proxies as $proxy)
            <tr>
                <td>{{$proxy->ip_port}}</td>
                <td>{{$proxy->type}}</td>
                <td>{{$proxy->country}}</td>
                <td>{{$proxy->work ? ($proxy->kind ? 'Anonymous' : 'Transparent') : null}}</td>
                <td>{{$proxy->work ? 'Works' : 'Doesnt work'}}</td>
                <td>{{$proxy->timing}}</td>
                <td>{{$proxy->query}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
