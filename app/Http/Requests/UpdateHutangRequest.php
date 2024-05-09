<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHutangRequest extends FormRequest
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
        $id = $this->route('hutang')->id;
        return [
            'hutang' => 'required|unique:hutangs,hutang,' . $id,
            'nilai' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'hutang.required' => 'Form hutang tidak boleh kosong',
            'hutang.unique' => 'Hutang sudah digunakan sebelumnya',
            'nilai.required' => 'Form nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
        ];
    }
}
