<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use Illuminate\Http\Request;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class HelpdeskController extends Controller
{
    public function index(Request $request)
    {
        $getHelpdesk = Helpdesk::where('is_active', 1)->get();

        return view('admin.helpdesk', [
            'title'     => 'Helpdesk',
            'helpdesk'  => $getHelpdesk,
        ]);
    }

    public function getHelpdesk(Request $request)
    {
        if($request->ajax()){
            $data = Helpdesk::where('is_active', 1)->get();

            return DataTables::of($data)
                               ->addColumn('action', function($row){
                                $edit = '<button class="btn btn-sm btn-outline-primary"
                                data-toggle="modal" data-target="#editHelpdesk'. $row['id'] .'">
                                <i class="fa fa-pencil-square"></i></button>';

                                $delete = '<button class="btn btn-sm btn-outline-danger"
                                data-toggle="modal" data-target="#deleteHelpdesk'. $row['id'] .'">
                                <i class="fa fa-trash"></i></button>';
                                return $edit . $delete;
                               })
                               ->rawColumns(['action'])
                               ->make(true);
        }
    }

    public function helpdeskStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'helpdesk_name' => 'required',
        ],
        [
            'helpdesk_name.required' => 'This field is required.',
        ]);

        if($validator->fails()){
            Alert::error('Oops..', 'Something went wrong with your input. Please try again.');
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $insertHelpdesk = Helpdesk::create([
            'helpdesk_name'   => $request->helpdesk_name,
            'created_by'      => $request->session()->get('username'),
            'updated_by'      => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Inserted Helpdesk',
            'activity_behavior' => 'create',
            'activity_path'     => '/admin/helpdesk',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', 'New helpdesk was successfully added.');
        return redirect()->back();
    }

    public function helpdeskUpdate(Request $request)
    {
        $updateHelpdesk = Helpdesk::where('id', $request->helpdesk_id)->update([
            'helpdesk_name' => $request->helpdesk_name,
            'updated_by'    => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Updated Helpdesk',
            'activity_behavior' => 'update',
            'activity_path'     => '/admin/helpdesk',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', $request->helpdesk_name . ' was successfully updated.');
        return redirect()->back();
    }

    public function helpdeskDelete(Request $request)
    {
        $deleteHelpdesk = Helpdesk::where('id', $request->helpdesk_id)->update([
            'is_active'      => 0,
            'updated_by'    => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Deleted Helpdesk',
            'activity_behavior' => 'delete',
            'activity_path'     => '/admin/helpdesk',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', $request->helpdesk_name . ' was successfully deleted.');
        return redirect()->back();
    }
}
