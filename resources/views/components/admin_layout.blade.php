<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/fontawesome/css/all.min.css">
    <link rel= "stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>MaturedfashionStores</title>
    <style>
        #nav_head span{
            color:white;
            width:20px;
            text-align:center;
            font-weight:bold;
            background-color:red;
            border-radius:50%;
            font-size:15px;
            margin-left:-28px;
            display:block;
            margin-top:25px;
        }
        .modal button a {
            text-decoration:none;
            color:white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- navigation -->
          <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg " id='nav_head'>
                    <div class="container-fluid ">
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                            <a class="navbar-brand fw-bold me-auto fs-3 fst-italic" href={{route("admin.dashboard")}}>Maturefashion</a>
                            <div class="dropdown user-menu d-flex align-items-center">
                                <a class="btn dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hi, {{auth()->user()->admin->first_name}}
                                </a>
                                <ul class="dropdown-menu user-profile" style="border-radius:0px;background-color:white;">
                                    <li><a class="dropdown-item text-dark" href="/all_orders">Orders</a></li> 
                                    <li><a class="dropdown-item text-dark" href={{route('admin.logout')}}>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                  
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/admin/dashboard">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        @if(auth()->user()->can('manage_customers'))
                            <li class="nav-item">
                                <a class="nav-link" href="/all_orders">
                                    <span data-feather="file"></span>
                                    Orders
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->can('manage_products'))
                            <li class="nav-item">
                                <a class="nav-link" href={{route('all_products')}}>
                                    <span data-feather="shopping-cart"></span>
                                    Products
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->can('manage_customers'))
                            <li class="nav-item">
                                <a class="nav-link" href="/all_customers">
                                    <span data-feather="users"></span>
                                    Customers
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->can('manage_products'))
                            <li class="nav-item">
                                <a class="nav-link" href="/category">
                                    <span data-feather="users"></span>
                                    Category
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->can('manage_users'))
                            <li class="nav-item">
                                <a class="nav-link" href="/all_roles">
                                    <span data-feather="users"></span>
                                    Roles
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->can('manage_users'))
                            <li class="nav-item">
                                <a class="nav-link" href="/users_roles">
                                    <span data-feather="users"></span>
                                    Users
                                </a>
                            </li>
                        @endif
                    </ul> 
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                {{ $slot }}
            </main>
        </div>

        

        <footer>
            <div class="row mt-5 ms-5 me-5 footer_container" >
            
                    <div class="col-md-2 mt-4">
                        <h6>Customer services</h6>
                        <ul>
                            <li><a href="{{route('contact')}}">Customer Care</a></li>
                            <li><a href="{{route('product')}}">Product</a></li>
                            <li><a href="{{route('product')}}">Returns</a></li>
                            <li><a href="{{route('product')}}">FAQ</a></li>
                            <li><a href="{{route('login')}}">My Account</a></li>
                        </ul>  
                    </div>
                    <div class="col-md-2 mt-4">
                        <h6>Company</h6>
                        <ul>
                            <li><a href="{{route("about")}}">About Us</a></li>
                            <li><a href="{{route("contact")}}">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 mt-4">
                        <h6>Categories</h6>
                        <ul>
                            <li><a href="">New Arrivals</a></li>
                            <li><a href="">Suits</a></li>
                            <li><a href="">Jackets</a></li>
                            <li><a href="">T-shirts</a></li>
                            <li><a href="">Pants</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 mt-4">
                        <h6>Policies</h6>
                        <ul>
                            <li><a href="">Exchange Policy</a></li>
                            <li><a href="">Return Policy</a></li>
                            <li><a href="">Refund Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 mt-4">
                        <h5>Join our list</h5>
                        <p class="ms-4">Receive updates on our latest products, releases and exclusive partnerships</p>
                        <input type="checkbox" name="men" value="men"class="ms-4 "> Men
                        <input type="checkbox" name="women" value="women" class="ms-4"> Woman
                        <input type="email" name="email" placeholder="Enter Email"class="form-control mt-3 ms-4"> 
                        <a href="../login.php"><i class="fa-brands fa-facebook ms-4 mt-5 "></i></a>
                        <a href="../login.php"><i class="fa-brands fa-instagram ps-2"></i></a>
                        <a href="../login.php"><i class="fa-brands fa-x-twitter ps-2"></i></a>
                        <a href="../login.php"><i class="fa-brands fa-tiktok ps-2" ></i></i></a>
                    </div>
                
                <hr>
                    
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="ms-5 mt-5">&copy 2025, Maturefashion, All rights reserved.</p>
                </div>
            </div>
        </footer>

    </div>
    <script type="text/javascript" src="/bootstrap/js/bootstrap.bundle.min.js" ></script>
    <script src="js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myOrder").DataTable();
            $("#myProduct").DataTable();
            $("#allCustomers").DataTable();
        })
    </script>
</body>
</html>