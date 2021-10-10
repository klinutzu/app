@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.detaliitehnice.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.detaliitehnices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.detaliitehnice.fields.numar_comanda') }}
                        </th>
                        <td>
                            {{ $detaliitehnice->numar_comanda->numar_comanda ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detaliitehnice.fields.detalii_tehnice') }}
                        </th>
                        <td>
                            {{ $detaliitehnice->detalii_tehnice->ip ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.detaliitehnice.fields.link_monitorizare') }}
                        </th>
                        <td>
                            {{ $detaliitehnice->link_monitorizare }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.detaliitehnices.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection