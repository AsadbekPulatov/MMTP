<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Workers</title>
    <style>
        * {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 16px;
        }
        p{
            text-align: center;
            font-weight: bold;
        }
        table{
            border-collapse: collapse;
            width: 100%;
        }
        td, th{
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }
        .header > th{
            border: 3px double black;
        }
    </style>
</head>
<body>
<p>"Улугбек-Обод" МЧЖ трактор хайдовчиларига {{ $year }}-йил {{ $month }} ойида хисобланган иш хаки</p>
<table border="1">
    <thead>
    <tr class="header">
        <th>#</th>
        <th>Санаси</th>
        <th>Тракторчининг Ф.И.Ш</th>
        <th>Ф\х номи</th>
        <th>Иш тури</th>
        <th>Тр маркаси</th>
        <th>у\б</th>
        <th class="rotate">иш меъёри</th>
        <th style="width: 30px">хаки- катда бажа- рилган иш</th>
        <th>асосий иш хаки</th>
        <th class="rotate">сменада</th>
        <th class="rotate">1 бирлик иш хаки</th>
        <th>жами иш хаки</th>
    </tr>
    </thead>
    <tbody>
    @foreach($workers as $firm)
        @foreach($firm['data'] as $item)
            <tr>
                <td>{{$loop->index +1}}</td>
                <td>{{$item['date']}}</td>
                <td>{{$item['worker']}}</td>
                <td>{{$item['farmer']}}</td>
                <td>{{$item['service']}}</td>
                <td>{{$item['tractor']}}</td>
                <td>{{$item['type']}}</td>
                <td>{{$item['count']}}</td>
                <td>{{$item['weight']}}</td>
                <td>{{number_format($item['price_worker'],2,',',' ')}}</td>
                <td>{{$item['staj']}}</td>
                <td>{{number_format($item['price_worker_oneday'],2,',',' ')}}</td>
                <td>{{number_format($item['price_worker_all'],2,',',' ')}}</td>
            </tr>
        @endforeach
        <tr style="font-weight: bold; background-color: #d5d0d0">
            <td>х</td>
            <td>х</td>
            <td>ЖАМИ</td>
            <td>х</td>
            <td>х</td>
            <td>х</td>
            <td>х</td>
            <td>х</td>
            <td>х</td>
            <td>х</td>
            <td>{{$firm['sum_staj']}}</td>
            <td>х</td>
            <td>{{number_format($firm['sum_price'],2,',',' ')}}</td>
        </tr>
    @endforeach
    <tr style="font-weight: bold; background-color: #5bf85b">
        <td>х</td>
        <td>х</td>
        <td>ХАММАСИ</td>
        <td>х</td>
        <td>х</td>
        <td>х</td>
        <td>х</td>
        <td>х</td>
        <td>х</td>
        <td>х</td>
        <td>{{$sum['staj']}}</td>
        <td>х</td>
        <td>{{number_format($sum['price'],2,',',' ')}}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
