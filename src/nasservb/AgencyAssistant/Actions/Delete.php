<?php

namespace nasservb\AgencyAssistant\Actions;

use nasservb\AgencyAssistant\Models\City;
use nasservb\AgencyAssistant\Models\Road;
use nasservb\AgencyAssistant\Helpers\Input;

class Delete
{
    use Input;

    /**
     * handle delete city menu
     */
    public static function deleteCity()
    {
        $id = static::readNumber();

        $city = City::getById($id);
        if ($city)
        {
            City::deleteById($id);
            echo 'City:'.$id.' deleted!';
        }
        else
        {
            echo 'City with id '.$id.' not found!';
        }
    }

    /**
     * handle delete road menu
     */
    public static function deleteRoad()
    {
        $id = static::readNumber();

        $road = Road::getById($id);
        if ($road)
        {
            Road::deleteById($id);
            echo 'Road:'.$id.' deleted!';
        }
        else
        {
            echo 'Road with id '.$id.' not found!';
        }
    }

}