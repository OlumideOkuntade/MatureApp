@include("header")

<div class="row">
  <div class="col-md-4 mb-5 offset-4 ">
    @if(session()->has('success'))
        <p class="bg-success text-light fs-5 mt-5">{{session('success')}}</p>
    @endif
    <div class="login">
      <h6 class="fs-5 mt-4">Login</h6>
      <form action="/login/store" method="post" class="mt-4">
        @csrf
        <x-input name='email' type='email' label='Enter your'/>
        <x-input name='password' type='password' label='Enter your'/>
        <button class="btn btn-dark col-6 round-5 col-12 mb-4"name="login">Login</button>
      </form>
    </div>
    <div class="mt-5 mb-5" >
      <h6>Don't have an account?</h6>
      <button class="btn btn-dark col-12 round-5 "><a style="color:white;text-decoration:none;" href="{{route("register")}}">Create account</a></button>
    </div>
  </div>
</div>

@include("footer")
       
