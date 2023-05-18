<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;


class UserRoleController extends Controller
{

    // User Function
    public function index(Request $request)
    {
        $getRole = Role::where('is_active', 1)->get();

        return view('admin.user', [
            'title'     => 'User',
            'role'      => $getRole,
        ]);
    }

    // Role Funciton
    public function role(Request $request)
    {
        $getRole = Role::where('is_active', 1)->get();

        return view('admin.role', [
            'title'     => 'Role',
            'role'      => $getRole,
        ]);
    }

    public function getRole(Request $request)
    {
        if($request->ajax()){
            $data = Role::where('is_active', 1)->get();

            return DataTables::of($data)
                               ->addColumn('action', function($row){
                                $edit = '<button class="btn btn-sm btn-outline-primary"
                                data-toggle="modal" data-target="#editRole'. $row['id'] .'">
                                <i class="fa fa-pencil-square"></i></button>';
                                $delete = '<button class="btn btn-sm btn-outline-danger"
                                data-toggle="modal" data-target="#deleteRole'. $row['id'] .'">
                                <i class="fa fa-trash"></i></button>';
                                return $edit . $delete;
                               })
                               ->rawColumns(['action'])
                               ->make(true);
        }
    }

    public function roleStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required',
        ],
        [
            'role_name.required' => 'This field is required.',
        ]);

        if($validator->fails()){
            Alert::error('Oops..', 'Something went wrong with your input. Please try again.');
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $insertRole = Role::create([
            'role_name'   => $request->role_name,
            'created_by'  => $request->session()->get('username'),
            'updated_by'  => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Inserted Role',
            'activity_behavior' => 'create',
            'activity_path'     => '/admin/role',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', 'New role was successfully added.');
        return redirect()->back();
    }

    public function roleUpdate(Request $request)
    {
        $updateRole = Role::where('id', $request->role_id)->update([
            'role_name'     => $request->role_name,
            'updated_by'    => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Updated Department',
            'activity_behavior' => 'update',
            'activity_path'     => '/admin/role',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', $request->role_name . ' role was successfully updated.');
        return redirect()->back();
    }

    public function roleDelete(Request $request)
    {
        $deleteRole = Role::where('id', $request->role_id)->update([
            'is_active'     => 0,
            'updated_by'    => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Deleted Role',
            'activity_behavior' => 'delete',
            'activity_path'     => '/admin/role',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', $request->role_name . ' role was successfully deleted.');
        return redirect()->back();
    }
}
