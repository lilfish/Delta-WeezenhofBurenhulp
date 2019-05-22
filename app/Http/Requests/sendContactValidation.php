<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sendContactValidation extends FormRequest
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
            'voornaam' => 'required|min:2|max:255',
            'achternaam' => 'required|min:2|max:255',
            'email' => 'required|email|max:255',
            'gender' => ' required',
            
        ];
    }
    public function messages()
    {
        return [
            'voornaam.required' => 'Vul je voornaam in.',
            'voornaam.min' => 'Vul minimaal 2 characters in',
            'achternaam.min' => 'Vul minimaal 2 characters in',
            'voornaam.max' => 'Een voornaam kan niet zo lang zijn!',
            'achternaam.max' => 'Een achternaam kan niet zo lang zijn!',
            'achternaam.required'  => 'Vul je achternaam in.',
            'email.required' => 'Vul een email in.',
            'email.email'=>'Vul een geldig email in.',
            'email.max'=>'Een email kan niet zo lang zijn!',
            'gender.required'=>'Ben je een man of een vrouw?',
        ];
    }
}
