<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryan
 * Date: 2/10/12
 * Time: 3:35 PM
 * To change this template use File | Settings | File Templates.
 */

/*
 * This file contains the rewrites for the original classes, as they very badly needed a redesign. -R
 * The original object model was, unfortunately, slightly flawed. However, fixing it should only take a few hours of thinking,
 * provided I can do that. Most of the original code, however, need only be repackaged.
 *
 * I think I'll rederive the interactions between the various interfaces before proceeding further.
 *
 *
 */


    //TSBuilder -> class for building a Timestamp. Debating whether I need this one.
    class TSBuilder {

        const Year = "Year";
        const Month = "Month";
        const Week = "Week";
        const Day = "Day";
        const Hour = "Hour";
        const Second = "Second";


        // Create a new timestamp in a sane way.
        public function __construct() {


        }




    }

    // TSInfoExtractor -> going to play around with this one. I'm splitting the former Helper class into two, so it better differentiates various functions.
    class TSInfoExtractor {

        const DayOfTheWeek_toString = "DayOfTheWeek_toString";

        // Extract information from a timestamp.
        public static function Extract($timestamp, $arg) {


            return;
        }




    }

    // CompositeCalendar -> should handle the GUI elements of drawing the calendars, plus accept a handful of arguments.
    class CompositeCalendar {
        //@todo: Rebuild this part last, but keep in mind the various arguments / requests it will need to make to other classes. I say last because of the styling / unrelated data structure stuff.
        //@todo: Check if any other HTML / CSS items should be popped off into their own classes. Should not be building a singleton, in case someone wants to extend this eventually. (At least try not to, or think about not doing it). ^_^
        private $CalendarList = Array();


        public function __construct($User) {


        }

        // private $Query = "SELECT [CalendarID] FROM [Calendar] WHERE [Displayed] = 1"; // Prototype new query for selecting calendars for display in the composite calendar object.

    }


    // Calendar -> class for containg user-defined calendars.
    class Calendar {
        private $SQL_ID = "";
        private $CalendarName = "";
        private $SuperFeedList = Array();

        public function __construct() {


        }

    }

    //@todo: Check Fiddler for variant HTTP requests, and confirm the new object model based off of these observations.
    //@todo: Following that, use the new MySQL Query / Table Analyzer to rebuild the sql table model to better specifications.

    // SuperFeed -> class for storing the primary link for the collection of CalDav resources.
    class SuperFeed {
        private $SQL_ID = "";
        private $URL = "";

        private $EventList = Array();


        public function __construct() {


        }
    }

    // Event -> class for storing event information. Due to this redesign, Event will now be handling some of the functions previously found in the Feed class.
    class Event {
        private $URL = "";
        private $ETAG = "";


        public function __construct() {


        }


        public function Update() {


        }

        public function Delete() {

        }

        public function Create() {

        }




    }

    // User -> class for passing around user information. Should only pass around the UserID (a unqiue SQL ID), for security reasons, in a Session object.
    class User {
        private $SQL_ID = "";
        //@todo: Get the User object to actually talk to the other classes. Lol.

        public function __construct($Username, $Password) {


        }

        // Boolean function to tell us if we have a valid user.
        public function IsValid() {
            if($this->SQL_ID != "") {
                return true;
            }
            else {
                return false;
            }

        }

        public function GetUserID() {
            return $this->SQL_ID;

        }

        // private $Query = "SELECT [UserID] FROM [Users] WHERE [Username] = '' AND PASSWORD = '';"; // Prototype User query (for selecting a UserID).


    }



















?>