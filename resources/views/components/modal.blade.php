@props(["cartitem","total"])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/fontawesome/css/all.min.css">
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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class='container'>
                            <div class='row'>
                                <div class='col-md-12 mb-3'>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th><th>Description</th><th>size</th><th>Qty</th><th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($cartitem ?? false)
                                                @foreach($cartitem as $cart)
                                                    <tr>
                                                        <td><img src="/images/bg.jpeg" class="img-fluid" style="width:30px;"></td>
                                                        <td>{{$cart->product->name}}</td>
                                                        <td>{{$cart->size}}</td>
                                                        <td>{{$cart->quantity}}</td>
                                                        <td>{{'₦'. number_format($cart->amount)}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"><a href={{route('order.purchase')}}> 
                            @if($total ?? false)
                             Checkout ({{'₦'.number_format($total)}})
                            @endif
                        </a></button>   
                    </div>
                </div>
            </div>
        </div>
        <!-- end Modal -->
    </div>
</body>
</html>
