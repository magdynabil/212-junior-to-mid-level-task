<?php

namespace App\Http\Controllers;

use App\Events\AfterEmployeeIsAdded;
use App\Helpers\Helpers;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{


    public function index(Request $request)
    {

        $allCompanies = Company::all();

        if ($request->ajax()) {

            $employees = Employee::with('company');

            if (!empty($request->get("company_id"))) {
                $employees = $employees->where("company_id", $request->get("company_id"));
            }
            $employees = $employees->get()->toArray();

            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('company', function ($row) {
                    return $row["company"]["name"]??"";
                })
                ->addColumn('actions', function ($row) {
                    return View::make("dashboard.employees.actions", [
                        "row" => $row
                    ])->render();
                })
                ->rawColumns(['company', 'actions'])
                ->make(true);

        }

        return view('dashboard.employees.index', [
            "all_companies" => $allCompanies,
        ]);
    }


    public function create()
    {
        $allCompanies = Company::all();

        return view('dashboard.employees.create', [
            "all_companies" => $allCompanies,
        ]);

    }


    public function store(StoreEmployeeRequest $request)
    {

        $fileName = Helpers::uploadImage('image', $request->image);

        $empObj = Employee::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'company_id' => $request->company_id,
            'image'      => $fileName

        ]);

        event(new AfterEmployeeIsAdded($empObj));

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('employee.index');
    }


    public function edit($id)
    {


        $employee     = Employee::findOrFail($id);
        $allCompanies = Company::all();


        return view('dashboard.employees.edit', [
            "employee"      => $employee,
            "all_companies" => $allCompanies,
        ]);


    }


    public function update(UpdateEmployeeRequest $request, $id)
    {

        $employee = Employee::findOrFail($id);

        $fileName = $employee->image;
        if ($request->has('image')) {
            $fileName = Helpers::uploadImage('image', $request->image);
            Helpers::deleteOldImage('image', $employee->image);
        }


        Employee::where('id', $id)->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'company_id' => $request->company_id,
            'image'      => $fileName
        ]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('employee.index');

    }


    public function destroy($id)
    {

        $employee = Employee::find($id);
        if (!is_object($employee)) {
            session()->flash('success', __('site.deleted_successfully'));
            return redirect()->route('employee.index');
        }

        Helpers::deleteOldImage('image', $employee->image);

        $employee->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('employee.index');

    }
}
