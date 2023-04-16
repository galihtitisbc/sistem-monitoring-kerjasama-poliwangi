<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahKerjasamaRequest extends FormRequest
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
            'mou'               =>  'required|mimes:docx,pdf',
            'nomor_mou'         =>  'required'
        ];
    }
}
