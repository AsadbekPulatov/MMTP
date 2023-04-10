@extends('admin.master')
{{--@section('title', 'Иш ҳақи')--}}
@section('content')
    <style>
        .rotate{
            /*transform: rotate(270deg);*/
        }
    </style>
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">{{ __("messages.report_worker") }}</h3>
                </div>
                <div class="modal fade" id="modal-create">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{ __("messages.filter") }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="get" action="{{ route('reports.workers') }}" id="form">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="from_date">Санадан:</label>
                                            <input type="date" name="from_date" class="form-control" id="from_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="to_date">Санагача:</label>
                                            <input type="date" name="to_date" class="form-control" id="to_date" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Ишчилар:</label><br>
                                            <label for="n0"><input type="checkbox" id="n0" name="worker_id[]" value="0" onclick="filter()"> Всё </label>
                                            <br>
                                            @foreach(\App\Models\Worker::all() as $worker)
                                                <label for="n{{ $worker->id }}"><input type="checkbox" id="n{{ $worker->id }}" name="worker_id[]" value="{{ $worker->id }}"> {{ $worker->name }} </label>
                                                <br>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Бекор қилиш</button>
                                        <button type="submit" class="btn btn-primary">Сақлаш</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-filter"></i> {{ __("messages.filter") }}
                        </button>
                        <div>
                            <a href="{{ route('download.workers',
                                        [
                                            'from_date' => $from_date,
                                            'to_date' => $to_date,
                                            'worker_id' => $worker_id,
                                            'type' => 'pdf'
                                        ]
                                        ) }}" class="btn btn-info ml-3"><i class="fa fa-download"></i> {{ __("messages.download") }} <i class="fa fa-file-pdf"></i>
                            </a>
                            <a href="{{ route('download.workers',
                                        [
                                            'from_date' => $from_date,
                                            'to_date' => $to_date,
                                            'worker_id' => $worker_id,
                                            'type' => 'xls'
                                        ]
                                        ) }}" class="btn btn-info ml-3"><i class="fa fa-download"></i> {{ __("messages.download") }} <i class="fa fa-file-excel"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Санаси</th>
                                <th>Тракторчининг Ф.И.Ш</th>
                                <th>Ф\х номи</th>
                                <th>Иш тури</th>
                                <th>Тр маркаси</th>
                                <th>у\б</th>
                                <th class="rotate">иш меъёри</th>
                                <th>хакикатда бажарилган иш</th>
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
                                <tr class="text-bold">
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
                            <tr class="text-bold">
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
                    </div>
                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
    <script>
        function filter(){
            var all = document.getElementById('n0');
            @foreach(\App\Models\Worker::all() as $worker)
                if (all.checked){
                    document.getElementById('n{{ $worker->id }}').checked = true;
                }else
                document.getElementById('n{{ $worker->id }}').checked = false;
            @endforeach
        }
    </script>
@endsection
