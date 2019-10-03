@extends('layouts/admin')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Hover Data Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a href="{!! route('admin.companies.create') !!}" class="btn btn-primary btn-flat">Add new</a>
            <table id="companies" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>{!! $company->logo !!}</td>
                        <td>{!! $company->name !!}</td>
                        <td>{!! $company->email !!}</td>
                        <td>{!! $company->website !!}</td>
                        <td class="text-center">
                            <form action="{!! route('admin.companies.destroy', $company->id) !!}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-sm btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Entries not found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{ $companies->links() }}
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