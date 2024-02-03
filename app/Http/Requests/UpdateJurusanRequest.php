<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJurusanRequest extends FormRequest
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
        $id = $this->route('jurusan')->id;
        return [
            'jurusan' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:jurusans,jurusan,' . $id
        ];
    }

    public function messages()
    {
        return [
            'jurusan.required' => 'Form jurusan tidak boleh kosong',
            'jurusan.unique' => 'Jurusan sudah digunakan sebelumnya',
            'jurusan.regex' => 'Jurusan tidak boleh mengandung angka dan simbol',
        ];
    }
}
