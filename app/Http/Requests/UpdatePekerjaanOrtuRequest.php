<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePekerjaanOrtuRequest extends FormRequest
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
        $id = $this->route('pekerjaan_ortu')->id;
        return [
            'pekerjaan_ortu' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:pekerjaan_ortus,pekerjaan_ortu,' . $id,
            'nilai' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'pekerjaan_ortu.required' => 'Form pekerjaan orang tua tidak boleh kosong',
            'pekerjaan_ortu.unique' => 'Pekerjaan orang tua sudah digunakan sebelumnya',
            'pekerjaan_ortu.regex' => 'Pekerjaan orang tua tidak boleh mengandung angka dan simbol',
            'nilai.required' => 'Form nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
        ];
    }
}
