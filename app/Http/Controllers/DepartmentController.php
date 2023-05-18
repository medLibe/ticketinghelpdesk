<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $getDepartment = Department::where('is_active', 1)->get();

        return view('admin.department', [
            'title'         => 'Department',
            'department'    => $getDepartment,
        ]);
    }

    public function getDepartment(Request $request)
    {
        if($request->ajax()){
            $data = Department::where('is_active', 1)->get();

            return DataTables::of($data)
                               ->addColumn('action', function($row){
                                $edit = '<button class="btn btn-sm btn-outline-primary"
                                data-toggle="modal" data-target="#editDepartment'. $row['id'] .'">
                                <i class="fa fa-pencil-square"></i></button>';

                                $delete = '<button class="btn btn-sm btn-outline-danger"
                                data-toggle="modal" data-target="#deleteDepartment'. $row['id'] .'">
                                <i class="fa fa-trash"></i></button>';
                                return $edit . $delete;
                               })
                               ->rawColumns(['action'])
                               ->make(true);
        }
    }

    public function departmentStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required',
            'department_head' => 'required',
            'department_place'=> 'required',
        ],
        [
            'department_name.required' => 'This field is required.',
            'department_head.required' => 'This field is required.',
            'department_place.required'=> 'This field is required.',
        ]);

        if($validator->fails()){
            Alert::error('Oops..', 'Something went wrong with your input. Please try again.');
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $insertDepartment = Department::create([
            'department_name'   => $request->department_name,
            'department_head'   => $request->department_head,
            'department_place'  => $request->department_place,
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Inserted Department',
            'activity_behavior' => 'create',
            'activity_path'     => '/admin/department',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', 'New department was successfully added.');
        return redirect()->back();
    }

    public function departmentUpdate(Request $request)
    {
        $updateDepartment = Department::where('id', $request->department_id)->update([
            'department_name'   => $request->department_name,
            'department_head'   => $request->department_head,
            'department_place'  => $request->department_place,
            'updated_by'        => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Updated Department',
            'activity_behavior' => 'update',
            'activity_path'     => '/admin/department',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', $request->department_name . ' was successfully updated.');
        return redirect()->back();
    }

    public function departmentDelete(Request $request)
    {
        $deleteDepartment = Department::where('id', $request->department_id)->update([
            'is_active'      => 0,
            'updated_by'    => $request->session()->get('username'),
        ]);

        $insertLog = LogActivity::create([
            'user_id'           => base64_decode($request->session()->get('user_id')),
            'activity_name'     => 'Deleted Department',
            'activity_behavior' => 'delete',
            'activity_path'     => '/admin/department',
            'created_by'        => $request->session()->get('username'),
            'updated_by'        => $request->session()->get('username'),
        ]);

        Alert::success('Success', $request->department_name . ' was successfully deleted.');
        return redirect()->back();
    }
}
