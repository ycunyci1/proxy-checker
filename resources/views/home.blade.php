<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
<div id="preloader-wrapper" class="d-none flex-column justify-content-center align-items-center">
{{--    <!-- Спиннер Bootstrap -->--}}
{{--    <div class="spinner-border text-light" role="status">--}}
{{--        <span class="sr-only"></span>--}}
{{--    </div>--}}

{{--    <!-- Прогресс-бар Bootstrap -->--}}
{{--    <div class="progress" style="width: 50%; margin-top: 20px;">--}}
{{--        <div class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--    </div>--}}
    <div id="preloader-overlay" class="d-flex justify-content-center align-items-center">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only"></span>
        </div>
        <div class="progress" style="width: 50%; margin-top: 20px;">
            <div class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
</div>
<h1 class="w-100 text-center d-block">Proxy checker</h1>
<a href="{{route('history')}}" class="d-block text-center">История проверок</a>
<div class="d-flex justify-content-center align-items-center">
    <div class="checker__wrapper mb-3 w-50">
        <label for="checker" class="form-label w-100 text-center">Введите ip:port для проверки (каждый прокси с новой строки)</label>
        <textarea id="checker" class="form-control" style="min-height: 100px"></textarea>
        <button type="button" class="btn btn-primary mt-2 checker__btn">Проверить</button>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center">
    <div class="results__wrapper">
        <table class="table table-bordered" style="display: none">
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

            </tbody>
        </table>
        <div class="result__counter"></div>
    </div>
</div>
</body>
</html>
