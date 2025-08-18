<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Order details</title>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="{{ public_path('bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container my-5 py-5">

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <h1 class="font-weight-lighter mb-5">INVOICE</h1>
            </div>
        </div>
        <div class="row my-3 mt-3">
            <div class="col-8">
                <h5 class="mb-0"><b>{{$customer->last_name .' '. $customer->first_name}}</b></h5>
                <p class="mb-0">6, Omole Benson Lagos state</p>
                <p class="mb-0">{{$customer->phone_number}}</p>
                <p class="mb-0">{{$customer->user->email}}</p>
            </div>
            <div class="col-lg-3">
                <table>
                    <tbody>
                        <tr>
                            <td>Invoice No</td>
                            <td class="px-3">:</td>
                            <td>123456</td>
                        </tr>
                        <tr>
                            <td>Order Date</td>
                            <td class="px-3">:</td>
                            <td>{{now()->format('Y-m-d')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <?php $n =1 ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>                           
                            <th scope="col">ITEM DESCREPTION</th>
                            <th scope="col">QTY</th>
                            <th scope="col">PRICE</th>
                            <th scope="col">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $total = 0; @endphp
                    @foreach ($orderDetails as $detail )
                    @php $total += $detail->amt; @endphp
                        <tr > 
                            <td>{{$n++}}</td>
                            <td>{{$detail->name}}</td>
                            <td>{{$detail->qty}}</td>
                            <td>{{number_format($detail->price)}}</td>
                            <td>{{number_format($detail->amt)}}</td>
                        </tr>
                    @endforeach   
                        <tr class="mt-5">
                            <td colspan="3"></td>
                            <td><b>TOTAL</b></td>
                            <td><b>{{number_format($total)}}</b></td>
                        </tr>
                        <tr class="mt-5">
                            <?php $discount = 3/100 ?>
                            <td colspan="3"></td>
                            <td><b>Discount 3%</b></td>
                            <td><b>{{$grand_total = number_format(($discount) * $total)}}</b></td>
                        </tr>
                        <tr class="mt-5" style='color:aqua;'>
                            <td colspan="3"></td>
                            <td ><b>GRAND TOTAL</b></td>
                            <td><b>{{$grand_total}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>




 