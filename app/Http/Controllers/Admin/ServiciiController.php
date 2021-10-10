<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiciiRequest;
use App\Http\Requests\StoreServiciiRequest;
use App\Http\Requests\UpdateServiciiRequest;
use App\Models\Servicii;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiciiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('servicii_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviciis = Servicii::all();

        return view('admin.serviciis.index', compact('serviciis'));
    }

    public function create()
    {
        abort_if(Gate::denies('servicii_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serviciis.create');
    }

    public function store(StoreServiciiRequest $request)
    {
        $servicii = Servicii::create($request->all());

        return redirect()->route('admin.serviciis.index');
    }

    public function edit(Servicii $servicii)
    {
        abort_if(Gate::denies('servicii_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serviciis.edit', compact('servicii'));
    }

    public function update(UpdateServiciiRequest $request, Servicii $servicii)
    {
        $servicii->update($request->all());

        return redirect()->route('admin.serviciis.index');
    }

    public function show(Servicii $servicii)
    {
        abort_if(Gate::denies('servicii_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.serviciis.show', compact('servicii'));
    }

    public function destroy(Servicii $servicii)
    {
        abort_if(Gate::denies('servicii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servicii->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiciiRequest $request)
    {
        Servicii::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
