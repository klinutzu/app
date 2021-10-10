@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.servicii.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.serviciis.update", [$servicii->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="serviciu">{{ trans('cruds.servicii.fields.serviciu') }}</label>
                <input class="form-control {{ $errors->has('serviciu') ? 'is-invalid' : '' }}" type="text" name="serviciu" id="serviciu" value="{{ old('serviciu', $servicii->serviciu) }}" required>
                @if($errors->has('serviciu'))
                    <div class="invalid-feedback">
                        {{ $errors->first('serviciu') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.servicii.fields.serviciu_helper') }}</span>
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