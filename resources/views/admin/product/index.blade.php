@extends('layouts.backend-layout')

@section('title')
Admin | All Products
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
        <div class="container-fluid" >
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary" style="color:white; background: rgb(34, 128, 204);">
                  <h4 class="card-title ">All Products</h4>

                </div>
                <div class="card-body">
                  <div class= "table-responsive">
                    <table id="table" class="table" style="width:100%">
                      <thead class=" text-primary">
                        <th>
                         SN
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                          Description
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Status
                        </th>
                        {{-- <th>
                          Created_At
                        </th>
                        <th>
                          Updated_At
                        </th> --}}
                        <th>
                            Action
                        </th>
                      </thead>
                      <tbody>
                       @foreach ($products as $key=>$product)
                           <tr>
                               <td>{{ $key+1 }}</td>
                               <td>{{ $product->name }}</td>
                               <td>{{ $product->category->name }}</td>
                               <td>
                                   <img src="{{ URL::to('public/storage/product/'.$product->image) }}" alt="{{ Str::limit($product->image,10)}}" style="height: 50px; width:70px">
                                </td>
                               <td>{{ Str::limit($product->short_description,20) }}</td>
                             {{--   <td>{{ $category->created_at }}</td>
                               <td>{{ $category->updated_at }}</td> --}}
                               <td>{{ $product->price }}</td>
                               <td>
                                 @if ( $product->status ==true)
                                       <span class="badge badge-success"><i class="fas fa-thumbs-up"></i></span>
                                    @else
                                        <span class="badge badge-danger"><i class="fas fa-question-circle"></i></span>
                                    @endif
                               <td >

                                   <a href="{{ route('admin.product.edit',$product->id) }}" class="btn btn-info btn-sm waves-effect"><i class="fas fa-edit"></i></a>

                                   <button onclick="deleteProduct({{ $product->id }})" type="button" class="btn btn-danger btn-sm waves-effect"><i class="fas fa-eraser"></i></button>

                                   <form id="delete-form-{{ $product->id }}" method="POST" action="{{ route('admin.product.destroy',$product->id) }}" style="display: none">
                                    @csrf
                                    @method('DELETE');
                                   </form>

                                   @if ($product->status==false)
                                                            <button type="button"
                                                                class="btn btn-success btn-sm waves-effect"
                                                                onclick="publishProduct({{ $product->id }})">
                                                               <i class="fas fa-check-square"></i>

                                                            </button>
                                                            <form method="POST"
                                                                action="{{ route('admin.product.publish',$product->id) }}"
                                                                id="publish-form-{{ $product->id }}" style="display: none;">
                                                                @csrf
                                                            </form>
                                                            @else

                                                             <button type="button"
                                                                class="btn btn-warning btn-sm waves-effect"
                                                                onclick="unpublishProduct({{ $product->id }})">
                                                               <i class="fas fa-calendar-times"></i>

                                                            </button>
                                                            <form method="POST"
                                                                action="{{ route('admin.product.unpublish',$product->id) }}"
                                                                id="unpublish-form-{{ $product->id }}" style="display: none;">
                                                                @csrf
                                                            </form>
                                                            @endif
                            </td>
                           </tr>
                       @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="container-fluid" >
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary" style="color:white; background:#E02D1B;">
                  <h4 class="card-title ">Deleted Products</h4>

                </div>
                <div class="card-body">
                  <div class= "table-responsive">
                    <table id="table2" class="table" style="width:100%">
                      <thead class=" text-primary">
                        <th>
                         SN
                        </th>
                        <th>
                          Name
                        </th>
                        <th>
                            Category
                        </th>
                        <th>
                            Image
                        </th>
                        <th>
                          Description
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Status
                        </th>
                        {{-- <th>
                          Created_At
                        </th>
                        <th>
                          Updated_At
                        </th> --}}
                        <th>
                            Action
                        </th>
                      </thead>
                      <tbody>
                       @foreach ($softDeleteProducts as $key=>$softDeleteProduct)
                           <tr>
                               <td>{{ $key+1 }}</td>
                               <td>{{ $softDeleteProduct->name }}</td>
                               <td>{{ $softDeleteProduct->category->name }}</td>
                               <td>
                                   <img src="{{ URL::to('public/storage/product/'.$softDeleteProduct->image) }}" alt="{{ Str::limit($softDeleteProduct->image,10)}}" style="height: 50px; width:70px">
                                </td>
                               <td>{{ Str::limit($softDeleteProduct->short_description,20) }}</td>
                             {{--   <td>{{ $category->created_at }}</td>
                               <td>{{ $category->updated_at }}</td> --}}
                               <td>{{ $softDeleteProduct->price }}</td>
                               <td>
                                 @if ( $softDeleteProduct->status ==true)
                                       <span class="badge badge-success"><i class="fas fa-thumbs-up"></i></span>
                                    @else
                                        <span class="badge badge-danger"><i class="fas fa-question-circle"></i></span>
                                    @endif
                               <td >

                                   <button type="button" class="btn btn-info btn-sm waves-effect"
                                       onclick="restoreProduct({{ $softDeleteProduct->id }})">
                                       <i class="fas fa-undo"></i>
                                   </button>
                                                            <form method="POST"
                                                                action="{{ route('admin.product.restore',$softDeleteProduct->id) }}"
                                                                id="restore-form-{{ $softDeleteProduct->id }}"
                                                                style="display: none;">
                                                                @csrf
                                                            </form>

                                   <button onclick="forceDeleteProduct({{ $softDeleteProduct->id }})" type="button" class="btn btn-danger btn-sm waves-effect"><i class="fas fa-trash-alt"></i></button>

                                   <form id="forceDelete-form-{{ $softDeleteProduct->id }}" method="POST" action="{{ route('admin.product.forceDelete',$softDeleteProduct->id) }}" style="display: none">
                                    @csrf
                                    @method('DELETE');
                                   </form>
                            </td>
                           </tr>
                       @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
<script>
$(document).ready(function() {
    $('#table2').DataTable();
} );
</script>
  {{--  sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">

//Delete Category........
         function deleteProduct(id){
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
         function publishProduct(id){
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
         function unpublishProduct(id){
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

         //restore Product
          function restoreProduct(id){
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
  confirmButtonText: 'Yes, restore it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      event.preventDefault();
      document.getElementById('restore-form-'+id).submit();
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


//force delete
 function forceDeleteProduct(id){
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
  confirmButtonText: 'Yes, permanently delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      event.preventDefault();
      document.getElementById('forceDelete-form-'+id).submit();
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
