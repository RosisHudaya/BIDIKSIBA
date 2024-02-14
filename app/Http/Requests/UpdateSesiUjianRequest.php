<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSesiUjianRequest extends FormRequest
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
        $id = $this->route('sesi_ujian')->id;
        return [
            'id_ujian' => 'required',
            'nama_sesi' => 'required|unique:sesi_ujians,nama_sesi,' . $id,
            'waktu_mulai' => 'required',
            'waktu_akhir' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_ujian' => 'Form ujian tidak boleh kosong',
            'nama_sesi.required' => 'Form sesi ujian tidak boleh kosong',
            'nama_sesi.unique' => 'Sesi ujian ini sudah digunakan sebelumnya',
            'waktu_mulai' => 'Form waktu mulai tidak boleh kosong',
            'waktu_akhir' => 'Form waktu selesai tidak boleh kosong',
        ];
    }
}
