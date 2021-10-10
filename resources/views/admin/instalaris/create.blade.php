@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.instalari.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.instalaris.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="numar_comanda_id">{{ trans('cruds.instalari.fields.numar_comanda') }}</label>
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
                <span class="help-block">{{ trans('cruds.instalari.fields.numar_comanda_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ip">{{ trans('cruds.instalari.fields.ip') }}</label>
                <input class="form-control {{ $errors->has('ip') ? 'is-invalid' : '' }}" type="text" name="ip" id="ip" value="{{ old('ip', '') }}">
                @if($errors->has('ip'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ip') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalari.fields.ip_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user">{{ trans('cruds.instalari.fields.user') }}</label>
                <input class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" type="text" name="user" id="user" value="{{ old('user', '') }}">
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalari.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="parola">{{ trans('cruds.instalari.fields.parola') }}</label>
                <input class="form-control {{ $errors->has('parola') ? 'is-invalid' : '' }}" type="text" name="parola" id="parola" value="{{ old('parola', '') }}">
                @if($errors->has('parola'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parola') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalari.fields.parola_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fisiere">{{ trans('cruds.instalari.fields.fisiere') }}</label>
                <div class="needsclick dropzone {{ $errors->has('fisiere') ? 'is-invalid' : '' }}" id="fisiere-dropzone">
                </div>
                @if($errors->has('fisiere'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fisiere') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalari.fields.fisiere_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="survey_id">{{ trans('cruds.instalari.fields.survey') }}</label>
                <select class="form-control select2 {{ $errors->has('survey') ? 'is-invalid' : '' }}" name="survey_id" id="survey_id" required>
                    @foreach($surveys as $id => $entry)
                        <option value="{{ $id }}" {{ old('survey_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('survey'))
                    <div class="invalid-feedback">
                        {{ $errors->first('survey') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instalari.fields.survey_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedFisiereMap = {}
Dropzone.options.fisiereDropzone = {
    url: '{{ route('admin.instalaris.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="fisiere[]" value="' + response.name + '">')
      uploadedFisiereMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFisiereMap[file.name]
      }
      $('form').find('input[name="fisiere[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($instalari) && $instalari->fisiere)
          var files =
            {!! json_encode($instalari->fisiere) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="fisiere[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection