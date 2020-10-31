<?php


namespace nasservb\AgencyAssistant\Services;

use nasservb\AgencyAssistant\Models\Road;

class RoadService
{
    /**
     * store roads by name
     * @var array $roads
     */
    private static $roads = [];

    /**
     * @param int $id
     * @return  Road|null
     */
    public static function getById(int $id)
    {
        return isset(static::$roads[$id]) ? static::$roads[$id] : null;
    }

    /**
     * remove city by id
     * @param int $id
     */
    public static function deleteById(int $id)
    {
        unset(static::$roads[$id]);
    }

    /**
     * add or update road
     * @param RoadService $road
     */
    public static function addRoad(Road $road)
    {
        static::$roads[$road->getId()] = $road;
    }

    /**
     * @param int $from
     * @param int $to
     * @return Road|null
     */
    public static function getShortestPath(int $from, int $to)
    {
        //get list of road contain the city in source , target or through
        $containRoad = [];

        foreach (static::$roads as $road) {

            if (($road->getBiDirectional() == false) &&
                ($road->getFrom() == $from || in_array($from, $road->getThrough())) &&
                ($road->getTo() == $to || in_array($to, $road->getThrough()))) {


                if (in_array($from, $road->getThrough()) && in_array($to, $road->getThrough())) {
                    if (strpos(implode(',', $road->getThrough()), (string)$from) <
                        strpos(implode(',', $road->getThrough()), (string)$to))
                        $containRoad[$road->calculateTime()] = $road;
                } else {
                    $containRoad[$road->calculateTime()] = $road;
                }

            } elseif (($road->getBiDirectional() == true) &&
                (($road->getFrom() == $from || in_array($from, $road->getThrough())) &&
                    ($road->getTo() == $to || in_array($to, $road->getThrough())))
                ||
                (($road->getFrom() == $to || in_array($to, $road->getThrough())) &&
                    ($road->getTo() == $from || in_array($from, $road->getThrough())))

            ) {
                $containRoad[$road->calculateTime()] = $road;
            }

        }

        //sort the list by time
        asort($containRoad);
        //return shortest time
        $road = reset($containRoad);

        return $road ? $road : null;
    }

}