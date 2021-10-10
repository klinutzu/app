@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.detaliitehnice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.detaliitehnices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="numar_comanda_id">{{ trans('cruds.detaliitehnice.fields.numar_comanda') }}</label>
                <select class="form-control select2 {{ $errors->has('numar_comanda') ? 'is-invalid' : '' }}" name="numar_comanda_id" id="numar_comanda_id" required>
                    @foreach($numar_comandas as $id => $entry)
                        <option value="{{ $id }}" {{ old('numar_comanda_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('numar_comanda'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numar_comanda') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.detaliitehnice.fields.numar_comanda_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="detalii_tehnice_id">{{ trans('cruds.detaliitehnice.fields.detalii_tehnice') }}</label>
                <select class="form-control select2 {{ $errors->has('detalii_tehnice') ? 'is-invalid' : '' }}" name="detalii_tehnice_id" id="detalii_tehnice_id" required>
                    @foreach($detalii_tehnices as $id => $entry)
                        <option value="{{ $id }}" {{ old('detalii_tehnice_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('detalii_tehnice'))
                    <div class="invalid-feedback">
                        {{ $errors->first('detalii_tehnice') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.detaliitehnice.fields.detalii_tehnice_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_monitorizare">{{ trans('cruds.detaliitehnice.fields.link_monitorizare') }}</label>
                <input class="form-control {{ $errors->has('link_monitorizare') ? 'is-invalid' : '' }}" type="text" name="link_monitorizare" id="link_monitorizare" value="{{ old('link_monitorizare', '') }}">
                @if($errors->has('link_monitorizare'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link_monitorizare') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.detaliitehnice.fields.link_monitorizare_helper') }}</span>
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