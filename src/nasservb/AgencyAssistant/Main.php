<?php

namespace nasservb\AgencyAssistant;

use nasservb\AgencyAssistant\Actions\Add;
use nasservb\AgencyAssistant\Actions\Delete;
use nasservb\AgencyAssistant\Actions\Search;
use nasservb\AgencyAssistant\Helpers\Input;

class Main
{
    use Input;
    /**
     * start of the application is here !
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
