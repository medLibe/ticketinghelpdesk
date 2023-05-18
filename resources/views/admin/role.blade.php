@extends('admin.layout')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>{{ $title }}</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <button class="btn text-white" style="background-color:teal; font-size:10pt;" data-toggle="modal" data-target="#createRole">
                                    <i class="fa fa-plus"></i> Role
                                </button>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="roleTable"
                                        class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Role Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div class="modal fade" id="createRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add New Role</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="createForm" method="POST" action="/admin/role-store">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Role Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="role_name" id="role_name" required
                            autofocus placeholder="Role Name" title="This field is required">
                        @error('role_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm text-white" id="insertButton" form="createForm" style="background-color:teal;">Save</button>
            </div>
          </div>
        </div>
    </div>

    @foreach ($role as $r1)
    {{-- Modal Edit --}}
    <div class="modal fade" id="editRole{{ $r1->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Role</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="editForm{{ $r1->id }}" method="POST" action="/admin/role-update">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Role Name</label>
                        <input type="text" class="form-control" name="role_name" required placeholder="Role Name" value="{{ $r1->role_name }}">
                        <input type="hidden" class="form-control" name="role_id" readonly value="{{ $r1->id }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-primary" form="editForm{{ $r1->id }}">Save</button>
            </div>
          </div>
        </div>
    </div>

     {{-- Modal Delete --}}
     <div class="modal fade" id="deleteRole{{ $r1->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Role</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="deleteForm{{ $r1->id }}" method="POST" action="/admin/role-delete">
                    @csrf
                    <span>Are you sure want to delete <strong>{{ $r1->role_name }}</strong> role?</span>
                    <input type="hidden" class="form-control" readonly value="{{ $r1->id }}" name="role_id">
                    <input type="hidden" class="form-control" readonly value="{{ $r1->role_name }}" name="role_name">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-danger" form="deleteForm{{ $r1->id }}">Delete</button>
            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Validation --}}
<script>
    $(document).ready(function() {
        $('#createForm').validate();
    });
</script>

<script>
    $(function() {
        table = $('#roleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.role-ajax') }}",
            columns: [
                {data: 'role_name', name: 'role_name'},
                {data: 'action', name: 'action'}
            ],
            columnDefs: [
                { className: 'text-center', 'targets': [ 1 ] }
            ]
        });
    });
</script>
@endsection
