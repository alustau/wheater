<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Prediction as Model;
use App\Models\PredictionTime;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\Prediction as PredictionRepository;

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
        $city  = factory(City::class)->create(['name' => 'Amsterdam']);
        $city2 = factory(City::class)->create(['name' => 'João Pessoa']);

        factory(Model::class, 3)->create(['city_id' => $city->id]);
        factory(Model::class, 2)->create(['city_id' => $city2->id]);

        $predictions = $this->repository->getAllByCityName('Amsterdam');

        $this->assertCount(3, $predictions);
    }

    /**
     * @test
     * @return void
     */
    public function count_time_in_a_prediction()
    {
        $prediction = factory(Model::class)->create();

        factory(PredictionTime::class, 5)->create(['prediction_id' => $prediction->id]);

        $predictions = $this->repository->getAllByCityName($prediction->city->name);

        $this->assertCount(5, $predictions->first()->times);
    }
}
