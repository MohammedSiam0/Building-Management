@extends('layouts.admin.app',['title'=> 'Services Manager'])
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
                <h3 class="card-title">{{__('Services')}}</h3>
           
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form>
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{__('service_name')}}</label>
                            <input type="text" class="form-control" id="service_name" placeholder="{{__('service_name')}}"
                                   name="service_name" value="{{$service->service_name}}">
                        </div>

                        <div class="form-group">
                            <label for="">{{ __('Parent') }}</label>
                            <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                <option value="">No Parent</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}" @if($parent->id == old('parent_id', $service->parent_id)) selected @endif>{{ $parent->service_name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="service_price">{{__('service_price')}}</label>
                            <input type="text" class="form-control" id="service_price" placeholder="{{__('service_price')}}"
                                   name="service_price"  value="{{$service->service_price}}">
                        </div>


                        <div class="form-group">
                            <textarea name="description" class="summernote" id="description" cols="30" rows="10">{{$service->description}}</textarea>
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

<script src="{{asset('admin_files/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
$(function () {
    // Summernote
    $('.summernote').summernote() })
</script>
<script>
    function performUpdate() {
                        axios.put('/admin/services/{{$service->id}}', {
                            service_name: document.getElementById('service_name').value,
                            parent_id: document.getElementById('parent_id').value,
                            service_price: document.getElementById('service_price').value,
                            description: document.getElementById('description').value,
                        })
                            .then(function (response) {
                                //2xx
                                console.log(response);
                                toastr.success(response.data.message);
                                //
                                window.location.href = '/admin/services';
                            })
                            .catch(function (error) {
                                //4xx - 5xx
                                console.log(error.response.data.message);
                                toastr.error(error.response.data.message);
                            });
                    }
</script>
@endpush()
