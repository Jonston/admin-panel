@extends('layouts/admin')

@section('content')
    @if(session('success'))
        <div class="callout callout-success">
            <h4 style="margin: 0">{!! session('success') !!}</h4>
        </div>
    @endif
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Employees</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a href="{!! route('admin.employees.create') !!}" class="btn btn-success btn-flat">Add new</a>
            <table id="companies" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th colspan="2" width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td>{!! $employee->id !!}</td>
                        <td>{!! $employee->first_name !!}</td>
                        <td>{!! $employee->last_name !!}</td>
                        <td>{!! $employee->email !!}</td>
                        <td>{!! $employee->phone !!}</td>
                        <td class="text-center">
                            <a href="{!! route('admin.employees.edit', $employee->id) !!}" class="d-inline-block btn btn-sm btn-primary">Edit</a>
                        </td>
                        <td class="text-center">
                            <form action="{!! route('admin.employees.destroy', $employee->id) !!}" method="post" class="d-inline-block">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-sm btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Entries not found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $employees->links() }}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection

@section('script')
    <script>
        $(function () {
            $('#companies').DataTable({
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : false,
                'autoWidth'   : false
            });
        });
    </script>
@endsection