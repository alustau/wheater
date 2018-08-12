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
                'name'    => 'Kelvin',
                'formula' => '$temperature = x;',
            ],
            [
                'name'    => 'Fahrenheit',
                'formula' => '$temperature = (x + 459.67) / 1.8;',
            ],
            [
                'name'    => 'Celsius',
                'formula' => '$temperature = x + 273.15;',
            ]
        ];

        foreach ($scales as $scale) {
            Scale::create($scale);
        }
    }
}
