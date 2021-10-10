@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.presale.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.presales.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="presales">{{ trans('cruds.presale.fields.presales') }}</label>
                <input class="form-control {{ $errors->has('presales') ? 'is-invalid' : '' }}" type="text" name="presales" id="presales" value="{{ old('presales', '') }}" required>
                @if($errors->has('presales'))
                    <div class="invalid-feedback">
                        {{ $errors->first('presales') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.presale.fields.presales_helper') }}</span>
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