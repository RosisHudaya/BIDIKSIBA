<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAsalJurusanRequest extends FormRequest
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
            'asal_jurusan' => 'required|unique:asal_jurusans,asal_jurusan|regex:/^[a-zA-Z\s()]+$/u'
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
