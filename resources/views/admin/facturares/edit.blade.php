@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.facturare.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.facturares.update", [$facturare->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="numar_comanda_id">{{ trans('cruds.facturare.fields.numar_comanda') }}</label>
                <select class="form-control select2 {{ $errors->has('numar_comanda') ? 'is-invalid' : '' }}" name="numar_comanda_id" id="numar_comanda_id" required>
                    @foreach($numar_comandas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('numar_comanda_id') ? old('numar_comanda_id') : $facturare->numar_comanda->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('numar_comanda'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numar_comanda') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.facturare.fields.numar_comanda_helper') }}</span>
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