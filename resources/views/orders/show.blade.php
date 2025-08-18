<x-no_cartLayout >
      
      <div class="row">
            <div class="col-md-10 offset-1 mt-5">
                  <table class="table table-bordered">
                        <thead>
                              <tr>
                                    <th class="text-center">Product Image</th>
                                    <th class="text-center">Product name</th>
                                    <th class="text-center">Product size</th>
                                    <th class="text-center">Product qty</th>
                                    <th class="text-center">Product Amount</th>
                              </tr>
                        </thead>
                        <tbody>
                              @if($orderedProduct ?? null)
                                    @foreach($orderedProduct as $pro)
                                          <tr>
                                                <td class="text-center"><img src="{{ $pro->image}}" class="img-fluid" style="width:40px;"></td>
                                                <td class="text-center">{{$pro->name }}</td>
                                                <td class="text-center">{{$pro->size }}</td>
                                                <td class="text-center">{{$pro->qty }}</td>
                                                <td class="text-center">{{number_format($pro->amt)}}</td>
                                          </tr>
                                    @endforeach
                              @endif
                        </tbody>
                  </table>
            </div>
            <div class="col-md-11 ">
                  <button class="float-end btn btn-dark text-light"><a style="color:white;text-decoration:none;" href={{route("my_orders")}} ><i class="fa-solid fa-arrow-left"></i></a></button>
            </div>
      </div>
        
</x-no_cartLayout>  
 