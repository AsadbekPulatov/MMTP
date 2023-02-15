@extends('admin.master')
{{--@section('title', 'Улчов бирликлари')--}}
@section('content')
    <div class="row">

        <!-- /.col-md-6 -->
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">{{ __("messages.types") }}</h3>
                </div>
                <div class="card-body">
                    @include("admin.types.create")
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Ўлчов бирлиги</th>
                                <th>Амаллар</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($types as $firm)
                                <tr>
                                    <td>{{$loop->index +1}}</td>
                                    <td>{{$firm->type}}</td>
                                    <td class="d-flex">

                                        <button type="button" onclick="edit({{$firm->id}})" class="btn btn-warning"
                                                data-toggle="modal" data-target="#modal-edit">
                                            <i class="fa fa-pen"></i>
                                        </button>


                                        <form action="{{route('types.destroy', $firm->id)}}" method="post">
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
                @include("admin.types.edit")
            </div>

        </div>
        <!-- /.col-md-6 -->
    </div>
@endsection
@section('custom-scripts')
    <script>

        let firmes =@json($types);

        function edit(id) {
            let form = document.getElementById('edit_form').action;
            document.getElementById('edit_form').action = form + '/' + id;
            for (let i = 0; i < firmes.length; i++) {
                if (id == firmes[i]["id"]) {
                    var firms = firmes[i];
                    console.log(firms);
                    document.getElementById('edit_type').value = firms['type'];
                    document.getElementById('edit_id').value = firms['id'];
                    break;
                }
            }
        }
    </script>
@endsection
