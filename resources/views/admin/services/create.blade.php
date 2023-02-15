@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Янги нарх қўшиш</h3>
                </div>
                {{--                <div class="card-body">--}}
                <form method="post" action="{{route('services.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Иш тури:</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Ўлчов бирлиги:</label>
                            <select name="type_id" id="type_id" class="form-control form-select" required>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tractor_id">Трактор:</label>
                            <select name="tractor_id" id="tractor_id" class="form-control form-select" required>
                                @foreach($tractors as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex">
                            <div class="form-group w-50">
                                <label for="price">Хизмат баҳоси:</label>
                                <input type="text" name="price" class="form-control" id="price" required>
                            </div>
                            <div class="form-group w-50 ml-3">
                                <label for="price_worker">Разряд баҳоси:</label>
                                <input type="text" name="price_worker" class="form-control" id="price_worker"
                                       required>
                            </div>
                            <div class="form-group w-50 ml-3">
                                <label for="count">Миқдори:</label>
                                <input type="text" name="count" class="form-control" id="count" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date">Сана:</label>
                            <input type="date" name="date" class="form-control" id="date" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">{{ __("messages.save") }}</button>
                    </div>
                </form>
                {{--                </div>--}}
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
