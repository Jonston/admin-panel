<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Mail\CreateCompany;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = DB::table('companies')->simplePaginate(10);

        return view('admin/companies/list', [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/companies/create');
    }

    /**
     * @param StoreCompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = new Company();
        $company->fill($request->only('name', 'email', 'website'));

        $file = $this->storeImage();

        if($file)
            $company->logo = $file;

        $company->save();

        Mail::to('jonston@list.ru')->send(new CreateCompany($company));

        return redirect(route('admin.companies.index'))->with('success', 'Company successfully created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return view('admin.companies.edit', [
            'company' => $company
        ]);
    }

    /**
     * @param UpdateCompanyRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::find($id);
        $company->fill($request->only('name', 'email', 'website'));

        $file = $this->storeImage();

        if($file){
            Storage::disk('public')->delete($company->logo);

            $company->logo = $file;
        }

        $company->save();

        return redirect(route('admin.companies.index'))->with('success', 'Company successfully updated!');
    }

    /**
     * @return bool|string
     */
    public function storeImage()
    {
        if (request()->has('logo')) {

            $file = $this->resizeImage(
                $this->uploadFile(request()->file('logo'))
            );

            return $file;
        }

        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Company::destroy($id);

        return redirect(route('admin.companies.index'));
    }
}
