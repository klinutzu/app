<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInstalariRequest;
use App\Http\Requests\StoreInstalariRequest;
use App\Http\Requests\UpdateInstalariRequest;
use App\Models\Comenzi;
use App\Models\Instalari;
use App\Models\Surveyuri;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class InstalariController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('instalari_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalaris = Instalari::with(['numar_comanda', 'survey', 'media'])->get();

        $comenzis = Comenzi::get();

        $surveyuris = Surveyuri::get();

        return view('admin.instalaris.index', compact('instalaris', 'comenzis', 'surveyuris'));
    }

    public function create()
    {
        abort_if(Gate::denies('instalari_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveys = Surveyuri::pluck('survey', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.instalaris.create', compact('numar_comandas', 'surveys'));
    }

    public function store(StoreInstalariRequest $request)
    {
        $instalari = Instalari::create($request->all());

        foreach ($request->input('fisiere', []) as $file) {
            $instalari->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fisiere');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $instalari->id]);
        }

        return redirect()->route('admin.instalaris.index');
    }

    public function edit(Instalari $instalari)
    {
        abort_if(Gate::denies('instalari_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveys = Surveyuri::pluck('survey', 'id')->prepend(trans('global.pleaseSelect'), '');

        $instalari->load('numar_comanda', 'survey');

        return view('admin.instalaris.edit', compact('numar_comandas', 'surveys', 'instalari'));
    }

    public function update(UpdateInstalariRequest $request, Instalari $instalari)
    {
        $instalari->update($request->all());

        if (count($instalari->fisiere) > 0) {
            foreach ($instalari->fisiere as $media) {
                if (!in_array($media->file_name, $request->input('fisiere', []))) {
                    $media->delete();
                }
            }
        }
        $media = $instalari->fisiere->pluck('file_name')->toArray();
        foreach ($request->input('fisiere', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $instalari->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fisiere');
            }
        }

        return redirect()->route('admin.instalaris.index');
    }

    public function show(Instalari $instalari)
    {
        abort_if(Gate::denies('instalari_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalari->load('numar_comanda', 'survey');

        return view('admin.instalaris.show', compact('instalari'));
    }

    public function destroy(Instalari $instalari)
    {
        abort_if(Gate::denies('instalari_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalari->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstalariRequest $request)
    {
        Instalari::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('instalari_create') && Gate::denies('instalari_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Instalari();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
