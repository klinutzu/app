<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSurveyuriRequest;
use App\Http\Requests\UpdateSurveyuriRequest;
use App\Http\Resources\Admin\SurveyuriResource;
use App\Models\Surveyuri;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyuriApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('surveyuri_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyuriResource(Surveyuri::with(['numar_comanda'])->get());
    }

    public function store(StoreSurveyuriRequest $request)
    {
        $surveyuri = Surveyuri::create($request->all());

        if ($request->input('fisiere', false)) {
            $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($request->input('fisiere'))))->toMediaCollection('fisiere');
        }

        if ($request->input('poze', false)) {
            $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($request->input('poze'))))->toMediaCollection('poze');
        }

        return (new SurveyuriResource($surveyuri))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Surveyuri $surveyuri)
    {
        abort_if(Gate::denies('surveyuri_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SurveyuriResource($surveyuri->load(['numar_comanda']));
    }

    public function update(UpdateSurveyuriRequest $request, Surveyuri $surveyuri)
    {
        $surveyuri->update($request->all());

        if ($request->input('fisiere', false)) {
            if (!$surveyuri->fisiere || $request->input('fisiere') !== $surveyuri->fisiere->file_name) {
                if ($surveyuri->fisiere) {
                    $surveyuri->fisiere->delete();
                }
                $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($request->input('fisiere'))))->toMediaCollection('fisiere');
            }
        } elseif ($surveyuri->fisiere) {
            $surveyuri->fisiere->delete();
        }

        if ($request->input('poze', false)) {
            if (!$surveyuri->poze || $request->input('poze') !== $surveyuri->poze->file_name) {
                if ($surveyuri->poze) {
                    $surveyuri->poze->delete();
                }
                $surveyuri->addMedia(storage_path('tmp/uploads/' . basename($request->input('poze'))))->toMediaCollection('poze');
            }
        } elseif ($surveyuri->poze) {
            $surveyuri->poze->delete();
        }

        return (new SurveyuriResource($surveyuri))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Surveyuri $surveyuri)
    {
        abort_if(Gate::denies('surveyuri_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $surveyuri->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
