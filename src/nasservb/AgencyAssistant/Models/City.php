<?php

namespace nasservb\AgencyAssistant\Models;

class City
{
    /**@var string name of city **/
    private $name = '';

    /** @var int id */
    private $id = 0 ;

    /**
     * CityService constructor.
     * @param string $name
     * @param int $id
     */
    public function __construct($name ,$id)
    {
        $this->id = $id;
        $this->name = $name;
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



}