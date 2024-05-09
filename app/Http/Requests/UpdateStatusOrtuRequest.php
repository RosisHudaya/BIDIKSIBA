<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusOrtuRequest extends FormRequest
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
        $id = $this->route('status_ortu')->id;
        return [
            'status_ortu' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:status_ortus,status_ortu,' . $id,
            'nilai' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'status_ortu.required' => 'Form status orang tua tidak boleh kosong',
            'status_ortu.unique' => 'Status orang tua sudah digunakan sebelumnya',
            'status_ortu.regex' => 'Status orang tua tidak boleh mengandung angka dan simbol',
            'nilai.required' => 'Form nilai tidak boleh kosong',
            'nilai.numeric' => 'Nilai harus berupa angka',
        ];
    }
}
