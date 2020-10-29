<?php

namespace Tests\Unit;

use nasservb\AgencyAssistant\Models\City;
use nasservb\AgencyAssistant\Models\Road;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @test
     */
    public function testDeleteCity()
    {
        $city1 = new City('Tehran', 1);
        $city2 = new City('Qazvin', 2);
        $city3 = new City('Hamedan', 3);
        $city4 = new City('Kerman', 4);

        $this->assertEquals(City::getById(2)->getId(), $city2->getId());
        City::deleteById(2);

        $this->assertEquals(City::getById(2), null);

        $city2 = new City('Qazvin', 2);
        $this->assertEquals(City::getById(2)->getId(), $city2->getId());

        City::deleteById(2);

        $this->assertEquals(City::getById(2), null);


    }

    /**
     * @test
     */
    public function testDeleteRoad()
    {

        $city1 = new City('Tehran', 1);
        $city2 = new City('Qazvin', 2);
        $city3 = new City('Hamedan', 3);

        $road1 = new Road(1,
            'west',
            $city1->getId(),
            $city3->getId(),
            [$city1->getId(), $city2->getId()],
            110,
            330,
            1
        );

        $this->assertEquals(Road::getById(1)->getId(), $road1->getId());
        Road::deleteById(1);

        $this->assertEquals(Road::getById(1), null);

    }

}