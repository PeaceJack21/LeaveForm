@extends('layouts.admin')
@section('content')
<div class="form-group">
    <a class="btn btn-secondary" href="{{ route("admin.employees.index") }}">
        {{ trans('global.back') }}
    </a>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.employee.title_singular') }}
    </div>
    <div class="card-body">
        <form action="{{ route("admin.employees.store") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="empId" class="required">{{ trans('cruds.employee.fields.empId')}}</label>
                <input class="form-control @error('empId') form-control-danger @enderror" type="text" name="empId" id="empId" value="{{ old('empId', '') }}" required>
                @error('empId')
                <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="first_name" class="required">{{ trans('cruds.employee.fields.first_name')}}</label>
                <input class="form-control @error('first_name') form-control-danger @enderror" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @error('first_name')
                <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name" class="required">{{ trans('cruds.employee.fields.last_name')}}</label>
                <input class="form-control @error('last_name') form-control-danger @enderror" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @error('last_name')
                <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="gender" class="required">{{ trans('cruds.employee.fields.gender')}}</label>
                <input class="form-control @error('gender') form-control-danger @enderror" type="text" name="gender" id="gender" value="{{ old('gender', '') }}" required>
                @error('gender')
                <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="eligible" class="required">{{ trans('cruds.employee.fields.eligible')}}</label>
                <input class="form-control @error('eligible') form-control-danger @enderror" type="text" name="eligible" id="eligible" value="{{ old('eligible', '') }}" required>
                @error('eligible')
                <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="hire_date" class="required">{{ trans('cruds.employee.fields.hire_date')}}</label>
                <input class="form-control @error('hire_date') form-control-danger @enderror" type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', '') }}" required>
                @error('hire_date')
                <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="position_id" class="required">{{ trans('cruds.employee.fields.position')}}</label>
                <select class="js-example-basic-single w-100 select2-hidden-accessible @error('position_id') form-control-danger @enderror" name="position_id" data-width="100%" aria-hidden="true">
                    <option value=""​>--- Choose Position ---</option>
                    @foreach ($positions as $id => $position)
                        <option value="{{ $id }}"​>{{ $position }}</option>
                    @endforeach
                </select>
                @error('position_id')
                    <label class="error mt-2 text-danger">{{ $message }}</label>
                @enderror
            </div>

            <div class="form-group">
                <label for="user_id" class="required">{{ trans('cruds.employee.fields.user')}}</label>
                <select class="js-example-basic-single w-100 select2-hidden-accessible @error('user_id') form-control-danger @enderror" name="user_id" data-width="100%" aria-hidden="true">
                    <option value=""​>--- Choose User ---</option>
                    @foreach ($users as $id => $user)
                        <option value="{{ $id }}"​>{{ $user }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <label class="error mt-2 text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
