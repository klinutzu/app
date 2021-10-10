<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInitiatoriRequest;
use App\Http\Requests\StoreInitiatoriRequest;
use App\Http\Requests\UpdateInitiatoriRequest;
use App\Models\Initiatori;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitiatoriController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('initiatori_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $initiatoris = Initiatori::all();

        return view('admin.initiatoris.index', compact('initiatoris'));
    }

    public function create()
    {
        abort_if(Gate::denies('initiatori_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.initiatoris.create');
    }

    public function store(StoreInitiatoriRequest $request)
    {
        $initiatori = Initiatori::create($request->all());

        return redirect()->route('admin.initiatoris.index');
    }

    public function edit(Initiatori $initiatori)
    {
        abort_if(Gate::denies('initiatori_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.initiatoris.edit', compact('initiatori'));
    }

    public function update(UpdateInitiatoriRequest $request, Initiatori $initiatori)
    {
        $initiatori->update($request->all());

        return redirect()->route('admin.initiatoris.index');
    }

    public function show(Initiatori $initiatori)
    {
        abort_if(Gate::denies('initiatori_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.initiatoris.show', compact('initiatori'));
    }

    public function destroy(Initiatori $initiatori)
    {
        abort_if(Gate::denies('initiatori_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $initiatori->delete();

        return back();
    }

    public function massDestroy(MassDestroyInitiatoriRequest $request)
    {
        Initiatori::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
