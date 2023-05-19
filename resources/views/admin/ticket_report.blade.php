@extends('admin.layout')

@section('content')
    <style>
        .btn-default {
            background-color: #bfbebe;
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
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
                            <button class="btn text-white" style="background-color:teal;" data-toggle="modal"
                                data-target="#filterReport">
                                <i class="fa fa-plus"></i> Filter Report
                            </button>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="ticketTable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Ticket ID</th>
                                                    <th>Submitted Date</th>
                                                    <th>Requester</th>
                                                    <th>Department</th>
                                                    <th>Helpdesk</th>
                                                    <th>Priority</th>
                                                    <th>Status</th>
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
        <div class="modal fade" id="filterReport" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Periode</label>
                            <input type="month" class="form-control" id="periode" value="{{ date('Y-m') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Department</label>
                            <select id="department_id" class="form-control">
                                <option value="0">All Department</option>
                                @foreach ($department as $de)
                                    <option value="{{ $de->id }}">{{ $de->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Status</label>
                            <select id="status" class="form-control">
                                <option value="0">All Status</option>
                                <option value="1">Pending</option>
                                <option value="2">Done</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-sm text-white"
                            id="filterButton"style="background-color:teal;">Filter</button>
                    </div>
                </div>
            </div>
        </div>
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
                ajax: "/admin/ticket-report-ajax/1",
                columns: [{
                        data: 'ticket_no',
                        name: 'ticket_no'
                    },
                    {
                        data: 'submitted_date',
                        name: 'submitted_date'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'helpdesk_name',
                        name: 'helpdesk_name'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                dom: 'Bfrtip'
            });
        });
    </script>

    <script>
        $('#filterButton').on('click', function() {
            let periode = $('#periode').val();
            let department_id = $('#department_id').val();
            let status = $('#status').val();

            var lastTable = $('#ticketTable').DataTable();
            lastTable.destroy();
            $('#ticketTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/admin/ticket-report-ajax/2',
                    type: 'GET',
                    data: {
                        month: periode,
                        department_id: department_id,
                        status: status,
                    },
                    dataType: 'JSON',
                },
                columns: [{
                        data: 'ticket_no',
                        name: 'ticket_no'
                    },
                    {
                        data: 'submitted_date',
                        name: 'submitted_date'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'department_name',
                        name: 'department_name'
                    },
                    {
                        data: 'helpdesk_name',
                        name: 'helpdesk_name'
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                ],
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ],
                dom: 'Bfrtip'
            });
        });
    </script>
@endsection
