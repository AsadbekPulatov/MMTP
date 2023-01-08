@extends('admin.master')
@section('title', 'Fermer qoshish')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
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
