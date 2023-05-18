<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Helpdesk Ticketing System | {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Crimson+Text&display=swap');

        body {
            font-family: 'Crimson Text', 'serif';
        }

        table{
            margin-left: 27px;
        }

        .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #7ac142;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #fff;
        stroke-miterlimit: 10;
        margin: 4% auto;
        box-shadow: inset 0px 0px 0px #7ac142;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
        }

        .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
        }

        @keyframes stroke {
        100% {
            stroke-dashoffset: 0;
        }
        }
        @keyframes scale {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
        }
        @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 30px #7ac142;
        }
        }
    </style>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><strong>HELPDESK TICKET</strong></a>
        </div>
    </nav>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mb-3">
                <div class="card-header p-1 bg-success"></div>
                <div class="card">
                    <div class="card-body">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                        <h3 class="text-success text-center"><strong>SUCCESS</strong></h3>
                        <div class="fs-5 text-center">Your request was submitted at {{ $created_at }}</div>
                        <div class="mt-3 mb-3 text-center">
                            Here are the details:
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-auto">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="40%">Ticket ID</th>
                                        <td>:</td>
                                        <td width="60%">{{ $ticket_no }} (Please noted this.)</td>
                                    </tr>
                                    <tr>
                                        <th width="40%">Requester:</th>
                                        <td>:</td>
                                        <td class="60%">{{ $name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="40%">From Department:</th>
                                        <td>:</td>
                                        <td class="60%">{{ $department_name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="40%">Helpdesk:</th>
                                        <td>:</td>
                                        <td class="60%">{{ $helpdesk_name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="40%">Priority:</th>
                                        <td>:</td>
                                        <td class="60%">{{ $priority }}</td>
                                    </tr>
                                    <tr>
                                        <th width="40%">Detail about helpdesk:</th>
                                        <td>:</td>
                                        <td class="60%">{{ $detail_of_problem }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5 text-end">
                <a href="/helpdeskticket" class="btn btn-secondary">Back to previous page</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</body>

</html>
