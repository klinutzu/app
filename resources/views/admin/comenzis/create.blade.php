@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.comenzi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comenzis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="initiator_id">{{ trans('cruds.comenzi.fields.initiator') }}</label>
                <select class="form-control select2 {{ $errors->has('initiator') ? 'is-invalid' : '' }}" name="initiator_id" id="initiator_id" required>
                    @foreach($initiators as $id => $entry)
                        <option value="{{ $id }}" {{ old('initiator_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('initiator'))
                    <div class="invalid-feedback">
                        {{ $errors->first('initiator') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.initiator_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="presales_id">{{ trans('cruds.comenzi.fields.presales') }}</label>
                <select class="form-control select2 {{ $errors->has('presales') ? 'is-invalid' : '' }}" name="presales_id" id="presales_id" required>
                    @foreach($presales as $id => $entry)
                        <option value="{{ $id }}" {{ old('presales_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('presales'))
                    <div class="invalid-feedback">
                        {{ $errors->first('presales') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.presales_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="data_init">{{ trans('cruds.comenzi.fields.data_init') }}</label>
                <input class="form-control date {{ $errors->has('data_init') ? 'is-invalid' : '' }}" type="text" name="data_init" id="data_init" value="{{ old('data_init') }}" required>
                @if($errors->has('data_init'))
                    <div class="invalid-feedback">
                        {{ $errors->first('data_init') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.data_init_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nume_client">{{ trans('cruds.comenzi.fields.nume_client') }}</label>
                <input class="form-control {{ $errors->has('nume_client') ? 'is-invalid' : '' }}" type="text" name="nume_client" id="nume_client" value="{{ old('nume_client', '') }}" required>
                @if($errors->has('nume_client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nume_client') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.nume_client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="pers_contact">{{ trans('cruds.comenzi.fields.pers_contact') }}</label>
                <input class="form-control {{ $errors->has('pers_contact') ? 'is-invalid' : '' }}" type="text" name="pers_contact" id="pers_contact" value="{{ old('pers_contact', '') }}" required>
                @if($errors->has('pers_contact'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pers_contact') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.pers_contact_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="telefon">{{ trans('cruds.comenzi.fields.telefon') }}</label>
                <input class="form-control {{ $errors->has('telefon') ? 'is-invalid' : '' }}" type="text" name="telefon" id="telefon" value="{{ old('telefon', '') }}" required>
                @if($errors->has('telefon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.telefon_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="adresa">{{ trans('cruds.comenzi.fields.adresa') }}</label>
                <input class="form-control {{ $errors->has('adresa') ? 'is-invalid' : '' }}" type="text" name="adresa" id="adresa" value="{{ old('adresa', '') }}" required>
                @if($errors->has('adresa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('adresa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.adresa_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="servicius">{{ trans('cruds.comenzi.fields.serviciu') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('servicius') ? 'is-invalid' : '' }}" name="servicius[]" id="servicius" multiple required>
                    @foreach($servicius as $id => $serviciu)
                        <option value="{{ $id }}" {{ in_array($id, old('servicius', [])) ? 'selected' : '' }}>{{ $serviciu }}</option>
                    @endforeach
                </select>
                @if($errors->has('servicius'))
                    <div class="invalid-feedback">
                        {{ $errors->first('servicius') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.serviciu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cost_total">{{ trans('cruds.comenzi.fields.cost_total') }}</label>
                <input class="form-control {{ $errors->has('cost_total') ? 'is-invalid' : '' }}" type="text" name="cost_total" id="cost_total" value="{{ old('cost_total', '') }}">
                @if($errors->has('cost_total'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cost_total') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.cost_total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cost_lunar">{{ trans('cruds.comenzi.fields.cost_lunar') }}</label>
                <input class="form-control {{ $errors->has('cost_lunar') ? 'is-invalid' : '' }}" type="text" name="cost_lunar" id="cost_lunar" value="{{ old('cost_lunar', '') }}">
                @if($errors->has('cost_lunar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cost_lunar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.cost_lunar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fisiere">{{ trans('cruds.comenzi.fields.fisiere') }}</label>
                <div class="needsclick dropzone {{ $errors->has('fisiere') ? 'is-invalid' : '' }}" id="fisiere-dropzone">
                </div>
                @if($errors->has('fisiere'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fisiere') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.fisiere_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="numar_comanda">{{ trans('cruds.comenzi.fields.numar_comanda') }}</label>
                <input class="form-control {{ $errors->has('numar_comanda') ? 'is-invalid' : '' }}" type="text" name="numar_comanda" id="numar_comanda" value="{{ old('numar_comanda', '1') }}" required>
                @if($errors->has('numar_comanda'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numar_comanda') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.numar_comanda_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numar_ariba">{{ trans('cruds.comenzi.fields.numar_ariba') }}</label>
                <input class="form-control {{ $errors->has('numar_ariba') ? 'is-invalid' : '' }}" type="text" name="numar_ariba" id="numar_ariba" value="{{ old('numar_ariba', '') }}">
                @if($errors->has('numar_ariba'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numar_ariba') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.numar_ariba_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="observatii">{{ trans('cruds.comenzi.fields.observatii') }}</label>
                <textarea class="form-control {{ $errors->has('observatii') ? 'is-invalid' : '' }}" name="observatii" id="observatii">{{ old('observatii') }}</textarea>
                @if($errors->has('observatii'))
                    <div class="invalid-feedback">
                        {{ $errors->first('observatii') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comenzi.fields.observatii_helper') }}</span>
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
    url: '{{ route('admin.comenzis.storeMedia') }}',
    maxFilesize: 100, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100
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
@if(isset($comenzi) && $comenzi->fisiere)
          var files =
            {!! json_encode($comenzi->fisiere) !!}
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