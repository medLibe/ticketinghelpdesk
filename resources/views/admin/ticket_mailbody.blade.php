<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Helpdesk Ticketing System | Ticket #{{ $data['ticket_no'] }}</title>
</head>
<body>
    <div>
        A new ticket with no. #{{ $data['ticket_no'] }} was created. Here details:
        <ul>
            <li>Requester: {{ $data['name'] }}</li>
            <li>From Department: {{ $data['department_name'] }}</li>
            <li>Helpdesk: {{ $data['helpdesk_name'] }}</li>
            <li>Priority:
            @if ($data['priority'] == 1)
                {{ 'High' }}
            @elseif($data['priority'] == 2)
                {{ 'Medium' }}
            @else
                {{ 'Low' }}
            @endif
            </li>
            <li>Detail about helpdesk: {{ $data['detail_of_problem'] }}</li>
        </ul>
    </div>
</body>
</html>
