<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('it_IT');

        DB::table('users')->insert([
            'name' => 'bebras',
            'email' => 'bebras@gmail.com',
            'password' => Hash::make('123'),
        ]);

        // $titles = [
        //     'Dienos nuotykiai',
        //     'Menulis',
        //     'Vaivoryste',
        //     'Kapitono parduotuve',
        //     'Azuolo takas',
        //     'Baltas paukstis'
        // ];

        $types = [
            'Marskinia',
            'Suba',
            'Kelnes',
            'Kojines',
            'Megztinis',
            'Striuke'
        ];

        $colors = [
            'Balta',
            'Juoda',
            'Zalia',
            'Raudona',
            'Melyna',
            'Violetine'
        ];

        $names = [
            'Dave',
            'John',
            'Oleg',
            'Will',
            'Drew',
            'Sasha'
        ];

        $surnames = [
            'Shakespear',
            'Bulgakov',
            'Tolstoj',
            'Dostoevskij',
            'Gorkij',
            'Efremov'
        ];


        $brands = [
            'Nike',
            'Gucci',
            'H&M',
            'Adidas',
            'Puma',
            'Bulgari'
        ];

        foreach (range(1, 20) as $_) {
            $name = $faker->firstName;
            $surname = $faker->lastName;

            DB::table('authors')->insert([
                'name' => $name,
                'surname' => $surname,
                'photo' => rand(0, 4) ? $faker->imageUrl(200, 250, $name . $surname, false) : null
            ]);
        }

        foreach (range(1, 10) as $_) {

            $title = $faker->company;

            DB::table('brands')->insert([
                'title' => $title,
                'logo' => $faker->imageUrl(100, 120, $title, false)
            ]);
        }

        foreach (range(1, 100) as $_) {
            DB::table('books')->insert([
                'title' => $faker->realText(rand(10, 30), 1),
                'isbn' => $faker->isbn13,
                'pages' => rand(10, 200),
                'about' => $faker->realText(rand(100, 200), rand(1, 4)),
                'author_id' => rand(1, 20)
            ]);
        }

        foreach (range(1, 100) as $id) {
            if (!rand(0, 4)) {
                continue;
            }
            $main = true;
            foreach (range(1, rand(1, 8)) as $_) {
                DB::table('book_photos')->insert([
                    'photo' => $faker->imageUrl(200, 250, 'Id: ' . $id, false),
                    'book_id' => $id,
                    'main' => $main ? 1 : null
                ]);
                $main = false;
            }
        }



        foreach (range(1, 100) as $_) {
            DB::table('outfits')->insert([
                'type' => $types[rand(0, count($types) - 1)],
                'color' => $faker->colorName,
                'price' => rand(5, 100) + (rand(1, 99) / 100),
                'discount' => rand(0, 5) + (rand(1, 99) / 100),
                'brand_id' => rand(1, 10)
            ]);
        }
        foreach (range(1, 100) as $id) {
            if (!rand(0, 4)) {
                continue;
            }
            $main = true;
            foreach (range(1, rand(1, 8)) as $_) {
                DB::table('outfit_photos')->insert([
                    'photo' => $faker->imageUrl(200, 250, 'Id: ' . $id, false),
                    'outfit_id' => $id,
                    'main' => $main ? 1 : null
                ]);
                $main = false;
            }
        }

        foreach (range(1, 15) as $_) {
            DB::table('tags')->insert([
                'name' => $faker->streetName,
            ]);
        }
    }
}
