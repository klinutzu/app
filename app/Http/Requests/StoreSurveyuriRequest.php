<?php

namespace App\Http\Requests;

use App\Models\Surveyuri;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyuriRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('surveyuri_create');
    }

    public function rules()
    {
        return [
            'numar_comanda_id' => [
                'required',
                'integer',
            ],
            'fisiere' => [
                'array',
            ],
            'poze' => [
                'array',
            ],
        ];
    }
}
