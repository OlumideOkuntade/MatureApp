<x-admin_layout>
    
<div class="row">
      <div class="col-md-6 offset-1 mt-5 register">
            <h6 class="fs-5">Add Roles</h6>
           @if(session('success'))
                  <div class="bg-success text-light">{{session('success')}}</div>
           @endif
           <form action={{route('all_roles.store')}} method="post">
                  @csrf
                  <div>
                        <label for="role" class="mt-7 mb-1">Role name</label>
                        <input type="text" name="role" class="form-control mb-3" value = {{old('role')}}>
                        @error('role')
                              <p class="text-danger">{{$message}}</p>
                        @enderror
                        <h6>Select Permissions</h6>
                        @foreach($permissions as $permission)
                              <input type="checkbox" name="permissions[]" class="mb-3 ms-2" value ="{{$permission->name}}">
                              <label for="permissions">{{$permission->name}}</label>
                        @endforeach
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Create Role</button>  
            </form> 
      </div>
</div>
<div class="row">
      @foreach($roles as $role)
            <div class="col-md-3 mt-5"> 
                  <div class="card ">
                        <div class="card-header bg-dark text-white">
                              <strong>Role: {{ ucfirst($role->name) }}</strong>
                        </div>
                        <div class="card-body">
                              <h6>Permissions:</h6>
                              @if($role->permissions->isEmpty())
                                    <p class="text-muted">No permissions assigned.</p>
                              @else
                              <ul class="list-group list-group-flush">
                                    @foreach($role->permissions as $permission)
                                          <li class="list-group-item">{{ $permission->name }}</li>
                                    @endforeach
                              </ul>
                              @endif
                        </div>
                        <div class="card-footer text-end">
                              <a href={{route('edit_role',["role" => $role->id])}} class="btn btn-sm btn-outline-secondary">Edit</a>
                        </div>
                  </div>
            </div>
      @endforeach  
</div>
</x-admin_layout>