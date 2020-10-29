<?php

namespace nasservb\AgencyAssistant\Models;

class City
{
    /**@var string name of city **/
    private $name = '';

    /** @var int id */
    private $id = 0 ;

    /**
     * City constructor.
     * @param string $name
     * @param int $id
     */
    public function __construct($name ,$id)
    {
        $this->id = $id;
        $this->name = $name;
        static::setCity($id, $this);
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


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
    public static function getById(int $id):?City
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
     * @param int $id
     * @param City $name
     */
    public static function setCity(int $id,City $city)
    {
        static::$cities[$id] = $city;
    }
}