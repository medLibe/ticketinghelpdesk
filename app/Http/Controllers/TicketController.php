<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Department;
use App\Models\Helpdesk;
use App\Models\LogActivity;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends Controller
{
    // These methods is for Administrator
    public function index(Request $request)
    {
        return view('admin.ticket', [
            'title'   => 'Active Tickets',
        ]);
    }

    public function getTicket(Request $request)
    {
        if($request->ajax()){
            $ticket = new Ticket;
            $data = $ticket->getAllTickets();

            return DataTables::of($data)
                               ->addColumn('action', function($row){
                                $dotask = '<a href="/admin/ticket-view/'. base64_encode($row->id) .'"
                                class="btn btn-sm btn-outline-success">
                                <i class="fa fa-pencil-square"></i></a>';
                                return $dotask;
                               })
                               ->rawColumns(['action'])
                               ->make(true);
        }
    }

    public function viewTicket(Request $request, $id)
    {
        $ticket_id = base64_decode($id);
        $ticket = new Ticket;
        $getTicket = $ticket->getTicketDetails($ticket_id);

        return view('admin.ticket_view', [
            'title'     => 'View Ticket',
            'ticket'    => $getTicket,
        ]);
    }

    public function approvalTicket(Request $request, $id)
    {
        $ticket_id = base64_decode($id);


        $getTicket = Ticket::select('ticket_no')->where('id', $ticket_id)->first();

        $approve = Ticket::where('id', $ticket_id)->update([
            'detail_of_solving' => $request->detail_of_solving,
            'is_active'         => 2,
            'updated_by'        => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Approve Ticket #'. $getTicket->ticket_no,
            'activity_behavior' => 'update',
            'activity_path'     => '/admin/ticket-view',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', "Ticket # " . $getTicket->ticket_no . " was successfully approved.");
        return redirect('/admin/ticket');
    }


    // These methods for Requester
    public function createTicket(Request $request)
    {
        $getDepartment = Department::where('is_active', 1)->get();
        $getHelpdesk = Helpdesk::where('is_active', 1)->get();

        return view('create_ticket', [
            'title'     => 'Create Helpdesk Ticket',
            'department'=> $getDepartment,
            'helpdesk'  => $getHelpdesk,
        ]);
    }

    public function submitTicket(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'department_id' => 'required',
            'helpdesk_id'   => 'required',
            'priority'      => 'required',
        ],
        [
            'name.required'          => 'This field is required.',
            'department_id.required' => 'This field is required.',
            'helpdesk_id.required'   => 'This field is required.',
            'priority.required'      => 'This field is required.',
        ]);

        if($validator->fails()){
            Alert::error('Oops..', 'Something went wrong with your input. Please try again.');
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $getDepartment = Department::select('department_name')->where('id', $request->department_id)->first();
        $getHelpdesk = Helpdesk::select('helpdesk_name')->where('id', $request->helpdesk_id)->first();
        $ticket_no = $this->generateRandomString(5) . date('dmy');
        $getTicketNo = Ticket::where('ticket_no', $ticket_no)->first();


        if($getTicketNo !== null){
            $ticket_no = $this->generateRandomString(5) . date('dmy');
        }

        $insertTicket = Ticket::create([
            'ticket_no'         => $ticket_no,
            'name'              => $request->name,
            'department_id'     => $request->department_id,
            'helpdesk_id'       => $request->helpdesk_id,
            'priority'          => $request->priority,
            'detail_of_problem' => $request->detail_of_problem,
            'created_by'        => $request->name,
            'updated_by'        => $request->name,
        ]);

        $data = [
            'ticket_no'         => $ticket_no,
            'name'              => $request->name,
            'department_name'   => $getDepartment->department_name,
            'helpdesk_name'     => $getHelpdesk->helpdesk_name,
            'priority'          => $request->priority,
            'detail_of_problem' => $request->detail_of_problem,
        ];

        Mail::to('p.gerry03@gmail.com')->send(new TicketMail($data));

        Alert::success('Success', 'Your request was submitted. Please wait Technical Support to handle your request.');
        return redirect()->to('/helpdeskticket-submitted/'.base64_encode($insertTicket->id));
    }

    public function submittedTicket(Request $request, $id)
    {
        $tickets = new Ticket;
        $getTicket = $tickets->getTicketDetails(base64_decode($id));

        if($getTicket->priority == 1){
            $priority = 'High';
        }elseif($getTicket->priority == 2){
            $priority = 'Medium';
        }else{
            $priority = 'Low';
        }

        return view('ticket_submitted', [
            'title'             => 'Ticket #'. $getTicket->ticket_no,
            'ticket_no'         => $getTicket->ticket_no,
            'name'              => $getTicket->name,
            'helpdesk_name'     => $getTicket->helpdesk_name,
            'department_name'   => $getTicket->department_name,
            'detail_of_problem' => $getTicket->detail_of_problem,
            'created_at'        => $getTicket->created_at,
            'priority'          => $priority,
        ]);
    }

    public function checkTicket(Request $request)
    {
        $getTicket = Ticket::select('is_active as status', 'detail_of_solving')->where('ticket_no', $request->ticket_no)->first();

        if($getTicket->status == 1){
            $status = 'Pending';
        }elseif($getTicket->status == 2){
            $status = 'Done';
        }

        return response()->json([
            'status'            => 200,
            'data_status'       => $status,
            'data_information'  => $getTicket->detail_of_solving,
        ]);
    }

    function generateRandomString($lengthOfString)
    {
        $pickString = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($pickString), 0, $lengthOfString);
    }

    public function reportTicket()
    {
        $getDepartment = Department::where('is_active', 1)->get();
        return view('admin.ticket_report', [
            'title'     => 'Ticket Reports',
            'department'=> $getDepartment,
        ]);
    }

    public function getReportTicket(Request $request, $filter)
    {
        if($request->ajax()){
            $ticket = new Ticket;

            if($filter == 1){
                $arr = [
                    'month'         => date('Y-m'),
                    'department'    => 0,
                    'status'        => 0,
                ];
            }else{
                $arr = [
                    'month'         => $request->month,
                    'department'    => $request->department_id,
                    'status'        => $request->status,
                ];
            }
            $data = $ticket->getFilterTickets($arr);

            return DataTables::of($data)
                               ->addColumn('submitted_date', function($row){
                                    $submitted_date = '<span>' . date('d-m-Y', strtotime($row->created_at)) . '</span>';
                                    return $submitted_date;
                               })
                               ->addColumn('status', function($row){
                                    if($row->is_active == 1){
                                        $status = '<span class="badge badge-warning">Pending</span>';
                                    }else{
                                        $status = '<span class="badge badge-primary">Done</span>';
                                    }
                                    return $status;
                               })
                               ->rawColumns(['submitted_date', 'status'])
                               ->make(true);
        }
    }
}
