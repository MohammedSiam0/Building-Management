@extends('layouts.admin.app',['title' =>'Financial Manager'])
@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Financial Table</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Financial</a></li>
                        <li class="breadcrumb-item active">dashboard</li>
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
                    <h3 class="card-title">{{__('Financial Table')}}</h3>
                    <div style="float: right">
                        <a href="{{url('admin/financials/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>
                            {{__('Create')}}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('bond_number')}}</th>
                            <th>{{__('people_id')}}</th>
                            <th>{{__('service_id')}}</th>
                            <th>{{__('amount_paid')}}</th>
                            <th>{{__('payment_date')}}</th>
                            <th>{{__('description')}}</th>
                            <th>{{__('action')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($financials as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->bond_number}}</td>
                                <td>{{$data->people->name}}</td>
                                <td>{{$data->service->service_name}}</td>
                                <td>{{$data->service->service_price}}</td>
                                <td>{{$data->payment_date}}</td>
                                <td>{{$data->description}}</td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{{ route('admin.financials.edit', $data->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fa fa-edit"></i> edit</a>
                                        <a href="#" onclick="confirmDelete('{{$data->id}}',this)" class=" btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="{{ route('admin.financials.invoice', $data->id) }}" class="btn btn-success btn-sm"><i
                                                class="fa fa-edit"></i> edit</a>
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
            axios.delete('/admin/financials/'+id)
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
