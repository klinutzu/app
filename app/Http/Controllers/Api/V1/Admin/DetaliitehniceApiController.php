<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDetaliitehniceRequest;
use App\Http\Requests\UpdateDetaliitehniceRequest;
use App\Http\Resources\Admin\DetaliitehniceResource;
use App\Models\Detaliitehnice;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetaliitehniceApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('detaliitehnice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DetaliitehniceResource(Detaliitehnice::with(['numar_comanda', 'detalii_tehnice'])->get());
    }

    public function store(StoreDetaliitehniceRequest $request)
    {
        $detaliitehnice = Detaliitehnice::create($request->all());

        return (new DetaliitehniceResource($detaliitehnice))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Detaliitehnice $detaliitehnice)
    {
        abort_if(Gate::denies('detaliitehnice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DetaliitehniceResource($detaliitehnice->load(['numar_comanda', 'detalii_tehnice']));
    }

    public function update(UpdateDetaliitehniceRequest $request, Detaliitehnice $detaliitehnice)
    {
        $detaliitehnice->update($request->all());

        return (new DetaliitehniceResource($detaliitehnice))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Detaliitehnice $detaliitehnice)
    {
        abort_if(Gate::denies('detaliitehnice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detaliitehnice->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
