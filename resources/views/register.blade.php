@include("header")

<div class="row">
  <div class="col-md-4 offset-4 mt-5 register">
    @if(session()->has('success'))
        <p class="bg-success text-light fs-5">{{session('success')}}</p>
      @endif
    <h6 class="fs-5">Create Account</h6>
      <form action="/register" method="post">
        @csrf
        <div class=' form-floating '>
          <input type="text" name="firstname" class='form-control mb-3 ' placeholder="Enter your Firstname"value="{{old('firstname')}}">     
          <label >First name</label>
          @error('firstname')
            <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <div class=' form-floating '>
          <input type="text" name="lastname" class='form-control mb-3' placeholder="Enter your Lastname"value="{{old('lastname')}}">
          <label >Last name</label>
           @error('lastname')
            <p class="text-danger fs-6">{{$message}}</p>
          @enderror
        </div>
        <div class=' form-floating '>
          <input type="email" name="email" class='form-control mb-3'placeholder="Enter your email"value="{{old('email')}}" >
          <label>Enter your email</label>
           @error('email')
            <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <div class=' form-floating '>
          <input type="text" name="phone" class='form-control mb-3 ' placeholder="Enter phone number"value="{{old('phone')}}" >
          <label>Phone number</label>
          @error('phone')
            <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <div class=' form-floating '>
          <input type="password" name="password" class='form-control mb-3'placeholder="Enter your password" >
          <label>Enter your password</label>
          @error('password')
            <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <label>Would you like to receive updates on Mature latest products, 
          releases and exclusive partnerships in line with our privacy policy?</label>
        <div>
          @error('radio')
            <p class="text-danger">{{$message}}</p>
          @enderror
          <input type="radio" name="radio" class="mb-2" value ="yes"
           {{old('radio') == "yes" ? 'checked': ''}}> Yes
        </div>
        <div>
          <input type="radio" name="radio" class="mb-5" value="no"
          {{old('radio') == "no" ? 'checked': ''}}> No
        </div>

        <button name="btn"class="btn btn-dark col-12 round-5 mb-2">Create</button>
        <p>By continuing, you agree to the Terms of use and Privacy Policy.</p> 
      </form> 

      <div class="mt-5 mb-5">
        <p>Already have an account?</p>
        <button class="btn btn-outline-dark col-12 round-5"><a href="/login">Sign in</a></button>
      </div>
  </div>
</div> 

  @include("footer");






