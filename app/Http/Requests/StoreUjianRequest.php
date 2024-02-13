<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUjianRequest extends FormRequest
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
            'nama_ujian' => 'required|unique:ujians,nama_ujian'
        ];
    }

    public function messages()
    {
        return [
            'nama_ujian.required' => 'Form nama ujian tidak boleh kosong',
            'nama_ujian.unique' => 'Nama ujian sudah digunakan sebelumnya',
        ];
    }
}
