<?php


namespace nasservb\AgencyAssistant\Services;

use nasservb\AgencyAssistant\Models\City;

class CityService
{
    /**
     * store list of cities
     * @var array
     */
    private static $cities =[];

    /**
     * get city by id
     * @param int $id
     * @return String|null
     */
    public static function getById(int $id)
    {
        return static::$cities[$id] ? static::$cities[$id] : null;
    }

    /**
     * remove city by id
     * @param int $id
     */
    public static function deleteById(int $id)
    {
        unset(static::$cities[$id]);
    }


    /**
     * @param City $city
     */
    public static function addCity(City $city)
    {
        static::$cities[$city->getId()] = $city;
    }
}