<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Иш хаки</title>
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
        /*3500 px width*/
        table tr td:nth-child(1), table tr th:nth-child(1){ /*#*/
            width: 3%;
        }
        table tr td:nth-child(2), table tr th:nth-child(2){ /*date*/
            width: 8%;
        }
        table tr td:nth-child(3), table tr th:nth-child(3){ /*worker*/
            width: 12%;
        }
        table tr td:nth-child(4), table tr th:nth-child(4){ /*farmer*/
            width: 11%;
        }
        table tr td:nth-child(5), table tr th:nth-child(5){ /*service*/
            width: 10%;
        }
        table tr td:nth-child(6), table tr th:nth-child(6){ /*tractor*/
            width: 7%;
        }
        table tr td:nth-child(7), table tr th:nth-child(7){ /*type*/
            width: 4%;
        }
        table tr td:nth-child(8), table tr th:nth-child(8){ /*count*/
            width: 4%;
        }
        table tr td:nth-child(9), table tr th:nth-child(9){ /*weight*/
            width: 5%;
        }
        table tr td:nth-child(10), table tr th:nth-child(10){ /*price_worker*/
            width: 9%;
        }
        table tr td:nth-child(11), table tr th:nth-child(11){ /*staj*/
            width: 6%;
        }
        table tr td:nth-child(12), table tr th:nth-child(12){ /*price_worker_oneday*/
            width: 8%;
        }
        table tr td:nth-child(13), table tr th:nth-child(13){ /*price_worker_all*/
            width: 13%;
        }
        .header > th{
            border: 3px double black;
        }
    </style>
</head>
<body>
<p>{{ $office->name }} трактор хайдовчиларига {{ $date }} хисобланган иш хаки</p>
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
        <th>иш меъёри</th>
        <th>хаки- катда бажа- рилган иш</th>
        <th>асосий иш хаки</th>
        <th>сменада</th>
        <th>1 бирлик иш хаки</th>
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
        <tr style="font-weight: bold; background-color: #ccffff">
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
    <tr style="font-weight: bold; background-color: #ccffff">
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
