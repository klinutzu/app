<?php

namespace App\Http\Requests;

use App\Models\Presale;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePresaleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('presale_edit');
    }

    public function rules()
    {
        return [
            'presales' => [
                'string',
                'required',
            ],
        ];
    }
}
