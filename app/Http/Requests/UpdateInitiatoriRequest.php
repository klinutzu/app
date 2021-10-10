<?php

namespace App\Http\Requests;

use App\Models\Initiatori;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInitiatoriRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('initiatori_edit');
    }

    public function rules()
    {
        return [
            'initiator' => [
                'string',
                'max:20',
                'required',
            ],
        ];
    }
}
