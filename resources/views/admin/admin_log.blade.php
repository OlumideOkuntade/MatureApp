<x-admin_layout>
    
<div class="row">
      <div class="col-md-7 offset-1 mt-5 register">
            <h6 class="fs-2 text-center">Admin Logs</h6>
            <table class="table table-striped table-sm mt-5" id="mylog">
                  <thead>
                        <th>Log name</th>
                        <th>Description</th>
                        <th>Caused by</th>
                  </thead>
                  <tbody>
                        @foreach($activities as $activity)
                              <tr>
                                    <td>{{$activity->log_name}}</td>
                                    <td>{{$activity->description}}</td>
                                    <td>{{$activity->causer->email}}</td>
                              </tr>
                        @endforeach
                  </tbody>
            </table>
      </div>
</div>

</x-admin_layout>