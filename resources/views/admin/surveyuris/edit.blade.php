@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.surveyuri.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.surveyuris.update", [$surveyuri->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="numar_comanda_id">{{ trans('cruds.surveyuri.fields.numar_comanda') }}</label>
                <select class="form-control select2 {{ $errors->has('numar_comanda') ? 'is-invalid' : '' }}" name="numar_comanda_id" id="numar_comanda_id" required>
                    @foreach($numar_comandas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('numar_comanda_id') ? old('numar_comanda_id') : $surveyuri->numar_comanda->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('numar_comanda'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numar_comanda') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyuri.fields.numar_comanda_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="survey">{{ trans('cruds.surveyuri.fields.survey') }}</label>
                <textarea class="form-control {{ $errors->has('survey') ? 'is-invalid' : '' }}" name="survey" id="survey">{{ old('survey', $surveyuri->survey) }}</textarea>
                @if($errors->has('survey'))
                    <div class="invalid-feedback">
                        {{ $errors->first('survey') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyuri.fields.survey_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fisiere">{{ trans('cruds.surveyuri.fields.fisiere') }}</label>
                <div class="needsclick dropzone {{ $errors->has('fisiere') ? 'is-invalid' : '' }}" id="fisiere-dropzone">
                </div>
                @if($errors->has('fisiere'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fisiere') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyuri.fields.fisiere_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="poze">{{ trans('cruds.surveyuri.fields.poze') }}</label>
                <div class="needsclick dropzone {{ $errors->has('poze') ? 'is-invalid' : '' }}" id="poze-dropzone">
                </div>
                @if($errors->has('poze'))
                    <div class="invalid-feedback">
                        {{ $errors->first('poze') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.surveyuri.fields.poze_helper') }}</span>
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
    url: '{{ route('admin.surveyuris.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
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
@if(isset($surveyuri) && $surveyuri->fisiere)
          var files =
            {!! json_encode($surveyuri->fisiere) !!}
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
<script>
    var uploadedPozeMap = {}
Dropzone.options.pozeDropzone = {
    url: '{{ route('admin.surveyuris.storeMedia') }}',
    maxFilesize: 10, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="poze[]" value="' + response.name + '">')
      uploadedPozeMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPozeMap[file.name]
      }
      $('form').find('input[name="poze[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($surveyuri) && $surveyuri->poze)
      var files = {!! json_encode($surveyuri->poze) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="poze[]" value="' + file.file_name + '">')
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