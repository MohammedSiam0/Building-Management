@extends('layouts.admin.app',['title' =>'Services manger'])
@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{__('Services Table')}}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.services.index')}}">{{__('Services')}}</a></li>
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
                        <h3 class="card-title">{{__('Services.create')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{__('service_name')}}</label>
                                <input type="text" class="form-control" id="service_name" placeholder="{{__('service_name')}}"
                                    name="service_name" value="{{old('service_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('Parent') }}</label>
                                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                    <option value="">No Parent</option>
                                    @foreach ($parents as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->service_name }}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="service_price">{{__('service_price')}}</label>
                                <input type="text" class="form-control" id="service_price" placeholder="{{__('service_price')}}"
                                    name="service_price" value="{{old('service_price')}}">
                            </div>

                            <div class="form-group">
                                <textarea name="description" id="description" class="summernote" cols="30" rows="10"></textarea>
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
         axios.post('/admin/services', {
             service_name: document.getElementById('service_name').value,
             parent_id: document.getElementById('parent_id').value,
             service_price: document.getElementById('service_price').value,
             description: document.getElementById('description').value,

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
