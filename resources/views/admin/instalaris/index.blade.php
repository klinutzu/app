@extends('layouts.admin')
@section('content')
@can('instalari_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.instalaris.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.instalari.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.instalari.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Instalari">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.instalari.fields.numar_comanda') }}
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
                            {{ trans('cruds.instalari.fields.ip') }}
                        </th>
                        <th>
                            {{ trans('cruds.instalari.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.instalari.fields.parola') }}
                        </th>
                        <th>
                            {{ trans('cruds.instalari.fields.fisiere') }}
                        </th>
                        <th>
                            {{ trans('cruds.instalari.fields.survey') }}
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($surveyuris as $key => $item)
                                    <option value="{{ $item->survey }}">{{ $item->survey }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instalaris as $key => $instalari)
                        <tr data-entry-id="{{ $instalari->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $instalari->numar_comanda->numar_comanda ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->numar_comanda->data_init ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->numar_comanda->nume_client ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->numar_comanda->pers_contact ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->numar_comanda->telefon ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->numar_comanda->adresa ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->ip ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->user ?? '' }}
                            </td>
                            <td>
                                {{ $instalari->parola ?? '' }}
                            </td>
                            <td>
                                @foreach($instalari->fisiere as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $instalari->survey->survey ?? '' }}
                            </td>
                            <td>
                                @can('instalari_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.instalaris.show', $instalari->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('instalari_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.instalaris.edit', $instalari->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('instalari_delete')
                                    <form action="{{ route('admin.instalaris.destroy', $instalari->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('instalari_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.instalaris.massDestroy') }}",
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
  let table = $('.datatable-Instalari:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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