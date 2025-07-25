<x-no_cartLayout>

    <div class="row">
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
                                <td class="text-center"><img src="{{$cart->product->getFirstMediaUrl('default') }}" class="img-fluid" style="width:40px;"></td>
                                <td class="text-center">{{$cart->product->name}}</td>
                                <td class="text-center">{{'NGN'. number_format($cart->amount)}}</td>
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
        <form action="{{route("confirm.order.store")}}" method="post">
            @csrf
            <button class="btn btn-dark float-end">Confirm order</button>    
        </form>
    </div>
</div>

</x-no_cartLayout>        