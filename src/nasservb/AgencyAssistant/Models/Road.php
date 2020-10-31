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
     * RoadService constructor.
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
     * @return int
     */
    public function getFrom()
    {
        return $this->from;
    }


    /**
     * @return int
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return array
     */
    public function getThrough()
    {
        return $this->through;
    }


    /**
     * @return int
     */
    public function getSpeedLimit()
    {
        return $this->speed_limit;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }


    /**
     * @return boolean
     */
    public function getBiDirectional()
    {
        return (bool)$this->bi_directional;
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

        $s = (int)$time;
        return sprintf('%d:%02d:%02d', $s/86400, $s/3600%24, $s/60%60);
    }



}
