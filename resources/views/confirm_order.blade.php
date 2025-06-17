<x-no_cartLayout>


         {{-- <div class="row">
            <div class="col-md-10 offset-1 mt-5">
                  <table class="table table-bordered">
                        <thead>
                              <tr>
                                    <th class="text-center">Product Image</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Amount</th>
                              </tr>
                        </thead>
                        <tbody>
                            @if($cartItem ?? false)
                                @foreach($cartItem as $cart)
                                    <tr>
                                        <td class="text-center"><img src="/images/bg.jpeg" class="img-fluid" style="width:40px;"></td>
                                        <td class="text-center">{{$cart->product->name}}</td>
                                        <td class="text-center">
                                            @if($total ?? false)
                                                {{'NGN'. number_format($total)}}
                                            @endif
                                        </td>
                                    </tr> 
                                @endforeach
                            @endif
                        </tbody>
                  </table>
            </div>
            <div class="col-md-11">
                <p class="text-end">
                    Total amount: 
                        @if($total ?? false)
                            {{'NGN'. number_format($total)}}
                        @endif
                </p>
                <form action="process/process_order.php" method="post">
                    <button class="btn btn-dark float-end" name="btnorder">Confirm order</button>
                </form>
            </div>
        </div> --}}
    
</x-no_cartLayout>  