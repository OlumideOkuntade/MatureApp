<x-admin_layout>
    
<div class="row">
      <div class="col-md-9 offset-1">
            <h6 class="fs-3">All Customers</h6>
            <hr>
            @if(session('delete'))
                  <p class="bg-success text-light fs-5 mt-5">{{session('delete')}}</p>
            @endif
            <table class="table table-striped table-sm mt-5">
                  <thead>
                        <tr>
                              <th>S/N</th> 
                              <th>First name</th> 
                              <th>Last name</th>
                              <th>Phone number</th>
                              <th>Actions</th>
                        </tr>
                  </thead>
                  <tbody>
                        
                        @if($users ?? null)
                              @foreach ($users as $user)
                                    <tr>
                                          <td>{{$user->id}}</td>
                                          <td>{{$user->customer->first_name}}</td>
                                          <td>{{$user->customer->last_name}}</td>
                                          <td>{{$user->customer->phone_number}}</td>
                                          <td>
                                                <form method="post" action="/delete_user/{{$user->customer->id}}">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button class="btn btn-danger">Delete</button>
                                                </form>  
                                          </td>
                                    </tr>
                              @endforeach
                        @endif
                  </tbody>
            </table>
      
      </div>
</div>

</x-admin_layout>