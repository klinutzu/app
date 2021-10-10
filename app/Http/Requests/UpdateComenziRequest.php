<?php

namespace App\Http\Requests;

use App\Models\Comenzi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateComenziRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comenzi_edit');
    }

    public function rules()
    {
        return [
            'initiator_id' => [
                'required',
                'integer',
            ],
            'presales_id' => [
                'required',
                'integer',
            ],
            'data_init' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'nume_client' => [
                'string',
                'max:30',
                'required',
            ],
            'pers_contact' => [
                'string',
                'max:30',
                'required',
            ],
            'telefon' => [
                'string',
                'min:10',
                'max:10',
                'required',
            ],
            'adresa' => [
                'string',
                'max:50',
                'required',
            ],
            'servicius.*' => [
                'integer',
            ],
            'servicius' => [
                'required',
                'array',
            ],
            'cost_total' => [
                'string',
                'nullable',
            ],
            'cost_lunar' => [
                'string',
                'nullable',
            ],
            'fisiere' => [
                'array',
            ],
            'numar_comanda' => [
                'string',
                'max:15',
                'required',
            ],
            'numar_ariba' => [
                'string',
                'nullable',
            ],
        ];
    }
}
