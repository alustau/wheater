<?php

use App\Models\Scale;
use Illuminate\Database\Seeder;

class AddScalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scales = [
            [
                'name'             => 'Kelvin',
                'formula'          => 'x',
                'formula_rollback' => 'x'
            ],
            [
                'name'             => 'Fahrentheit',
                'formula'          => '(x + 459.67) / 1.8',
                'formula_rollback' => '(x * 1.8) - 459.889'
            ],
            [
                'name'             => 'Celsius',
                'formula'          => 'x + 273.15',
                'formula_rollback' => 'x - 273.15'
            ]
        ];

        foreach ($scales as $scale) {
            Scale::create($scale);
        }
    }
}
