<?php

namespace Tests\Unit;

use nasservb\AgencyAssistant\Models\City;
use nasservb\AgencyAssistant\Models\Road;
use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    /**
     * @test
     */
    public function testPath()
    {
        $city1 = new City('Tehran', 1);
        $city2 = new City('Qazvin', 2);
        $city3 = new City('Hamedan', 3);
        $city4 = new City('Kerman', 4);

        $road1 = new Road(1,
            'west',
            $city1->getId(),
            $city3->getId(),
            [$city1->getId(), $city2->getId()],
            110,
            330,
            1
        );

        $road2 = new Road(2,
            'south',
            $city1->getId(),
            $city4->getId(),
            [$city1->getId()],
            120,
            700,
            1
        );

        $road = Road::getShortestPath($city1->getId(), $city2->getId());
        $this->assertEquals($road->getId(), $road1->getId());

        $road = Road::getShortestPath($city2->getId(), $city3->getId());
        $this->assertEquals($road->getId(), $road1->getId());


        $road = Road::getShortestPath($city1->getId(), $city4->getId());
        $this->assertEquals($road->getId(), $road2->getId());

        $road = Road::getShortestPath($city3->getId(), $city4->getId());
        $this->assertEquals(null, $road);

    }
}