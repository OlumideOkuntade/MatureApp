<x-layout :name="auth()->user()->customer->first_name">
      <x-modal />

      <div class="row">
            <div class="col-md-6 ms-5 mt-5 mb-5">
                <img src="/images/bg.jpeg" class="img-fluid" style="width:280px;">
            </div>
            <div class="col-md-5 pt-5">
                <p class="fs-5 fw-bold">{{$product->name}}</p>
                <p class="fw-bold">Brand : Mature Fashion </p>
                <p class="fw-bold">{{'₦'.number_format($product->price)}}</p>
                <p>
                        @if ($product->quantity > 0)
                              {{"in stock"}}
                        @else
                              {{ "out of stock"}}
                        @endif
                </p>
                <form action ="{{route('product.store')}}" method="post">
                        @csrf
                        <div class="mb-4">
                        <select class="form-select noround border-dark" name="size">
                              <option value="#">Choose Size</option>
                              <option value="small">S</option>
                              <option value="medium">M</option>
                              <option value="large">L</option>
                              <option value="extra large">XL</option>
                        </select>
                        <input type="hidden"name="productId" value="{{$product->id}}">
                        <input type="hidden"name="price" value="{{$product->price}}">
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                              <input type="number" min='1' name="qty" class="col-4 rounded text-center" >
                        </div>
                        <div>
                              <button class="btn btn-dark col-12 rounded-7 col-12 mb-4"name="addcart">Add to Cart</button>
                        </div>
                </form>
            </div>
      </div>
</x-layout>
