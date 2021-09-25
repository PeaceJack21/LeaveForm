@extends('layouts.admin')
@section('content')
<div class="form-group">
    <a class="btn btn-secondary" href="{{ route("admin.positions.index") }}">
        {{ trans('global.back') }}
    </a>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.position.title_singular') }}
    </div>
    <div class="card-body">
        <form action="{{ route("admin.positions.store") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title" class="required">{{ trans('cruds.position.fields.title')}}</label>
                <input class="form-control @error('title') form-control-danger @enderror type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @error('title')
                <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="department_id" class="required">{{ trans('cruds.position.fields.department')}}</label>
                <select class="js-example-basic-single w-100 select2-hidden-accessible @error('department_id') form-control-danger @enderror" name="department_id" data-width="100%" aria-hidden="true">
                    <option value=""​>--- Choose Department ---</option>
                    @foreach ($departments as $id => $department)
                        <option value="{{ $id }}"​>{{ $department }}</option>
                    @endforeach
                </select>
                @error('department_id')
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
