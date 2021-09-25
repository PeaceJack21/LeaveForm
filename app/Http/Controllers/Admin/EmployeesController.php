<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Position;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Requests\Employee\MassDestroyEmployeeRequest;

class EmployeesController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('position_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::with('position')->get();

        return view('admin.employees.index', compact('employees'));
    }

    
    public function create()
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::pluck('title', 'id');
        $users = User::pluck('name', 'id');

        return view('admin.employees.create', compact('positions', 'users'));
    }

    
    public function store(StoreEmployeeRequest $request)
    {
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Employee::create($request->all());

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee has been create successfully');
    }

    
    public function show(Employee $employee)
    {
        //
    }

    
    public function edit(Employee $employee)
    {
        //
    }

    
    public function update(Request $request, Employee $employee)
    {
        //
    }

    
    public function destroy(Employee $employee)
    {
        //
    }
}
