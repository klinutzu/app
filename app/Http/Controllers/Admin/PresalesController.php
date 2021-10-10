<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPresaleRequest;
use App\Http\Requests\StorePresaleRequest;
use App\Http\Requests\UpdatePresaleRequest;
use App\Models\Presale;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PresalesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('presale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presales = Presale::all();

        return view('admin.presales.index', compact('presales'));
    }

    public function create()
    {
        abort_if(Gate::denies('presale_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.presales.create');
    }

    public function store(StorePresaleRequest $request)
    {
        $presale = Presale::create($request->all());

        return redirect()->route('admin.presales.index');
    }

    public function edit(Presale $presale)
    {
        abort_if(Gate::denies('presale_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.presales.edit', compact('presale'));
    }

    public function update(UpdatePresaleRequest $request, Presale $presale)
    {
        $presale->update($request->all());

        return redirect()->route('admin.presales.index');
    }

    public function show(Presale $presale)
    {
        abort_if(Gate::denies('presale_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.presales.show', compact('presale'));
    }

    public function destroy(Presale $presale)
    {
        abort_if(Gate::denies('presale_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $presale->delete();

        return back();
    }

    public function massDestroy(MassDestroyPresaleRequest $request)
    {
        Presale::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
