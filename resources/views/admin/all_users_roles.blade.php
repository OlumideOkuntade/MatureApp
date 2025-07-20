<x-admin_layout>
    
<div class="row">
      <div class="col-md-7 offset-1 mt-5 register">
            <h6 class="fs-5">Add Users</h6>
            @if(session('success'))
                  <div class="bg-success twect-light">{{session('success')}}</div>
            @endif
           <form action={{ route('users_roles.store') }} method="post">
                  @csrf
                  <div class="mb-3">
                        <label>Firstname</label>
                        <input type="text" name="first_name" class="form-control">
                  </div>
                  <div class="mb-3">
                        <label>Lastname</label>
                        <input type="text" name="last_name" class="form-control">
                       
                  </div>
                  <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" >
                  </div>
                  <div class="mb-3">
                        <label>Phone number</label>
                        <input type="text" name="phone" class="form-control">
                  </div>
                  <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                  </div>
                  <div class="mb-3">
                        <label>Assign Role</label>
                        <select name="role" class="form-control">
                              @foreach($roles as $role )
                                    <option value="{{ $role->name}}">{{ ucfirst($role->name) }}</option>
                              @endforeach
                        </select>
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Create User</button>  
            </form> 
      </div>
</div>
<div class="row">
@foreach($users as $user)
      <div class="col-md-3 mt-5"> 
            <div class="card ">
                  <div class="card-header bg-dark text-white">
                        <strong>User: {{ ucfirst($user->admin->first_name ?? null ) }}</strong>
                  </div>
                  <div class="card-body">
                        <h6>Role:</h6>
                        <ul class="list-group list-group-flush">
                              @foreach($user->roles as $role )
                                    <li class="list-group-item">{{ $role->name }}</li>
                              @endforeach
                        </ul>
                  </div>
                  <div class="card-footer text-end">
                        <a href={{route('users_roles.edit', $user->id ?? null)}} class="btn btn-sm btn-outline-secondary">Edit</a>
                  </div>
            </div>
      </div>
@endforeach
</div>

</x-admin_layout>