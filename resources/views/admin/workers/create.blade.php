<div class="d-flex mb-3">
    <div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create">
            <i class="fa fa-plus"></i> {{ __("messages.add") }}
        </button>
    </div>
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ишчи қўшиш</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('workers.store')}}" id="form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Ф.И.Ш:</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("messages.close") }}</button>
                            <button type="submit" class="btn btn-primary">{{ __("messages.save") }}</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
