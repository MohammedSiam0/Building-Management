@extends('layouts.admin.app',['title' =>'Purchases Manager'])
@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{__('Purchases Table')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('Purchases')}}</a></li>
                        <li class="breadcrumb-item active">{{__('dashboard')}}</li>
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
                    <h3 class="card-title">{{__('Purchases Table')}}</h3>
          
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                        <tr>

                            <th>#</th>
                            <th>{{__('invoice_number')}}</th>
                            <th>{{__('product_name')}}</th>
                            <th>{{__('price')}}</th>
                            <th>{{__('date_of_purchase')}}</th>
                            <th>{{__('description')}}</th>
                            <th>{{__('action')}}</th>
                            <th>{{__('setting')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$purchase->invoice_number}}</td>
                                <td>{{$purchase->product_name}}</td>
                                <td>{{$purchase->price}}</td>
                                <td>{{$purchase->date_of_purchase}}</td>
                                <td>{{$purchase->description}}</td>
                               <td>{{($purchase->created_at)->format('Y-m-d')}}</td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{{ route('admin.purchases.edit', $purchase->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fa fa-edit"></i> edit</a>
                                        <a href="#" onclick="confirmDelete('{{$purchase->id}}',this)" class=" btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id,reference) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    performDelete(id,reference);
                }
            });
        }

        function performDelete(id,reference) {
            axios.delete('/admin/purchases/'+id)
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    reference.closest('tr').remove();
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endpush
