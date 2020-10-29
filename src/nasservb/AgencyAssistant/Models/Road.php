<?php


namespace nasservb\AgencyAssistant\Models;

class Road
{
    /**
     *    int - عدد صحیح مثبت
     * @var int
     */
    private $id = 0;

    /**
     *    string - یک رشته متشکل از حروف و اعداد
     * @var string
     */
    private $name = '';

    /**
     *    int - شماره شهر شروع جاده
     * @var int
     */
    private $from;

    /**
     * int - شماره شهر پایان جاده
     * @var int
     */
    private $to;

    /**
     *    list of int - یک لیست از شماره شهرهایی که در بین مسیر وجود دارد به ترتیب دیده شدن
     * @var array
     */
    private $through = null;

    /**
     * int - محدودیت سرعت
     * @var int
     */
    private $speed_limit = 0;

    /**
     *    int - طول مسیر
     * @var int
     */
    private $length = 0;

    /**
     * 0 or 1 - نشان دهنده دوطرفه بودن یا نبودن مسیر
     * @var boolean
     */
    private $bi_directional = true;

    /**
     * Road constructor.
     * @param int $id
     * @param string $name
     * @param int $from
     * @param int $to
     * @param array $through
     * @param int $speed_limit
     * @param int $length
     * @param boolean $bi_directional
     */
    public function __construct($id, $name, $from, $to, $through, $speed_limit, $length, $bi_directional)
    {
        $this->id = $id;
        $this->name = $name;
        $this->from = $from;
        $this->to = $to;
        $this->through = $through;
        $this->speed_limit = $speed_limit;
        $this->length = $length;
        $this->bi_directional = $bi_directional;

        static::addRoad($this);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return false|string
     */
    public function calculateTime()
    {
        $distance = $this->length;

        /**convert speed from hour to second**/
        $speed = $this->speed_limit / 3600;

        $time = $distance / $speed;

        return gmdate("H:i:s", $time);
    }

    /**
     *
     * Static Functions
     *
     **/

    /**
     * store roads by name
     * @var array $roads
     */
    private static $roads = [];

    /**
     * @param int $id
     * @return Road|null
     */
    public static function getById(int $id): ?Road
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
     * @param Road $road
     */
    public static function addRoad(Road $road)
    {
        static::$roads[$road->id] = $road;
    }

    /**
     * @param int $from
     * @param int $to
     * @return Road|null
     */
    public static function getShortestPath(int $from, int $to): ?Road
    {
        //get list of road contain the city in source , target or through
        $containRoad = [];
        foreach (static::$roads as $road) {
            if (($road->from == $from || in_array($from, $road->through)) &&
                ($road->to == $to || in_array($to, $road->through))) {
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