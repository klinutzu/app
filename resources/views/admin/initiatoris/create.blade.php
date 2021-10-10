@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.initiatori.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.initiatoris.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="initiator">{{ trans('cruds.initiatori.fields.initiator') }}</label>
                <input class="form-control {{ $errors->has('initiator') ? 'is-invalid' : '' }}" type="text" name="initiator" id="initiator" value="{{ old('initiator', '') }}" required>
                @if($errors->has('initiator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('initiator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.initiatori.fields.initiator_helper') }}</span>
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