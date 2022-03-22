@extends('layouts.admin.app',['title' =>'Financials manger'])
@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Financials Table')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.financials.index')}}">{{__('Financials')}}</a></li>
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
                        <h3 class="card-title">{{__('Financials.create')}}</h3>
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
                                <label for="">{{ __('people') }}</label>
                                <select name="people_id" id="people_id" class="form-control @error('people_id') is-invalid @enderror">
                                    <option value="">No Parent</option>
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
                                <label for="amount_paid">{{__('amount_paid')}}</label>
                                <input type="number" class="form-control" id="amount_paid" placeholder="{{__('amount_paid')}}"
                                    name="amount_paid" value="amount_paid">
                            </div>
                            <div class="form-group">
                                <label for="payment_date">{{__('payment_date')}}</label>
                                <input type="date" class="form-control" id="payment_date" placeholder="{{__('payment_date')}}"
                                       name="payment_date" value="{{old('payment_date')}}">
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
         axios.post('/admin/financials', {
             bond_number: document.getElementById('bond_number').value,
             people_id: document.getElementById('people_id').value,
             service_id: document.getElementById('service_id').value,
             amount_paid: document.getElementById('amount_paid').value,
             payment_date: document.getElementById('payment_date').value,

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
