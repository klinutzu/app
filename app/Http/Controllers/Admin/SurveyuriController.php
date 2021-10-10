<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySurveyuriRequest;
use App\Http\Requests\StoreSurveyuriRequest;
use App\Http\Requests\UpdateSurveyuriRequest;
use App\Models\Comenzi;
use App\Models\Surveyuri;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SurveyuriController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('surveyuri_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyuris = Surveyuri::with(['numar_comanda', 'media'])->get();

        $comenzis = Comenzi::get();

        return view('admin.surveyuris.index', compact('surveyuris', 'comenzis'));
    }

    public function create()
    {
        abort_if(Gate::denies('surveyuri_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.surveyuris.create', compact('numar_comandas'));
    }

    public function store(StoreSurveyuriRequest $request)
    {
        $surveyuri = Surveyuri::create($request->all());

        foreach ($request->input('fisiere', []) as $file) {
            $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fisiere');
        }

        foreach ($request->input('poze', []) as $file) {
            $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('poze');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $surveyuri->id]);
        }

        return redirect()->route('admin.surveyuris.index');
    }

    public function edit(Surveyuri $surveyuri)
    {
        abort_if(Gate::denies('surveyuri_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        $surveyuri->load('numar_comanda');

        return view('admin.surveyuris.edit', compact('numar_comandas', 'surveyuri'));
    }

    public function update(UpdateSurveyuriRequest $request, Surveyuri $surveyuri)
    {
        $surveyuri->update($request->all());

        if (count($surveyuri->fisiere) > 0) {
            foreach ($surveyuri->fisiere as $media) {
                if (!in_array($media->file_name, $request->input('fisiere', []))) {
                    $media->delete();
                }
            }
        }
        $media = $surveyuri->fisiere->pluck('file_name')->toArray();
        foreach ($request->input('fisiere', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('fisiere');
            }
        }

        if (count($surveyuri->poze) > 0) {
            foreach ($surveyuri->poze as $media) {
                if (!in_array($media->file_name, $request->input('poze', []))) {
                    $media->delete();
                }
            }
        }
        $media = $surveyuri->poze->pluck('file_name')->toArray();
        foreach ($request->input('poze', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('poze');
            }
        }

        return redirect()->route('admin.surveyuris.index');
    }

    public function show(Surveyuri $surveyuri)
    {
        abort_if(Gate::denies('surveyuri_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyuri->load('numar_comanda');

        return view('admin.surveyuris.show', compact('surveyuri'));
    }

    public function destroy(Surveyuri $surveyuri)
    {
        abort_if(Gate::denies('surveyuri_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyuri->delete();

        return back();
    }

    public function massDestroy(MassDestroySurveyuriRequest $request)
    {
        Surveyuri::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('surveyuri_create') && Gate::denies('surveyuri_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Surveyuri();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
