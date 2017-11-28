<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalanceSheetRequest extends FormRequest
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
            'current_assets_default.*.value' => 'nullable|numeric|min:0',
            'current_assets_addon.*.label' => 'required',
            'current_assets_addon.*.value' => 'nullable|numeric|min:0',
            'longterm_assets_default.*.value' => 'nullable|numeric|min:0',
            'longterm_assets_addon.*.label' => 'required',
            'longterm_assets_addon.*.value' => 'nullable|numeric|min:0',
            'current_liabilities_default.*.value' => 'nullable|numeric|min:0',
            'current_liabilities_addon.*.label' => 'required',
            'current_liabilities_addon.*.value' => 'nullable|numeric|min:0',
            'longterm_liabilities_default.*.value' => 'nullable|numeric|min:0',
            'longterm_liabiilties_addon.*.label' => 'required',
            'longterm_liabilities_addon.*.value' => 'nullable|numeric|min:0',
        ];
    }
}
