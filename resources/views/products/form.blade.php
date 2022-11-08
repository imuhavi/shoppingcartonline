<div class="card-body">
    <div class="form-group">
      <label for="exampleInputEmail1">Product name</label>
      <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" id="exampleInputEmail1" placeholder="Enter product name">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Product price</label>
      <input type="number" name="product_price" class="form-control" value="{{ old('product_price', $product->product_price) }}" id="exampleInputEmail1" placeholder="Enter product price" min="1">
    </div>
    <div class="form-group">
      <label>Product category</label>
      <select name="category_id" class="form-control select2" style="width: 100%;">
        @foreach ($categories as $category)
          <option  value="{{$category->id}}">{{$category->category_name}}</option>
        @endforeach
      </select>
    </div>
    <label for="exampleInputFile">Product image</label>
    <div class="input-group">
      <div class="custom-file">
        {{-- <input type="file" name="file" required> --}}
        <input type="file" name="file" class="custom-file-input" id="exampleInputFile">
        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
      </div>
      <div class="input-group-append">
        <span class="input-group-text">Upload</span>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <!-- <button type="submit" class="btn btn-success">Submit</button> -->
    <input type="submit" class="btn btn-success" value="{{ $product->exists ? 'Update' : 'Save' }}">
  </div>