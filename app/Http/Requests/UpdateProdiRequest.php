<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProdiRequest extends FormRequest
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
        $id = $this->route('program_studi')->id;
        return [
            'id_jurusan' => 'required',
            'prodi' => 'required|regex:/^[a-zA-Z0-9\s]+$/u|unique:prodis,prodi,' . $id
        ];
    }

    public function messages()
    {
        return [
            'id_jurusan.required' => 'Form jurusan tidak boleh kosong',
            'prodi.required' => 'Form program studi tidak boleh kosong',
            'prodi.unique' => 'Program studi sudah digunakan sebelumnya',
            'prodi.regex' => 'Program studi tidak boleh mengandung simbol',
        ];
    }
}
