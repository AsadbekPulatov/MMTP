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
    <h1>??????????-???????????? ???_____</h1>
    <h1>{{ $date }}</h1>
    <div class="office">
        <p>???????????? ????????????????????: </p>
        <p>{{\App\Models\Office::all()[0]->name}}</p>
        <p>??\?? {{\App\Models\Office::all()[0]->bank_account}}</p>
        <p>??????: {{\App\Models\Office::all()[0]->bank_code}} ??????: {{\App\Models\Office::all()[0]->inn}}</p>
    </div>
    <div class="farmer">
        <p>??????????????????: </p>
        <p>{{$reports[0]->farmer->name}}</p>
        <p>??\?? {{$reports[0]->farmer->bank_account}}</p>
        <p>??????: {{$reports[0]->farmer->bank_code}} ??????: {{$reports[0]->farmer->inn}}</p>
    </div>
    <div>
        <table border="1" style="margin-top: 200px;">
            <thead>
            <tr class="header">
                <th rowspan="2">#</th>
                {{--                <th>????????????</th>--}}
                <th rowspan="2">???????????? ????????</th>
                <th rowspan="2" style="width: 50px;">??\??</th>
                <th rowspan="2">??????????????</th>
                <th rowspan="2">????????????</th>
                <th rowspan="2">???????? ???????????? ????????????</th>
                <th colspan="2">??????</th>
                <th rowspan="2" style="width: 100px;">?????? ??-?? ?????????? ???????????? ????????????</th>
            </tr>
            <tr class="header">
                <th>%</th>
                <th>??????????</th>
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
                    <td colspan="2">?????? ??????</td>
                    <td>-</td>
                    <?php
                    $s += $firm->service->price * $firm->weight;
                    ?>
                </tr>
            @endforeach
            <tr style="font-weight: bold; background-color: #d5d0d0">
                <td></td>
                <td>????????</td>
                <td>??</td>
                <td>??</td>
                <td>??</td>
                <td>{{number_format($s, 2, ',', ' ')}}</td>
                <td colspan="2">?????? ??????</td>
                <td>-</td>
            </tr>
            </tbody>
        </table>
    </div>
    <p style="margin-left: 50px;">
        <?php
        $service = new \App\Http\Service\number_to_word();
        echo $service->number_to_word(floor($s)) . " ?????? " . (round($s - floor($s), 2) * 100) . " ??????????";
        ?>
    </p>
    <p style="margin-left: 50px; font-size: 18px;">??????????????: ???????????? ???????????? ???????????????? ??????????????????.</p>

    <div class="info">
        <div class="info-left">
            <pre>????????????:                                         {{ \App\Models\Office::all()[0]->leader }}</pre>
            <pre>?????? ??????????????:                               {{ \App\Models\Office::all()[0]->accountant }}</pre>
            <pre>                       ??.??.</pre>
        </div>
        <div class="info-right">
            <p>??????????-?????????????????? ??????????</p>
            <p>______________________________________________________</p>
        </div>
    </div>
@elseif($page == 'worker')
    <p>{{\App\Models\Office::all()[0]->name}} ?????????????? ???????????????????? {{ $reports[0]->worker->name }}???????? {{ $date }} ???????????????? ????????????????????</p>
    <div>
        <table border="1">
            <thead>
            <tr class="header">
                <th style="width: 3%;">??/??</th>
                <th style="width: 10%;">????????????</th>
                <th style="width: 15%;">?????????????????????????? ??.??.??</th>
                <th style="width: 15%">??\?? ????????</th>
                <th style="width: 15%">???? ????????</th>
                <th style="width: 7%">???? ??????????????</th>
                <th style="width: 5%">??\??</th>
                <th style="width: 7%">??????????????</th>
                <th style="width: 7%">????????????</th>
                <th style="width: 15%">???????? ???????????? ????????????</th>
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
                <td>??</td>
                <td>??</td>
                <td>????????</td>
                <td>??</td>
                <td>??</td>
                <td>??</td>
                <td>??</td>
                <td>{{$sum['staj']}}</td>
                <td>??</td>
                <td>{{number_format($sum['price'], 2, ',', ' ')}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endif
</body>
</html>
