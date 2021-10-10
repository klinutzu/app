<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFacturareRequest;
use App\Http\Requests\StoreFacturareRequest;
use App\Http\Requests\UpdateFacturareRequest;
use App\Models\Comenzi;
use App\Models\Facturare;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacturareController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facturare_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facturares = Facturare::with(['numar_comanda'])->get();

        $comenzis = Comenzi::get();

        return view('admin.facturares.index', compact('facturares', 'comenzis'));
    }

    public function create()
    {
        abort_if(Gate::denies('facturare_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.facturares.create', compact('numar_comandas'));
    }

    public function store(StoreFacturareRequest $request)
    {
        $facturare = Facturare::create($request->all());

        return redirect()->route('admin.facturares.index');
    }

    public function edit(Facturare $facturare)
    {
        abort_if(Gate::denies('facturare_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        $facturare->load('numar_comanda');

        return view('admin.facturares.edit', compact('numar_comandas', 'facturare'));
    }

    public function update(UpdateFacturareRequest $request, Facturare $facturare)
    {
        $facturare->update($request->all());

        return redirect()->route('admin.facturares.index');
    }

    public function show(Facturare $facturare)
    {
        abort_if(Gate::denies('facturare_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facturare->load('numar_comanda');

        return view('admin.facturares.show', compact('facturare'));
    }

    public function destroy(Facturare $facturare)
    {
        abort_if(Gate::denies('facturare_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facturare->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacturareRequest $request)
    {
        Facturare::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
