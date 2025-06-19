@include("header")

<div class="row">
  <div class="col-md-4 offset-4 mt-5 register">
    <h6 class="fs-5">Create Account</h6>
    <form action="/register/store" method="post">
      @csrf
      <x-input name='firstname' type='text'/>
      <x-input name='lastname' type='text'/>
      <x-input name='email' type='email' label='Enter your'/>
      <x-input name='phone' type='text' label='Enter your'/>
      <x-input name='password' type='password' label='Enter your'/>
      <label>Would you like to receive updates on Mature latest products, 
        releases and exclusive partnerships in line with our privacy policy?
      </label>
      <div>
        <x-error name="radio" />
        <input type="radio" name="radio" class="mb-2" value ="yes"
        {{old('radio') == "yes" ? 'checked': ''}}> Yes
      </div>
      <div>
        <input type="radio" name="radio" class="mb-5" value="no"
        {{old('radio') == "no" ? 'checked': ''}}> No
      </div>
      <button name="btn"class="btn btn-dark col-12 round-5 mb-2">Create</button>
    </form> 

    <div class="mt-5 mb-5">
      <p>Already have an account?</p>
      <button class="btn btn-outline-dark col-12 round-5"><a href="/login">Sign in</a></button>
    </div>
  </div>
</div> 

@include("footer");






