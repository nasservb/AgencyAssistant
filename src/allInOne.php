<?php

/**
 * road Model
 * Class Road
 */
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

        $s = (int)$time;
        return sprintf('%d:%02d:%02d', $s/86400, $s/3600%24, $s/60%60);

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

            if ( ($road->bi_directional == 0) &&
                ($road->from == $from || in_array($from, $road->through)) &&
                ($road->to == $to || in_array($to, $road->through))) {
                
                
                if (in_array($from, $road->through) &&  in_array($to, $road->through))
                {
                  if (strpos(implode(',',$road->through), $from)< strpos(implode(',',$road->through), $to))
                    $containRoad[$road->calculateTime()] = $road;
                }
                else 
                {
                   $containRoad[$road->calculateTime()] = $road;
                }
                
            }
            elseif ( ($road->bi_directional == 1) &&
                ( ($road->from == $from || in_array($from, $road->through)) &&
                ($road->to == $to || in_array($to, $road->through)))
            ||
                ( ($road->from ==$to  || in_array($to, $road->through)) &&
                    ($road->to == $from || in_array($from, $road->through)))

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

/**
 * city Model
 * Class City
 */
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
    public static $cities =[];

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


class Menu
{
    public static function getMainMenu()
    {
        return "Main Menu - Select an action:\n" .
            "1. Help\n" .
            "2. Add\n" .
            "3. Delete\n" .
            "4. Path\n" .
            "5. Exit\n";
    }

    public static function getInvalidMenu()
    {
        return "Invalid input. Please enter 1 for more info.\n";
    }

    public static function getHelpMenu()
    {
        return "Select a number from shown menu and enter. For example 1 is for help.\n";
    }

    public static function getModelMenu()
    {
        return "Select model:\n" .
            "1. City\n" .
            "2. Road\n";
    }

    public static function getAfterCityMenu()
    {
        return "Select your next action\n" .
            "1. Add another City\n" .
            "2. Main Menu\n";
    }

    public static function getAfterRoadMenu()
    {
        return "Select your next action\n" .
            "1. Add another Road\n" .
            "2. Main Menu\n";
    }

}

trait Input{

    /**
     * read number from terminal
     * @param null $prompt
     * @return int
     */
    public static  function readNumber($prompt = null ): int
    {
        while (true) {
            $number = readline($prompt);
            if (!is_numeric($number))
                echo Menu::getInvalidMenu();
            else
                return $number;
        }

    }
}

/**
 * for handling add actions
 * Class Add
 */
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
            $throughValue = str_replace(['[', ']'], '', trim($throughValue));
            $through = explode(',',$throughValue);
            $speed_limit = readline('speed_limit=?');
            $length = readline('length=?');
            $bi_directional = readline('bi_directional=?');
            $road = new Road($id, $name, $from, $to, $through, $speed_limit, $length, $bi_directional);
            echo 'Road with id=' . $road->getId() . " added!\n";

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
            echo 'City with id=' . $city->getId() . " added!\n";

            echo Menu::getAfterCityMenu();
            $number = static::readNumber();
            $exit = $number == 2;
        }
    }
}

/**
 * for handling delete actions
 * Class Delete
 */
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
            echo 'City:'.$id." deleted!\n";
        }
        else
        {
            echo 'City with id '.$id." not found!\n";
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
            echo 'Road:'.$id." deleted!\n";
        }
        else
        {
            echo 'Road with id '.$id." not found!\n";
        }
    }

}

/**
 * for handling search actions
 * Class Search
 */
class Search
{

    /**
     * handle search city to city menu
     */
    public static function processSearch()
    {
        $path = readline();
        $pathData = explode(':', $path);
        $fromCity = City::getById((int)$pathData[0]);
        $toCity = City::getById((int)$pathData[1]);

        $road = Road::getShortestPath($fromCity->getId(), $toCity->getId());

	if ($road)
          echo $fromCity->getName() . ':' . $toCity->getName() . ' via Road ' .
            	$road->getName() . ': Takes ' . $road->calculateTime()."\n";
    }

}

/**
 * handle application main menu
 * Class Main
 */
class Main
{
    use Input;
    /**
     * start of application is here !
     */
    public static function Start()
    {
        while (true) {
            echo Menu::getMainMenu();
            $number = static::readNumber();
            static::processMainMenu($number);
        }
    }

    /**
     * process main menu
     * @param $number
     */
    public static function processMainMenu($number)
    {
        switch ($number) {
            case 1: //help
                echo Menu::getHelpMenu();
                break;
            case 2 : //add
                echo Menu::getModelMenu();
                $number = static::readNumber();
                if ($number == 1) {
                    Add::addCity();
                } elseif ($number == 2) {
                    Add::addRoad();
                } else {
                    echo Menu::getInvalidMenu();
                }
                break;
            case 3 : //Delete
                echo Menu::getModelMenu();
                $number = static::readNumber();
                if ($number == 1) {
                    Delete::deleteCity();
                } elseif ($number == 2) {
                    Delete::deleteRoad();
                } else {
                    echo Menu::getInvalidMenu();
                }
                break;
            case 4 : //Path
                Search::processSearch();
                break;
            case 5:
                exit(0);
                break;
        }
    }
}

Main::Start();
