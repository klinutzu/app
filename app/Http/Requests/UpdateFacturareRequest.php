<?php

namespace App\Http\Requests;

use App\Models\Facturare;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFacturareRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('facturare_edit');
    }

    public function rules()
    {
        return [
            'numar_comanda_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
