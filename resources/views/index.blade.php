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
                <div>
                    {{$gender}}
                    </div>
                <button class="btn btn-dark btn-sm rounded-3 ">View all</button>
            </div>
        </section>
    </div>
<!-- first card -->
    <div class="row ms-5 me-5 card_container">
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg18.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">V-Neck Sweater</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦23,000</p>
                        <button class="btn btn-success round-5 lh-1 mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg14.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">Black V-Neck Sweater</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦21,000</p>
                        <button class="btn btn-success round-5 lh-1 mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg15.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">Green V-Neck Sweater</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦29,000</p>
                        <button class="btn btn-success round-5 lh-1 mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg17.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">Light-Green V-Neck Sweater</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦22,000</p>
                        <button class="btn btn-success round-5 lh-1  mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end first card -->
<!-- second card -->
    <div class="row ms-5 me-5 card_container">
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">Complete Men style</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦41,000</p>
                        <button class="btn btn-success round-5 lh-1 mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg8.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">Men Sweatshirt</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦22,000</p>
                        <button class="btn btn-success round-5 lh-1 mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg9.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">Brown Sweatshirt</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦24,000</p>
                        <button class="btn btn-success round-5 lh-1 mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ">
            <div class="card" >
                <img src="images/bg7.jpeg" class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                <div class="card-body ">
                    <p class="fs-6 fw-bold lh-1">Jean Jacket Shirt</p>
                    <div class="d-flex justify-content-between align-items-start">
                        <p class="fs-4 fw-bold lh-1 ">₦26,000</p>
                        <button class="btn btn-success round-5 lh-1 mt-4">Mature Fashion</button>  
                    </div>
                </div>
            </div>
        </div>
    </div> 
<!-- end second card -->      
<!-- footer -->
@include("footer")
