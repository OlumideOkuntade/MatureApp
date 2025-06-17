<x-layout>
    
<div class="row">
      <div class="col-md-4 offset-4 mt-5 register">
            <h6 class="fs-5">Add Product</h6>
           <form action="/new_product" method="post">
                  @csrf
                  <div>
                        <label for="name">Product name</label>
                        <input type="text" name="name" class="form-control mb-3" value = {{old('name')}}>
                        @error('name')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <div>
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty" class="form-control mb-3"value ={{old('qty')}}>
                          @error('qty')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <div>
                        <label for="price">Price</label>
                        <input type="text" name="price"  class="form-control mb-3"value={{old('name')}}>
                          @error('price')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <div>
                        <label for="file">Upload Image</label>
                        <input type="file" name="file"  class="form-control mb-3" placeholder="please upload file">

                  </div>
                  <div>
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select mb-3">
                              <option value="active">Active</option>
                              <option value="inactive">Inactive</option>
                        </select>
                          @error('status')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <div>
                        <label for="category">Product category</label>
                        <select name="category" id="category"class="form-select mb-3">
                              <option value="#">Select Category</option>
                              @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                        </select>
                          @error('category')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Add product</button>  
            </form> 
      </div>
</div>

</x-layout>