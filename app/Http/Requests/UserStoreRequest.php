<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
        $user_id = $this->admin ? $this->admin : $this->kasir;
        
        return [
            'email'    => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user_id)],
            'name'     => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
