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
                        <li class="breadcrumb-item"><a href="{{route('admin.employees.index')}}">{{__('Employee')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Create')}}</li>
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
                            <h3 class="card-title">{{__('Employee.create')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="create-form" >
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="city_id">{{__('messages.employee')}}</label>
                                </div>


                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.name')}} <span style="color: red;">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Enter name " value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label for="mobile"> {{__('messages.mobile')}} <span style="color: red;">*</span></label>
                                    <input type="number" name="mobile" class="form-control" id="mobile"
                                           placeholder="Enter name mobile" value="{{old('mobile')}}">
                                </div>
                                <div class="form-group">
                                    <label for="phone"> {{__('messages.phone')}} <span style="color: red;">*</span></label>
                                    <input type="number" name="phone" class="form-control" id="phone"
                                           placeholder="Enter name phone" value="{{old('phone')}}">
                                </div>
                                <div class="form-group">
                                    <label for="identification_number"> {{__('messages.identification_number')}}<span style="color: red;">*</span></label>
                                    <input type="number" name="identification_number" class="form-control"
                                           id="identification_number"
                                           placeholder="Enter name identification number"
                                           value="{{old('identification_number')}}">
                                </div>

                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="">{{ __('type_job') }}<span style="color: red;">*</span></label>
                                        <select name="type_job" id="type_job" class="form-control @error('service_id') is-invalid @enderror">
                                            <option value="">No Server</option>
                                            @foreach ($service as $parent)
                                                <option value="{{ $parent->id }}">{{ $parent->service_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_job')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.date_job')}} <span style="color: red;">*</span></label>
                                    <input type="date" name="date_job" class="form-control" id="date_job"
                                           placeholder="Enter name date job" value="{{old('date_job')}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.salary')}}<span style="color: red;">*</span></label>
                                    <input type="number" name="salary" class="form-control" id="salary"
                                           placeholder="Enter name salary" value="{{old('salary')}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.living')}} <span style="color: red;">*</span></label>
                                    <input type="text" name="living" class="form-control" id="living"
                                           placeholder="Enter name living" value="{{old('living')}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.photo')}} <span style="color: red;">*</span></label>
                                    <input type="file" name="photo" class="form-control" id="photo"
                                           placeholder="Enter name photo" value="{{old('photo')}}">
                                </div>

                                <div class="form-group">
                                    <label for="status">Work time <span style="color: red;">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="work_time" id="work_time"
                                               value="AM">
                                        <label class="form-check-label">AM</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="work_time" type="radio" id="work_time"
                                               value="PM">
                                        <label class="form-check-label">PM</label>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate()"
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
        function performUpdate() {
           // console.log('wwww1');

            var selected = document.querySelector('input[type=radio][name=work_time]:checked')
            
            let formData = new FormData();
                 formData.append('photo',document.getElementById('photo').files[0]);
                 formData.append('name',document.getElementById('name').value);
                 formData.append('living',document.getElementById('living').value);
                 formData.append('salary',document.getElementById('salary').value);
                 formData.append('date_job',document.getElementById('date_job').value);
                 formData.append('phone',document.getElementById('phone').value);
                 formData.append('type_job',document.getElementById('type_job').value);
                 formData.append('mobile',document.getElementById('mobile').value);
               formData.append('identification_number',document.getElementById('identification_number').value);  
                   formData.append('work_time',selected.value);
            axios.post('/admin/employees',formData )
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
