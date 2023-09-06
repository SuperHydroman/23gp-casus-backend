<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'driver_id' => 'nullable|distinct|integer|exists:results',
            'sector_1' => 'required|decimal:3|min:0|not_in:0',
            'sector_2' => 'required|decimal:3|min:0|not_in:0',
            'sector_3' => 'required|decimal:3|min:0|not_in:0',
            'lap_total' => 'nullable|string|date_format:i:s.v',
        ];
    }
}
