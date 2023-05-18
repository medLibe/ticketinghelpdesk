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
                        <button class="btn text-white" style="background-color:teal;" data-toggle="modal" data-target="#createDepartment">
                            <i class="fa fa-plus"></i> Department
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="departmentTable"
                                        class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Department Name</th>
                                                <th>Department Head</th>
                                                <th>Department Place</th>
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
    <div class="modal fade" id="createDepartment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add New Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="createForm" method="POST" action="/admin/department-store">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Department Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="department_name" id="department_name"
                            autofocus placeholder="Department Name" required title="This field is required">
                        @error('department_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Department Head <span class="required">*</span></label>
                        <input type="text" class="form-control" name="department_head" id="department_head"
                            placeholder="Department Head" required title="This field is required">
                        @error('department_head')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Department Place <span class="required">*</span></label>
                        <input type="text" class="form-control" name="department_place" id="department_place"
                            placeholder="Department Place" required title="This field is required">
                        @error('department_place')
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

    @foreach ($department as $d1)
    {{-- Modal Edit --}}
    <div class="modal fade" id="editDepartment{{ $d1->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="editForm{{ $d1->id }}" method="POST" action="/admin/department-update">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="department_name" placeholder="Department Name" value="{{ $d1->department_name }}">
                        <input type="hidden" class="form-control" name="department_id" readonly value="{{ $d1->id }}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Department Head</label>
                        <input type="text" class="form-control" name="department_head" placeholder="Department Head" value="{{ $d1->department_head }}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Department Place</label>
                        <input type="text" class="form-control" name="department_place" placeholder="Department Place" value="{{ $d1->department_place }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-primary" form="editForm{{ $d1->id }}">Save</button>
            </div>
          </div>
        </div>
    </div>

     {{-- Modal Delete --}}
     <div class="modal fade" id="deleteDepartment{{ $d1->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="deleteForm{{ $d1->id }}" method="POST" action="/admin/department-delete">
                    @csrf
                    <span>Are you sure want to delete <strong>{{ $d1->department_name }}</strong> department?</span>
                    <input type="hidden" class="form-control" readonly value="{{ $d1->id }}" name="department_id">
                    <input type="hidden" class="form-control" readonly value="{{ $d1->department_name }}" name="department_name">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-danger" form="deleteForm{{ $d1->id }}">Delete</button>
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
        table = $('#departmentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.department-ajax') }}",
            columns: [
                {data: 'department_name', name: 'department_name'},
                {data: 'department_head', name: 'department_head'},
                {data: 'department_place', name: 'department_place'},
                {data: 'action', name: 'action', searchable: false}
            ],
            columnDefs: [
                { className: 'text-center', 'targets': [ 3 ] }
            ]
        });
    });
</script>
@endsection
