@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.comenzi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comenzis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.initiator') }}
                        </th>
                        <td>
                            {{ $comenzi->initiator->initiator ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.presales') }}
                        </th>
                        <td>
                            {{ $comenzi->presales->presales ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.data_init') }}
                        </th>
                        <td>
                            {{ $comenzi->data_init }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.nume_client') }}
                        </th>
                        <td>
                            {{ $comenzi->nume_client }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.pers_contact') }}
                        </th>
                        <td>
                            {{ $comenzi->pers_contact }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.telefon') }}
                        </th>
                        <td>
                            {{ $comenzi->telefon }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.adresa') }}
                        </th>
                        <td>
                            {{ $comenzi->adresa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.serviciu') }}
                        </th>
                        <td>
                            @foreach($comenzi->servicius as $key => $serviciu)
                                <span class="label label-info">{{ $serviciu->serviciu }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.cost_total') }}
                        </th>
                        <td>
                            {{ $comenzi->cost_total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.cost_lunar') }}
                        </th>
                        <td>
                            {{ $comenzi->cost_lunar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.fisiere') }}
                        </th>
                        <td>
                            @foreach($comenzi->fisiere as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.numar_comanda') }}
                        </th>
                        <td>
                            {{ $comenzi->numar_comanda }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.numar_ariba') }}
                        </th>
                        <td>
                            {{ $comenzi->numar_ariba }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.comenzi.fields.observatii') }}
                        </th>
                        <td>
                            {{ $comenzi->observatii }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.comenzis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection