<x-admin_layout>
    
<div class="row">
      <div class="col-md-9 offset-1">
            <h6 class="fs-3">Edit products</h6>
            <hr>  
            <button class="btn btn-dark mb-5 float-end"><a href="/new_product">Add product</a></button>     
            <form action="/update_product/{{$product->id}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div>
                        <label for="name" class="mt-5">Product name</label>
                        <input type="text" name="name" class="form-control mb-3" value = {{$product->name}}>
                  </div>
                  <div>
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" class="form-control mb-3"value = {{$product->quantity}}>
                  </div>
                  <div>
                        <label for="price">Price</label>
                        <input type="text" name="price"  class="form-control mb-3"value = {{$product->price}}>  
                  </div>
                  <div>
                        <label for="file">Upload Image</label>
                        <input type="file" name="image"  class="form-control mb-3" placeholder="please upload file">
                  </div>
                  <div>
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select mb-3">
                              <option value="active">Active</option>
                              <option value="inactive">Inactive</option>
                        </select>
                  </div>
                  <div>
                        <label for="category">Product category</label>
                        <select name="category" id="category"class="form-select mb-3">
                              <option value="{{$product->category->id}}"
                                    {{old("category") == $product->category->id ? 'selected': '' }}>{{$product->category->name}}
                              </option>
                        </select>   
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Edit product</button>  
            </form>
      </div>
</div>

</x-admin_layout>