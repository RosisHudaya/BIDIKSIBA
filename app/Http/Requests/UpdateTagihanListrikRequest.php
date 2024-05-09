<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagihanListrikRequest extends FormRequest
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
        $id = $this->route('tagihan_listrik')->id;
        return [
            'tagihan_listrik' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:tagihan_listriks,tagihan_listrik,' . $id,
            'nilai' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'tagihan_listrik.required' => 'Form tagihan listrik tidak boleh kosong',
            'tagihan_listrik.unique' => 'Tagihan listrik sudah digunakan sebelumnya',
            'tagihan_listrik.regex' => 'Tagihan listrik tidak boleh mengandung angka dan simbol',
            'nilai.required' => 'Form nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
        ];
    }
}
