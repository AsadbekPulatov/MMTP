@extends('admin.master')
{{--@section('title', 'Ишчилар')--}}
@section('content')
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">{{ __("messages.workers") }}</h3>
                </div>
                <div class="card-body">
                    @include("admin.workers.create")
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ф.И.Ш</th>
                                <th>Амаллар</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($workers as $firm)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{$firm->name}}</td>
                                    <td class="d-flex">

                                        <button type="button" onclick="edit({{$firm->id}})" class="btn btn-warning"
                                                data-toggle="modal" data-target="#modal-edit">
                                            <i class="fa fa-pen"></i>
                                        </button>


                                        <form action="{{route('workers.destroy', $firm->id)}}" method="post">
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
                @include("admin.workers.edit")
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
@section('custom-scripts')
    <script>

        let firmes =@json($workers);

        function edit(id) {
            let form = document.getElementById('edit_form').action;
            document.getElementById('edit_form').action = form + '/' + id;
            for (let i = 0; i < firmes.length; i++) {
                if (id == firmes[i]["id"]) {
                    var firms = firmes[i];
                    console.log(firms);
                    document.getElementById('edit_name').value = firms['name'];
                    document.getElementById('edit_id').value = firms['id'];
                    break;
                }
            }
        }
    </script>
@endsection
