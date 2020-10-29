<?php

namespace nasservb\AgencyAssistant;

class Menu
{
    public static function getMainMenu()
    {
        return "Main Menu - Select an action:\n" .
            "1. Help\n" .
            "2. Add\n" .
            "3. Delete\n" .
            "4. Path\n" .
            "5. Exit";
    }

    public static function getInvalidMenu()
    {
        return "Invalid input. Please enter 1 for more info.";
    }

    public static function getHelpMenu()
    {
        return "Select a number from shown menu and enter. For example 1 is for help.";
    }

    public static function getModelMenu()
    {
        return "Select model:\n" .
            "1. City\n" .
            "2. Road";
    }

    public static function getAfterCityMenu()
    {
        return "Select your next action\n" .
            "1. Add another City\n" .
            "2. Main Menu";
    }

    public static function getAfterRoadMenu()
    {
        return "Select your next action\n" .
            "1. Add another Road\n" .
            "2. Main Menu";
    }

}