@extends('admin.master')
@section('title', 'Xizmatlar')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <a href="{{ route('services.create') }}" class="btn btn-success">
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
                            <th>Трактор</th>
                            <th>Хизмат нархи</th>
                            <th>Ишчи нархи</th>
                            <th>Сана</th>
                            <th>Amallar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $firm)
                            <tr>
                                <td>{{$loop->index +1}}</td>
                                <td>{{$firm->name}}</td>
                                <td>{{$firm->tractor->name}}</td>
                                <td>{{ number_format($firm->price, 0, ' ', ' ') }}</td>
                                <td>{{ number_format($firm->price_worker, 0, ' ', ' ') }}</td>
                                <td>{{ $firm->date }}</td>
                                <td class="d-flex">

                                    <a href="{{ route('services.edit', $firm->id) }}" class="btn btn-warning">
                                        <i class="fa fa-pen"></i>
                                    </a>


                                    <form action="{{route('services.destroy', $firm->id)}}" method="post">
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
