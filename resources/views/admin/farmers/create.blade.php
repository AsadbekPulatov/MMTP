@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">{{ __("messages.farmer") }} {{ mb_strtolower(__("messages.add"), "UTF-8") }}</h3>
                </div>
                <form method="post" action="{{route('farmers.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Номи:</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="inn">ИНН:</label>
                            <input type="text" name="inn" class="form-control" id="inn" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_account">хр:</label>
                            <input type="text" name="bank_account" class="form-control" id="bank_account" required>
                        </div>
                        <div class="form-group">
                            <label for="bank_code">Банк коди:</label>
                            <input type="text" name="bank_code" class="form-control" id="bank_code" required>
                        </div>
                        <div class="form-group">
                            <label for="leader">Рахбари:</label>
                            <input type="text" name="leader" class="form-control" id="leader" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">{{__("messages.save")}}</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
