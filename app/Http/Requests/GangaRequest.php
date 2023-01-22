<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class GangaRequest extends FormRequest
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
            'title' => 'required|min:5',
            'description' => 'required|min:15',
            'url' => 'required',
            'price' => 'required|min:0',
            'price_sale' => 'required|min:0',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El titol es obligatori',
            'title.min' => 'El titol ha de tindre com a mínim 5 lletres',
            'description.required' => 'El descripció es obligatori',
            'description.min' => 'El descripció ha de tindre com a mínim 15 lletres',
            'url.required' => 'La url de la ganga es obligatoria',
            'price.required' => 'El preu es obligatori',
            'price.min' => 'El preu a de ser un nombre positiu',
            'price_sale.required' => 'El preu es obligatori',
            'price_sale.min' => 'El preu a de ser un nombre positiu',
            'category_id.required' => 'Has de seleccionar una categoria',
            'photo.required' => 'La foto del producte es obligatoria',
        ];
    }
}
