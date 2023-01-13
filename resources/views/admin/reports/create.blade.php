@extends('admin.master')
{{--@section('title', 'Бажарилган ишларни киритиш')--}}
@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: x-large">Бажарилган ишларни киритиш</h3>
                </div>
                {{--                <div class="card-body">--}}
                <form method="post" action="{{route('reports.store')}}" id="form">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="form-group w-100">
                                <label for="start_date">Санадан:</label>
                                <input type="date" name="start_date" class="form-control" id="date" required
                                       onchange="sana()">
                            </div>
                            <div class="form-group w-100 ml-3">
                                <label for="date">Санагача:</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" required
                                       onchange="validate()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="worker_id">Тракторчи:</label>
                            <select name="worker_id" class="form-control" id="worker_id" required>
                                <option value="">Тракторчини танланг</option>
                                @foreach($workers as $worker)
                                    <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tractor_id">Трактор маркаси:</label>
                            <select name="tractor_id" class="form-control" id="tractor_id" required
                                    onchange="tractor()">
                                <option value="">Трактор маркасини танланг</option>
                                @foreach($tractors as $tractor)
                                    <option value="{{ $tractor->id }}">{{ $tractor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="farmer_id">Фермер:</label>
                            <select name="farmer_id" class="form-control" id="farmer_id" required>
                                <option value="">Фермерни танланг</option>
                                @foreach($farmers as $farmer)
                                    <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="service_id">Иш тури:</label>
                            <select name="service_id" class="form-control" id="service_id" required
                                    onclick="service()"></select>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Улчов бирлиги:</label>
                            <input type="text" name="type_id" class="form-control" id="type_id" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="count">Иш меъёри:</label>
                            <input type="number" name="count" class="form-control" id="count" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="weight">Микдори:</label>
                            <input type="text" name="weight" class="form-control" id="weight" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Хизмат баҳоси:</label>
                            <input type="number" name="price" class="form-control" id="price" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="price_worker">Разряд баҳоси:</label>
                            <input type="number" name="price_worker" class="form-control" id="price_worker" required
                                   disabled>
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
@section('custom-scripts')
    <script>
        var services = @json($services);
        var types = @json($types);
        var newServices = [];
        var ServiceName = [];

        function validate() {
            var start_date = document.getElementById('date');
            var end_date = document.getElementById('end_date');
            if (start_date.value > end_date.value) {
                toastr.error('Саналарни киритишда хатолик бор');
                end_date.style.backgroundColor = 'red';
                // end_date.style.border = '1px solid red';
            } else {
                end_date.style.backgroundColor = start_date.style.backgroundColor;
            }
        }

        function sana() {
            newServices = [];
            var date = document.getElementById('date').value;
            for (var i = 0; i < services.length; i++) {
                if (services[i].date <= date) {
                    ServiceName.push(services[i].name);
                    newServices.push(services[i]);
                }
            }
            var select = document.getElementById('service_id');
            select.innerHTML = '';
            var option = document.createElement('option');
            option.value = "";
            option.innerHTML = "Иш турини танланг";
            select.appendChild(option);
            document.getElementById('tractor_id').value = "";
            document.getElementById('type_id').value = "";
            document.getElementById('price').value = "";
            document.getElementById('price_worker').value = "";
            document.getElementById('count').value = "";
            for (var i = 0; i < newServices.length; i++) {
                var option = document.createElement('option');
                option.value = newServices[i].id;
                option.innerHTML = newServices[i].name;
                select.appendChild(option);
            }
        }

        function tractor() {
            var tractor_id = document.getElementById('tractor_id').value;
            var date = document.getElementById('date').value;
            var select = document.getElementById('service_id');
            ServiceName = [];
            newServices = [];
            for (var i = 0; i < services.length; i++) {
                if (services[i].date <= date && services[i].tractor_id == tractor_id && ServiceName.includes(services[i].name) == false) {
                    ServiceName.push(services[i].name);
                    newServices.push(services[i]);
                }
            }
            select.innerHTML = '';
            var option = document.createElement('option');
            option.value = "";
            option.innerHTML = "Иш турини танланг";
            select.appendChild(option);
            document.getElementById('type_id').value = "";
            document.getElementById('price').value = "";
            document.getElementById('price_worker').value = "";
            document.getElementById('count').value = "";
            for (var i = 0; i < newServices.length; i++) {
                if (newServices[i].tractor_id == tractor_id) {
                    var option = document.createElement('option');
                    option.value = newServices[i].id;
                    option.innerHTML = newServices[i].name;
                    select.appendChild(option);
                }
            }
        }

        function service() {
            var service_id = document.getElementById('service_id').value;
            var type_id = document.getElementById('type_id');
            var price = document.getElementById('price');
            var price_worker = document.getElementById('price_worker');
            var count = document.getElementById('count');
            for (var i = 0; i < newServices.length; i++) {
                if (newServices[i].id == service_id) {
                    type_id.value = types[newServices[i].type_id];
                    price.value = newServices[i].price;
                    price_worker.value = newServices[i].price_worker;
                    count.value = newServices[i].count;
                }
            }
        }
    </script>
@endsection
