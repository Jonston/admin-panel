@extends('layouts/admin')

@section('content')
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{!! route('admin.employees.update', $employee->id) !!}" method="post">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                    <div class="form-group @if($errors->has('first_name')) has-error @endif">
                        <label for="exampleInputEmail1" class="control-label">Employee first name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter first name"
                               value="{!! old('first_name') ? old('first_name') : $employee->first_name !!}">
                        @error('first_name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @if($errors->has('last_name')) has-error @endif">
                        <label for="exampleInputEmail1" class="control-label">Employee last name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter last name"
                               value="{!! old('last_name') ? old('last_name') : $employee->last_name !!}">
                        @error('last_name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label for="exampleInputEmail1" class="control-label">Employee email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                               value="{!! old('email') ? old('email') : $employee->email !!}">
                        @error('email')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @if($errors->has('phone')) has-error @endif">
                        <label for="exampleInputEmail1" class="control-label">Employee phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter phone"
                               value="{!! old('phone') ? old('phone') : $employee->phone !!}">
                        @error('phone')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    @if($companies)
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="company_id">
                                <option value="">--select company--</option>
                                @foreach($companies as $company)
                                    <option value="{!! $company->id !!}" @if($employee->company && $company->id === $employee->company->id) selected @endif>{!! $company->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
@endsection

@section('title') Edit employee @endsection