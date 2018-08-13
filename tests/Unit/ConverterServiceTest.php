<?php

namespace Tests\Unit;

use App\Exceptions\Converter\ConverterNotFoundException;
use App\Repositories\Scale as Repository;
use App\Services\Converter\Factory;
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
        $celsius = (new Repository)->get('Celsius');

        $service = new Fahrenheit;

        $fahrenheit = $service->convert($celsius, 23);

        $this->assertEquals(73.181, $fahrenheit);
    }

    /**
     * @test
     */
    public function convert_kelvin_to_celsius()
    {
        $kelvin = (new Repository)->get('Kelvin');

        $service = new Celsius;

        $celsius = $service->convert($kelvin, 296.15);

        $this->assertEquals(23, $celsius);
    }

    /**
     * @test
     */
    public function convert_kelvin_to_fahrenheit()
    {
        $kelvin = (new Repository)->get('Kelvin');

        $service = new Fahrenheit;

        $fahrenheit = $service->convert($kelvin, 296.15);

        $this->assertEquals(73.181, $fahrenheit);
    }

    /**
     * @test
     */
    public function temperature_returned_by_formula()
    {
        $kelvin = (new Repository)->get('Kelvin');

        $this->assertEquals(273.15, Formula::apply($kelvin->formula(), 273.15));
    }

    /**
     * @test
     */
    public function instance_of_return_of_factory()
    {
        $converter = (new Factory)->converter('Celsius');

        $this->assertInstanceOf(Celsius::class, $converter);
    }

    /**
     * @test
     */
    public function exception_when_converter_doesnt_exist()
    {
        $this->expectException(ConverterNotFoundException::class);

        (new Factory)->converter('Newton');
    }
}
