<?php

namespace App\Http\Requests;

use App\Models\Servicii;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServiciiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('servicii_create');
    }

    public function rules()
    {
        return [
            'serviciu' => [
                'string',
                'max:20',
                'required',
            ],
        ];
    }
}
