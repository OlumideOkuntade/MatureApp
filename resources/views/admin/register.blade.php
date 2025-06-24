<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../admincss/style.css">
    <title>MaturedfashionStores</title>
    
</head>
<body>
  <div class="container-fluid">
      <!-- navigation -->
    <div class="row">
      <div class="col-md-12">
          <nav class="navbar navbar-expand-lg " id='nav_head'>
              <div class="container-fluid ">
                  <a class="navbar-brand fw-bold me-auto fs-3 fst-italic" href="{{route("admin.login")}}">Maturefashion</a>
                  <a href="/admin/login">LOGIN</a>
              </div>
            </nav>
          </div>
      </div>
    </div>
    <!-- end navigation -->
    <div class="row">
      <div class="col-md-4 offset-4 mt-5 register">
        <h6 class="fs-5">Admin Registration</h6>
          <form action="/admin/register/store" method="post">
            @csrf
            <x-input name='firstname' type='text' label="Enter your"/>
            <x-input name='lastname' type='text' label="Enter your"/>
            <x-input name='email' type='email' label='Enter your'/>
            <x-input name='phone' type='text' label='Enter your'/>
            <x-input name='password' type='password' label='Enter your'/>
          <button class="btn btn-dark col-12 round-5 mb-2">Register</button>
        </form> 
      </div>
    </div> 
 @include("../footer")
