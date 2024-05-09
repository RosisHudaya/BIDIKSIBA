<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaudaraRequest extends FormRequest
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
        $id = $this->route('saudara')->id;
        return [
            'saudara' => 'required|unique:saudaras,saudara,' . $id,
            'nilai' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'saudara.required' => 'Form saudara tidak boleh kosong',
            'saudara.unique' => 'Saudara sudah digunakan sebelumnya',
            'nilai.required' => 'Form nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
        ];
    }
}
