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
 * Notes for any future programmer:
 * 1.) I used Fiddler to debug these HTTP requests (you might want that, if you are running on Windows).
 * 2.) I used PHPStorm (an IDE from JetBrains) after getting fed up with NetBeans. They offer free licenses for Open-Source projects with the appropriate documentation.
 * 3.) I used PHP on IIS on Windows (home machine) for development, and production testing is done with PHP on Apache on an Ubuntu box. Getting PHP configured correctly on IIS takes some effort.
 * 4.) IRC (Internet Relay Chat) is the preferred method to get in touch with Davical's creator (Andrew McMillan). Server: irc.oftc.net, Channel: #davical (reponses can take up to 24-48 hours, but they do respond).
 *     The community here is fairly decent (they won't give you the third-degree for asking questions / not knowing something).
 * 5.) No warranty is offered for any of this code, and you may not sue me. Use at your own risk. ^_^
 * 6.) I used XDebug as my debugger for PHP, having gotten tired of combing through the log files looking for errors (when they actually bother to appear...).
 *     If / when you get tired of the same, take a look at XDebug (it's free). I think it works with even Notepad++ (http://amiworks.co.in/talk/debugging-php-using-xdebug-and-notepad-part-i/) & VIM.
 */

    //@todo: Figure out how to get comments to show up in PhpStorm's Intellisense.
    //TSBuilder -> class for building a Timestamp. Debating whether I need this one.
namespace Time {
    class Time {
        /*
        const Year = "Year";
        const Month = "Month";
        const Week = "Week";
        const Day = "Day";
        const Hour = "Hour";
        const Minute = "Minute";
        const Second = "Second";
        */

        private $timestamp = 0;


        // Create a new timestamp in a sane way.
        public function __construct($timestamp) {
            $this->timestamp = $timestamp;
        }

        public function GetTimestamp() {
            return $this->timestamp;

        }

        public function Years($Years = null) {
            if($Years == null) {
                return date("Y", $this->timestamp);
            }
            else {
                //@todo: Put in a simple loop, to detect the leap years in the calculations.
                $this->timestamp += 365 * 24 * 60 * 60 * $Years; //Leap year possible issue.
            }
        }

        public function Months($Months = null) {
            if($Months == null) {
                return date("m", $this->timestamp);
            }
            else {
                $this->timestamp += 30 * 24 * 60 * 60 * $Months; // Previous month, with the day according to min / max.
            }
        }

        public function Weeks($Weeks = null) {
            if($Weeks == null) {
                return date("h", $this->timestamp);
            }
            else {
                $this->timestamp += 7 * 24 * 60 * 60 * $Weeks;
            }
        }

        public function Days($Days = null) {
            if($Days == null) {
                return date("d", $this->timestamp);
            }
            else {
                $this->timestamp += 24 * 60 * 60 * $Days;
            }
        }

        public function Hours($Hours = null) {
            if($Hours == null) {
                return date("H", $this->timestamp);
            }
            else {
                $this->timestamp += 60 * 60 * $Hours;
            }
        }

        public function Minutes($Minutes = null) {
            if($Minutes == null) {
                return date("i", $this->timestamp);
            }
            else {
                $this->timestamp += 60 * $Minutes;
            }
        }

        public function Seconds($Seconds = null) {
            if($Seconds == null) {
                return date("s", $this->timestamp);
            }
            else {
                $this->timestamp += $Seconds;
            }
        }




    }

    // TSInfoExtractor -> going to play around with this one. I'm splitting the former Helper class into two, so it better differentiates various functions.
    class TimeInfo {

        const NumberOfDaysInMonth = "NumberOfDaysInMonth";
        const DayOfTheWeek = "DayOfTheWeek";
        const Year = "Year";
        const Month = "Month";
        const Week = "Week";
        const Day = "Day";
        const Hour = "Hour";
        const Second = "Second";

        const TimezoneOffset = "TimezoneOffset";

        const String = "String";
        const Integer = "Integer";
        //const Timestamp = "Timestamp";

        // Extract information from a timestamp.
        public static function Extract($timestamp, $arg, $format) {
            //@todo: Finish this. Need to verify that extraction will work properly, and that the design is simplistic.
            switch($arg) {
                case NumberOfDaysInMonth:
                    switch($format) {
                        case String:
                            return date($timestamp, "l");
                            break;
                        case Integer:
                            return date($timestamp, "t");
                            break;
                    }
                    break;
                case DayOfTheWeek:
                    switch($format) {
                        case String:
                            return date($timestamp, "l");
                            break;
                        case Integer:
                            return date($timestamp, "l");
                            break;
                    }
                    break;
                case Year:
                    switch($format) {
                        case String:
                            return date($timestamp, "l");
                            break;
                        case Integer:
                            return date($timestamp, "l");
                            break;
                    }

                    break;
                case Month:
                    switch($format) {
                        case String:
                            return date($timestamp, "F");
                            break;
                        case Integer:
                            return date($timestamp, "n");
                            break;
                    }
                    break;
                case Week:
                    switch($format) {
                        case String:
                            return date($timestamp, "l");
                            break;
                        case Integer:
                            return date($timestamp, "l");
                            break;
                    }
                    break;

                case Day:
                    switch($format) {
                        case String:
                            return date($timestamp, "l");
                            break;
                        case Integer:
                            return date($timestamp, "N");
                            break;
                    }

                    break;
                case Hour:
                    switch($format) {
                        case String:
                            return date($timestamp, "l");
                            break;
                        case Integer:
                            return date($timestamp, "l");
                            break;
                    }

                    break;
                case Second:
                    switch($format) {
                        case String:
                            return date($timestamp, "l");
                            break;
                        case Integer:
                            return date($timestamp, "S");
                            break;
                    }
                    break;
                case TimezoneOffset:
                    switch($format) {
                        case String:
                            return date($timestamp, "Z");
                            break;
                        case Integer:
                            return date($timestamp, "l");
                            break;
                    }
                    break;

            }
            return;
        }




    }
}

namespace Extract {
    class Extract {
        /*
    BEGIN:VCALENDAR
    PRODID:-//Mozilla.org/NONSGML Mozilla Calendar V1.1//EN
    VERSION:2.0
    BEGIN:VTIMEZONE
    TZID:America/New_York
    X-LIC-LOCATION:America/New_York
    BEGIN:DAYLIGHT
    TZOFFSETFROM:-0500
    TZOFFSETTO:-0400
    TZNAME:EDT
    DTSTART:19700308T020000
    RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3
    END:DAYLIGHT
    BEGIN:STANDARD
    TZOFFSETFROM:-0400
    TZOFFSETTO:-0500
    TZNAME:EST
    DTSTART:19701101T020000
    RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11
    END:STANDARD
    END:VTIMEZONE
    BEGIN:VEVENT
    CREATED:20111219T194407Z
    LAST-MODIFIED:20111219T194431Z
    DTSTAMP:20111219T194431Z
    UID:c9bfc6b0-064e-4316-83fe-753db34e67ee
    SUMMARY:New Test
    DTSTART;TZID=America/New_York:20111219T150000
    DTEND;TZID=America/New_York:20111219T160000
    LOCATION:Philadelphia
    DESCRIPTION:Propfind test.
    END:VEVENT
    END:VCALENDAR
        */

        // This function may be unnecessary, but is included for completeness sake.
        public static function GetVCalendar($String) {
            //@todo: Modify this to get everything between VCALENDAR tags.
            $re1='.*?';	# Non-greedy match on filler
            $re2='(BEGIN:VCALENDAR)';
            $re3='(.*?)';
            $re4='(END:VCALENDAR)';	# Non-greedy match on filler
            //$re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {

                //$word1=$matches[1][0];
                $text=$matches[2][0];
                //$word2=$matches[3][0];
                return $text;
            }

        }

        //@todo: Generate and finalize these.

        public static function GetVTimeZone($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(BEGIN:VTIMEZONE)';
            $re3='(.*?)';
            $re4='(END:VTIMEZONE)';	# Non-greedy match on filler
            //$re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {

                //$word1=$matches[1][0];
                $text=$matches[2][0];
                //$word2=$matches[3][0];
                return $text;
            }

        }

        public static function GetDaylight($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(BEGIN:DAYLIGHT)';
            $re3='(.*?)';
            $re4='(END:DAYLIGHT)';	# Non-greedy match on filler
            //$re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {

                //$word1=$matches[1][0];
                $text=$matches[2][0];
                //$word2=$matches[3][0];
                return $text;
            }

        }

        public static function GetStandard($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(BEGIN:STANDARD)';
            $re3='(.*?)';
            $re4='(END:STANDARD)';	# Non-greedy match on filler
            //$re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {

                //$word1=$matches[1][0];
                $text=$matches[2][0];
                //$word2=$matches[3][0];
                return $text;
            }


        }

        public static function GetVEvent($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(BEGIN:VEVENT)';
            $re3='(.*?)';
            $re4='(END:VEVENT)';	# Non-greedy match on filler
            //$re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {

                //$word1=$matches[1][0];
                $text=$matches[2][0];
                //$word2=$matches[3][0];
                return $text;
            }

        }

        public static function GetProdID($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(PRODID)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetVersion($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(VERSION)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetTZID($String) {

            $re1='.*?';	# Non-greedy match on filler
            $re2='(TZID)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }
        }

        public static function GetXLicLocation($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(X-LIC-LOCATION)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetTZOffsetFrom($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(TZOFFSETFROM)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetTZOffsetTo($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(TZOFFSETTO)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetTZName($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(TZNAME)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetRRule($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(RRULE)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetCreated($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(CREATED)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(20111219)';	# YYYYMMDD 1
            $re5='(T)';	# Any Single Character 2
            $re6='(\\d+)';	# Integer Number 1
            $re7='(Z)';	# Any Single Character 3
            $re8='( )';	# Any Single Character 4

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8."/is", $String, $matches))
            {
                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $yyyymmdd1=$matches[3][0];
                $c2=$matches[4][0];
                $int1=$matches[5][0];
                $c3=$matches[6][0];
                $c4=$matches[7][0];

                return strtotime($yyyymmdd1 . $c2 . $int1 . $c3);
            }
        }

        public static function GetLastModified($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(LAST-MODIFIED)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }



        public static function GetDTStamp($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(DTSTAMP)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetUID($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(UID)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetDTStart($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(DTSTART)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetSummary($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(SUMMARY)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetDTEnd($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(DTEND)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetLocation($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(LOCATION)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        //@todo: Verify that this, and all of the above, will work for multiple lines.
        public static function GetDescription($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(DESCRIPTION)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='( )';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }



    }
}

namespace GUI {
    class Event {
        // @todo: Event may be unnecessary, if I use POST. Possibly.
        private $Name = "";
        private $Type = "";
        private $Data = Array();

        public function __construct($Name, $Type, $Data) {
            $this->Name = $Name;
            $this->Type = $Type;
            $this->Data = $Data;

        }

        public function Name() {
            return $this->Name;
        }

        public function Type() {
            return $this->Type;
        }

        public function Data() {
            return $this->Data;
        }

    }

    // Views here.
    class CompositeDropDown {
        private $HTMLName = "CompositeDropDownControl";
        private $CSSClass = "CompositeDropDownControl";
        private $User;

        //@todo: Need to link this to the composite calendar.
        public function __construct($User) {
            $this->User = $User;
            Refresh();
        }

        public function Draw() {
            echo RenderControl();
        }

        private function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";

            $html .= "</DIV>";

            return $html;
        }

        private function GetDefaultViews() {
            $query = "SELECT [DefaultView] FROM [Settings] WHERE [UserID] = '" . $this->User->GetUserID() . "';";
            $data = SQL::DataQuery($query);


            // Lock this down to a single row.
            while($row = mysql_fetch_array($data))
            {
                $this->CalendarList[$row['CalendarName']] = $row['Displayed'];
            }

        }

        public function Refresh() {
           $this->GetDefaultViews();

        }

        // Prototype -> Takes in an HTML element id, plus its associated value. Will have to write something more complete here.
        public function UpdateCallback($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }



        }

        public function EventCallback() {

        }

        public function CSSClass($CSSClass = null) {
            if($CSSClass == null) {
                return $this->CSSClass;
            }
            else {
                $this->CSSClass = $CSSClass;
            }
        }

        public function HTMLName($HTMLName = null) {
            if($HTMLName == null) {
                return $this->HTMLName;
            }
            else {
                $this->HTMLName = $HTMLName;
            }
        }

    }

    //Calendars here.
    class CompositeCheckBox {
        private $User;
        private $CalendarNameList = Array(); //@todo: Use a DataTable here for the information. Should be cleaner.
        private $CalendarDatatable;
        private $HTMLName = "CompositeCheckBoxControl";
        private $CSSClass = "CompositeCheckBoxControl";

        public function __construct($User) {

            $this->User = $User;
            Refresh();
        }


        private function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";

            foreach($this->CalendarNameList as $key => $value) {
                $html .= ""; //@todo: Put name in here.
                $html .= "<INPUT TYPE=\"checkbox\" NAME=\"vehicle\" VALUE=\"Bike\" />";
            }

            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {

            echo RenderControl();

        }

        public function Refresh() {

            $query = "SELECT [CalendarID], [CalendarName], [Displayed] FROM [Calendars] WHERE [UserID] = '" . $this->User->GetUserID() . "';";
            $data = SQL::DataQuery($query);
            $this->CalendarDatatable = new DataTable();
            //$this->CalendarDatatable

            while($row = mysql_fetch_array($data))
            {

                $row['CalendarName'];
                $this->CalendarList[] = $row['Displayed'];
            }

        }

        public function Update($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }



        }

        public function CSSClass($CSSClass = null) {
            if($CSSClass == null) {
                return $this->CSSClass;
            }
            else {
                $this->CSSClass = $CSSClass;
            }
        }

        public function HTMLName($HTMLName = null) {
            if($HTMLName == null) {
                return $this->HTMLName;
            }
            else {
                $this->HTMLName = $HTMLName;
            }
        }


    }

    // CompositeCalendar -> should handle the GUI elements of drawing the calendars, plus accept a handful of arguments.
    class CompositeCalendar {
        //@todo: Rebuild this part last, but keep in mind the various arguments / requests it will need to make to other classes. I say last because of the styling / unrelated data structure stuff.
        //@todo: Check if any other HTML / CSS items should be popped off into their own classes. Should not be building a singleton, in case someone wants to extend this eventually. (At least try not to, or think about not doing it). ^_^
        private $CalendarList = Array();
        private $User;
        private $View = 0;
        const Monthly = 0;
        const Weekly = 1;
        const Daily = 2;

        private static $Days = Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        private static $Times = Array("12 AM" => "12 AM", "1 AM" => "1 AM", "2 AM" => "2 AM", "3 AM" => "3 AM", "4 AM" => "4 AM", "5 AM"=>"5 AM", "6 AM"=>"6 AM",
            "7 AM"=>"7 AM", "8 AM"=>"8 AM", "9 AM"=>"9 AM", "10 AM"=>"10 AM", "11 AM"=>"11 AM", "12 PM"=>"12 PM", "1 PM"=>"1 PM", "2 PM"=>"2 PM",
        "3 PM"=>"3 PM", "4 PM"=>"4 PM", "5 PM"=>"5 PM", "6 PM"=>"6 PM", "7 PM"=>"7 PM", "8 PM"=>"8 PM", "9 PM"=>"9 PM", "10 PM"=>"10 PM", "11 PM"=>"11 PM");

        private $HTMLName = "CompositeCalendarControl";
        private $CSSClass = "CompositeCalendarControl";


        public function __construct($User) {
            $this->User = $User;
            Refresh();

        }

        // @todo: Work on this later. Reading pane functionality should be implemented with this kind of code.
        public function Ajax() {
            //xmlhttp.open("POST","ajax_test.asp",true);
            //xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //xmlhttp.send("fname=Henry&lname=Ford");
            //xmlhttp.responseText;
        }

        // List of Calendar names to display alongside the checkboxes.
        // @todo: Create a separate control for the list of calendars. Potentially.
        // @todo: Create an AJAX-enabled Viewing Pane for selected events on the composite calendar.
        // Make it read only, and have an Edit button that when clicked directs the user to the Edit Event control.
        public function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";

            $html .= RenderView();

            $html .= "</DIV>";

            return $html;

        }

        private function RenderView() {
            switch($this->View) {
                case Monthly:
                    return RenderMonthly();
                    break;
                case Weekly:
                    return RenderWeekly();
                    break;
                case Daily:
                    return RenderDaily();
                    break;
                default:
                    break;
            }

        }

        public function RenderMonthly() {
            $html = "";
            //@todo: Get a list of 5 weeks: the current one, 2 weeks prior, 2 weeks following.
            // "Month + Year:"


            return $html;

        }


        public function RenderWeekly() {
            $html = "";
            //@todo: Get a list of all dates of this week.
            //@todo: Need a static array of the days.
            //@todo: Need a static array of the hours. Maybe.

            //@todo: Add 'Week:' text here.

            //4% for each div, 8% for the column headers.
            //7 days, with row headers -> 100/8 -> 12.5, 7 * 12.5 = 87.5, 13% for, 91%, 9%



            //Refresh button. Upper left.
            $html .= "<DIV CLASS='RefreshButton' style='height:8%;width:9%;z-index:1'>";
            $html .= "</DIV>";

            // Column headers.
            foreach($days as $day) {
            $html .= "<DIV CLASS='ColumnHeader' style='height:8%;width:13%;z-index:1'>";
            $html .= "</DIV>";
            }

            foreach($times as $time) {
            //Row headers.
            $html .= "<DIV CLASS='RowHeader' style='height:4%;width:9%;z-index:1'>";
            $html .= "</DIV>";
            }

            /*
             * Hmm. I need to precalculate the actual html strings, per day, then divide their width according to the number per day.
             * Going to need a function that splits events according to dates...so an event that covers two days can be split into two buttons.
             * if(event > endtime && event < starttime) {$html .= "<button value="" name="" onclick=\"\">"}
             */

            //@todo: Review this design. It should be setup so that I can calculate just how many dates an event will cover, as well as the number of events per day.
            foreach($times as $time) {

                foreach($days as $day) {
                // Rows.
                $html .= "<DIV CLASS='Row' style='height:4%;width:13%;z-index:1'>";
                $html .= "</DIV>";
                }
            }

            return $html;

        }

        public function RenderDaily() {
            $html = "";

            //@todo: "Day:"


            return $html;

        }



        public function Draw() {
            echo RenderControl();
        }

        public function Refresh() {

            $query = "SELECT [CalendarID] FROM [Calendars] WHERE [Displayed] = 1 AND [UserID] = '" . $this->User->GetUserID() . "';";
            $data = SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $this->CalendarList[] = new Calendar($row['CalendarID']);
            }

        }

        public function UpdateCallback($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }



        }

        public function CSSClass($CSSClass = null) {
            if($CSSClass == null) {
                return $this->CSSClass;
            }
            else {
                $this->CSSClass = $CSSClass;
            }
        }

        public function HTMLName($HTMLName = null) {
            if($HTMLName == null) {
                return $this->HTMLName;
            }
            else {
                $this->HTMLName = $HTMLName;
            }
        }


        // private $Query = "SELECT [CalendarID] FROM [Calendar] WHERE [Displayed] = 1"; // Prototype new query for selecting calendars for display in the composite calendar object.

    }

    // Login -> a control to handle the login aspect of things. Will be a GUI control.
    class Login {
        private $User;
        private $HTMLName = "LoginControl";
        private $CSSClass = "LoginControl";
        private $LoginError = false;

        //@todo: Need to remember to check Update() in general, or whatever I am going to call this callback, and to encode / escape / sanitize the SQL inputs to prevent SQL injection attacks.

        public function __construct() {

        }

        private function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "Username:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Username\">";
            $html .= "Password:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Password\">";
            $html .= "<INPUT TYPE=\"submit\" VALUE=\"Login\">";
            if($this->LoginError) {
                $html .= "<BR>";
                $html .= "<SPAN CLASS=\"Error\">Login Error: Please check that your username and password are valid.</SPAN>";
            }
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo RenderControl();
        }

        // Returns boolean, indicating whether a user was successfully validated.
        public function Validate($Username, $Password) {
            $userid = "";
            //@todo: Rewrite this to return a boolean (does a user exist with this username / password?). Potentially safer, though I cannot qualify that right now.
            $query = "SELECT [UserID] FROM [Users] WHERE [Username] = '" . base64_encode($Username) . "' AND [Password] = '" . base64_encode($Password) . "';";
            $data = SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $userid = $row["UserID"];
            }

            if($userid != "") {
                $user = new User($userid);
                return $user;
            }
            else {
                $this->LoginError = true;
                return null;
            }
        }

        public function GetUser() {
            return $this->User;
        }

        public function Refresh() {
            // Included for completeness sake.
            //@todo: Possibly derive a new interface from all of this mess.
        }

        public function UpdateCallback($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }

            if(isset($_POST["Username"]) && isset($_POST["Password"])) {
                $user = Validate($_POST["Username"], $_POST["Password"]);
                if($user != null) {
                    $_SESSION["User"] = $user;
                    \HTTP\HTTPRedirector("calico_compositecalendar.php");
                }
            }

        }

        public function CSSClass($CSSClass = null) {
            if($CSSClass == null) {
                return $this->CSSClass;
            }
            else {
                $this->CSSClass = $CSSClass;
            }
        }

        public function HTMLName($HTMLName = null) {
            if($HTMLName == null) {
                return $this->HTMLName;
            }
            else {
                $this->HTMLName = $HTMLName;
            }
        }


    }


    class CalendarManager {
        private $User;
        private $HTMLName = "CalendarManagerControl";
        private $CSSClass = "CalendarManagerControl";

        public function __construct($User) {
            $this->User = $User;
            Refresh();
        }

        private function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            //@todo: Finish this design. A slight variation on the previous edition, but something easier to programmatically edit (hopefully).
            $html .= "Name:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"name\" />";
            //@todo: Checkboxes to select a calendar, and a button to delete them.
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo RenderControl();
        }

        public function Refresh() {
            //@todo: Pull from database here. Fill with calendars as per the user.
            $query = "SELECT [CalendarName] FROM [Calendars] WHERE [UserID] = '" . $this->User->GetUserID() . "';";
            $data = SQL::DataQuery($query);


            // Lock this down to a single row.
            while($row = mysql_fetch_array($data))
            {
                $this->CalendarList[$row['CalendarName']] = $row['Displayed'];
            }
        }

        public function UpdateCallback($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }
        }

        public function CSSClass($CSSClass = null) {
            if($CSSClass == null) {
                return $this->CSSClass;
            }
            else {
                $this->CSSClass = $CSSClass;
            }
        }

        public function HTMLName($HTMLName = null) {
            if($HTMLName == null) {
                return $this->HTMLName;
            }
            else {
                $this->HTMLName = $HTMLName;
            }
        }

    }

    class SuperFeedManager {
        private $User;
        private $HTMLName = "SuperFeedManagerControl";
        private $CSSClass = "SuperFeedManagerControl";

        public function __construct($User) {
            $this->User = $User;
            Refresh();
        }

        private function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "Feed Username:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"feedusername\" />";
            $html .= "Feed Password:";
            $html .= "<INPUT TYPE=\"password\" NAME=\"feedpassword\" />";
            $html .= "Feed URL:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"feedurl\" />";
            //@todo: Ensure that the feeds are listed below.

            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo RenderControl();
        }

        public function Refresh() {
            //@todo: Pull from database here. Fill with feeds as per the user.
            $query = "SELECT [FeedURL], [FeedUsername], [FeedPassword] FROM [SuperFeeds] WHERE [UserID] = '" . $this->User->GetUserID() . "';";
            $data = SQL::DataQuery($query);


            // Lock this down to a single row.
            while($row = mysql_fetch_array($data))
            {
                //$this->CalendarList[$row['CalendarName']] = $row['Displayed'];
            }

        }

        public function UpdateCallback($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }
        }


        public function CSSClass($CSSClass = null) {
            if($CSSClass == null) {
                return $this->CSSClass;
            }
            else {
                $this->CSSClass = $CSSClass;
            }
        }

        public function HTMLName($HTMLName = null) {
            if($HTMLName == null) {
                return $this->HTMLName;
            }
            else {
                $this->HTMLName = $HTMLName;
            }
        }

    }

    // Going to encapsulate the various pages in the previous version into GUI controls. Going full .NET on this one. ;-)
    class EventEditor {
        private $Event;
        private $HTMLName = "EventEditorControl";
        private $CSSClass = "EventEditorControl";

        public function __construct($Event = null) {
            //@todo: Put in logic here or elsewhere to deal with null Event (Create Event, essentially).
            $this->Event = $Event;
            Refresh();
        }

        private function RenderControl() {

            require_once('calendar/classes/tc_calendar.php'); // Require once to get the Calendar control on the page.

            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<SCRIPT LANGUAGE=\"javascript\" SRC=\"calendar\calendar.js\"></SCRIPT>";
            $html .= "Title:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"summary\" SIZE=\"40%\"/>"; //@todo: Possibly extract Size component here to CSS.
            $html .= "Location:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"location\" SIZE=\"40%\"/>";
            $html .= RenderPanel("Start");
            $html .= RenderPanel("End");
            $html .= "Repeat:";
            $html .= "<SELECT NAME=\"repeat\">";

            $options = array("Does not repeat", "Daily", "Weekly", "Every Weekday", "Bi-weekly","Monthly", "Yearly");
            $rrules = array("", "RRULE:FREQ=DAILY", "RRULE:FREQ=WEEKLY", "RRULE:FREQ=DAILY;BYDAY=MO,TU,WE,TH,FR", "RRULE:FREQ=WEEKLY;INTERVAL=2", "RRULE:FREQ=MONTHLY", "RRULE:FREQ=YEARLY");

            //@todo: Give this a more satisfying variable name.
            //@todo: Possibly build out this panel so it is tabbed.
            for($i = 0; $i < count($options); $i++)
            {
                $html .= "<OPTION VALUE=\"" . $rrules[$i] . "\">" . $options[$i] . "</OPTION>";
            }

            $html .= "</SELECT>";
            $html .= "Description:";
            $html .= "<TEXTAREA TYPE=\"text\" NAME=\"description\" ROWS=\"5\" COLS=\"60\">";
            $html .= "</TEXTAREA>";


            $html .= "</DIV>";

            return $html;
        }

        // @todo: Rename this to something more descriptive.
        private function RenderPanel($Prefix) {
            $html = "";
            $html .= $Prefix . " Date:";
            //@todo: Insert a modified variant of the calendar control here.
            $myCalendar = new tc_calendar("date5", true, false);
            $myCalendar->setIcon("calendar/images/iconCalendar.gif");
            $myCalendar->setDate(date('d'), date('m'), date('Y'));
            $myCalendar->setPath("calendar/");
            $myCalendar->setYearInterval(2000, 2050);
            $myCalendar->dateAllow('2008-05-13', '2015-03-01');
            $myCalendar->setDateFormat('j F Y');
            $myCalendar->setAlignment('left', 'bottom');

            // This should, hypothetically, redirect the output from echo to a string.
            // It's either this, or rewrite the control.
            ob_start();
            $myCalendar->writeScript();
            $html .= ob_get_contents();
            ob_end_clean();

            //$html .= $myCalendar->writeScript();

            $html .= "<SELECT NAME=\"" . $Prefix . "hour\">";
            for($hour = 1; $hour <= 12; $hour++)
            {
                $html .= "<OPTION value=\"" . str_pad($hour, 2, "0", STR_PAD_LEFT) . "\">" . $hour . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<SELECT NAME=\"" . $Prefix . "minute\">";
            for($minute = 0; $minute < 60; $minute++)
            {
                $html .= "<OPTION VALUE=\"" . str_pad($minute, 2, "0", STR_PAD_LEFT) . "\">" . str_pad($minute, 2, "0", STR_PAD_LEFT) . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<SELECT NAME=\"" . $Prefix . "period\">";
            $html .= "<OPTION VALUE=\"AM\">AM</OPTION>";
            $html .= "<OPTION VALUE=\"PM\">PM</OPTION>";
            $html .= "</SELECT>";

            return $html;
        }

        private function GetPanelDateTime($Prefix) {
            $_POST[""]; //@todo: Throw in the modified Calendar code here.
            //@todo: Finish writing function to put time into a nice DateTime or Timestamp.
            $_POST[$Prefix . "hour"] . $_POST[$Prefix . "minute"] . $_POST[$Prefix . "period"];

            //$_POST["year"] . $_POST["monthstart"] . $_POST["daystart"] . "T" . $_POST["hourstart"] . $_POST["minutestart"] . "00"



        }

        public function Create() {

            $event = \Data\Event::Create($_POST["summary"], $_POST["location"], $_POST["description"], $_POST["repeat"]);
            /*
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);
            $headers["If-Match"] = "\"" . $this->ETAG . "\""; // @todo: Modify this to match a Creation request.
            $headers["Content-Length"] = $this->ContentLength($Content);

            \HTTP\HTTPRequests::Put($this->URL, $headers);
            */

            //@todo: Maintain state, be sure to set the event to the new one.
        }

        // @todo: Store this here until I know what to do with it.
        public function GetNewUniqueID() {
            $isnew = true;
            $newid = uniqid("", true);
            do {
                foreach ($this->_events as $event) {
                    if($event->GetUID() == $newid) {
                        $isnew = false;
                        $newid = str_replace(".", "", uniqid("", true));
                    }
                }
            } while($isnew == false);

            return $newid;
        }

        public function Update() {
            $_POST[""];
            $_POST[""];
        }

        public function Delete() {
            $this->Event->Delete();
        }

        public function Draw() {
            echo RenderControl();
        }

        public function Refresh() {

        }

        public function UpdateCallback($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }

        }

        public function CSSClass($CSSClass = null) {
            if($CSSClass == null) {
                return $this->CSSClass;
            }
            else {
                $this->CSSClass = $CSSClass;
            }
        }

        public function HTMLName($HTMLName = null) {
            if($HTMLName == null) {
                return $this->HTMLName;
            }
            else {
                $this->HTMLName = $HTMLName;
            }
        }


    }
}

namespace Data {

    // User -> class for passing around user information. Should only pass around the UserID (a unqiue SQL ID), for security reasons, in a Session object.
    class User {
        private $SQL_ID = "";
        //@todo: Get the User object to actually talk to the other classes. Lol.

        public function __construct($Username, $Password) {
            // Probably want to Base64 encode the values going into and out of the MySQL database, to prevent a SQL Injection attack.
            $query = "SELECT [UserID] FROM [Users] WHERE [Username] = '" . base64_encode($Username) . "' AND [Password] = '" . base64_encode($Password) . "';";
            $data = SQL::DataQuery($query);

            $this->SQL_ID = $data["UserID"];

        }

        // Boolean function to tell us if we have a valid user. Might be able to merge this into the constructor.
        // @todo: Split into Login / User objects.
        public function IsValid() {
            if($this->SQL_ID == "") {
                return false;
            }

            return true;
        }

        public function GetUserID() {
            return $this->SQL_ID;

        }

        // private $Query = "SELECT [UserID] FROM [Users] WHERE [Username] = '' AND PASSWORD = '';"; // Prototype User query (for selecting a UserID).


    }
    // Calendar -> class for containg user-defined calendars.
    class Calendar {
        private $SQL_ID = "";
        private $CalendarName = "";
        private $SuperFeedList = Array();

        // @todo: Rewrite this more intelligently. Should I merge Calendar Add responsbilities into this class, or keep it separate?
        //@todo: Additionally, what arguments should I use to create this object? Is User necessary? Should I create the Calendar from it's ID? Or should I provide everything?
        public function __construct($CalendarID) {
            $this->SQL_ID = $CalendarID;
            Refresh();
        }

        public function Refresh() {
            $query = "SELECT [SuperFeedID] FROM [SuperFeeds] WHERE [CalendarID] = '" . $this->SQL_ID . "';";
            $data = SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $this->SuperFeedList[] = new SuperFeed($row['SuperFeedID']);
            }

        }

    }

    //@todo: Check Fiddler for variant HTTP requests, and confirm the new object model based off of these observations.
    //@todo: Following that, use the new MySQL Query / Table Analyzer to rebuild the sql table model to better specifications.

    // SuperFeed -> class for storing the primary link for the collection of CalDav resources.
    class SuperFeed {
        private $SQL_ID = "";
        private $URL = "";
        private $ETAG = ""; // I may have some use for this.
        private $FeedUsername = "";
        private $FeedPassword = "";

        private $EventList = Array();

        // @todo: Rewrite this more intelligently.
        public function __construct($SuperFeedID) {
            $this->SQL_ID = $SuperFeedID;
            Refresh();
        }

        public function Refresh() {
            $query = "SELECT [URL], [FeedUsername], [FeedPassword] FROM [SuperFeeds] WHERE [SuperFeedID] = '" . $this->SuperFeedID . "';";
            $data = SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                // @todo: Contact the actual resource for each event contained in the superfeed, then pass it off to the event for parsing.
                // Need to call Propfind, then Report to get initial resources.

                $row['URL'];
                $row['FeedUsername'];
                $row['FeedPassword'];

                //@todo: Pop this into a DataTable for easier parsing. Possibly.
                ParsePropfind(Propfind());
                //@todo: We will, in all likelihood, have to iterate through something here. Just not awake enough yet to think.
                $this->EventList[];//new Event();
            }

        }

        private function Propfind() {
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Depth"] = "0";
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);

            $content = "";
            $content .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $content .= "<D:propfind xmlns:D=\"DAV:\">";
            $content .= "<D:prop>";
            $content .= "<D:getcontenttype/>";
            $content .= "<D:resourcetype/>";
            $content .= "<D:getetag/>";
            $content .= "</D:prop>";
            $content .= "</D:propfind>";


            //$headers["Content-Length"] = $this->ContentLength($Content);

            return \HTTP\HTTPRequests::Propfind($this->URL, $headers, $content);

        }

        private function ParsePropfind($String) {

            $Xml = new SimpleXMLElement($String);
            $URL = $Xml->xpath("/multistatus/response/href"); // Modify these for iteration.
            $Etag = $Xml->xpath("/multistatus/response/propstat/prop/getetag");
        }


    }

    // Event -> class for storing event information. Due to this redesign, Event will now be handling some of the functions previously found in the Feed class.
    class Event {
        private $FeedURL = "";
        private $FeedUsername = "";
        private $FeedPassword = "";
        private $ETAG = "";
        //Creation responsibilities, of an Event, may not be handled here. I'm thinking the EventEditor might be the place. Pondering...
        //@todo: Verify that this is the correct, or at least, a very good idea. A default constructor that just takes in the string containing VEVENT information (raw).
        public function __construct($FeedUsername, $FeedPassword, $FeedURL) {
            //ParseVEvent($String);
            $this->FeedUsername = $FeedUsername;
            $this->FeedPassword = $FeedPassword;
            $this->FeedURL = $FeedURL;
            Refresh();

        }

        public function Refresh() {
            //@todo: Get data function goes here.
            Report();
        }

        public function Report() {
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);
            $headers["Depth"] = "1";

            $content = "";
            $content .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $content .= "<calendar-multiget xmlns:D=\"DAV:\" xmlns=\"urn:ietf:params:xml:ns:caldav\">";
            $content .= "<D:prop>";
            $content .= "<D:getetag/>";
            $content .= "<calendar-data/>";
            $content .= "</D:prop>";
            $content .= "<D:href>" . parse_url($this->URL, PHP_URL_PATH) . "</D:href>";
            $content .= "</calendar-multiget>";

            $headers["Content-Length"] = $this->ContentLength($content);

            ParseReport(\HTTP\HTTPRequests::Report($this->URL, $headers, $content));

        }


        public function Update($Summary, $StartDate, $EndDate, $Location, $Description, $RRule = null) {
            //@todo: Update function goes here -> need to decide what data to grab from the Event Editor control.


            Put();

        }

        private function Put() {
            // @todo: Rewrite the HTTP requests in this object to flow more.
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);
            $headers["If-Match"] = "\"" . $this->ETAG . "\"";

            $content = "";
            $content .= BuildUpdateVEvent();

            $request .= "BEGIN:VCALENDAR";
            $request .= "PRODID:-//Mozilla.org/NONSGML Mozilla Calendar V1.1//EN";
            $request .= "VERSION:2.0";

            $request .= "BEGIN:VTIMEZONE";
            $request .= "TZID:America/New_York";
            $request .= "X-LIC-LOCATION:America/New_York";
            $request .= "BEGIN:DAYLIGHT";
            $request .= "TZOFFSETFROM:-0500";
            $request .= "TZOFFSETTO:-0400";
            $request .= "TZNAME:EDT";
            $request .= "DTSTART:19700308T020000";
            $request .= "RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3";
            $request .= "END:DAYLIGHT";
            $request .= "BEGIN:STANDARD";
            $request .= "TZOFFSETFROM:-0400";
            $request .= "TZOFFSETTO:-0500";
            $request .= "TZNAME:EST";
            $request .= "DTSTART:19701101T020000";
            $request .= "RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11";
            $request .= "END:STANDARD";
            $request .= "END:VTIMEZONE";

            $request .= "BEGIN:VEVENT";
            $request .= "CREATED:20110912T163616Z";
            $request .= "LAST-MODIFIED:20120217T173356Z";
            $request .= "DTSTAMP:20120217T173356Z";
            $request .= "UID:4e6e3500e89673.63357057";
            $request .= "SUMMARY:Test";
            $request .= "DTSTART;TZID=America/New_York:20130717T081400";
            $request .= "DTEND;TZID=America/New_York:19691231T190000";
            $request .= "DESCRIPTION:Testhhhh";
            $request .= "X-MOZ-GENERATION:1";
            $request .= "END:VEVENT";
            $request .= "END:VCALENDAR";


            $headers["Content-Length"] = $this->ContentLength($content);

            \HTTP\HTTPRequests::Put($this->URL, $headers, $content);

        }

        public function Delete() {
            //@todo: Delete -> should be simple, with the general exception of getting the right eTag.

            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);
            $headers["If-Match"] = "\"" . $this->ETAG . "\"";

            ParseDelete(\HTTP\HTTPRequests::Delete($this->URL, $headers));
        }

        // @todo: Flesh this out. Might need to move / copy a variant to the Event class.
        private function ParsePropfind($String) {
            $Xml = new SimpleXMLElement($String);
            $Etag = $Xml->xpath("/multistatus/response/propstat/prop/getetag");
            $CCalendarData = $Xml->xpath("/multistatus/response/propstat/prop/C:calendar-data");

        }



        private function ParseDelete($String) {
            // HTTP/1.1 204 No Content

        }

        private function ParseReport($String) {
            //@todo: Put HTTP control logic in here.
            // HTTP/1.1 207 Multi-Status
            $xml = $String;
            $multistatus = new SimpleXMLElement($xml);

            //count($multistatus->response);

            $this->ETAG = $multistatus->response[0]->propstat->prop->getetag;

            //print_r($multistatus->response[0]->propstat->prop->children("urn:ietf:params:xml:ns:caldav"));

            $vevent = $multistatus->response[0]->propstat->prop->children("urn:ietf:params:xml:ns:caldav");
            //@todo: Parse VEVENT information here.
            ParseVEvent($vevent[0]);

        }

        //@todo: Move creation functions to Event.
        public static function Create($Summary, $StartDate, $EndDate, $Location, $Description, $RRule = null) {

            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);
            $headers["If-None-Match"] = "*";


            $content = "";
            $content .= BuildNewVEvent();

            $request .= "BEGIN:VCALENDAR";
            $request .= "PRODID:-//Mozilla.org/NONSGML Mozilla Calendar V1.1//EN";
            $request .= "VERSION:2.0";

            $request .= "BEGIN:VTIMEZONE";
            $request .= "TZID:" . date_default_timezone_get(); // date_default_timezone_get()
            $request .= "X-LIC-LOCATION:" . date_default_timezone_get();
            $request .= "BEGIN:DAYLIGHT";
            $request .= "TZOFFSETFROM:-0500";
            $request .= "TZOFFSETTO:-0400";
            $request .= "TZNAME:EDT"; //@todo: Use Timezone abbreviation here.
            $request .= "DTSTART:19700308T020000";
            $request .= "RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3"; //@todo: wat
            $request .= "END:DAYLIGHT";
            $request .= "BEGIN:STANDARD";
            $request .= "TZOFFSETFROM:-0400";
            $request .= "TZOFFSETTO:-0500";
            $request .= "TZNAME:EST";
            $request .= "DTSTART:19701101T020000";
            $request .= "RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11";
            $request .= "END:STANDARD";
            $request .= "END:VTIMEZONE";

            $request .= "BEGIN:VEVENT";
            $request .= "CREATED:20110912T163616Z"; //@todo: Use Time classes here.
            $request .= "LAST-MODIFIED:20120217T173356Z";
            $request .= "DTSTAMP:20120217T173356Z";
            $request .= "UID:4e6e3500e89673.63357057";
            $request .= "SUMMARY:Test";
            $request .= "DTSTART;TZID=" . date_default_timezone_get() .":20130717T081400";
            $request .= "DTEND;TZID=" . date_default_timezone_get() .":19691231T190000";
            $request .= "DESCRIPTION:Testhhhh";
            $request .= "X-MOZ-GENERATION:1";
            $request .= "END:VEVENT";
            $request .= "END:VCALENDAR";


            $headers["Content-Length"] = $this->ContentLength($content);
            //@todo: Keep a list of UIDs of known events to prevent reusing an existing UID.
            $url = "";
            \HTTP\HTTPRequests::Put($url, $headers, $content);

            $Event = new Event($url); // Use url returned in response to create and return the event.
            return $Event;
        }

        private function ParsePut($String) {
            // HTTP/1.1 201 Created
            // HTTP/1.1 204 No Content

            //@todo: Play with this later.
            if (strlen(strstr($String,"HTTP/1.1 201 Created"))>0) {
                // Needle Found
            }

            if (strlen(strstr($String,"HTTP/1.1 204 No Content"))>0) {
                // Needle Found
            }

        }

        private function ParseVEvent($String) {
            //\Extract\Extract::

            $Summary = "";
            $StartDate = "";
            $EndDate = "";
            $Location = "";
            $Description = "";
            $RRule = "";


        }

        public function BuildNewVEvent($Summary, $StartDate, $EndDate, $Location, $Description, $RRule = null) {
            $data = "";
            $data .= "BEGIN:VEVENT" . "\r\n";
            $data .= "CREATED:" . Helper::GetUTCFormattedStringFromTimestamp($this->_creationdate) . "\r\n";
            $data .= "LAST-MODIFIED:" . Helper::GetUTCFormattedStringFromTimestamp($this->_lastmodified) . "\r\n";
            $data .= "DTSTAMP:" . Helper::GetUTCFormattedStringFromTimestamp($this->_dtstamp) . "\r\n";
            $data .= "UID:" . $this->_uid . "\r\n";
            $data .= "SUMMARY:" . $Summary . "\r\n";
            if($RRule != null && $RRule != "") {
                $data .= "RRULE:" . $RRule . "\r\n";
            }
            $data .= "DTSTART;TZID=" . $this->_timezone . ":" . Helper::GetFormattedStringFromTimestamp($this->_startdate) . "\r\n";  //date_default_timezone_get()
            $data .= "DTEND;TZID=" . $this->_timezone . ":" . Helper::GetFormattedStringFromTimestamp($this->_enddate) . "\r\n";

            if($Location != null && $Location != "") {
                $data .= "LOCATION:" . $Location . "\r\n";
            }
            if($Description != null && $Description != "") {
                $data .= "DESCRIPTION:" . $Description . "\r\n";
            }
            $data .= "END:VEVENT" . "\r\n";
            return $data;
        }

        //@todo: Modify this into a more intelligent, and hopefully more readable version.
        public function BuildUpdateVEvent() {
            $data = "";
            $data .= "BEGIN:VEVENT" . "\r\n";
            $data .= "CREATED:" . Helper::GetUTCFormattedStringFromTimestamp($this->_creationdate) . "\r\n";
            $data .= "LAST-MODIFIED:" . Helper::GetUTCFormattedStringFromTimestamp($this->_lastmodified) . "\r\n";
            $data .= "DTSTAMP:" . Helper::GetUTCFormattedStringFromTimestamp($this->_dtstamp) . "\r\n";
            $data .= "UID:" . $this->_uid . "\r\n";
            $data .= "SUMMARY:" . $this->_summary . "\r\n";
            if($this->_rrule != null && $this->_rrule != "") {
                $data .= "RRULE:" . $this->_rrule . "\r\n";
            }
            $data .= "DTSTART;TZID=" . $this->_timezone . ":" . Helper::GetFormattedStringFromTimestamp($this->_startdate) . "\r\n";
            $data .= "DTEND;TZID=" . $this->_timezone . ":" . Helper::GetFormattedStringFromTimestamp($this->_enddate) . "\r\n";

            if($this->_location != null && $this->_location != "") {
                $data .= "LOCATION:" . $this->_location . "\r\n";
            }
            if($this->_description != null && $this->_description != "") {
                $data .= "DESCRIPTION:" . $this->_description . "\r\n";
            }
            $data .= "END:VEVENT" . "\r\n";
            return $data;
        }
    }
}

namespace HTTP {

    // Simple class to issue a HTTP redirect (to get around some problems). Should be the first thing on the page.
    class HTTPRedirector {
        public static function Redirect($URL) {
            header("Location : " . $URL);
        }
    }

    // HTTPRequests -> PHP seems to be lacking a lot of the WebDav / CalDav extensions. I'm abstracting these from the V1 versions, so future edits (ostensibly by other programmers) will be easier.
    class HTTPRequests {
        const ProxyEnabled = true;
        const ProxyServer = "127.0.0.1";
        const ProxyPort = 8888;

        const UserAgent = "Calico (v.02)";

        private static $StandardHeaders = Array("User-Agent" => "Calico v.02", "Accept" => "text/xml", "Accept-Language" => "en-us,en;q=0.5", "Accept-Encoding" => "gzip,deflate", "Accept-Charset" => "utf-8,*;q=0.1",
            "Keep-Alive" => "300", "Connection" => "keep-alive", "Pragma" => "no-cache", "Cache-Control" => "no-cache");

        public static function StandardHeaders() {
            return clone $this->StandardHeaders;
        }


        private static function ContentLength($Content) {
            return strlen(strstr($Content, "\r\n\r\n")) - 4;
        }

        private static function Base64UsernamePassword($Username, $Password) {
            return base64_encode($Username . ":" . $Password);

        }

        private static function Send($URL, $Data) {
            $server = parse_url($URL, PHP_URL_HOST);
            $port = parse_url($URL, PHP_URL_PORT);

            // If the parsing the port information fails, we will assume it's on a default port.
            // As such, we'll set the port in the switch below.
            if($port == null) {
                switch(parse_url($URL, PHP_URL_SCHEME)) {
                    case "HTTP":
                        $port = 80;
                        break;
                    case "HTTPS":
                        $port = 443;
                        break;

                }
            }

            // Check if we are using a proxy (debug configuration typically).
            if(ProxyEnabled) {
                $server = ProxyServer;
                $port = ProxyPort;
            }

            $response = "";

            // Open a connection to the server.
            $connection = fsockopen($server, $port, $errno, $errstr);
            if (!$connection) {
                die($errstr($errno));
            }

            fwrite($connection, $Data);
            while (!feof($connection)) {
                $response .= fgets($connection);
            }
            fclose($connection);

            return $response;
        }

        // parse_url for here.
        // rawurlencode / rawlurldecode for later.
        public static function Put($URL, $Headers, $Content) {
            //@todo: Finish deciding what will go in a general Put Request, and what will need to go in a Header Array.
            $request = "";

            $request .= "PUT " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";


            //@todo: Break this out into a php regular expression.
            //@todo: We should be able to match according to each line.



            return $this->Send($request);

        }

        public static function Report($URL, $Headers, $Content) {
            $request = "";

            $request .= "REPORT " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            foreach($Content as $data) {
                $request .= $data . "\r\n";
            }

            $headers = Array();
            $headers = $this->StandardHeaders();

            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($username) . ":" . base64_encode($password);
            $headers["Depth"] = "1";
            $headers["Content-Length"] = $this->ContentLength($Content);

            $request .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $request .= "<calendar-multiget xmlns:D=\"DAV:\" xmlns=\"urn:ietf:params:xml:ns:caldav\">";
            $request .= "<D:prop>";
            $request .= "<D:getetag/>";
            $request .= "<calendar-data/>";
            $request .= "</D:prop>";
            $request .= "<D:href>" . $path . "</D:href>"; //@todo: parse_url path extraction might work here.
            $request .= "</calendar-multiget>";

            return $this->Send($request);
        }


        public static function Propfind($URL, $Headers, $Content) {
            $request = "";
            $request .= "PROPFIND " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            $headers = Array();
            $headers = $this->StandardHeaders();

            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($username) . ":" . base64_encode($password);
            $headers["Depth"] = "0";
            $headers["Content-Length"] = $this->ContentLength($Content);

            $request .= "<D:propfind xmlns:D=\"DAV:\" xmlns:CS=\"http://calendarserver.org/ns/\">";
            $request .= "<D:prop>";
            $request .= "<D:resourcetype/>";
            $request .= "<D:owner/>";
            $request .= "<CS:getctag/>";
            $request .= "</D:prop>";
            $request .= "</D:propfind>";

            return $this->Send($request);
        }


        public static function Delete($URL, $Headers) {

            $request = "";
            $request .= "DELETE " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            return $this->Send($request);
        }

        public static function Options($URL, $Headers, $Content) {
            $request = "";
            $request .= "OPTIONS " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST)  . "\r\n";

            return Send($request);
        }


    }

}


namespace SQL {


    // SQL -> a basic data access layer for SQL servers. MySQL doesn't seem to differentiate between data and non-data queries, but other databases do.
    class SQL {

        // Keeping these as constants for now. Might be a good idea to pull them out into an XML file at some point.
        const Server = "localhost";
        const Username = "root";
        const Password = "mysql";
        const Database = "calico";

        // @todo: Perhaps better error handling here?
        public static function DataQuery($Query) {
            $connection = mysql_connect(Server, Username, Password);

            if (!$connection)
            {
                // error_log() here. Quiet logging of errors.
                die('Could not connect: ' . mysql_error());
            }

            mysql_select_db(Database, $connection);
            $data = mysql_query($Query);

            return $data;
        }


        public static function NonDataQuery($Query) {
            $connection = mysql_connect(Server, Username, Password);

            if (!$connection)
            {
                die("Could not connect: " . mysql_error());
            }

            mysql_select_db(Database, $connection);
            mysql_query($Query);

        }

    }


}














?>