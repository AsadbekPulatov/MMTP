@extends('admin.master')
@section('title', 'Fermerlar')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <a href="{{ route('farmers.create') }}" class="btn btn-success">
                            <i class="fa fa-plus"></i> Qo'shish
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Номи</th>
                            <th>ИНН</th>
                            <th>хр</th>
                            <th>Банк коди</th>
                            <th>Рахбари</th>
                            <th>Amallar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($farmers as $firm)
                            <tr>
                                <td>{{$loop->index +1}}</td>
                                <td>{{$firm->name}}</td>
                                <td>{{$firm->inn}}</td>
                                <td>{{$firm->bank_account}}</td>
                                <td>{{$firm->bank_code}}</td>
                                <td>{{$firm->leader}}</td>
                                <td class="d-flex">

                                    <a href="{{ route('farmers.edit', $firm->id) }}" class="btn btn-warning">
                                        <i class="fa fa-pen"></i>
                                    </a>


                                    <form action="{{route('farmers.destroy', $firm->id)}}" method="post">
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
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
@section('custom-scripts')
    <script>

        @if ($message = Session::get('success'))
        toastr.success("{{$message}}");
        @endif

    </script>
@endsection
