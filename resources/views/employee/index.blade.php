@extends('layouts.admin.app',['title' =>'Employee'])
@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{__('Employee Table')}} </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{__('Employee Table')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Employee Table')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('Employee Table')}}</h3>
                @if(app()->getLocale() == 'ar')
                    <div style="float:left">
                        total salary -{{ number_format($employeeSum, 2) }}

                    </div>
                @else
                    <div style="float:right">
                        total salary -{{ number_format($employeeSum, 2) }}

                    </div>
                @endif


            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <table class="table table-bordered  table-striped table-hover ">
                    <thead>
                    <tr>
                        <th style="width: 10px">{{__('messages.no_id')}}</th>
                        <th>{{__('messages.nameemployee')}}</th>
                        <th>{{__('messages.mobile')}}</th>
                        <th>{{__('messages.phone')}}</th>
                        <th>{{__('messages.identification_number')}}</th>
                        <th>{{__('messages.work_hour')}}</th>
                        <th>{{__('messages.date_job')}}</th>
                        <th style="width: 40px">{{__('messages.salary')}}</th>
                        <th style="width: 40px">{{__('messages.living')}}</th>
                        <th style="width: 40px">{{__('messages.photo')}}</th>
                        <th style="width: 20px">{{__('messages.setting')}}</th>

                    </tr>
                    </thead>
                    <tbody>


                    @foreach($employees as $employee)
                        <tr>
                            <td> {{$employee->id}}</td>
                            <td>{{$employee->name}}</td>
                            <td>{{$employee->mobile}}</td>
                            <td>{{$employee->phone}}</td>
                            <td>{{$employee->identification_number}}</td>
                            <td>{{$employee->work_time}}</td>
                            <td>{{$employee->date_job}}</td>
                            <td>{{$employee->salary}}</td>
                            <td>{{$employee->living}}</td>
                          
                            <td><img  height="100" src="{{asset('storage/'.$employee->photo)}}" alt="">
                            </td>

                            <td>

                                <div class="btn-group">
                                   
                                    <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-warning btn-sm"><i
                                            class="fa fa-edit"></i> edit</a>
                                           
                                    <a href="#" onclick="confirmDelete('{{$employee->id}}',this)" class=" btn btn-danger">
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
        <!-- /.card -->

    </div>


@endsection
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, reference) {
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
                    performDelete(id, reference);
                }
            });
        }

        function performDelete(id, reference) {
            axios.delete('/admin/employees/' + id)
                .then(function (response) {
                    //2xx
                    console.log(response);
                    toastr.success(response.data.message);
                    reference.closest('tr').remove(); // حيدذفلي السطر الي انا فيه بوضع this  مع الزر فوق
                })
                .catch(function (error) {
                    //4xx - 5xx
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endpush
