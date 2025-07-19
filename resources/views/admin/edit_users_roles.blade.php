<x-admin_layout>
    
<div class="row">
      <div class="col-md-6 offset-1 mt-5 register">
            <h6 class="fs-5">Edit Users</h6>
            @if(session('success'))
                  <div class="bg-success twect-light">{{session('success')}}</div>
            @endif
           <form action={{ route('users_roles.update',$user->id) }} method="post">
                  @csrf
                    <div class="mb-3">
                        <label>Firstname</label>
                        <input type="text" name="first_name" class="form-control"value="{{$user->customer->first_name}}">
                  </div>
                  <div class="mb-3">
                        <label>Lastname</label>
                        <input type="text" name="last_name" class="form-control"value="{{$user->customer->last_name}}">
                        @error('last_name')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                  </div>
                  <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                  </div>
                   <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control"value="{{$user->customer->phone_number}}">
                  </div>
                  <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                  </div>
                  <div class="mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control">
                              @foreach ($user_roles as $role)
                                    <option value="{{ $role->name }}"{{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                              @endforeach
                        </select>
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Edit User</button>  
            </form> 
      </div>
</div>

</x-admin_layout>