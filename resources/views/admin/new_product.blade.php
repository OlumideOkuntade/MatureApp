<x-admin_layout>
    
<div class="row">
      <div class="col-md-7 offset-1 mt-5 register">
            <h6 class="fs-5">Add Product</h6>
            <button class="btn btn-light mb-4 float-end"><a href="/all_products">All product</a></button>
            
           <form action="/new_product/store" method="post" enctype="multipart/form-data">
                  @csrf
                  <div>
                        <label for="name" class="mt-5">Product name</label>
                        <input type="text" name="name" class="form-control mb-3" value = {{old('name')}}>
                        @error('name')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <div>
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control mb-3"value ={{old('quantity')}}>
                          @error('quantity')
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
                        <input type="file" name="image"  class="form-control mb-3" placeholder="please upload file">
                        @error('image')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
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
                        <label for="category_id">Product category</label>
                        <select name="category_id" id="category_id"class="form-select mb-3">
                              @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                          {{old("category_id") == $category->id ? 'selected': '' }}>{{$category->name}}
                                    </option>
                              @endforeach
                        </select>
                        @error('category_id')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Add product</button>  
            </form> 
      </div>
</div>

</x-admin_layout>