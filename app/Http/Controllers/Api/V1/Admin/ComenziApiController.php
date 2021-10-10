<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreComenziRequest;
use App\Http\Requests\UpdateComenziRequest;
use App\Http\Resources\Admin\ComenziResource;
use App\Models\Comenzi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComenziApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('comenzi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComenziResource(Comenzi::with(['initiator', 'presales', 'servicius'])->get());
    }

    public function store(StoreComenziRequest $request)
    {
        $comenzi = Comenzi::create($request->all());
        $comenzi->servicius()->sync($request->input('servicius', []));
        if ($request->input('fisiere', false)) {
            $comenzi->addMedia(storage_path('tmp/uploads/' . basename($request->input('fisiere'))))->toMediaCollection('fisiere');
        }

        return (new ComenziResource($comenzi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Comenzi $comenzi)
    {
        abort_if(Gate::denies('comenzi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComenziResource($comenzi->load(['initiator', 'presales', 'servicius']));
    }

    public function update(UpdateComenziRequest $request, Comenzi $comenzi)
    {
        $comenzi->update($request->all());
        $comenzi->servicius()->sync($request->input('servicius', []));
        if ($request->input('fisiere', false)) {
            if (!$comenzi->fisiere || $request->input('fisiere') !== $comenzi->fisiere->file_name) {
                if ($comenzi->fisiere) {
                    $comenzi->fisiere->delete();
                }
                $comenzi->addMedia(storage_path('tmp/uploads/' . basename($request->input('fisiere'))))->toMediaCollection('fisiere');
            }
        } elseif ($comenzi->fisiere) {
            $comenzi->fisiere->delete();
        }

        return (new ComenziResource($comenzi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Comenzi $comenzi)
    {
        abort_if(Gate::denies('comenzi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comenzi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
