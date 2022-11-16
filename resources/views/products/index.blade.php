@extends('admin_layout.admin')


@section('content')

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Products</h3>
              </div>
              <!-- /.card-header -->
              @if ($message = session('message'))
                <div class="alert alert-success">{{ $message }}</div>
              @endif
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Num.</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($products as $index => $product)
                  <tr>
                    <td>{{$index + 1}}</td>
                    <td>
                        <img src="{{ asset('storage/product/' . $product->product_image) }}" style="height : 50px; width : 50px" class="img-circle elevation-2" alt="User Image">
                    </td>
                    <td>{{$product->product_name}}</td>
                    <td> {{$product->category->category_name}}</td>
                    <td>{{$product->product_price}}</td>
                    <td>
                      @if($product->status === 0)
                      
                      <form action="{{route('products.activate', $product->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-warning">Activate</button>
                      </form>
                      @else
                      <form action="{{route('products.deactivate', $product->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success">Unactivate</button>
                      </form>
                      @endif
                      <a href="{{route('products.edit',$product->id)}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
                      <form action="{{route('products.destroy', $product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="delete" class="btn btn-danger" onclick="alert('Are you sure?')" ><i class="nav-icon fas fa-trash"></i></button>
                      </form>
                    </td>
                    
                  </tr>
                  
                  @endforeach
                  </tbody>
                  <tfoot>
                  
                  </tfoot>
                </table>

                <div class="d-flex justify-content-center">
                  {{ $products->links() }}
              </div>
              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection