<?php

namespace nasservb\AgencyAssistant\Actions;

use nasservb\AgencyAssistant\Models\City;
use nasservb\AgencyAssistant\Models\Road;
use nasservb\AgencyAssistant\Helpers\Input;
use nasservb\AgencyAssistant\Menu;

class Add
{
    use Input;

    /**
     * handle add road menu
     */
    public static function addRoad()
    {
        $exit = false;
        while (!$exit) {
            $id = static::readNumber('id=?');
            $name = readline('name=?');
            $from = readline('from=?');
            $to = readline('to=?');
            $throughValue = readline('through=?');
            $throughValue = str_replace(['[', ']'], '',trim( $throughValue));
            $through = explode($throughValue, ',');
            $speed_limit = readline('speed_limit=?');
            $length = readline('length=?');
            $bi_directional = readline('bi_directional=?');
            $road = new Road($id, $name, $from, $to, $through, $speed_limit, $length, $bi_directional);
            echo 'Road with id=' . $road->getId() . ' added!';

            echo Menu::getAfterRoadMenu();
            $number = static::readNumber();
            $exit = $number == 2;
        }
    }

    /**
     * handle add city menu
     */
    public static function addCity()
    {
        $exit = false;
        while (!$exit) {
            $id = static::readNumber('id=?');
            $name = readline('name=?');
            $city = new City($name, $id);
            echo 'City with id=' . $city->getId() . ' added!';

            echo Menu::getAfterCityMenu();
            $number = static::readNumber();
            $exit = $number == 2;
        }
    }


}