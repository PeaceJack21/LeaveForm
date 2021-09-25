<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Position;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Position\StorePositionRequest;
use App\Http\Requests\Position\UpdatePositionRequest;
use App\Http\Requests\Position\MassDestroyPositionRequest;

class PositionsController extends Controller
{
    
    public function index()
    {
        abort_if(Gate::denies('position_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $positions = Position::with('department')->get();

        return view('admin.positions.index', compact('positions'));
    }

    public function create()
    {
        abort_if(Gate::denies('position_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('title', 'id');

        return view('admin.positions.create', compact('departments'));
    }

    public function store(StorePositionRequest $request)
    {
        abort_if(Gate::denies('position_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Position::create($request->all());

        return redirect()->route('admin.positions.index')
            ->with('success', 'Position has been create successfully');
    }

    public function show(Position $position)
    {
        abort_if(Gate::denies('position_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.positions.show', compact('position'));
    }

    public function edit(Position $position)
    {
        abort_if(Gate::denies('position_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $departments = Department::pluck('title', 'id');

        return view('admin.positions.edit', compact('position', 'departments'));
    }

    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->all());

        return redirect()->route('admin.positions.index');
    }

    public function destroy(Position $position)
    {
        abort_if(Gate::denies('position_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $position->delete();

        return redirect()->route('admin.positions.index');

    }

    public function MassDestroy(MassDestroyPositionRequest $position)
    {
        Position::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
