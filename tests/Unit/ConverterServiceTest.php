<?php

namespace Tests\Unit;

use App\Repositories\Scale as Repository;
use App\Services\Converter\Type\Celsius;
use App\Services\Converter\Type\Fahrenheit;
use App\Services\Converter\Formula;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConverterServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function convert_celsius_to_fahrenheit()
    {
        $scale = (new Repository)->get('Celsius');

        $service = new Fahrenheit;

        $fahrenheit = $service->convert($scale, 23);

        $this->assertEquals(73.181, $fahrenheit);
    }

    /**
     * @test
     */
    public function convert_kelvin_to_celsius()
    {
        $scale = (new Repository)->get('Kelvin');

        $service = new Celsius;

        $celsius = $service->convert($scale, 296.15);

        $this->assertEquals(23, $celsius);
    }

    /**
     * @test
     */
    public function convert_kelvin_to_fahrenheit()
    {
        $scale = (new Repository)->get('Kelvin');

        $service = new Fahrenheit;

        $fahrenheit = $service->convert($scale, 296.15);

        $this->assertEquals(73.181, $fahrenheit);
    }

    /**
     * @test
     */
    public function temperature_returned_by_formula()
    {
        $scale = (new Repository)->get('Kelvin');

        $this->assertEquals(273.15, Formula::apply($scale->formula(), 273.15));
    }
}
