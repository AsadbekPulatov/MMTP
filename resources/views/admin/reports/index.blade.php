@extends('admin.master')
{{--@section('title', 'Бажарилган ишлар')--}}
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">{{ __("messages.reports") }}</h3>
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
                                <form method="get" action="{{ route('reports.index') }}" id="form">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="farmer_id">Фермер:</label>
                                            <select name="farmer_id" class="form-control" id="farmer_id">
                                                <option value="">Танланг</option>
                                                @foreach(\App\Models\Farmer::all() as $farmer)
                                                    <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="worker_id">Тракторчи:</label>
                                            <select name="worker_id" class="form-control" id="worker_id">
                                                <option value="">Танланг</option>
                                                @foreach(\App\Models\Worker::all() as $worker)
                                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="from_date">Санадан:</label>
                                            <input type="date" name="from_date" class="form-control" id="from_date"
                                                   required>
                                        </div>
                                        <div class="form-group">
                                            <label for="to_date">Санагача:</label>
                                            <input type="date" name="to_date" class="form-control" id="to_date"
                                                   required>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Бекор қилиш
                                        </button>
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
                        <div>
                            <a href="{{ route('reports.create') }}" class="btn btn-success">
                                <i class="fa fa-plus"></i> {{ __("messages.add") }}
                            </a>
                        </div>
                        <button type="button" class="ml-3 btn btn-info" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-filter"></i> {{ __("messages.filter") }}
                        </button>
                        <div>
                            <a href="{{ route('download.farmers',
                                        [
                                            'from_date' => $from_date,
                                            'to_date' => $to_date,
                                            'worker_id' => $worker_id,
                                            'farmer_id' => $farmer_id,
                                        ]
                                        ) }}" class="btn btn-info ml-3"><i class="fa fa-download"></i> {{ __("messages.download") }}</a>
                        </div>
                    </div>
                    @if($page == 'farmer')
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Фермер</th>
                                    <th>Хизмат</th>
                                    <th>Микдори</th>
                                    <th>Нархи</th>
                                    <th>Жами</th>
                                    <th>Сана</th>
                                    <th>Амаллар</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $firm)
                                    <tr>
                                        <td>{{$loop->index +1}}</td>
                                        <td>{{$firm->farmer->name}}</td>
                                        <td>{{$firm->service->name}}</td>
                                        <td>{{$firm->weight}}</td>
                                        <td>{{number_format($firm->service->price, 0, ' ', ' ')}}</td>
                                        <td>{{number_format($firm->service->price * $firm->weight, 2, ',', ' ')}}</td>
                                        <td>
                                            @if($firm->start_date == $firm->end_date)
                                                {{date('d.m.Y', strtotime($firm->start_date))}}
                                            @else
                                                {{date('d.m.Y', strtotime($firm->start_date))}}
                                                - {{date('d.m.Y', strtotime($firm->end_date))}}
                                            @endif
                                            {{--                                    {{$firm->date}}--}}
                                        </td>
                                        <td class="d-flex">

                                            <a href="{{ route('reports.edit', $firm->id) }}" class="btn btn-warning">
                                                <i class="fa fa-pen"></i>
                                            </a>


                                            <form action="{{route('reports.destroy', $firm->id)}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger show_confirm"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif($page == 'worker')
                        <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
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
                                <tr class="text-bold">
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
                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
