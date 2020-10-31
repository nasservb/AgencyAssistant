<?php

namespace Tests\Unit;

use nasservb\AgencyAssistant\Services\CityService;
use nasservb\AgencyAssistant\Services\RoadService;
use nasservb\AgencyAssistant\Models\City;
use nasservb\AgencyAssistant\Models\Road;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    /**
     * @test
     */
    public function testDirectPath()
    {
        $city1 = new City('Tehran', 1);
        $city2 = new City('Qazvin', 2);
        $city3 = new City('Hamedan', 3);
        $city4 = new City('Kerman', 4);

        CityService::addCity($city1);
        CityService::addCity($city2);
        CityService::addCity($city3);
        CityService::addCity($city4);

        $road1 = new Road(1,
            'west',
            $city1->getId(),
            $city3->getId(),
            [$city1->getId(), $city2->getId()],
            110,
            330,
            0
        );

        $road2 = new Road(2,
            'south',
            $city1->getId(),
            $city4->getId(),
            [$city1->getId()],
            120,
            700,
            0
        );

        RoadService::addRoad($road1);
        RoadService::addRoad($road2);

        $road = RoadService::getShortestPath($city1->getId(), $city2->getId());

        $this->assertEquals($road->getId(), $road1->getId());

        $road = RoadService::getShortestPath($city2->getId(), $city3->getId());
        $this->assertEquals($road->getId(), $road1->getId());


        $road = RoadService::getShortestPath($city1->getId(), $city4->getId());
        $this->assertEquals($road->getId(), $road2->getId());

        $road = RoadService::getShortestPath($city3->getId(), $city4->getId());
        $this->assertEquals(null, $road);


    }

    /**
     * @test
     */
    public function testBidirectionalPath()
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
            [$city1->getId(),$city2->getId()],
            80,
            450,
            1
        );

        RoadService::addRoad($road1);

        $road = RoadService::getShortestPath($city3->getId(), $city2->getId());
        $this->assertEquals($road->getId(), $road1->getId());


    }
}