<?php

namespace App\Http\Requests\Like;

use Illuminate\Foundation\Http\FormRequest;

class ToggleLikesRequest extends FormRequest
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
            'id' => 'required|numeric',
            'model' => 'required|regex:/^[A-Z]{1}[a-z]{1,}::class$/',
        ];
    }
}
