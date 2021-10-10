<?php

namespace App\Http\Requests;

use App\Models\Servicii;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyServiciiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('servicii_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:serviciis,id',
        ];
    }
}
