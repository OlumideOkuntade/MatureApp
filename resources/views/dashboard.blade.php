
<x-nav>
        <x-modal/>
       
       
        <div class="row mb-5">
            <div class="col-md-12 ">
                <h3 style="margin-bottom:20px;" class="text-center heading-title mt-2">Dashboard</h3> 
                <h4 class="mx-5">Welcome back Olumide</h4>
                <p class="mx-5">You are logged in, Please select any cloth of choice for purchase.</p>
            </div>
        </div>
 <!-- start card -->
        <div class="row ms-5 me-5 card_container">
            @foreach($products as $product)
                <div class="col-md-3 ">
                    <div class="card" >
                        <img src="images/bg.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                        <div class="card-body ">
                            <p class="fs-6 fw-bold lh-1">{{$product->name}}</p>
                            <div class="d-flex justify-content-between align-items-start">
                                <p class="fs-4 fw-bold lh-1 ">{{number_format($product->price)}}</p>
                                <button class="btn btn-success round"><a href="">Quick Buy</a></button>   
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach  
        </div>
    <!-- end start card -->
</x-nav>



