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
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Helpdesk Ticket #{{ $ticket->ticket_no }}</h2>
                        <div class="text-right">
                            <a href="/admin/ticket" class="btn btn-sm btn-secondary"><i class="fa fa-arrow-circle-left"></i> Back</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <tr>
                                        <th width="30%">Requester</th>
                                        <td width="5%">:</td>
                                        <td>{{ $ticket->name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Department</th>
                                        <td width="5%">:</td>
                                        <td>{{ $ticket->department_name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Helpdesk</th>
                                        <td width="5%">:</td>
                                        <td>{{ $ticket->helpdesk_name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Priority</th>
                                        <td width="5%">:</td>
                                        <td>
                                            @if ($ticket->priority == 1)
                                                <span class="badge badge-danger">High</span>
                                            @elseif ($ticket->priority == 2)
                                                <span class="badge badge-warning">Medium</span>
                                            @else
                                                <span class="badge badge-primary">Low</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Detail Problem</th>
                                        <td width="5%">:</td>
                                        <td>{{ $ticket->detail_of_problem }}</td>
                                    </tr>
                                    <tr>
                                        <th width="30%">Submitted At</th>
                                        <td width="5%">:</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($ticket->created_at)) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <button class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#ticketApproval">Approve
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ticketApproval" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ticket Approval</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="ticketApproval" method="POST" action="/admin/ticket-approval/{{ base64_encode($ticket->id) }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Detail Troubleshooting</label>
                <textarea name="detail_of_solving" cols="20" rows="3" class="form-control"
                placeholder="Please write a troubleshooting description..."></textarea>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-primary">Approve</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endsection
