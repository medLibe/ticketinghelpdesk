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
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="ticketTable"
                                        class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Ticket ID</th>
                                                <th>Requester</th>
                                                <th>Department</th>
                                                <th>Helpdesk</th>
                                                <th>Priority</th>
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
    {{-- <div class="modal fade" id="createRole" tabindex="-1" aria-hidden="true">
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
                        <input type="text" class="form-control" name="role_name" id="role_name"
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
    </div> --}}
</div>

{{-- Validation --}}
<script>
    $(document).ready(function() {
        $('#createForm').validate();
    });
</script>

<script>
    $(function() {
        table = $('#ticketTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.ticket-ajax') }}",
            columns: [
                {data: 'ticket_no', name: 'ticket_no'},
                {data: 'name', name: 'name'},
                {data: 'department_name', name: 'department_name'},
                {data: 'helpdesk_name', name: 'helpdesk_name'},
                {data: 'priority', name: 'priority'},
                {data: 'action', name: 'action'}
            ],
            columnDefs: [
                { className: 'text-center', 'targets': [ 5 ] }
            ]
        });
    });
</script>
@endsection
