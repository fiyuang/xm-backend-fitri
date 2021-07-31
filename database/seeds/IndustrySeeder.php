<?php

use Illuminate\Database\Seeder;
use App\Industry;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $industries = [
            [
              'name' => 'Startup Teknologi'
            ],
            [
              'name' => 'Retail & Distribusi'
            ],
            [
              'name' => 'Keuangan'
            ]
        ];

        Industry::insert($industries);
    }
}
