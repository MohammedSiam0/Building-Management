@extends('layouts.admin.app',['title'=> 'Export Manager'])
@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Export Table')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.exports.index')}}">{{__('Export')}}</a></li>
                    <li class="breadcrumb-item active">{{__('Edit')}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('Export')}}</h3>
                <div style="float: right">
                    <a href="{{url('admin/exports')}}" class="btn btn-success"><i class="fa fa-plus"></i>
                        {{__('back')}}</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form>
                    @csrf

                        <div class="form-group">
                            <label for="">{{ __('Employee') }}</label>
                            <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="">No Parent</option>
                                @foreach ($people as $parent)
                                    <option value="{{ $parent->id }}" @if($parent->id == old('employee_id', $import->employee_id)) selected @endif>{{ $parent->name }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('services') }}</label>
                            <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror">
                                <option value="">No Parent</option>
                                @foreach ($services as $parent)
                                    <option value="{{ $parent->id }}" @if($parent->id == old('service_id', $import->service_id)) selected @endif>{{ $parent->service_name }}</option>
                                @endforeach
                            </select>
                            @error('service_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                    <div class="form-group">
                        <label for="amount_paid">{{__('amount')}}</label>
                        <input type="number" class="form-control" id="amount" placeholder="{{__('amount')}}"
                               name="amount" value="{{$import->amount}}">
                    </div>
                    <div class="form-group">
                        <label for="payment_date">{{__('date')}}</label>
                        <input type="date" class="form-control" id="date" placeholder="{{__('date')}}"
                               name="date" value="{{$import->date}}">
                    </div>


            <div class="card-footer">
                <button type="button" onclick="performUpdate()" class="btn btn-primary">{{__('update')}}</button>
            </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
@endsection
@push('scripts')
<script>
    function performUpdate() {
                        axios.put('/admin/exports/{{$financial->id}}', {
                            amount: document.getElementById('amount').value,
                            employee_id: document.getElementById('employee_id').value,
                            service_id: document.getElementById('service_id').value,
                            date: document.getElementById('date').value,
                            description: document.getElementById('description').value,
                        })
                            .then(function (response) {
                                //2xx
                                console.log(response);
                                toastr.success(response.data.message);
                                //
                                window.location.href = '/admin/exports';
                            })
                            .catch(function (error) {
                                //4xx - 5xx
                                console.log(error.response.data.message);
                                toastr.error(error.response.data.message);
                            });
                    }
</script>
@endpush()
