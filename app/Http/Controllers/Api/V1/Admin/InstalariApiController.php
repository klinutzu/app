<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreInstalariRequest;
use App\Http\Requests\UpdateInstalariRequest;
use App\Http\Resources\Admin\InstalariResource;
use App\Models\Instalari;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstalariApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('instalari_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstalariResource(Instalari::with(['numar_comanda', 'survey'])->get());
    }

    public function store(StoreInstalariRequest $request)
    {
        $instalari = Instalari::create($request->all());

        if ($request->input('fisiere', false)) {
            $instalari->addMedia(storage_path('tmp/uploads/' . basename($request->input('fisiere'))))->toMediaCollection('fisiere');
        }

        return (new InstalariResource($instalari))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Instalari $instalari)
    {
        abort_if(Gate::denies('instalari_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstalariResource($instalari->load(['numar_comanda', 'survey']));
    }

    public function update(UpdateInstalariRequest $request, Instalari $instalari)
    {
        $instalari->update($request->all());

        if ($request->input('fisiere', false)) {
            if (!$instalari->fisiere || $request->input('fisiere') !== $instalari->fisiere->file_name) {
                if ($instalari->fisiere) {
                    $instalari->fisiere->delete();
                }
                $instalari->addMedia(storage_path('tmp/uploads/' . basename($request->input('fisiere'))))->toMediaCollection('fisiere');
            }
        } elseif ($instalari->fisiere) {
            $instalari->fisiere->delete();
        }

        return (new InstalariResource($instalari))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Instalari $instalari)
    {
        abort_if(Gate::denies('instalari_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instalari->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
