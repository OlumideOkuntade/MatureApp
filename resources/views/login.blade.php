@include("header")
<!-- login form -->
<div class="row">
  <div class="col-md-4 mb-5 offset-4 ">
    <div class="login">
      <h6 class="fs-5 mt-4">Login</h6>
      <form action="process/process_login.php" method="post" class="mt-4">
        <div class=' form-floating '>
          <input type="email" name="email" class='form-control mb-4 ' placeholder="Enter your email" >
          <label for='email'>Enter your email</label>
        </div>
        <div class=' form-floating '>
          <input type="password" name="pass" class='form-control mb-4' placeholder="Enter your password" >
          <label for='password'>Enter your password</label>
        </div>
        <button class="btn btn-dark col-6 round-5 col-12 mb-4"name="login">Login</button>
        <div>
      </form>
    </div>
    <div class="mt-5 mb-5" >
      <h6>Don't have an account?</h6>
      <button class="btn btn-outline-dark col-12 round-5 "><a href="{{route("register")}}">Create account</a></button>
    </div>
  </div>
</div>
<!-- end login -->
@include("footer")
       
