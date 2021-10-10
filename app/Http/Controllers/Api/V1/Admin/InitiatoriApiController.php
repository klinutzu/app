<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInitiatoriRequest;
use App\Http\Requests\UpdateInitiatoriRequest;
use App\Http\Resources\Admin\InitiatoriResource;
use App\Models\Initiatori;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitiatoriApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('initiatori_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InitiatoriResource(Initiatori::all());
    }

    public function store(StoreInitiatoriRequest $request)
    {
        $initiatori = Initiatori::create($request->all());

        return (new InitiatoriResource($initiatori))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Initiatori $initiatori)
    {
        abort_if(Gate::denies('initiatori_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InitiatoriResource($initiatori);
    }

    public function update(UpdateInitiatoriRequest $request, Initiatori $initiatori)
    {
        $initiatori->update($request->all());

        return (new InitiatoriResource($initiatori))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Initiatori $initiatori)
    {
        abort_if(Gate::denies('initiatori_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $initiatori->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
