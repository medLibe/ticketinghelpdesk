<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Helpdesk Ticketing System | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap');

        body {
            font-family: 'Crimson Text', 'serif';
        }

        .form-control:focus {
            border-color: #1a1b1e;
            box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(222, 180, 173, 0.5);
        }

        label.error{
            color: #DC3545;
        }
    </style>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><strong>HELPDESK TICKET</strong></a>
        </div>
    </nav>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/helpdeskticket-submit" method="POST" id="createForm">
                    @csrf
                    <div class="mb-3">Already have a ticket? You could check
                        <a href="#" data-bs-toggle="modal" data-bs-target="#ticketCheck" style="color: rgba(225, 97, 97, 0.853);">here</a>.</div>
                    <div class="form-group mb-3">
                        <label class="form-label text-secondary">Name <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" autofocus>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label text-secondary">Department <b class="text-danger">*</b></label>
                        <select name="department_id" class="form-control" id="department_id">
                                <option value="">-- Select Department --</option>
                            @foreach ($department as $d)
                                <option value="{{ $d->id }}">{{ $d->department_name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label text-secondary">Helpdesk <b class="text-danger">*</b></label>
                        <select name="helpdesk_id" class="form-control" id="helpdesk_id">
                                <option value="">-- Select Helpdesk --</option>
                            @foreach ($helpdesk as $h)
                                <option value="{{ $h->id }}">{{ $h->helpdesk_name }}</option>
                            @endforeach
                        </select>
                        @error('helpdesk_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label text-secondary">Priority <b class="text-danger">*</b></label>
                        <select name="priority" class="form-control" id="priority">
                            <option value="">-- Select Priority --</option>
                            <option value="1">High</option>
                            <option value="2">Medium</option>
                            <option value="3">Low</option>
                        </select>
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label text-secondary">Information</label>
                        <textarea name="detail_of_problem" cols="10" rows="4" class="form-control"
                        placeholder="Please explain more detail about your device's problem"></textarea>
                    </div>
                    <div class="form-group text-end">
                        <button class="btn text-white" style="background-color: teal;">Submit Ticket</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ticketCheck" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Check Your Ticket Status</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="checkForm">
                <div class="form-group mb-3">
                    <label class="form-label">Your Ticket ID <b class="text-danger">*</b></label>
                    <input type="text" class="form-control" name="ticket_id" id="ticket_id" placeholder="Your Ticket ID">
                </div>
                <div class="text-wrapper" style="display: none;">
                    <div class="form-group mb-3" id="ticketStatus">
                        <label class="form-label">Your Ticket Status Is:</label>
                        <input type="text" class="form-control" id="ticket_status" readonly>
                    </div>
                    <div class="form-group mb-3" id="ticketInformation">
                        <label class="form-label">Description of Troubleshooting:</label>
                        <textarea id="ticket_information" class="form-control" cols="20" rows="3" readonly></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnSubmit" class="btn btn-sm text-white" style="background-color: teal;">Check</button>
            </div>
            </form>
          </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    {{-- Validation --}}
    <script>
        $(document).ready(() => {
            $('#createForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    department_id: {
                        required: true,
                    },
                    helpdesk_id: {
                        required: true,
                    },
                    priority:{
                        required: true,
                    }

                },
                message:{
                    name: {
                        required: 'This field is required.',
                    },
                    department_id: {
                        required: 'This field is required.',
                    },
                    helpdesk_id: {
                        required: 'This field is required.',
                    },
                    priority: {
                        required: 'This field is required.',
                    },
                }
            });
        });
    </script>

    <script>
        $(document).ready(() => {
           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
           });

           $('#btnSubmit').click((e) => {
                e.preventDefault();

                ticket_no = $('#ticket_id').val();
                url = '{{ route("helpdeskticket-check") }}';

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        ticket_no: ticket_no
                    },
                    success: (response) => {
                        $('.text-wrapper').show();
                        $('#ticket_status').val(response.data_status);
                        $('#ticket_information').val(response.data_information);
                    }
                })
           });
        });
    </script>
</body>

</html>
