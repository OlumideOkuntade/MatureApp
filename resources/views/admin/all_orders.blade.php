<x-admin_layout>

      <div class="row">
            <div class="col-md-10 offset-1 mt-5">
                  <table class="table table-bordered table-hover">
                        <thead>
                              <tr>
                                    <th class="text-center">Order No</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Customer Id</th>
                                    <th class="text-center">Customer Name</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center"> Status</th>
                                    <th class="text-center">Payment Status</th>
                                    <th class="text-center">View Product</th>
                              </tr>
                        </thead>
                        <tbody>
                              @if($orderContent ?? null)
                                    @foreach($orderContent as $content)
                                          <tr>
                                                <td class="text-center">{{$content->order_no }}</td>
                                                <td class="text-center">{{$content->order_date }}</td>
                                                <td class="text-center">{{$content->customer_id }}</td>
                                                <td class="text-center">{{$content->customer_name }}</td>
                                                <td class="text-center">{{$content->amount }}</td>
                                                <td><span class="badge rounded-pill text-bg-warning ">{{$content->status }}</span></td>
                                                <td><span class="badge rounded-pill text-bg-warning me-5">{{$content->payment_status}}</span></td>
                                                <td class="text-center"><button><a href={{route('orders_product',["order_id"=> $content->order_no])}}><i class="fa-solid fa-eye"></i></a></button></td>
                                          </tr>
                                    @endforeach
                              @endif
                        </tbody>
                  </table>
            </div>
      </div>
</x-admin_layout>     

 