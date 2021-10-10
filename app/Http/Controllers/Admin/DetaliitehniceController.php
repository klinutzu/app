<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDetaliitehniceRequest;
use App\Http\Requests\StoreDetaliitehniceRequest;
use App\Http\Requests\UpdateDetaliitehniceRequest;
use App\Models\Comenzi;
use App\Models\Detaliitehnice;
use App\Models\Instalari;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetaliitehniceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('detaliitehnice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detaliitehnices = Detaliitehnice::with(['numar_comanda', 'detalii_tehnice'])->get();

        $comenzis = Comenzi::get();

        $instalaris = Instalari::get();

        return view('admin.detaliitehnices.index', compact('detaliitehnices', 'comenzis', 'instalaris'));
    }

    public function create()
    {
        abort_if(Gate::denies('detaliitehnice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        $detalii_tehnices = Instalari::pluck('ip', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.detaliitehnices.create', compact('numar_comandas', 'detalii_tehnices'));
    }

    public function store(StoreDetaliitehniceRequest $request)
    {
        $detaliitehnice = Detaliitehnice::create($request->all());

        return redirect()->route('admin.detaliitehnices.index');
    }

    public function edit(Detaliitehnice $detaliitehnice)
    {
        abort_if(Gate::denies('detaliitehnice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $numar_comandas = Comenzi::pluck('numar_comanda', 'id')->prepend(trans('global.pleaseSelect'), '');

        $detalii_tehnices = Instalari::pluck('ip', 'id')->prepend(trans('global.pleaseSelect'), '');

        $detaliitehnice->load('numar_comanda', 'detalii_tehnice');

        return view('admin.detaliitehnices.edit', compact('numar_comandas', 'detalii_tehnices', 'detaliitehnice'));
    }

    public function update(UpdateDetaliitehniceRequest $request, Detaliitehnice $detaliitehnice)
    {
        $detaliitehnice->update($request->all());

        return redirect()->route('admin.detaliitehnices.index');
    }

    public function show(Detaliitehnice $detaliitehnice)
    {
        abort_if(Gate::denies('detaliitehnice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detaliitehnice->load('numar_comanda', 'detalii_tehnice');

        return view('admin.detaliitehnices.show', compact('detaliitehnice'));
    }

    public function destroy(Detaliitehnice $detaliitehnice)
    {
        abort_if(Gate::denies('detaliitehnice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $detaliitehnice->delete();

        return back();
    }

    public function massDestroy(MassDestroyDetaliitehniceRequest $request)
    {
        Detaliitehnice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
