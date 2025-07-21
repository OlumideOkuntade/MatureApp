<x-admin_layout>
    
<div class="row">
      <div class="col-md-9 offset-1">
            <h6 class="fs-3">All products</h6>
            <hr>  
            <button class="btn btn-dark mb-5 float-end"><a href="/new_product">Add product</a></button>
            
            @if(session('success'))
                  <p class="bg-success text-light fs-5 mt-5">{{session('success')}}</p>
            @elseif (session('delete'))
                  <p class="bg-success text-light fs-5 mt-5">{{session('delete')}}</p>
            @elseif(session('add'))
                   <p class="bg-success text-light fs-5 mt-5">{{session('add')}}</p>
            @endif
            <table class="table table-striped table-sm mt-5" id="myProduct">
                  <thead>
                        <tr>
                              <th>S/N</th> 
                              <th>Product Image</th> 
                              <th>Product Name</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th class="text-center ps-3">Edit</th>
                              <th class="text-center ps-3">Delete</th>
                        </tr>
                  </thead>
                  <tbody>
                        
                        @if($products ?? null)
                              @foreach ($products as $product)
                                    <tr>
                                          <td>{{$product->id}}</td>
                                          <td><img src="images/bg.jpeg" class="img-fluid rounded" style="width:50px; height:50px;" alt="responsive image"></td>
                                          <td>{{$product->name}}</td>
                                          <td>{{$product->quantity}}</td>
                                          <td>{{number_format($product->price)}}</td>
                                          <td><button class="btn btn-secondary ms-3"><a href="/edit_product/{{$product->id }}">Edit</a></button>  </td>
                                          
                                          <td>
                                                @can('delete', $product)
                                                      <form method="post" action="/delete_product/{{$product->id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger">Delete</button>
                                                      </form>
                                                @endcan  
                                          </td>
                                    </tr>
                              @endforeach
                        @endif
                  </tbody>
            </table>
      
      </div>
</div>

</x-admin_layout>