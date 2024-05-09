<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKamarMandiRequest extends FormRequest
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
        $id = $this->route('kamar_mandi')->id;
        return [
            'kamar_mandi' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:kamar_mandis,kamar_mandi,' . $id,
            'nilai' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'kamar_mandi.required' => 'Form kamar mandi tidak boleh kosong',
            'kamar_mandi.unique' => 'Kamar mandi sudah digunakan sebelumnya',
            'kamar_mandi.regex' => 'Kamar mandi tidak boleh mengandung angka dan simbol',
            'nilai.required' => 'Form nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
        ];
    }
}
