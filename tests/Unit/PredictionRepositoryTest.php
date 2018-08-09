<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Prediction as Model;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repository\Prediction as PredictionRepository;

class PredictionRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $repository;

    public function setUp()
    {
        parent::setUp();

        $this->repository = new PredictionRepository(new Model);
    }

    /**
     * @test
     * @return void
     */
    public function count_all_predictions_by_city_name()
    {
        $city = factory(City::class)->create(['name' => 'Amsterdam']);
        $city2 = factory(City::class)->create(['name' => 'João Pessoa']);

        factory(Model::class, 3)->create(['city_id' => $city->id]);
        factory(Model::class, 2)->create(['city_id' => $city2->id]);

        $predictions = $this->repository->getAllByCityName('Amsterdam');

        $this->assertCount(3, $predictions);
    }
}
