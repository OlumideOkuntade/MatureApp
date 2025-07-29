<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order details</title>
</head>
<body>
      <table class="table table-bordered">
            <thead>
                  <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Product name</th>
                        <th class="text-center">Size</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Amount</th>
                  </tr>
            </thead>
            <tbody>
                  @if ($orderDetails ?? null)
                        <?php $n = 1; ?>
                        @foreach($orderDetails as $detail)
                              <tr>
                                    <td class="text-center">{{$n++}}</td>
                                    <td class="text-center">{{$detail->name }}</td>
                                    <td class="text-center">{{$detail->size }}</td>
                                    <td class="text-center ">{{$detail->qty }}</td>
                                    <td class="text-center">{{number_format($detail->amt)}}</td>
                              </tr>
                        @endforeach
                  @endif
                        
            </tbody>
      </table>
</body>
</html>



 