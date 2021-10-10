<?php

namespace App\Http\Requests;

use App\Models\Facturare;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFacturareRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('facturare_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:facturares,id',
        ];
    }
}
