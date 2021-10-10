<?php

namespace App\Http\Requests;

use App\Models\Instalari;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstalariRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('instalari_create');
    }

    public function rules()
    {
        return [
            'numar_comanda_id' => [
                'required',
                'integer',
            ],
            'ip' => [
                'string',
                'nullable',
            ],
            'user' => [
                'string',
                'nullable',
            ],
            'parola' => [
                'string',
                'nullable',
            ],
            'survey_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
