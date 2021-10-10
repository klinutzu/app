<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiciiRequest;
use App\Http\Requests\UpdateServiciiRequest;
use App\Http\Resources\Admin\ServiciiResource;
use App\Models\Servicii;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiciiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('servicii_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiciiResource(Servicii::all());
    }

    public function store(StoreServiciiRequest $request)
    {
        $servicii = Servicii::create($request->all());

        return (new ServiciiResource($servicii))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Servicii $servicii)
    {
        abort_if(Gate::denies('servicii_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiciiResource($servicii);
    }

    public function update(UpdateServiciiRequest $request, Servicii $servicii)
    {
        $servicii->update($request->all());

        return (new ServiciiResource($servicii))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Servicii $servicii)
    {
        abort_if(Gate::denies('servicii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicii->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
