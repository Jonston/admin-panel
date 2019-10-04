@extends('layouts/admin')

@section('content')
    @if(session('success'))
        <div class="callout callout-success">
            <h4 style="margin: 0">{!! session('success') !!}</h4>
        </div>
    @endif
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Companies list</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <a href="{!! route('admin.companies.create') !!}" class="btn btn-success btn-flat">Add new</a>
            <table id="companies" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th colspan="2" width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>{!! $company->id !!}</td>
                        <td>
                            @if($company->logo)
                            <img src="{!! asset('/storage/' . $company->logo ) !!}">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{!! $company->name !!}</td>
                        <td>{!! $company->email !!}</td>
                        <td>{!! $company->website !!}</td>
                        <td class="text-center">
                            <a href="{!! route('admin.companies.edit', $company->id) !!}" class="d-inline-block btn btn-sm btn-primary">Edit</a>
                        </td>
                        <td class="text-center">
                            <form action="{!! route('admin.companies.destroy', $company->id) !!}" method="post" class="d-inline-block">
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