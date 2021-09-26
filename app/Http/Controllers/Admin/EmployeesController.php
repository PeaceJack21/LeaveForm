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

        // dd($request->all());

        Employee::create($request->all());

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee has been create successfully');
    }

    
    public function show(Employee $employee)
    {
        abort_if(Gate::denies('employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::pluck('title', 'id');
        $users = User::pluck('name', 'id');

        return view('admin.employees.show', compact('employee', 'positions', 'users'));
    }

    
    public function edit(Employee $employee)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $positions = Position::pluck('title', 'id');
        $users = User::pluck('name', 'id');

        return view('admin.employees.edit', compact('employee', 'positions', 'users'));
    }

    
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect()->route('admin.employees.index');
    }

    
    public function destroy(Employee $employee)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee->delete();

        return redirect()->route('admin.employees.index');
    }

    public function MassDestroy(MassDestroyEmployeeRequest $employee)
    {
        Employee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
