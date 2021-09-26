@extends('layouts.admin')

@section('content')
@can('employee_edit')

@include('partials.flash-message')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employee.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employees.update", [$employee->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="empId">{{ trans('cruds.employee.fields.empId') }}</label>
                <input class="form-control @error('empId') form-control-danger @enderror" type="text" name="empId" id="empId" value="{{ old('empId', $employee->empId) }}" required>
                @error('empId')
                    <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.empId_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.employee.fields.first_name') }}</label>
                <input class="form-control @error('first_name') form-control-danger @enderror" type="text" name="first_name" id="first_name" value="{{ old('first_name', $employee->first_name) }}" required>
                @error('first_name')
                    <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.employee.fields.last_name') }}</label>
                <input class="form-control @error('last_name') form-control-danger @enderror" type="text" name="last_name" id="last_name" value="{{ old('last_name', $employee->last_name) }}" required>
                @error('last_name')
                    <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="gender">{{ trans('cruds.employee.fields.gender') }}</label>
                <input class="form-control @error('gender') form-control-danger @enderror" type="text" name="gender" id="gender" value="{{ old('gender', $employee->gender) }}" required>
                @error('gender')
                    <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="eligible">{{ trans('cruds.employee.fields.eligible') }}</label>
                <input class="form-control @error('eligible') form-control-danger @enderror" type="text" name="eligible" id="eligible" value="{{ old('eligible', $employee->eligible) }}" required>
                @error('eligible')
                    <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.eligible_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hire_date">{{ trans('cruds.employee.fields.hire_date') }}</label>
                <input class="form-control @error('hire_date') form-control-danger @enderror" type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" required>
                @error('hire_date')
                    <span class="error mt-2 text-danger">{{ $message }}</span>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.hire_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="position_id">{{ trans('cruds.position.fields.position') }}</label>
                <select class="form-control @error('position_id') form-control-danger @enderror" type="position_id" name="position_id" id="position_id" required>
                    <option value="">--- Choose Position ---</option>
                    @foreach ($positions as $id => $position)
                        <option value="{{ $id }}" {{ old('position_id', $employee->position_id) == $id ? 'selected' : '' }}>{{ $position }}</option>
                    @endforeach
                </select>
                @error('position')
                    <label class="error mt-2 text-danger">{{ $message }}</label>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.position_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.position.fields.user') }}</label>
                <select class="form-control @error('user_id') form-control-danger @enderror" type="user_id" name="user_id" id="user_id" required>
                    <option value="">--- Choose User ---</option>
                    @foreach ($users as $id => $user)
                        <option value="{{ $id }}" {{ old('user_id', $employee->user_id) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @error('user')
                    <label class="error mt-2 text-danger">{{ $message }}</label>
                @enderror
                <span class="help-block">{{ trans('cruds.employee.fields.user_helper') }}</span>
            </div>
            
            <div class="form-group">
                <button class="btn float-right btn-success"  type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endcan
@endsection

@section('scripts')
@parent
<script>
    $(function() {
      let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
      let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
      let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
      let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
      let printButtonTrans = '{{ trans('global.datatables.print') }}'
      let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
      let selectAllButtonTrans = '{{ trans('global.select_all') }}'
      let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

      let languages = {
        'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
      };

      $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
      $.extend(true, $.fn.dataTable.defaults, {
        language: {
          url: languages['{{ app()->getLocale() }}']
        },
        columnDefs: [
        {
            orderable: false,
            className: 'dtr-control',
            targets: 0
        }, 
        {
            orderable: false,
            searchable: false,
            targets: -1
        }],
        select: {
          style:    'multi+shift',
          selector: 'td:first-child'
        },
        responsive: {
          breakpoints: [
            {name: 'bigdesktop', width: Infinity},
            {name: 'meddesktop', width: 1480},
            {name: 'smalldesktop', width: 1280},
            {name: 'medium', width: 1188},
            {name: 'tabletl', width: 1024},
            {name: 'btwtabllandp', width: 848},
            {name: 'tabletp', width: 768},
            {name: 'mobilel', width: 480},
            {name: 'mobilep', width: 320}
          ]
        },
        order: [],
        scroller: true,
        scrollX: false,
        pageLength: 100,
        dom: 'Bfrtip<"actions">',
        lengthMenu: [
            [ 10, 25, 50, 100, -1 ],
            [ '10 rows', '25 rows', '50 rows', '1000 rows', 'Show all' ]
        ],
        buttons: [
          'pageLength',
          {
            extend: 'selectAll',
            className: 'btn-primary',
            text: selectAllButtonTrans,
            exportOptions: {
              columns: ':visible'
            },
            action: function(e, dt) {
              e.preventDefault()
              dt.rows().deselect();
              dt.rows({ search: 'applied' }).select();
            }
          },
          {
            extend: 'selectNone',
            className: 'btn-primary',
            text: selectNoneButtonTrans,
            exportOptions: {
              columns: ':visible'
            }
          }
        ]
      });

      $.fn.dataTable.ext.classes.sPageButton = '';
    });

  </script>
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('employee_delete')
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.employees.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
            var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
            });

            if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
            }

            if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
            }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            select: false,
            pageLength: 100,
            select: true
        });
        let table = $('.datatable-Employee:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        
    })
</script>

@endsection