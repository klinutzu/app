@extends('layouts.admin')
@section('content')
@can('surveyuri_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.surveyuris.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.surveyuri.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.surveyuri.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Surveyuri">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.surveyuri.fields.numar_comanda') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.nume_client') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.pers_contact') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.telefon') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.adresa') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.observatii') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyuri.fields.survey') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyuri.fields.fisiere') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyuri.fields.poze') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($comenzis as $key => $item)
                                    <option value="{{ $item->numar_comanda }}">{{ $item->numar_comanda }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surveyuris as $key => $surveyuri)
                        <tr data-entry-id="{{ $surveyuri->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $surveyuri->numar_comanda->numar_comanda ?? '' }}
                            </td>
                            <td>
                                {{ $surveyuri->numar_comanda->nume_client ?? '' }}
                            </td>
                            <td>
                                {{ $surveyuri->numar_comanda->pers_contact ?? '' }}
                            </td>
                            <td>
                                {{ $surveyuri->numar_comanda->telefon ?? '' }}
                            </td>
                            <td>
                                {{ $surveyuri->numar_comanda->adresa ?? '' }}
                            </td>
                            <td>
                                {{ $surveyuri->numar_comanda->observatii ?? '' }}
                            </td>
                            <td>
                                {{ $surveyuri->survey ?? '' }}
                            </td>
                            <td>
                                @foreach($surveyuri->fisiere as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @foreach($surveyuri->poze as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $media->getUrl('thumb') }}">
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('surveyuri_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.surveyuris.show', $surveyuri->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('surveyuri_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.surveyuris.edit', $surveyuri->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('surveyuri_delete')
                                    <form action="{{ route('admin.surveyuris.destroy', $surveyuri->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('surveyuri_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.surveyuris.massDestroy') }}",
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
    order: [[ 1, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Surveyuri:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection