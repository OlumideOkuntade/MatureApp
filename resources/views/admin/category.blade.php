<x-admin_layout>
    
<div class="row">
      <div class="col-md-7 offset-1 mt-5 register">
            <h6 class="fs-5">Add Category</h6>
           @if(session('success'))
                  <p class="bg-success text-light">{{session('success')}}</p>
           @endif
           <form action={{route('category.store')}} method="post">
                  @csrf
                  <div>
                        <label for="category" class="mt-5">Category name</label>
                        <input type="text" name="category" class="form-control mb-3" value = {{old('category')}}>
                        @error('category')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Add Category</button>  
            </form> 
      </div>
</div>
</x-admin_layout>