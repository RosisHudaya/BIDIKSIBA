<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGajiOrtuRequest extends FormRequest
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
        $id = $this->route('penghasilan_ortu')->id;
        return [
            'gaji_ortu' => 'required|unique:gaji_ortus,gaji_ortu,' . $id,
            'nilai' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'gaji_ortu.required' => 'Form penghasilan orang tua tidak boleh kosong',
            'gaji_ortu.unique' => 'Penghasilan orang tua sudah digunakan sebelumnya',
            'nilai.required' => 'Form nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
        ];
    }
}
