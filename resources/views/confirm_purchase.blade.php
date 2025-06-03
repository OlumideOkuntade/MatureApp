<x-layout :name="auth()->user()->customer->first_name">
      <x-modal />

      <div class="row">
            <div class="col-md-6 ms-5 mt-5 mb-5">
                <img src="/images/bg.jpeg" class="img-fluid" style="width:280px;">
            </div>
            <div class="col-md-5 pt-5">
                <p class="fs-5 fw-bold">{{$product->name}}</p>
                <p class="fw-bold">Brand : Mature Fashion </p>
                <p class="fw-bold">{{'NGN'.number_format($product->price)}}</p>
                <p class="fw-bold">Size: small </p>
                <p>
                        @if ($product->quantity > 0)
                              {{"in stock"}}
                        @else
                              {{ "out of stock"}}
                        @endif
                </p>
        
            </div>
      </div>
</x-layout>
