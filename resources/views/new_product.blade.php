<x-nav>
    
<div class="row">
      <div class="col-md-4 offset-4 mt-5 register">
            <h6 class="fs-5">Add Product</h6>
           <form action="/new_product" method="post">
                  @csrf
                  <div>
                        <label for="name">Product name</label>
                        <input type="text" name="name" class="form-control mb-3" value = {{old('name')}}>
                  </div>
                  <div>
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty" class="form-control mb-3"value ={{old('qty')}}>
                  </div>
                  <div>
                        <label for="price">Price</label>
                        <input type="text" name="price"  class="form-control mb-3"value={{old('name')}}>
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
                  </div>
                  <div>
                        <label for="cat">Product category</label>
                        <select name="category" id="category"class="form-select mb-3">
                              <option value="#">Select Category</option>
                              @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                              @endforeach
                        </select>
                  </div>
                  <button class="btn btn-secondary col-12 mb-3 round-4"><a href="/new_product">Add product</a></button>  
            </form> 
      </div>
</div>

</x-nav>