<?php

namespace nasservb\AgencyAssistant;

use nasservb\AgencyAssistant\Actions\Add;
use nasservb\AgencyAssistant\Actions\Delete;
use nasservb\AgencyAssistant\Actions\Search;

class Main
{

    /**
     * start of application is here !
     */
    public function Main()
    {
        while (true) {
            echo Menu::getMainMenu();
            $number = $this->readNumber();
            $this->processMainMenu($number);
        }
    }

    /**
     * process main menu
     * @param $number
     */
    public function processMainMenu($number)
    {
        switch ($number) {
            case 1: //help
                echo Menu::getHelpMenu();
                break;
            case 2 : //add
                echo Menu::getModelMenu();
                $number = $this->readNumber();
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
                $number = $this->readNumber();
                if ($number == 1) {
                    Delete::deleteCity();
                } elseif ($number == 2) {
                    Delete::deleteRoad();
                } else {
                    echo Menu::getInvalidMenu();
                }
                break;
            case 4 : //Path
                Search::Search();
                break;
            case 5:
                exit(0);
                break;
        }
    }


}