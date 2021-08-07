<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
              'name' => 'HR'
            ],
            [
              'name' => 'Career Coach'
            ],
            [
              'name' => 'Psikolog'
            ],
            [
              'name' => 'Trainer'
            ],
            [
              'name' => 'Mentor'
            ]
        ];

        Tag::insert($tags);
    }
}
