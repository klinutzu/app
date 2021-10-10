@extends('layouts.admin')
@section('content')
@can('detaliitehnice_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.detaliitehnices.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.detaliitehnice.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.detaliitehnice.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Detaliitehnice">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.detaliitehnice.fields.numar_comanda') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.nume_client') }}
                        </th>
                        <th>
                            {{ trans('cruds.comenzi.fields.adresa') }}
                        </th>
                        <th>
                            {{ trans('cruds.detaliitehnice.fields.detalii_tehnice') }}
                        </th>
                        <th>
                            {{ trans('cruds.instalari.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.instalari.fields.parola') }}
                        </th>
                        <th>
                            {{ trans('cruds.detaliitehnice.fields.link_monitorizare') }}
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($instalaris as $key => $item)
                                    <option value="{{ $item->ip }}">{{ $item->ip }}</option>
                                @endforeach
                            </select>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($detaliitehnices as $key => $detaliitehnice)
                        <tr data-entry-id="{{ $detaliitehnice->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $detaliitehnice->numar_comanda->numar_comanda ?? '' }}
                            </td>
                            <td>
                                {{ $detaliitehnice->numar_comanda->nume_client ?? '' }}
                            </td>
                            <td>
                                {{ $detaliitehnice->numar_comanda->adresa ?? '' }}
                            </td>
                            <td>
                                {{ $detaliitehnice->detalii_tehnice->ip ?? '' }}
                            </td>
                            <td>
                                {{ $detaliitehnice->detalii_tehnice->user ?? '' }}
                            </td>
                            <td>
                                {{ $detaliitehnice->detalii_tehnice->parola ?? '' }}
                            </td>
                            <td>
                                {{ $detaliitehnice->link_monitorizare ?? '' }}
                            </td>
                            <td>
                                @can('detaliitehnice_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.detaliitehnices.show', $detaliitehnice->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('detaliitehnice_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.detaliitehnices.edit', $detaliitehnice->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('detaliitehnice_delete')
                                    <form action="{{ route('admin.detaliitehnices.destroy', $detaliitehnice->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('detaliitehnice_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.detaliitehnices.massDestroy') }}",
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
  let table = $('.datatable-Detaliitehnice:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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