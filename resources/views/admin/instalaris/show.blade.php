@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.instalari.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instalaris.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.instalari.fields.numar_comanda') }}
                        </th>
                        <td>
                            {{ $instalari->numar_comanda->numar_comanda ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instalari.fields.ip') }}
                        </th>
                        <td>
                            {{ $instalari->ip }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instalari.fields.user') }}
                        </th>
                        <td>
                            {{ $instalari->user }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instalari.fields.parola') }}
                        </th>
                        <td>
                            {{ $instalari->parola }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instalari.fields.fisiere') }}
                        </th>
                        <td>
                            @foreach($instalari->fisiere as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instalari.fields.survey') }}
                        </th>
                        <td>
                            {{ $instalari->survey->survey ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instalaris.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection