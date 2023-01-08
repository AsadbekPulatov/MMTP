@extends('admin.master')
@section('title', 'Xizmat qoshish')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{route('services.store')}}" id="form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Номи:</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="type_id">Бирлик:</label>
                                <select name="type_id" id="type_id" class="form-control form-select" required>
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @foreach($tractors as $item)
                                <input type="hidden" value="{{ $item['id'] }}" name="tractor_id[]">
                                <div class="d-flex">
                                    <div class="form-group w-50">
                                        <label for="price">Хизмат нархи({{ $item['name'] }}):</label>
                                        <input type="text" name="price[]" class="form-control" id="price" required>
                                    </div>
                                    <div class="form-group w-50 ml-3">
                                        <label for="price_worker">Ишчи нархи({{ $item['name'] }}):</label>
                                        <input type="text" name="price_worker[]" class="form-control" id="price_worker" required>
                                    </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <label for="date">Сана:</label>
                                <input type="date" name="date" class="form-control" id="date" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
