<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'reason' => 'required|max:255',
            'amount' => 'required|numeric',
            'detail_reason' => 'required',
        ];
    }

    public function messages(){

        return [
            'reason.required' => 'The reason is required',
            'reason.max:255' => 'The reason is too long',
            'amount.required' => 'The amount is required',
            'amount.numeric' => 'The amount must be a number',

        ];
    }
}
