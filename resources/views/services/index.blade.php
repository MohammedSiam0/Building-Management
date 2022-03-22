@extends('layouts.admin.app',['title' =>'Services Manager'])
@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Services Table</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Services</a></li>
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
                    <h3 class="card-title">{{__('Services Table')}}</h3>
                    <div style="float: right">
              
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                        <tr>




                            <th>#</th>
                            <th>{{__('service_name')}}</th>
                            <th>{{__('Parent Name')}}</th>
                            <th>{{__('service_price')}}</th>
                            <th>{{__('note')}}</th>
                            <th>{{__('action')}}</th>
                            <th>{{__('setting')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($service as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->service_name}}</td>
                                <td>{{$data->parent->service_name}}</td>
                                <td>{{$data->service_price}}</td>
                                <td>{{$data->description}}</td>
                                <td>{{($data->created_at)->format('Y-m-d')}}</td>
                                <td>
                                    <div class="btn-group">
                                    <a href="{{ route('admin.services.edit', $data->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fa fa-edit"></i> edit</a>
                                        <a href="#" onclick="confirmDelete('{{$data->id}}',this)" class=" btn btn-danger">
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
            axios.delete('/admin/services/'+id)
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
