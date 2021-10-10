<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyComenziRequest;
use App\Http\Requests\StoreComenziRequest;
use App\Http\Requests\UpdateComenziRequest;
use App\Models\Comenzi;
use App\Models\Initiatori;
use App\Models\Presale;
use App\Models\Servicii;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ComenziController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('comenzi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comenzis = Comenzi::with(['initiator', 'presales', 'servicius', 'media'])->get();

        $initiatoris = Initiatori::get();

        $presales = Presale::get();

        $serviciis = Servicii::get();

        return view('admin.comenzis.index', compact('comenzis', 'initiatoris', 'presales', 'serviciis'));
    }

    public function create()
    {
        abort_if(Gate::denies('comenzi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $initiators = Initiatori::pluck('initiator', 'id')->prepend(trans('global.pleaseSelect'), '');

        $presales = Presale::pluck('presales', 'id')->prepend(trans('global.pleaseSelect'), '');

        $servicius = Servicii::pluck('serviciu', 'id');

        return view('admin.comenzis.create', compact('initiators', 'presales', 'servicius'));
    }

    public function store(StoreComenziRequest $request)
    {
        $comenzi = Comenzi::create($request->all());
        $comenzi->servicius()->sync($request->input('servicius', []));
        foreach ($request->input('fisiere', []) as $file) {
            $comenzi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fisiere');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $comenzi->id]);
        }

        return redirect()->route('admin.comenzis.index');
    }

    public function edit(Comenzi $comenzi)
    {
        abort_if(Gate::denies('comenzi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $initiators = Initiatori::pluck('initiator', 'id')->prepend(trans('global.pleaseSelect'), '');

        $presales = Presale::pluck('presales', 'id')->prepend(trans('global.pleaseSelect'), '');

        $servicius = Servicii::pluck('serviciu', 'id');

        $comenzi->load('initiator', 'presales', 'servicius');

        return view('admin.comenzis.edit', compact('initiators', 'presales', 'servicius', 'comenzi'));
    }

    public function update(UpdateComenziRequest $request, Comenzi $comenzi)
    {
        $comenzi->update($request->all());
        $comenzi->servicius()->sync($request->input('servicius', []));
        if (count($comenzi->fisiere) > 0) {
            foreach ($comenzi->fisiere as $media) {
                if (!in_array($media->file_name, $request->input('fisiere', []))) {
                    $media->delete();
                }
            }
        }
        $media = $comenzi->fisiere->pluck('file_name')->toArray();
        foreach ($request->input('fisiere', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $comenzi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fisiere');
            }
        }

        return redirect()->route('admin.comenzis.index');
    }

    public function show(Comenzi $comenzi)
    {
        abort_if(Gate::denies('comenzi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comenzi->load('initiator', 'presales', 'servicius');

        return view('admin.comenzis.show', compact('comenzi'));
    }

    public function destroy(Comenzi $comenzi)
    {
        abort_if(Gate::denies('comenzi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comenzi->delete();

        return back();
    }

    public function massDestroy(MassDestroyComenziRequest $request)
    {
        Comenzi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('comenzi_create') && Gate::denies('comenzi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Comenzi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
