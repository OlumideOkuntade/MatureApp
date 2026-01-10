
<x-layout :name="auth()->user()->customer->first_name" :count="$count">
        <x-modal :cartitem="$cartItem" :total="$total"/>

        <div class="row mb-3">
            <div class="col-md-12">   
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="tab">
                        <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard" type="button" role="tab" aria-controls="home" aria-selected="true">Dashboard</button>
                    </li>
                    <li class="nav-item" role="tab">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                    </li>
                    <li class="nav-item" role="tab">
                        <button class="nav-link" id="2fa-tab" data-bs-toggle="tab" data-bs-target="#2fa" type="button" role="tab" aria-controls="messages" aria-selected="false">Authentication</button>
                    </li>
                    <li class="nav-item" role="tab">
                        <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="dashboard" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <h4 class="mx-5 mt-5"> 
                        @if(session()->has('success'))
                            <div class="text-dark fs-5 mt-5">{{session('success')}}</div>
                        @endif
                            Welcome, {{auth()->user()->customer->first_name}} 
                        </h4>
                        <p class="mx-5">You are logged in, Please tap the profile tab to order any cloth of choice.</p>
                        
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="row ms-5 me-5 card_container">
                            @foreach($products as $product)
                                <div class="col-md-3 mt-3 ">
                                    <div class="card">
                                        <img src={{$product->getFirstMediaUrl('default')}} class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                                        <div class="card-body ">
                                            <p class="fs-6 fw-bold">{{$product->name}}</p>
                                            <div class="d-flex justify-content-between align-items-start">
                                                <p class="fs-5 fw-bold lh-1 "> {{'₦'.number_format($product->price)}}</p>
                                                <button class="btn btn-success round"><a href={{route('product.purchase',['product'=> $product->id])}}>Quick Buy</a></button>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach  
                        </div> 
                    </div>
                    <div class="tab-pane" id="2fa" role="tabpanel" aria-labelledby="messages-tab" tabindex="0">
                        @if (!auth()->user()->google2fa_enabled)
                        <button class="btn btn-dark float-start mt-4 mx-5" id="2fa"><a href="/2fa/setup" style="color:white;text-decoration:none">Setup 2FA </a></button>
                        @endif
                    </div>
                    <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab" tabindex="0">...</div>
                </div>
            
                
               
            </div>
        
        </div>
 <!-- start card -->
        {{-- <div class="row ms-5 me-5 card_container">
            @foreach($products as $product)
                <div class="col-md-3 mt-3 ">
                    <div class="card">
                        <img src={{$product->getFirstMediaUrl('default')}} class="img-fluid rounded" style="width:350px; height:350px;" alt="responsive image">
                        <div class="card-body ">
                            <p class="fs-6 fw-bold">{{$product->name}}</p>
                            <div class="d-flex justify-content-between align-items-start">
                                <p class="fs-5 fw-bold lh-1 "> {{'₦'.number_format($product->price)}}</p>
                                <button class="btn btn-success round"><a href={{route('product.purchase',['product'=> $product->id])}}>Quick Buy</a></button>   
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach  
        </div> --}}
    <!-- end start card -->
</x-layout>



