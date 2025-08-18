@include("header")
    <div class="row mb-5">
        <div class="col-md-12" >
            <div class="header_container">
                <div class ="overlay">
                    <div>
                        <h1 >Refined Fashion.</h1>
                        <h1>Unmatched Style.</h1>
                        <button class=" fw-bold btn btn-light btn-lg rounded-5 mt-3 ">Shop Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row view_container ms-5 mb-3 me-5">
        <section>
            @if(session()->has('success'))
                <p class="bg-success text-light fs-5 mt-5">{{session('success')}}</p>
            @endif
            <div class="col-md-12 view_container-first mb-3">
                <h3>New Arrivals</h3>
            </div>
            <div class="col-md-12 view_container-second" >
                <div>{{$gender}}</div>
                <button class="btn btn-dark btn-sm rounded-3 ">View all</button>
            </div>
        </section>
    </div>
<!-- first card -->
    
    <div class="row ms-5 me-5 card_container">
        @foreach ($products as $product )
            <div class="col-md-3 ">
                <div class="card bg-light-subtle float-end mt-3" >
                    <a href=""><img src="{{$product->getFirstMediaUrl('default')}}" class="img-fluid rounded-4" style="width:350px; height:350px;" alt="responsive image"></a>
                    <div class="card-body ">
                        <p class="fs-6 fw-bold">{{$product->name }}</p>
                        <div class="d-flex justify-content-between align-items-start">
                            <p class="fs-5 fw-bold lh-1 "> {{'₦'.number_format($product->price)}}</p>
                            <p class="fs-6 text-grey">Mature Fashion</p>  
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
<!-- end first card -->      
<!-- footer -->
@include("footer")
