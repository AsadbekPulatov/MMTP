<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @if($page == 'worker')
        <title>{{ $reports[0]->worker->name }}</title>
    @else
        <title>{{ $reports[0]->farmer->name }}</title>
    @endif
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
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid black;
            text-align: center;
            /*padding: 8px;*/
        }

        .header > th {
            border: 3px double black;
        }

        .office {
            line-height: 20px;
            width: 500px;
            /*font-weight: bold;*/
            text-align: center;
            position: absolute;
            left: 1%;
            top: 10%;
        }

        .farmer {
            line-height: 20px;
            width: 500px;
            /*font-weight: bold;*/
            text-align: center;
            position: absolute;
            left: 70%;
            top: 10%;
        }
        .info{
            /*border: 1px solid black;*/
            padding: 10px;
            width: 100%;
            margin-top: 20px;
        }
        .info-left{
            /*border: 1px solid red;*/
            float: left;
            line-height: 20px;
            padding: 10px;
            width: 40%;
        }
        .info-right{
            /*border: 1px solid blue;*/
            float: right;
            line-height: 30px;
            text-align: center;
            padding: 10px;
            width: 40%;
        }
    </style>
</head>
<body>
@if($page == 'farmer')
    <?php
    $s = 0;
    ?>
    <h1>ХИСОБ-ФАКТУР №_____</h1>
    <h1>{{ $date }}</h1>
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
        <table border="1" style="margin-top: 200px;">
            <thead>
            <tr class="header">
                <th rowspan="2">#</th>
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
                    <td>{{$loop->index +1}}</td>
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
                <td></td>
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

    <div class="info">
        <div class="info-left">
            <pre>Рахбар:                                         {{ \App\Models\Office::all()[0]->leader }}</pre>
            <pre>Бош хисобчи:                               {{ \App\Models\Office::all()[0]->accountant }}</pre>
            <pre>                       м.у.</pre>
        </div>
        <div class="info-right">
            <p>Хисоб-фактурани олдим</p>
            <p>______________________________________________________</p>
        </div>
    </div>
@elseif($page == 'worker')
    <p>{{\App\Models\Office::all()[0]->name}} трактор хайдовчиси {{ $reports[0]->worker->name }}нинг {{ $date }} бажарган хизматлари</p>
    <div>
        <table border="1">
            <thead>
            <tr class="header">
                <th style="width: 3%;">Т/р</th>
                <th style="width: 10%;">Санаси</th>
                <th style="width: 15%;">Тракторчининг Ф.И.Ш</th>
                <th style="width: 15%">Ф\х номи</th>
                <th style="width: 15%">Иш тури</th>
                <th style="width: 7%">Тр маркаси</th>
                <th style="width: 5%">у\б</th>
                <th style="width: 7%">Микдори</th>
                <th style="width: 7%">Бахоси</th>
                <th style="width: 15%">Жами хизмат бахоси</th>
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
