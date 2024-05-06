<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'name' => 'required|string|max:50',
            'password' => 'required|min:8',
            'user_type' => ['required', Rule::in(['calon-mahasiswa', 'admin-bidiksiba', 'pengawas'])],
        ];

    }

    public function messages()
    {
        return [
            'email.required' => 'Form email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',

            'name.required' => 'Form nama harus diisi.',
            'name.string' => 'Format nama tidak valid.',
            'name.max' => 'Form nama tidak boleh lebih dari :max karakter.',
            'name.regex' => 'Form nama lengkap tidak boleh mengandung angka',

            'password.required' => 'Form password harus diisi.',
            'password.min' => 'Password harus memiliki setidaknya 8 karakter.',

            'user_type.required' => 'Pilih role (Calon Mahasiswa, Admin BIDIKSIBA, atau Pengawas).',
            'user_type.in' => 'Role yang dipilih tidak valid.',
        ];
    }

}
