@extends('layouts.backend-layout')

@section('title')
Admin | Order Details
@endsection

@section('content')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endpush

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.partial.backend-sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.partial.backend-topbar')

                <!-- Begin Page Content -->

                    {{-- Body Content --}}




<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto mb-4">
                <h2 class="text-center">Order info for this order</h2>
            <table class="table table-hover table-bordered ">
                    <tr>
                        <th>Order Id</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Total Price</th>
                        <td>{{ $order->total_price }}</td>
                    </tr>
                    <tr>
                        <th>Order Status</th>
                        <td>{{ $order->order_status }}</td>
                    </tr>
					<tr>
                        <th>Payment Status</th>
                        <td>{{ $order->payment_status }}</td>
                    </tr>
					<tr>
                        <th>Payment type</th>
                        <td>{{ $order->payment_type }}</td>
                    </tr>
                    <tr>
                        <th>Order Date </th>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto mb-4">
                <h2 class="text-center">Customer info for this order</h2>
            <table class="table table-hover table-bordered ">
                    <tr>
                        <th>Customer Name </th>
                        <td>{{ $order->customer->first_name.' '.$order->customer->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number </th>
                        <td>{{ $order->customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email Address </th>
                        <td>{{ $order->customer->email }}</td>
                    </tr>
                    <tr>
                        <th>Address </th>
                        <td>{{ $order->customer->address }}</td>
                    </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto mb-4">
                <h2 class="text-center">Shipping info for this order</h2>
            <table class="table table-hover table-bordered ">
                    <tr>
                        <th>Full Name </th>
                        <td>{{ $shipping->name }}</td>
                    </tr>
                    <tr>
                        <th>Phone Number </th>
                        <td>{{ $shipping->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email Address </th>
                        <td>{{ $shipping->email }}</td>
                    </tr>
                    <tr>
                        <th>Address </th>
                        <td>{{ $shipping->address }}</td>
                    </tr>
            </table>
        </div>
    </div>
    <div class="row">
            <div class="col-md-12 mb-5">
                    <h2 class="text-center">Product info for this order</h2>
                <table class="table table-hover table-bordered ">
                    <thead class="thead-light">
                        <tr>
                            <th>SN</th>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Product Price</th>
                            <th>Product Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($orderProducts as $key=>$orderProduct)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $orderProduct->product_id }}</td>
                                <td>{{ $orderProduct->product_name }}</td>
                                <td>
                                   <img src="{{ asset('public/storage/product/'.$orderProduct->product_image) }}" alt="{{ Str::limit($orderProduct->product_image,10)}}" style="height: 50px; width:70px">
                                </td>
                                <td>TK {{ $orderProduct->product_price }}</td>
                                <td>{{ $orderProduct->product_quantity }}</td>
                                <td>TK {{ $orderProduct->product_price*$orderProduct->product_quantity }}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>

</div>


                    {{--  End Body Content --}}
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2019</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    {{--   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
   --}}
    @endsection
@push('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
  {{--  sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">

//Delete Category........
         function deleteCategory(id){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to delete this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      event.preventDefault();
      document.getElementById('delete-form-'+id).submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your Data is safe :)',
      'error'
    )
  }
})
         }
         //Publish Category........
         function publishCategory(id){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to publish this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, publish it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      event.preventDefault();
      document.getElementById('publish-form-'+id).submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your Data is safe :)',
      'error'
    )
  }
})
         }
//Unpublish Category........
         function unpublishCategory(id){
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to unpublish this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, unpublish it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      event.preventDefault();
      document.getElementById('unpublish-form-'+id).submit();
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your Data is safe :)',
      'error'
    )
  }
})
         }

         </script>
@endpush
