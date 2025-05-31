<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Kategori;  // pastikan namespace model sudah benar

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $data = [
                'kategori' => $faker->word,
                'keterangan' => $faker->sentence,
            ];

            Kategori::create($data);
        }
    }
}
