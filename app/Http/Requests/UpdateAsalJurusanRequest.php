<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAsalJurusanRequest extends FormRequest
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
        $id = $this->route('asal_jurusan')->id;
        return [
            'asal_jurusan' => 'required|regex:/^[a-zA-Z\s()]+$/u|unique:asal_jurusans,asal_jurusan,' . $id
        ];
    }

    public function messages()
    {
        return [
            'asal_jurusan.required' => 'Form jurusan SMA/SMk tidak boleh kosong',
            'asal_jurusan.unique' => 'Jurusan SMA/SMK sudah digunakan sebelumnya',
            'asal_jurusan.regex' => 'Jurusan SMA/SMK tidak boleh mengandung angka dan simbol (kecuali tanda kurung)',
        ];
    }
}
