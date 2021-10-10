<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacturareRequest;
use App\Http\Requests\UpdateFacturareRequest;
use App\Http\Resources\Admin\FacturareResource;
use App\Models\Facturare;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacturareApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facturare_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacturareResource(Facturare::with(['numar_comanda'])->get());
    }

    public function store(StoreFacturareRequest $request)
    {
        $facturare = Facturare::create($request->all());

        return (new FacturareResource($facturare))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Facturare $facturare)
    {
        abort_if(Gate::denies('facturare_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FacturareResource($facturare->load(['numar_comanda']));
    }

    public function update(UpdateFacturareRequest $request, Facturare $facturare)
    {
        $facturare->update($request->all());

        return (new FacturareResource($facturare))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Facturare $facturare)
    {
        abort_if(Gate::denies('facturare_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facturare->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
