@extends('admin.master')
{{--@section('title', 'Нархни таҳрирлаш')--}}
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Нархни таҳрирлаш</h3>
                </div>
{{--                <div class="card-body">--}}
                    <form method="post" action="{{route('services.update', $service->id)}}" id="form">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Иш тури:</label>
                                <input type="text" name="name" class="form-control" id="name" required
                                       value="{{ $service->name }}">
                            </div>
                            <div class="form-group">
                                <label for="type_id">Ўлчов бирлиги:</label>
                                <select name="type_id" id="type_id" class="form-control form-select" required>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}"
                                            {{ $service->type_id == $type->id ? 'selected' : '' }}>
                                            {{$type->type}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" value="{{ $service->tractor_id }}" name="tractor_id">
                            <div class="d-flex">
                                <div class="form-group w-50">
                                    <label for="price">Хизмат баҳоси({{ $service->tractor->name }}):</label>
                                    <input type="text" name="price" class="form-control" id="price" required value="{{ $service->price }}">
                                </div>
                                <div class="form-group w-50 ml-3">
                                    <label for="price_worker">Разряд баҳоси({{ $service->tractor->name }}):</label>
                                    <input type="text" name="price_worker" class="form-control" id="price_worker"
                                           required value="{{ $service->price_worker }}">
                                </div>
                                <div class="form-group w-50 ml-3">
                                    <label for="count">Миқдори({{ $service->tractor->name }}):</label>
                                    <input type="text" name="count" class="form-control" id="count"
                                           required value="{{ $service->count }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date">Сана:</label>
                                <input type="date" name="date" class="form-control" id="date" required
                                       value="{{ $service->date }}">
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
