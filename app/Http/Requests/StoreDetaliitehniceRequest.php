<?php

namespace App\Http\Requests;

use App\Models\Detaliitehnice;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDetaliitehniceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('detaliitehnice_create');
    }

    public function rules()
    {
        return [
            'numar_comanda_id' => [
                'required',
                'integer',
            ],
            'detalii_tehnice_id' => [
                'required',
                'integer',
            ],
            'link_monitorizare' => [
                'string',
                'nullable',
            ],
        ];
    }
}
