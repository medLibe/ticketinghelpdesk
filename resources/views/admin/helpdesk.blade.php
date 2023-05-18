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
                        <button class="btn text-white" style="background-color:teal;" data-toggle="modal" data-target="#createHelpdesk">
                            <i class="fa fa-plus"></i> Helpdesk
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="helpdeskTable"
                                        class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Helpdesk Name</th>
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
    <div class="modal fade" id="createHelpdesk" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add New Helpdesk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="createForm" method="POST" action="/admin/helpdesk-store">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Helpdesk Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="helpdesk_name" id="helpdesk_name"
                            autofocus placeholder="Helpdesk Name" required title="This field is required">
                        @error('helpdesk_name')
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

    @foreach ($helpdesk as $h1)
    {{-- Modal Edit --}}
    <div class="modal fade" id="editHelpdesk{{ $h1->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Department</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="editForm{{ $h1->id }}" method="POST" action="/admin/helpdesk-update">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Helpdesk Name</label>
                        <input type="text" class="form-control" name="helpdesk_name" placeholder="Helpdesk Name" value="{{ $h1->helpdesk_name }}">
                        <input type="hidden" class="form-control" name="helpdesk_id" readonly value="{{ $h1->id }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-primary" form="editForm{{ $h1->id }}">Save</button>
            </div>
          </div>
        </div>
    </div>

     {{-- Modal Delete --}}
     <div class="modal fade" id="deleteHelpdesk{{ $h1->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Helpdesk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="deleteForm{{ $h1->id }}" method="POST" action="/admin/helpdesk-delete">
                    @csrf
                    <span>Are you sure want to delete <strong>{{ $h1->helpdesk_name }}</strong>?</span>
                    <input type="hidden" class="form-control" readonly value="{{ $h1->id }}" name="helpdesk_id">
                    <input type="hidden" class="form-control" readonly value="{{ $h1->helpdesk_name }}" name="helpdesk_name">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-sm btn-danger" form="deleteForm{{ $h1->id }}">Delete</button>
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
        table = $('#helpdeskTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.helpdesk-ajax') }}",
            columns: [
                {data: 'helpdesk_name', name: 'helpdesk_name'},
                {data: 'action', name: 'action', searchable: false}
            ],
            columnDefs: [
                { className: 'text-center', 'targets': [ 1 ] }
            ]
        });
    });
</script>
@endsection
