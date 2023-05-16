<?php

namespace Database\Factories;

use App\Models\Kerjasama;
use Illuminate\Database\Eloquent\Factories\Factory;

class KerjasamaFactory extends Factory
{
    protected $model = Kerjasama::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user'       =>  1,
            'id_kategori'   =>  rand(1, 5),
            'nama_instansi' =>  $this->faker->name,
            'nomor_mou'     => $this->faker->phoneNumber,
            'file_mou'     => $this->faker->phoneNumber,
            'jenis_kegiatan'    =>  $this->faker->paragraph(1),
            'manfaat'           =>  $this->faker->paragraph(1),
            'implementasi'      =>  $this->faker->paragraph(1),
            'tgl_mulai'         =>  $this->faker->date('Y-m-d'),
            'tgl_berakhir'      =>  $this->faker->date('Y-m-d', 'now'),
            'created_at'        =>  $this->faker->dateTimeBetween(),
        ];
    }
}
