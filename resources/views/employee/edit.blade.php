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
                        <li class="breadcrumb-item"><a href="{{route('admin.employees.index')}}">{{__('Employee Table')}}</a></li>
                        <li class="breadcrumb-item active">{{__('Employee Edit')}}</li>
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
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('messages.update')}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form >
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="city_id">{{__('messages.employee')}}</label>
                                </div>


                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.name')}}</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Enter name " value="{{$employee->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.mobile')}}</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile"
                                           placeholder="Enter name mobile" value="{{$employee->mobile}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.phone')}}</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                           placeholder="Enter name phone" value="{{$employee->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.identification_number')}}</label>
                                    <input type="text" name="identification_number" class="form-control"
                                           id="identification_number"
                                           placeholder="Enter name identification number"
                                           value="{{$employee->identification_number}}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{ __('Parent') }}</label>
                                    <select name="type_job" id="type_job" class="form-control @error('type_job') is-invalid @enderror">
                                        <option value="">No Parent</option>
                                        @foreach ($service as $parent)
                                            <option value="{{ $parent->id }}" @if($parent->id == old('parent_id', $employee->parent_id)) selected @endif>{{ $parent->service_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.date_job')}}</label>
                                    <input type="text" name="date_job" class="form-control" id="date_job"
                                           placeholder="Enter name date job" value="{{$employee->date_job}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.salary')}}</label>
                                    <input type="number" name="salary" class="form-control" id="salary"
                                           placeholder="Enter name salary" value="{{$employee->salary}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.living')}}</label>
                                    <input type="text" name="living" class="form-control" id="living"
                                           placeholder="Enter name living" value="{{$employee->living}}">
                                </div>
                                <div class="form-group">
                                    <label for="name_en"> {{__('messages.photo')}}</label>
                                    <input type="file" name="photo" class="form-control" id="photo"
                                           placeholder="Enter name photo" value="{{$employee->photo}}">
                                </div>

                                <div class="form-group">
                                    <label for="status">Work time</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="work_time" id="work_time" value="AM" @if(old('work_time', $employee->work_time) == 'AM') checked @endif>
                                        <label class="form-check-label">AM</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" name="work_time" type="radio" id="work_time" value="PM" @if(old('work_time', $employee->work_time) == 'PM') checked @endif>
                                        <label class="form-check-label">PM</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" onclick="performUpdate()"
                                        class="btn btn-primary">{{__('messages.save')}}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('scripts')
<script>
    function performUpdate() {

        var selected = document.querySelector('input[type=radio][name=work_time]:checked')
        
        let formData = new FormData();
        formData.append('_method','PUT');
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
        axios.post('/admin/employees/{{$employee->id}}',formData )
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
