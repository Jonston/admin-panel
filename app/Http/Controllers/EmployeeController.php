<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')->simplePaginate(10);

        return view('admin/employees/list', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('admin/employees/create', [
            'companies' => $companies
        ]);
    }

    /**
     * @param StoreEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->fill($request->only('first_name', 'last_name', 'email', 'phone'));

        $company = Company::find($request->post('company_id'));
        $employee->company()->associate($company);

        $employee->save();

        return redirect(route('admin.employees.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::all();

        return view('admin/employees/edit', [
            'employee'  => $employee,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findORFail($id);
        $employee->fill($request->only('first_name', 'last_name', 'email', 'phone'));

        $company = Company::find($request->post('company_id'));
        $employee->company()->associate($company);

        $employee->save();

        return redirect(route('admin.employees.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);

        return redirect(route('admin.employees.index'));
    }
}
