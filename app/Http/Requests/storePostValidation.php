<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storePostValidation extends FormRequest
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
            'telefoon' => ' required|regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'categorie' => ' required',
            'titel' => ' required|min:5',
            'content' => ' required|min:15',
            'voorwaarden' =>'required',
            'image.*' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2'
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
            'telefoon.required'=>'Vul een telefoon nummer in.',
            'telefoon.regex'=>'Vul een geldig telefoon nummer in.',
            'categorie.required'=>'Kies een categorie.',
            'titel.required'=>'Voer een titel in.',
            'titel.min'=>'Voer een langere titel in dan 5 letters.',
            'content.required'=>'Wat is de beschrijving?',
            'content.min'=>'Een beschrijving kan niet kleiner dan 15 characters zijn.',
            'voorwaarden.required'=>'Ga je akkoord met de Algemene voorwaarden en Privacy statement?',
            'uploaded' => 'zijn te groot en kunnen daarom niet geupload worden.',
        ];
    }
    public function attributes()
    {
        return [
            'image.*.uploaded' => 'Een of meerdere afbeeldingen',
        ];
    }
}
