<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBobotRequest extends FormRequest
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
        $id = $this->route('bobot_kriterium')->id;
        return [
            'kriteria' => 'required|regex:/^[a-zA-Z\s]+$/u|unique:bobots,kriteria,' . $id,
            'bobot' => 'required|regex:/^[0-9.]+$/'
        ];
    }

    public function messages()
    {
        return [
            'kriteria.required' => 'Form kriteria tidak boleh kosong',
            'kriteria.unique' => 'Kriteria sudah digunakan sebelumnya',
            'kriteria.regex' => 'Kriteria tidak boleh mengandung angka dan simbol',
            'bobot.required' => 'Form bobot tidak boleh kosong',
            'bobot.regex' => 'Bobot harus berupa angka atau desimal',
        ];
    }
}
