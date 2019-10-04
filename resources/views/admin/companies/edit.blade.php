@extends('layouts/admin')

@section('content')
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                @if($company->logo)
                <img class="profile-user-img img-responsive img-circle" src="{!! asset('/storage/' . $company->logo) !!}" alt="{!! $company->logo !!}">
                @endif
                <h3 class="profile-username text-center">{!! $company->name !!}</h3>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit company</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{!! route('admin.companies.update', $company->id) !!}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                    <div class="form-group @if($errors->has('name')) has-error @endif">
                        <label for="exampleInputEmail1" class="control-label">Company name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter company name"
                               value="{!! old('name') ? old('name') : $company->name !!}">
                        @error('name')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @if($errors->has('email')) has-error @endif">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                               value="{!!  old('email') ? old('email') : $company->email !!}">
                        @error('email')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @if($errors->has('website')) has-error @endif">
                        <label for="exampleInputEmail1">Website</label>
                        <input type="text" class="form-control" name="website" id="website" placeholder="Enter website"
                               value="{!! old('website') ? old('website') : $company->website !!}">
                        @error('website')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group @if($errors->has('logo')) has-error @endif">
                        <label for="logo">File input</label>
                        <input type="file" id="logo" name="logo">
                        @error('logo')
                        <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
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

@section('title') Edit company @endsection