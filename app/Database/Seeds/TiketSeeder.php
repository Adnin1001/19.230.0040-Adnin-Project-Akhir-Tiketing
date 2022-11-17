<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;

class TiketSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('status')->insertBatch([
            [
                'status'      => 'Publish',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'status'      => 'Pending',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'status'      => 'Draft',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ]);

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 1000; $i++) {
            $seed = [
                'nama' => $faker->sentence,
                'nohp' => $faker->name,
                'tglberangkat' => date('Y-m-d H:i:s'),
                'kelasarmada' => $faker->randomElement(['Executive', 'Travel Hiace', 'Micro Bus', 'Pariwisata']),
                'kotatujuan' => $faker->randomElement(['Bandung', 'Jakarta', 'Semarang', 'Purwokerto', 'Tegal']),
                'tiket' => $faker->randomElement(['1', '2', '3']),
                'status_id'   => $faker->randomElement(['1', '2', '3']),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $data[] = $seed;
        }

        $this->db->table('tiket')->insertBatch($data);
    }
}
