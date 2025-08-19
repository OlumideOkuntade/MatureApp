<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>Order details</title>
      <style>
            body { font-family: DejaVu Sans, sans-serif; }
            h1 { color: navy; text-align: center; }
            table { width: 100%; border-collapse: collapse; margin-top:20px; }
            th, td { border: 1px solid #000; padding: 8px; }
            #invoice { display:flex; justify-content: space-between; align-items: center; margin-left:20px;margin-right:30px;}
      </style>
</head>
<body>
    <div class="container my-5 py-5">
        <div class="row">
            <div class="col-lg-9 "></div>
            <div class="col-lg-6">
                <h1 class="font-weight-lighter">INVOICE</h1>
            </div>
        </div>
        <div class="row my-3 mt-3" id="invoice">
            <div class="col-lg-8">
                <h5 class="mb-0"><b>{{$customer->last_name .' '. $customer->first_name}}</b></h5>
                <p class="mb-0">6, Omole Benson Lagos state</p>
                <p class="mb-0">{{$customer->phone_number}}</p>
                <p class="mb-0">{{$customer->user->email}}</p>
            </div>
            <div class="col-lg-3">
                <p class="mb-0">Invoice No: 123456</p>
                <p class="mb-0">Order Date: {{now()->format('Y-m-d')}}</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>                           
                            <th>ITEM DESCREPTION</th>
                            <th>QTY</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $n =1 ?>
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
                        <tr>
                            <td colspan="3"></td>
                            <td><b>GRAND TOTAL</b></td>
                            <td><b>{{$grand_total}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>




 