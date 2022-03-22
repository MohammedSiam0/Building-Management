@extends('layouts.admin.app',['title' =>'Invoice Manager'])
@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Invoice Table</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                        <li class="breadcrumb-item active">dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('content')


   @php
       foreach($financials as $financial)


   @endphp

      <!-- Content Wrapper. Contains page content -->

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">

    <!-- Main content -->
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
          <div class="col-12">
            <h4>
              <i class="fas fa-globe"></i> AdminLTE, Inc.
              <small class="float-right">Date: {{$financial->payment_date}}</small>
            </h4>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">

            <address>
              <strong>Admin Inc.</strong><br>
             User name {{$financial->people->name}}<br>
              Phone: {{$financial->people->phone}}<br>
            </address>
          </div>

          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <br>
            <b>Payment Due:</b> {{$financial->payment_date}}<br>
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Service</th>
                   <th>Subtotal</th>
              </tr>
              </thead>
              <tbody>
                    @foreach($financials as $financial)
                        <tr>
                            <td>{{$financial->bond_number}}</td>
                            <td>{{$financial->people->name}}</td>
                            <td>{{$financial->service->service_name}}</td>
                            <td>${{$financial->service->service_price}}</td>

                        </tr>
                    @endforeach

              </tbody>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-6">

          </div>
          <!-- /.col -->
          <div class="col-6">
            <p class="lead">Amount Due {{$financial->payment_date}}</p>

            <div class="table-responsive">
              <table class="table">
                <tr>
                    @php
                        $data = \App\Models\Service::get()->sum('service_price');
                    @endphp
                  <th style="width:50%">Subtotal:</th>
                  <td>${{$data}}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>${{$data}}</td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-12">
            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
          </div>
        </div>
      </div>
              </div>
            </div>
          </div>
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
            axios.delete('/admin/imports/'+id)
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
