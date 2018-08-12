<?php

namespace Tests\Unit;

use App\Repositories\Scale as Repository;
use App\Services\Converter\Fahrenheit;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConverterServiceTest extends TestCase
{
    use DatabaseTransactions;

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
}
