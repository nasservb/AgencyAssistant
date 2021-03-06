<?php

namespace Tests\Unit;

use nasservb\AgencyAssistant\Services\CityService;
use nasservb\AgencyAssistant\Services\RoadService;
use nasservb\AgencyAssistant\Models\City;
use nasservb\AgencyAssistant\Models\Road;
use PHPUnit\Framework\TestCase;

class  AddTest extends TestCase
{
    /**
     * @test
     */
    public function testAddCity()
    {
        $city1 = new City('Tehran', 1);
        $city2 = new City('Qazvin', 2);
        $city3 = new City('Hamedan', 3);
        $city4 = new City('Kerman', 4);

        CityService::addCity($city1);
        CityService::addCity($city2);
        CityService::addCity($city3);
        CityService::addCity($city4);

        $this->assertEquals(CityService::getById(2)->getId(), $city2->getId());
        $this->assertEquals(CityService::getById(4)->getId(), $city4->getId());

    }

    /**
     * @test
     */
    public function testAddRoad()
    {
        $city1 = new City('Tehran', 1);
        $city2 = new City('Qazvin', 2);
        $city3 = new City('Hamedan', 3);

        CityService::addCity($city1);
        CityService::addCity($city2);
        CityService::addCity($city3);

        $road1 = new Road(1,
            'west',
            $city1->getId(),
            $city3->getId(),
            [$city1->getId(), $city2->getId()],
            110,
            330,
            1
        );

        RoadService::addRoad($road1);

        $this->assertEquals(RoadService::getById(1)->getId(), $road1->getId());

    }
}