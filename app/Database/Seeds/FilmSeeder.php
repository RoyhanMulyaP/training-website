<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FilmSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'slug'       => 'the-matrix',
                'judul'      => 'The Matrix',
                'sutradara'  => 'The Wachowskis',
                'synopsis'   => 'Seorang hacker menemukan bahwa dunia yang ia tinggali hanyalah simulasi.',
                'cover'      => 'https://image.tmdb.org/t/p/w500/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'slug'       => 'interstellar',
                'judul'      => 'Interstellar',
                'sutradara'  => 'Christopher Nolan',
                'synopsis'   => 'Perjalanan manusia menembus ruang dan waktu demi kelangsungan umat manusia.',
                'cover'      => 'https://image.tmdb.org/t/p/w500/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'slug'       => 'inception',
                'judul'      => 'Inception',
                'sutradara'  => 'Christopher Nolan',
                'synopsis'   => 'Misi pencurian rahasia melalui mimpi di dalam mimpi.',
                'cover'      => 'https://image.tmdb.org/t/p/w500/9gk7adHYeDvHkCSEqAvQNLV5Uge.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'slug'       => 'parasite',
                'judul'      => 'Parasite',
                'sutradara'  => 'Bong Joon-ho',
                'synopsis'   => 'Kisah dua keluarga dengan latar sosial berbeda yang saling terkait.',
                'cover'      => 'https://image.tmdb.org/t/p/w500/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'slug'       => 'avengers-endgame',
                'judul'      => 'Avengers: Endgame',
                'sutradara'  => 'Russo Brothers',
                'synopsis'   => 'Pertempuran terakhir Avengers untuk menyelamatkan alam semesta.',
                'cover'      => 'https://image.tmdb.org/t/p/w500/ulzhLuWrPK07P1YkdWQLZnQh1JL.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('listfilm')->insertBatch($data);
    }
}
