<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [
            'Dienos nuotykiai',
            'Menulis',
            'Vaivoryste',
            'Kapitono parduotuve',
            'Azuolo takas',
            'Baltas paukstis'
        ];
        foreach (range(1, 50) as $_) {
            DB::table('books')->insert([
                'title' => $titles[rand(0, count($titles) - 1)],
                'isbn' => Str::random(20),
                'pages' => rand(10, 200),
                'about' => Str::random(rand(20, 80))
            ]);
        }
    }
}
