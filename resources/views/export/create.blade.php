@extends('layouts.admin.app',['title' =>'Import manger'])
@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Import Table')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.exports.index')}}">{{__('Import')}}</a></li>
                    <li class="breadcrumb-item active">{{__('create')}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('Export.create')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="bond_number">{{__('bond_number')}}</label>
                                <input type="number" class="form-control" id="bond_number" placeholder="{{__('bond_number')}}"
                                       name="bond_number" value="{{old('bond_number')}}">
                            </div>
                            <div class="form-group">
                                <label for="company_name">{{__('company_name')}}</label>
                                <input type="text" class="form-control" id="company_name" placeholder="{{__('company_name')}}"
                                       name="company_name" value="{{old('company_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('Employee') }}</label>
                                <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
                                    <option value="">No Employee</option>
                                    @foreach ($people as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                    @endforeach
                                </select>
                                @error('people_id')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">{{ __('services') }}</label>
                                <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror">
                                    <option value="">No Parent</option>
                                    @foreach ($services as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->service_name }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="amount_paid">{{__('amount')}}</label>
                                <input type="number" class="form-control" id="amount" placeholder="{{__('amount')}}"
                                    name="amount" value="{{old('amount')}}">
                            </div>
                            <div class="form-group">
                                <label for="payment_date">{{__('date')}}</label>
                                <input type="date" class="form-control" id="date" placeholder="{{__('date')}}"
                                       name="date" value="{{old('date')}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('description')}}</label>
                                <input type="text" class="form-control" id="description" placeholder="{{__('description')}}"
                                       name="description" value="{{old('description')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
                                class="btn btn-primary">{{__('Add')}}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@push('scripts')




<script>
    function performStore() {
         axios.post('/admin/exports', {
             bond_number: document.getElementById('bond_number').value,
             amount: document.getElementById('amount').value,
             employee_id: document.getElementById('employee_id').value,
             service_id: document.getElementById('service_id').value,
             date: document.getElementById('date').value,
             description: document.getElementById('description').value,
             company_name: document.getElementById('company_name').value,

         })
             .then(function (response) {
                 //2xx
                 console.log(response);
                 toastr.success(response.data.message);
                 document.getElementById('create-form').reset();
             })
             .catch(function (error) {
                 //4xx - 5xx
                 console.log(error.response.data.message);
                 toastr.error(error.response.data.message);
             });
     }
</script>
@endpush
