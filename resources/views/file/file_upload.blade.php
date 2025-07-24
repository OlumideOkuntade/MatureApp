<x-admin_layout>
    
<div class="row">
      <div class="col-md-7 offset-1 mt-5 register">
            <h6 class="fs-5">File Upload</h6>
            @if(session('success'))
                  <div class="bg-success twect-light">{{session('success')}}</div>
            @endif
           <form action={{ route('upload.store') }} method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                        <label>file</label>
                        <input type="file" name="file" class="form-control">
                  </div>
                  <button class="btn btn-dark col-12 mb-3 round-4">Upload CSV</button>  
            </form> 
      </div>
</div>


</x-admin_layout>