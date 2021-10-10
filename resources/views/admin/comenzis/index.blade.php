@extends('layouts.admin')
@section('content')
@can('comenzi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.comenzis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.comenzi.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.comenzi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Comenzi">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.initiator') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.presales') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.data_init') }}
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
                            {{ trans('cruds.comenzi.fields.serviciu') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.cost_total') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.cost_lunar') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.fisiere') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.numar_comanda') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.numar_ariba') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.observatii') }}
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
                                @foreach($initiatoris as $key => $item)
                                    <option value="{{ $item->initiator }}">{{ $item->initiator }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($presales as $key => $item)
                                    <option value="{{ $item->presales }}">{{ $item->presales }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($serviciis as $key => $item)
                                    <option value="{{ $item->serviciu }}">{{ $item->serviciu }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comenzis as $key => $comenzi)
                        <tr data-entry-id="{{ $comenzi->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $comenzi->initiator->initiator ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->presales->presales ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->data_init ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->nume_client ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->pers_contact ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->telefon ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->adresa ?? '' }}
                            </td>
                            <td>
                                @foreach($comenzi->servicius as $key => $item)
                                    <span class="badge badge-info">{{ $item->serviciu }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $comenzi->cost_total ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->cost_lunar ?? '' }}
                            </td>
                            <td>
                                @foreach($comenzi->fisiere as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $comenzi->numar_comanda ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->numar_ariba ?? '' }}
                            </td>
                            <td>
                                {{ $comenzi->observatii ?? '' }}
                            </td>
                            <td>
                                @can('comenzi_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.comenzis.show', $comenzi->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('comenzi_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.comenzis.edit', $comenzi->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('comenzi_delete')
                                    <form action="{{ route('admin.comenzis.destroy', $comenzi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('comenzi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.comenzis.massDestroy') }}",
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
    order: [[ 12, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Comenzi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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