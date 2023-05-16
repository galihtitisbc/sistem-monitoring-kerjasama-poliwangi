<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKerjasamaRequest extends FormRequest
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
            'nama_instansi'     => 'required',
            'jenis_kegiatan'    => 'required',
            'manfaat'           => 'required',
            'tgl_mulai'         => 'required|date|before:tgl_berakhir',
            'tgl_berakhir'      => 'required|date',
            'prodi'             => 'required',
            'kategori'          => 'required',
            'hard_file'          => 'required',
            'implementasi'      => 'required',
            'mou'               =>  'sometimes|nullable|mimes:docx,pdf',
            'nomor_mou'         =>  'required',
            'nomor_mou_old'         =>  'required',
            'file_mou'         =>  'required'
        ];
    }
}
