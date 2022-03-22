@extends('layouts.admin.app',['title'=> 'Purchases Manager'])
@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Purchases Table')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.purchases.index')}}">{{__('Purchases')}}</a></li>
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
                <h3 class="card-title">{{__('Purchases')}}</h3>
            
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form>
                    @csrf
                    {{-- {{$purchase}} --}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{__('invoice_number')}}</label>
                            <input type="number" class="form-control" id="invoice_number" placeholder="{{__('invoice_number')}}"
                                   name="invoice_number" value="{{$purchase->invoice_number}}">
                        </div>
                        <div class="form-group">
                            <label for="product_name">{{__('product_name')}}</label>
                            <input type="text" class="form-control" id="product_name" placeholder="{{__('product_name')}}"
                                   name="product_name" value="{{$purchase->product_name}}">
                        </div>
                        <div class="form-group">
                            <label for="price">{{__('price')}}</label>
                            <input type="number" class="form-control" id="price" placeholder="{{__('price')}}"
                                   name="price" value="{{$purchase->price}}">
                        </div>
                        <div class="form-group">
                            <label for="date_of_purchase">{{__('date_of_purchase')}}</label>
                            <input type="date" class="form-control" id="date_of_purchase"
                                   placeholder="{{__('date_of_purchase')}}" name="date_of_purchase"
                                   value="{{$purchase->date_of_purchase}}">
                        </div>
                        <div class="form-group">
                            <textarea name="description" id="description" cols="30" rows="10">{{$purchase->description}}</textarea>
                        </div>


                    </div>
                    <!-- /.card-body -->

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
                        axios.put('/admin/purchases/{{$purchase->id}}', {
                            invoice_number: document.getElementById('invoice_number').value,
                            product_name: document.getElementById('product_name').value,
                            price: document.getElementById('price').value,
                            date_of_purchase: document.getElementById('date_of_purchase').value,
                            description: document.getElementById('description').value,
                        })
                            .then(function (response) {
                                //2xx
                                console.log(response);
                                toastr.success(response.data.message);
                                //
                                window.location.href = '/admin/purchases';
                            })
                            .catch(function (error) {
                                //4xx - 5xx
                                console.log(error.response.data.message);
                                toastr.error(error.response.data.message);
                            });
                    }
</script>
@endpush()
