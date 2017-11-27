<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MimoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'active_income_default.*.value' => 'nullable|numeric|min:0',
            'active_income_addon.*.label' => 'required',
            'active_income_addon.*.value' => 'nullable|numeric|min:0',
            'passive_income_default.*.value' => 'nullable|numeric|min:0',
            'passive_income_addon.*.label' => 'required',
            'passive_income_addon.*.value' => 'nullable|numeric|min:0',
            'regular_expenses_default.*.value' => 'nullable|numeric|min:0',
            'regular_expenses_addon.*.label' => 'required',
            'occassional_expenses_addon.*.value' => 'nullable|numeric|min:0',
            'occassional_expenses_addon.*.label' => 'required',
            'occassional_expenses_addon.*.frequency' => 'required',         
        ];
    }
}
