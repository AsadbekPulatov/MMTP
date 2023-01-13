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
            font-size: 20px;
        }

        h1 {
            font-size: 20px;
            text-align: center;
            font-weight: bold;
        }

        table {
            margin-top: 250px;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }

        .header > th {
            border: 3px double black;
        }
        .office{
            width: 500px;
            font-weight: bold;
            text-align: center;
            position: absolute;
            left: 1%;
        }
        .farmer{
            width: 500px;
            font-weight: bold;
            text-align: center;
            position: absolute;
            left: 70%;
        }
    </style>
</head>
<body>
@if($page == 'farmer')
    <?php
    $s = 0;
    ?>
    <h1>ХИСОБ-ФАКТУР №_____</h1>
    <h1>{{$month}} {{$year}}-йил</h1>
    <div class="office">
        <p>Хизмат курсатувчи: </p>
        <p>{{\App\Models\Office::all()[0]->name}}</p>
        <p>х\р {{\App\Models\Office::all()[0]->bank_account}}</p>
        <p>МФО: {{\App\Models\Office::all()[0]->bank_code}} ИНН: {{\App\Models\Office::all()[0]->inn}}</p>
    </div>
    <div class="farmer">
        <p>Буюртмачи: </p>
        <p>{{$reports[0]->farmer->name}}</p>
        <p>х\р {{$reports[0]->farmer->bank_account}}</p>
        <p>МФО: {{$reports[0]->farmer->bank_code}} ИНН: {{$reports[0]->farmer->inn}}</p>
    </div>
    <div>
        <table border="1">
            <thead>
            <tr class="header">
                {{--                <th>#</th>--}}
                {{--                <th>Фермер</th>--}}
                <th rowspan="2">Хизмат тури</th>
                <th rowspan="2" style="width: 50px;">у\б</th>
                <th rowspan="2">Микдори</th>
                <th rowspan="2">Бахоси</th>
                <th rowspan="2">Жами хизмат бахоси</th>
                <th colspan="2">ККС</th>
                <th rowspan="2" style="width: 100px;">ККС б-н бирга хизмат бахоси</th>
            </tr>
            <tr class="header">
                <th>%</th>
                <th>сумма</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $firm)
                <tr>
                    {{--                    <td>{{$loop->index +1}}</td>--}}
                    {{--                    <td>{{$firm->farmer->name}}</td>--}}
                    <td>{{$firm->service->name}}</td>
                    <td>{{$firm->service->type->type }}</td>
                    <td>{{$firm->weight}}</td>
                    <td>{{number_format($firm->service->price, 0, ' ', ' ')}}</td>
                    <td>{{number_format($firm->service->price * $firm->weight, 2, ',', ' ')}}</td>
                    <td colspan="2">ККС сиз</td>
                    <td>-</td>
                    <?php
                    $s += $firm->service->price * $firm->weight;
                    ?>
                </tr>
            @endforeach
            <tr style="font-weight: bold; background-color: #d5d0d0">
                <td>ЖАМИ</td>
                <td>х</td>
                <td>х</td>
                <td>х</td>
                <td>{{number_format($s, 2, ',', ' ')}}</td>
                <td colspan="2">ККС сиз</td>
                <td>-</td>
            </tr>
            </tbody>
        </table>
    </div>
    <p style="margin-left: 50px;">
        <?php
        $service = new \App\Http\Service\number_to_word();
        echo $service->number_to_word(floor($s)) . " СУМ " . (round($s - floor($s), 2) * 100) . " ТИЙИН";
        ?>
    </p>
    <p style="margin-left: 50px; font-size: 18px;">Эслатма: Ёкилги фермер хужалиги хисобидан.</p>

    <div>
        <p>Рахбар: </p>
        <p>Бош хисобчи: </p>
    </div>
@elseif($page == 'worker')
    <div>
        <table border="1">
            <thead>
            <tr class="header">
                <th>Т/р</th>
                <th>Санаси</th>
                <th>Тракторчининг Ф.И.Ш</th>
                <th>Ф\х номи</th>
                <th>Иш тури</th>
                <th>Тр маркаси</th>
                <th>у\б</th>
                <th>Микдори</th>
                <th>Нархи</th>
                <th>Жами</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $firm)
                <tr>
                    <td>{{$loop->index +1}}</td>
                    <td>
                        @if($firm->start_date == $firm->end_date)
                            {{date('d.m.Y', strtotime($firm->start_date))}}
                        @else
                            {{date('d.m.Y', strtotime($firm->start_date))}}
                            - {{date('d.m.Y', strtotime($firm->end_date))}}
                        @endif
                    </td>
                    <td>{{$firm->worker->name}}</td>
                    <td>{{$firm->farmer->name}}</td>
                    <td>{{$firm->service->name}}</td>
                    <td>{{$firm->tractor->name}}</td>
                    <td>{{$firm->service->type->type}}</td>
                    <td>{{$firm->weight}}</td>
                    <td>{{number_format($firm->service->price, 0, ' ', ' ')}}</td>
                    <td>{{number_format($firm->service->price * $firm->weight, 2, ',', ' ')}}</td>
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
                <td>{{$sum['staj']}}</td>
                <td>х</td>
                <td>{{number_format($sum['price'], 2, ',', ' ')}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif
</body>
</html>
