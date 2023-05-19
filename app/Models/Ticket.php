<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_no',
        'name',
        'department_id',
        'helpdesk_id',
        'department_name',
        'helpdesk_name',
        'priority',
        'detail_of_problem',
        'detail_of_solving',
        'created_by',
        'updated_by',
        'is_active',
    ];

    public function getTicketDetails($id)
    {
        $data = DB::table('tickets')
                  ->select('tickets.*', 'helpdesks.helpdesk_name', 'departments.department_name')
                  ->join('departments', 'tickets.department_id', '=', 'departments.id')
                  ->join('helpdesks', 'tickets.helpdesk_id', '=', 'helpdesks.id')
                  ->where('tickets.id', $id)
                  ->first();

        return $data;
    }

    public function getAllTickets()
    {
        $data = DB::table('tickets')
                  ->join('departments', 'tickets.department_id', '=', 'departments.id')
                  ->join('helpdesks', 'tickets.helpdesk_id', '=', 'helpdesks.id')
                  ->select('tickets.*', 'helpdesks.helpdesk_name', 'departments.department_name',
                            DB::raw("(CASE tickets.priority WHEN 1 THEN 'High' WHEN 2 THEN 'Medium'  ELSE 'Low' END) AS priority"))
                  ->where('tickets.is_active', 1)
                  ->get();

        return $data;
    }

    public function getFilterTickets($arr)
    {
        $month = $arr['month'];
        if($arr['department'] == 0 && $arr['status'] == 0){
            $data = DB::table('tickets')
                    ->join('departments', 'tickets.department_id', '=', 'departments.id')
                    ->join('helpdesks', 'tickets.helpdesk_id', '=', 'helpdesks.id')
                    ->select('tickets.*', 'helpdesks.helpdesk_name', 'departments.department_name',
                        DB::raw("(CASE tickets.priority WHEN 1 THEN 'High' WHEN 2 THEN 'Medium'  ELSE 'Low' END) AS priority"))
                    ->whereRaw("DATE_FORMAT(tickets.created_at, '%Y-%m') = '$month'")
                    ->get();
        }elseif($arr['department'] == 0 && $arr['status'] != 0){
            $data = DB::table('tickets')
                    ->join('departments', 'tickets.department_id', '=', 'departments.id')
                    ->join('helpdesks', 'tickets.helpdesk_id', '=', 'helpdesks.id')
                    ->select('tickets.*', 'helpdesks.helpdesk_name', 'departments.department_name',
                        DB::raw("(CASE tickets.priority WHEN 1 THEN 'High' WHEN 2 THEN 'Medium'  ELSE 'Low' END) AS priority"))
                    ->whereRaw("DATE_FORMAT(tickets.created_at, '%Y-%m') = '$month'")
                    ->where('tickets.is_active', $arr['status'])
                    ->get();
        }elseif($arr['department'] != 0 && $arr['status'] == 0){
            $data = DB::table('tickets')
                    ->join('departments', 'tickets.department_id', '=', 'departments.id')
                    ->join('helpdesks', 'tickets.helpdesk_id', '=', 'helpdesks.id')
                    ->select('tickets.*', 'helpdesks.helpdesk_name', 'departments.department_name',
                        DB::raw("(CASE tickets.priority WHEN 1 THEN 'High' WHEN 2 THEN 'Medium'  ELSE 'Low' END) AS priority"))
                    ->whereRaw("DATE_FORMAT(tickets.created_at, '%Y-%m') = '$month'")
                    ->where('department_id', $arr['department'])
                    ->get();
        }else{
            $data = DB::table('tickets')
                    ->join('departments', 'tickets.department_id', '=', 'departments.id')
                    ->join('helpdesks', 'tickets.helpdesk_id', '=', 'helpdesks.id')
                    ->select('tickets.*', 'helpdesks.helpdesk_name', 'departments.department_name',
                        DB::raw("(CASE tickets.priority WHEN 1 THEN 'High' WHEN 2 THEN 'Medium'  ELSE 'Low' END) AS priority"))
                    ->whereRaw("DATE_FORMAT(tickets.created_at, '%Y-%m') = '$month'")
                    ->where('tickets.is_active', $arr['status'])
                    ->where('department_id', $arr['department'])
                    ->get();
        }

        return $data;
    }
}
