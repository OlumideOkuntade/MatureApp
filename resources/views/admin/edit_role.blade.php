<x-admin_layout>
    
<div class="row">
      <div class="col-md-6 offset-1 mt-5 register">
            <h6 class="fs-5">Update Permission</h6>
           @if(session('update'))
                  <div class="bg-success text-light">{{session('update')}}</div>
           @endif
            <form action="/update_role/{{$role->id }}" method="post">
                  @csrf
                  <div>
                        <label for="role" class="mt-7 mb-1">Role name</label>
                        <input type="text" name="role" class="form-control mb-3" value="{{$role->name}}">
                        <h6>Permissions</h6>
                        @foreach($permissions as $permission)
                              <input type="checkbox" name="permissions[]" class="ms-2" value="{{$permission->name}}"
                              {{ in_array($permission->name, $permissionArray) ? 'checked' : ''}}>
                              <label for="permissions">{{$permission->name}}</label>
                        @endforeach
                  </div>
                  <button class="btn btn-dark col-12 mt-3 round-4">Update Permission</button>  
            </form> 
      </div>
</div>

</x-admin_layout>