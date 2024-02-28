<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSoalUjianRequest extends FormRequest
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
        $id = $this->route('soalUjian')->id;
        return [
            'gambar' => 'nullable',
            'soal' => 'required|unique:soal_ujians,soal,' . $id,
            'jawaban_a' => 'required|unique:soal_ujians,jawaban_a,' . $id,
            'jawaban_b' => 'required',
            'jawaban_c' => 'required',
            'jawaban_d' => 'required',
            'jawaban_benar' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'soal.required' => 'Form soal tidak boleh kosong',
            'soal.unique' => 'Soal tersebut sudah digunakan sebelumnya',
            'jawaban_a.required' => 'Form jawaban A tidak boleh kosong',
            'jawaban_b.required' => 'Form jawaban B tidak boleh kosong',
            'jawaban_c.required' => 'Form jawaban C tidak boleh kosong',
            'jawaban_d.required' => 'Form jawaban D tidak boleh kosong',
            'jawaban_benar.required' => 'Form jawaban benar tidak boleh kosong',
        ];
    }
}
