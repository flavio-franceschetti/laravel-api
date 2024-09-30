<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class StoreProjectRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //qui tutte le regole di validazione del form
        return [
            'name' => 'required|string|max:100|min:3',
            'description' => 'required|string|min:10',
            'status' => 'required',
            'github' => 'string|max:255',
            // controllo che l'id presente nella tabella project esista realmente nella rabella types
            'type_id' => 'exists:types,id|nullable',
            'technologies' => 'exists:technologies,id',
            'image_path' => 'image|max:5120|mimes:png,jpg'
        ];

    }

    public function messages()
    {
        // qui tutti i messaggi di errore nel caso non vengano rispettate alcune regole sopra
        return[
            'name.required' => 'Il nome è un campo obbligatorio',
            'name.string' => 'Il nome deve essere una stringa',
            'name.max' => 'Il nome deve avere massimo :max caratteri',
            'name.min' => 'Il nome deve avere minimo :min caratteri',
            'description.required' => 'La descrizione è obbligatoria',
            'description.string' => 'La descrizione deve essere una stringa',
            'description.min' => 'La descrizione deve avere almeno :min caratteri',
            'status.required' => 'Lo status del progetto è obbligatorio',
            'github.string' => 'Deve essere un link a github',
            'github.max' => 'Deve avere massimo :max caratteri',
        ];
    }
}
