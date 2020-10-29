<?php

namespace nasservb\AgencyAssistant\Actions;

use nasservb\AgencyAssistant\Models\City;
use nasservb\AgencyAssistant\Models\Road;

class Search
{

    /**
     * handle search city to city menu
     */
    public static function Search()
    {
        $path = readline();
        $pathData = explode(':', $path);
        $fromCity = City::getById($pathData[0]);
        $toCity = City::getById($pathData[1]);

        $road = Road::getShortestPath($fromCity->getId(), $toCity->getId());
        echo $fromCity->getName() . ':' . $toCity->getName() . ' via Road ' .
            $road->getName() . ': Takes ' . $road->calculateTime();
    }

}