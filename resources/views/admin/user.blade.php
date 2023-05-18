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
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <button class="btn text-white" style="background-color:teal; font-size:10pt;" data-toggle="modal" data-target="#createUser">
                                    <i class="fa fa-plus"></i> Team
                                </button>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-fixed-header"
                                        class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Role</th>
                                                <th class="text-center">Action</th>
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

    {{-- Modal --}}
    <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Team</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group mb-3">
                        <label class="form-label">Username <span class="required">*</span></label>
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus placeholder="Username">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Password <span class="required">*</span></label>
                        <input type="text" class="form-control" name="username" value="{{ old('password') }}" placeholder="Password">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Role <span class="required">*</span></label>
                        <select name="role_id" id="" class="form-control">
                            <option value="">-- Select Role --</option>
                            @foreach ($role as $r)
                                <option value="{{ $r->id }}">{{ $r->role_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-sm text-white" style="background-color:teal;">Save</button>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
