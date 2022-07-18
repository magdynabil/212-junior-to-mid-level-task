<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $companies = Company::all()->toArray();

            return DataTables::of($companies)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return View::make("dashboard.company.actions", [
                        "row" => $row
                    ])->render();
                })
                ->rawColumns(['actions'])
                ->make(true);

        }

        return view('dashboard.company.index');

    }


    public function create()
    {

        return view('dashboard.company.create');

    }


    public function store(StoreCompanyRequest $request)
    {
        $fileName = Helpers::uploadImage('logo', $request->logo);

        Company::create([
            'name'    => $request->name,
            'address' => $request->address,
            'logo'    => $fileName,
        ]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('employee.index');
    }


    public function show(Company $company)
    {
        //
    }


    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view('dashboard.company.edit', [
            'company' => $company
        ]);

    }


    public function update(UpdateCompanyRequest $request, $id)
    {

        $company = Company::findOrFail($id);

        $fileName = $company->logo;
        if ($request->has('logo')) {
            $fileName = Helpers::uploadImage('logo', $request->logo);
            Helpers::deleteOldImage('logo', $company->logo);
        }


        Company::where('id', $id)->update([
            'name'    => $request->name,
            'address' => $request->address,
            'logo'    => $fileName
        ]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('company.index');

    }


    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        Helpers::deleteOldImage('logo', $company->logo);

        $company->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('company.index');
    }
}
