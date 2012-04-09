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
                if($Years > 0) {
                    $this->timestamp = strtotime(date("Y-m-d H:i:s", strtotime($this->timestamp)) . " +" . 12 * $Years ." month");

                }
                else {
                    $this->timestamp = strtotime(date("Y-m-d H:i:s", strtotime($this->timestamp)) . " -" . 12 * $Years ." month");
                }

            }
        }

        public function Months($Months = null) {
            if($Months == null) {
                return date("m", $this->timestamp);
            }
            else {
                if($Months > 0) {
                    $this->timestamp = strtotime(date("Y-m-d H:i:s", strtotime($this->timestamp)) . " +" . $Months ." month");

                }
                else {
                    $this->timestamp = strtotime(date("Y-m-d H:i:s", strtotime($this->timestamp)) . " -" . $Months ." month");
                }
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
        const Minute = "Minute";
        const Second = "Second";
        const TimezoneOffset = "TimezoneOffset";

        const String = "String";
        const Integer = "Integer";
        //const Timestamp = "Timestamp";

        // Extract information from a timestamp. My sad attempt to make Time information slightly more friendly.
        // One rule though: if it doesn't have a nice String representation, it returns an Integer. Do not, I repeat, do not rely on that behavior for future releases.
        // Or you will end up in a hell of your own making.
        public static function Extract($timestamp, $arg, $format) {
            //@todo: Finish this. Need to verify that extraction will work properly, and that the design is simplistic.
            switch($arg) {
                case NumberOfDaysInMonth:
                    switch($format) {
                        case String:
                            return date($timestamp, "t");  // Number of days in the given month	(28 through 31)
                            break;
                        case Integer:
                            return date($timestamp, "t");  // Number of days in the given month	(28 through 31)
                            break;
                    }
                    break;
                case DayOfTheWeek:
                    switch($format) {
                        case String:
                            return date($timestamp, "l"); // A full textual representation of the day of the week (Sunday through Saturday)
                            break;
                        case Integer:
                            return date($timestamp, "N"); // ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0) (1 (for Monday) through 7 (for Sunday))
                            break;
                    }
                    break;
                case Year:
                    switch($format) {
                        case String:
                            return date($timestamp, "Y"); // A full numeric representation of a year, 4 digits (Examples: 1999 or 2003)
                            break;
                        case Integer:
                            return date($timestamp, "Y"); // A full numeric representation of a year, 4 digits (Examples: 1999 or 2003)
                            break;
                    }

                    break;
                case Month:
                    switch($format) {
                        case String:
                            return date($timestamp, "F"); // A full textual representation of a month (such as January or March	January through December)
                            break;
                        case Integer:
                            return date($timestamp, "n"); // Numeric representation of a month, without leading zeros (1 through 12)
                            break;
                    }
                    break;
                case Week:
                    switch($format) {
                        case String:
                            return date($timestamp, "W"); // ISO-8601 week number of year, weeks starting on Monday (added in PHP 4.1.0) (Example: 42 (the 42nd week in the year))
                            break;
                        case Integer:
                            return date($timestamp, "W"); // ISO-8601 week number of year, weeks starting on Monday (added in PHP 4.1.0) (Example: 42 (the 42nd week in the year))
                            break;
                    }
                    break;

                case DayOfTheMonth:
                    switch($format) {
                        case String:
                            return date($timestamp, "js"); // English ordinal suffix for the day of the month, 2 characters	st, nd, rd or th. (Works well with j)
                            break;
                        case Integer:
                            return date($timestamp, "j"); // Day of the month without leading zeros (1 to 31)
                            break;
                    }

                    break;
                case Hour:
                    switch($format) {
                        case String:
                            return date($timestamp, "g"); // 12-hour format of an hour without leading zeros (1 through 12)
                            break;
                        case Integer:
                            return date($timestamp, "g"); // 12-hour format of an hour without leading zeros (1 through 12)
                            break;
                    }

                    break;
                case Minute:
                    switch($format) {
                        case String:
                            return date($timestamp, "i"); // Minutes with leading zeros	(00 to 59)
                            break;
                        case Integer:
                            return date($timestamp, "i"); // Minutes with leading zeros	(00 to 59)
                            break;
                    }
                    break;
                case Second:
                    switch($format) {
                        case String:
                            return date($timestamp, "s"); // Seconds, with leading zeros (00 through 59)
                            break;
                        case Integer:
                            return date($timestamp, "S"); // Seconds, with leading zeros (00 through 59)
                            break;
                    }
                    break;
                case TimezoneOffset:
                    switch($format) {
                        case String:
                            return date($timestamp, "Z"); // Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive.
                            break;
                        case Integer:
                            return date($timestamp, "Z"); // Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive.
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

        //@todo: GetETag -> Need to add this function, so I can grab from the HTTP responses.

        public static function GetETag($String) {
            $re1='(ETag)';	# Variable Name 1
            $re2='(: )';	# Any Single Character 1
            $re3='.*?';	# Non-greedy match on filler
            $re4='(".*?")';	# Double Quote String 1

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {
                $var1=$matches[1][0];
                $c1=$matches[2][0];
                $string1=$matches[3][0];
                return $string1;
            }

        }

        public static function GetDateStamp($String) {
            $re1='(DSTAMP)';	# Variable Name 1
            $re2='(:)';	# Any Single Character 1
            $re3='.*?';	# Non-greedy match on filler
            $re4='(".*?")';	# Double Quote String 1

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {
                $var1=$matches[1][0];
                $c1=$matches[2][0];
                $string1=$matches[3][0];
                return $string1;
            }

        }

        public static function GetXMozGeneration($String) {
            $re1='(X-MOZ-GENERATION)';	# Variable Name 1
            $re2='(:)';	# Any Single Character 1
            $re3='.*?';	# Non-greedy match on filler
            $re4='(".*?")';	# Double Quote String 1

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4."/is", $String, $matches))
            {
                $var1=$matches[1][0];
                $c1=$matches[2][0];
                $string1=$matches[3][0];
                return $string1;
            }

        }




    }
}

namespace GUI {
    class Event {
        // @todo: Event may be unnecessary, if I use POST. Possibly.
        private $Publisher = "";
        private $Type = "";
        private $Data = Array();

        public function __construct($Publisher, $Type, $Data) {
            $this->Publisher = $Publisher;
            $this->Type = $Type;
            $this->Data = $Data;

        }

        public function Publisher() {
            return $this->Publisher;
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
        private $User = null;
        private $Options = Array("Monthly", "Weekly", "Daily");
        private $DefaultView = "";


        public function __construct($User) {
            $this->User = $User;
            $this->Refresh();
        }

        public function Draw() {
            echo $this->RenderControl();
        }

        private function RenderControl() {
            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<SELECT NAME=\"DefaultView\">";
            foreach($this->Options as $option) {
            $html .= "<OPTION VALUE=\"" . $option . "\"";
            if($this->DefaultView == $option) {
                $html .= " selected=\"selected\"";
            }

            $html .= ">" . $option . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "</DIV>";

            return $html;
        }

        private function GetDefaultViews() {
            $query = "SELECT `DefaultView` FROM `calico.settings` WHERE `UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL::DataQuery($query);
            $row = mysql_fetch_array($data);
            $this->DefaultView = $row['DefaultView'];
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

        public function Postback() {

                $this->DefaultView = $_POST["DefaultView"];
                $query = "UPDATE `calico`.`settings` SET `DefaultView` = '" . $this->DefaultView . "' WHERE `UserID` = '" . $this->User->GetUserID() . "' ;";
                $data = SQL\SQL::NonDataQuery($query);

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
        private $User = null;
        private $CalendarData = Array();
        private $HTMLName = "CompositeCheckBoxControl";
        private $CSSClass = "CompositeCheckBoxControl";

        public function __construct($User) {

            $this->User = $User;
            $this->Refresh();
        }


        private function RenderControl() {
            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            for($i = 0; $i < count($this->CalendarData); $i++) {
                $html .= $this->CalendarData["CalendarName"][$i]; //@todo: Put name in here.
                $checked = "";
                if($this->CalendarData["CalendarName"][$i] == 1){
                    $checked = "CHECKED";
                }
                $html .= "<INPUT TYPE=\"checkbox\" NAME=\"DisplayedCalendars[]\" VALUE=\"" . $i . "\" " . $checked . " >";
            }
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {

            echo $this->RenderControl();

        }

        public function Refresh() {

            $query = "SELECT `CalendarName`, `IsDisplayed` FROM `calico.calendars` WHERE `UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL\SQL::DataQuery($query);
            //$this->CalendarData = Array();
            $this->CalendarData["CalendarName"] = Array();
            $this->CalendarData["IsDisplayed"] = Array();

            while($row = mysql_fetch_array($data))
            {

                $this->CalendarData["CalendarName"][] = base64_decode($row["CalendarName"]);
                $this->CalendarData["IsDisplayed"][] = $row["IsDisplayed"];

            }

        }

        public function Postback() {

            $this->Refresh();
            for($i = 0; $i < count($this->CalendarData["IsDisplayed"]); $i++) {
                $this->CalendarData["IsDisplayed"] = 0;
            }

            $displayedcalendars = $_POST["DisplayedCalendars"];
            foreach($displayedcalendars as $key => $value) {
                if($value == "checked") {
                   $this->CalendarData["IsDisplayed"][$key] = 1;
                }
            }

            for($i = 0; $i < count($this->CalendarData["IsDisplayed"]); $i++) {
                $query = "UPDATE `calico`.`calendars` SET `IsDisplayed` = " . $this->CalendarData["IsDisplayed"][$i] . " WHERE `UserID` = '" . $this->User->GetUserID() . "' AND `CalendarName` = '" . base64_encode($this->CalendarData["CalendarName"][$i]) . "';";
                $data = SQL\SQL::NonDataQuery($query);
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

class DivEvent {
    private $StartTime = 0;
    private $EndTime = 0;
    private $RowIndexStart = 0;
    private $RowIndexEnd = 0;
    private $ColumnIndex = 0;
    private $Event = null;

    public function __construct($Event, $StartTime, $EndTime, $ColumnIndex, $RowIndexStart, $RowIndexEnd) {
        $this->Event = $Event;
        $this->ColumnIndex = $ColumnIndex;
        $this->RowIndexStart = $RowIndexStart;
        $this->RowIndexEnd = $RowIndexEnd;
    }

    public function GetEvent() {
        return $this->Event;
    }

    public function GetStartTime() {
        return $this->StartTime;
    }

    public function GetEndTime() {
        return $this->EndTime;
    }

    public function GetColumnIndex() {
        return $this->ColumnIndex;
    }

    public function GetRowIndexStart() {
        return $this->RowIndexStart;
    }

    public function GetRowIndexEnd() {
        return $this->RowIndexEnd;
    }

}

class Bitmap {
    private $Data = Array(Array());
    private $Height = 0;

    public function __construct($Height) {
        $this->Height = $Height;
    }

    public function GetNumColumns() {
        return count($this->Data);
    }

    private function FillColumn($Column) {
        for($row = 0; $row < $this->Height; $row++) {
            $this->Data[$Column][$row] = 0;
        }
    }

    private function AddColumn() {
        $this->Data[] = Array();
        $newcolumn = $this->Data[count(Data) - 1];
        $this->FillColumn($newcolumn);
        return $newcolumn;
    }

    public function FillRows($Row, $NumRows, $Column) {
        for($row = $Row; $row < $Row + $NumRows; $row++) {
            $this->Data[$Column][$row] = 1;
        }
    }

    public function FindEmpty($Row, $NumRows) {
        //Columns
        for($col = 0; $col < count($this->Data); $col++) {
            //Rows
            $foundempty = true;
            for($row = $Row; $row < $Row + $NumRows; $row++) {
                if($this->Data[$col][$row] == 0) {
                    $foundempty = false;
                }
            }
            if($foundempty == true) {
                return $col;
            }
        }

        $this->AddColumn();
        return count($this->Data) - 1;
    }



}

    // CompositeCalendar -> should handle the GUI elements of drawing the calendars, plus accept a handful of arguments.
    class CompositeCalendar {
        //@todo: Rebuild this part last, but keep in mind the various arguments / requests it will need to make to other classes. I say last because of the styling / unrelated data structure stuff.
        //@todo: Check if any other HTML / CSS items should be popped off into their own classes. Should not be building a singleton, in case someone wants to extend this eventually. (At least try not to, or think about not doing it). ^_^
        //@todo: Possible issue with repeat. Make sure the event appears for all repeats.
        //@todo: Relax. Your anxiety is too high, so you can't think. You have plenty of time. You will finish on time. Relax.
        private $CalendarList = Array();
        private $User = null;
        private $View = 0;
        private $SelectedTime;
        const Monthly = 0;
        const Weekly = 1;
        const Daily = 2;

        private static $Days = Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        //@todo: Need to change these strings to html, with superscripts.
        //Prototype code: <span style=\"vertical-align: super;font-size:50%;\"></span>
        private static $Times = Array("12 AM" => "12 <SPAN CLASS=\"period\">AM</SPAN>", "1 AM" => "1 <SPAN CLASS=\"period\">AM</SPAN>", "2 AM" => "2 <SPAN CLASS=\"period\">AM</SPAN>", "3 AM" => "3 <SPAN CLASS=\"period\">AM</SPAN>", "4 AM" => "4 <SPAN CLASS=\"period\">AM</SPAN>", "5 AM"=>"5 <SPAN CLASS=\"period\">AM</SPAN>", "6 AM"=>"6 <SPAN CLASS=\"period\">AM</SPAN>",
            "7 AM"=>"7 <SPAN CLASS=\"period\">AM</SPAN>", "8 AM"=>"8 <SPAN CLASS=\"period\">AM</SPAN>", "9 AM"=>"9 <SPAN CLASS=\"period\">AM</SPAN>", "10 AM"=>"10 <SPAN CLASS=\"period\">AM</SPAN>", "11 AM"=>"11 <SPAN CLASS=\"period\">AM</SPAN>", "12 PM"=>"12 <SPAN CLASS=\"period\">PM</SPAN>", "1 PM"=>"1 <SPAN CLASS=\"period\">PM</SPAN>", "2 PM"=>"2 <SPAN CLASS=\"period\">PM</SPAN>",
        "3 PM"=>"3 <SPAN CLASS=\"period\">PM</SPAN>", "4 PM"=>"4 <SPAN CLASS=\"period\">PM</SPAN>", "5 PM"=>"5 <SPAN CLASS=\"period\">PM</SPAN>", "6 PM"=>"6 <SPAN CLASS=\"period\">PM</SPAN>",
            "7 PM"=>"7 <SPAN CLASS=\"period\">PM</SPAN>", "8 PM"=>"8 <SPAN CLASS=\"period\">PM</SPAN>", "9 PM"=>"9 <SPAN CLASS=\"period\">PM</SPAN>", "10 PM"=>"10 <SPAN CLASS=\"period\">PM</SPAN>", "11 PM"=>"11 <SPAN CLASS=\"period\">PM</SPAN>");

        private $HTMLName = "CompositeCalendarControl";
        private $CSSClass = "CompositeCalendarControl";


        public function __construct($User) {
            $this->User = $User;
            $this->Refresh();
            $this->SelectedTime = time();

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
            $html .= "<SCRIPT LANGUAGE=\"javascript\" SRC=\"calendar\calendar.js\"></SCRIPT>";
            $html .= "Selected Date:";
            //@todo: give an appropriate html name to this.
            $myCalendar = new tc_calendar("compositecalendardatepicker", true, false);
            $myCalendar->setIcon("calendar/images/iconCalendar.gif");
            $myCalendar->setDate(date('d', strtotime($this->SelectedTime))
                , date('m', strtotime($this->SelectedTime))
                , date('Y', strtotime($this->SelectedTime)));
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

            $html .= $this->RenderView();

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

        // Round down.
        private function RoundStartTime($Timestamp) {
            if(date("i", $Timestamp) != 30 && date("i", $Timestamp) != 0) {
                if(date("i", $Timestamp) < 30) {
                    // 7:08 - 0:08
                    $Timestamp -= date("i", $Timestamp);
                }
                else{
                    // 0:30 - 7:38 = 8
                    $Timestamp -= (30 * 60) - date("i", $Timestamp);
                }

            }

            return $Timestamp;

        }

        // Round up.
        private function RoundEndTime($Timestamp) {
            if(date("i", $Timestamp) != 30 && date("i", $Timestamp) != 0) {
                if(date("i", $Timestamp) < 30) {
                    // 7:30 - 7:08 = +22
                    $Timestamp += (30 * 60) - date("i", $Timestamp);
                }
                else{
                    // 8:00 - 7:38 = +22
                    $Timestamp += (60 * 60) - date("i", $Timestamp);
                }

            }

            return $Timestamp;
        }

        /*  Truth Table:
           {EventStart}{CalendarStart}{EventEnd}------------{CalendarEnd}------------
           {EventStart}{CalendarStart}----------------------{CalendarEnd}{EventEnd}--
           ------------{CalendarStart}{EventStart}----------{CalendarEnd}{EventEnd}--
           ------------{CalendarStart}{EventStart}{EventEnd}{CalendarEnd}--
         */

        //@todo: Mental note-> ensure that the eventeditor does not allow calendarstarts > calendarends

        private function TimeRangeContains($calendarstart, $calendarend, $eventstart, $eventend) {
            // Timestamps are ints. Earlier times are smaller.
           if($eventstart < $calendarend && $eventend > $calendarstart) {
               return true;
           }
            return false;
        }

        private function GetRelevantEvents($calendarstart, $calendarend) {
            $events = Array();
            foreach($this->CalendarList as $calendar) {
                foreach($calendar->GetSuperFeedList() as $superfeed) {
                    foreach($superfeed->GetEvents() as $event) {
                        //Hmm. Need to ensure the time range of the event falls within the time range of the calendar.
                        if($this->TimeRangeContains($calendarstart, $calendarend, $event->GetStartDate(), $event->GetEndDate())) {
                            $events[] = $event;
                        }
                    }
                }
            }
            return $events;
        }

        /*
        private function GetMaxWidth($events) {
            $maxwidth = 0;
            for($i = 0; $i < count($events); $i++) {
                for($j = 0; $j < count($events[$i]); $j++) {
                    if(count($events[$i][$j]) > $maxwidth) {
                        $maxwidth = count($events[$i][$j]);
                    }
                }
            }

            return $maxwidth;

        }
        */


        /*

        // Attempts to perform some space-fitting (arrange the various event rectangles) to make more efficient use of screen space.
        private function OrganizeEvents($segmentstart, $segmentend, $increment, $events) {
            //@todo: First, create the array.
            $organize = Array();
            $info = Array();
            //@todo: Then fill it with increments.
            for($time = $segmentstart; $time < $segmentend; $time == $increment) {
                $organize[$time] = Array();
            }
            $columns = 0;
            //@todo: Then attempt to fill each increment.
            foreach($events as $event) {
                $x = 0;
                $starttime = $event->GetStartDate;
                if($starttime < $segmentstart) {
                    $starttime = $segmentstart;
                } else if(date("i", $starttime) != 30 && date("i", $starttime) != 0) {
                    if(date("i", $starttime) < 30) {
                        $starttime -= date("i", $starttime);
                    }
                    else{
                        $starttime = (30 * 60) - date("i", $starttime);
                    }

                }
                $endtime = $event->GetEndDate;
                if($endtime > $segmentend) {
                    $endtime = $segmentend;
                }
                else if(date("i", $endtime) != 30 && date("i", $endtime) != 0) {
                    if(date("i", $endtime) < 30) {
                        $endtime -= date("i", $endtime);
                    }
                    else{
                        $endtime = (30 * 60) - date("i", $endtime);
                    }

                }
                //$time = $starttime; // Round to the nearest increment.
                // Check if the key exists, and if it has anything set for it.
                $newcolumn = true;
                //Check if the event will fit in any current column.
                for($x = 0; x < $columns; $x++) {
                    // Check if the column exists. If not, add it.
                    if(!array_key_exists("x" + $x, $organize[$starttime])) {
                        //Might want a while loop here. In case of multiple columns that need to be added.
                        $organize[$starttime]["x" + $x] = null;
                    }
                    if($organize[$starttime]["x" + $x] == null) {
                        // If it doesn't, keep checking the available time slots, in increments, until the endtime.
                        // Then, put the event in question into that slot.
                        $nexttime = $increment + $starttime;

                        while($nexttime < $endtime) {
                            if(!array_key_exists("x" + $x, $organize[$nexttime])) {
                                //Might want a while loop here. In case of multiple columns that need to be added.
                                for($i = count($organize[$nexttime]); $i < $x; $i++) {
                                    $organize[$nexttime]["x" + $x] = null;
                                }
                            }
                            if($organize[$nexttime]["x" + $x] == null) {
                                $nexttime += $increment;
                            }
                        }
                        if($nexttime >= $endtime) {
                            $newcolumn = false;
                            //Add event to all slots.

                            //@todo: Add event info here.
                            $info["ColumnIndex"] = $x;
                            $info["RowIndexStart"] = $starttime;

                            for($t = $starttime; $t < $endtime; $t += $increment) {
                                $organize[$t]["x" + $x] = $event;

                            }
                            $info["RowIndexEnd"] = $endtime;





                            break;
                        }



                    }

                }

                if($newcolumn) {
                    $columns++;
                    $info["ColumnIndex"] = $columns;
                    $info["RowIndexStart"] = $starttime;
                    for($t = $starttime; $t < $endtime; $t += $increment) {
                        for($i = count($organize[$t]); $i < $columns; $i++) {
                            $organize[$t]["x" + $i] = null;
                        }

                        $organize[$t]["x" + $columns] = $event;
                    }
                    $info["RowIndexEnd"] = $endtime;

                }
            }

            $value = Array();
            $value["Organize"] = $organize;
            $value["Info"] = $info;

            return $value;

        }

        */

        public function RenderMonthly() {
            $html = "";
            //@todo: Get a list of 5 weeks: the current one, 2 weeks prior, 2 weeks following.
            // "Month + Year:"

            $monthstart = strtotime(date("Y-m", $this->SelectedTime));
            $monthend = strtotime("+1 month", strtotime(date("Y-m", $this->SelectedTime)));

            $events = GetRelevantEvents($monthstart, $monthend);


            return $html;

        }




        public function RenderWeekly() {
            $html = "";

            //@todo: Set a time range, with which to decide which events we care about.
            //@todo: Get a list of all dates of this week.

            //@todo: Add 'Week:' text here.

            // StartDate = Time(Y-m-d) - Time(w) DayofWeek (Sunday, 12:00 AM)
            // EndDate = (Time(Y-M-D) - Time(w) DayofWeek) + 1 week) (Sunday 12:00 AM)
            $weekstart = strtotime("-" . date("w", $this->SelectedTime) . " day", strtotime(date("Y-m-d", $this->SelectedTime)));
            $weekend = strtotime("+1 week", strtotime(date("Y-m-d", $this->SelectedTime)));

            $events = GetRelevantEvents($weekstart, $weekend);
            $increment = 30 * 60; // 30 minutes
            $segments = Array();
            $segments["Start"] = Array();
            $segments["End"] = Array();
            $segments["Width"] = Array(); // The width of each event per day.

            for($t = $weekstart; $t < $weekend; strtotime("+1 day", $t)) {
                $segments["Start"] = $t;
                $segments["End"] = strtotime("+1 day", $t);

            }

            //Newline for HTML buttons: &#10;


            //4% for each div, 8% for the column headers.
            //7 days, with row headers -> 100/8 -> 12.5, 7 * 12.5 = 87.5, 13% for, 91%, 9%


            $html .= "<DIV NAME=\"Calendar\">";
            //Refresh button. Upper left.
            $html .= "<DIV NAME=\"CalendarRefreshButton\" CLASS='RefreshButton' style='height:8%;width:9%;z-index:1'>";
            $html .= "</DIV>";

            $columnwidth = 13;
            $columnheight = 8;

            $rowheaderwidth = 9; # of Rows = 24 (hours) * 2 (30 minute increments) = 48 + 1 columnn row
            $rowheadereheight = 2;

            $rowwidth = 13;
            $rowheight = 2;

            // Column headers.
            foreach($segments["Start"] as $segment) {
                $html .= "<DIV NAME=\"CalendarColumnHeader\" CLASS='ColumnHeader' style='height:8%;width:13%;z-index:1'>";
                $html .= date("j", $segment) . "     " . date("l", $segment);
                $html .= "</DIV>";
            }

            for($t = $segments["Start"][0]; $t < $segments["End"][0]; $t += $increment) {
                //Row headers.
                $html .= "<DIV NAME=\"CalendarRowHeader\" CLASS='RowHeader' style='height:4%;width:9%;z-index:1'>";
                if(date("i", $t) == 0) {
                    $html .= date("g", $t) . ":" . date("i", $t) . date("A", $t);
                }
                $html .= "</DIV>";
            }

            /*
             * Hmm. I need to precalculate the actual html strings, per day, then divide their width according to the number per day.
             * Going to need a function that splits events according to dates...so an event that covers two days can be split into two buttons.
             * if(event > endtime && event < starttime) {$html .= "<button value="" name="" onclick=\"\">"}
             */

            //@todo: Review this design. It should be setup so that I can calculate just how many dates an event will cover, as well as the number of events per day.
            //@todo: Cycle through each segment.
            for($t = 0; $t < count($segments["Start"]); $t++) {
                $segmentstart = $segments["Start"][$t]; // For weekly, this is days. Segment (of time) Start here = CurrentDay @ 12:00AM
                $segmentend = $segments["End"][$t]; //Segment (of time) End here = NextDay @ 12:00AM
                $value = OrganizeEvents($segmentstart, $segmentend, $increment, $events);
                $segevents = $value["Organize"];
                $segment["Width"][$t] = $this->GetMaxWidth($segevents);
                // Rows.
                foreach($segevents as $event) {
                    $html .= "<DIV NAME=\"CalendarRow\" CLASS='Row' style='height:4%;width:13%;z-index:1'>";
                    $html .= "</DIV>";

                }

            }




            // Need to create divs, filled with buttons, that span each segment, and are positioned over the above divs.
            // Relative positioning, with percentage-based sizes should work here.

            $html .= "</DIV>";

            return $html;

        }

        public function RenderDaily() {
            $html = "";

            $daystart = strtotime(date("Y-m-d", $this->SelectedTime));
            $dayend = strtotime("+1 day", strtotime(date("Y-m-d", $this->SelectedTime)));

            $events = GetRelevantEvents($daystart, $dayend);


            return $html;

        }

        public function Draw() {
            echo $this->RenderControl();
        }

        public function Refresh() {
            $query = "SELECT `CalendarID` FROM `calico`.`calendars` WHERE `IsDisplayed` = 1 AND `UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $this->CalendarList[] = new Calendar($row['CalendarID']);
            }
        }

        public function Postback() {
            //@todo: Get DatePicker value and what not here.

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
        private $User = null;
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
            $html .= "<BR>";
            $html .= "Password:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Password\">";
            $html .= "<BR>";
            $html .= "<INPUT TYPE=\"submit\" VALUE=\"Login\">";
            if($this->LoginError) {
                $html .= "<BR>";
                $html .= "<SPAN CLASS=\"Error\">Login Error: Please check that your username and password are valid.</SPAN>";
            }
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo $this->RenderControl();
        }

        // Returns boolean, indicating whether a user was successfully validated.
        public function Validate($Username, $Password) {
            $query = "SELECT Count(`Username`) FROM `calico.users` WHERE `Username` = '" . base64_encode($Username) . "' AND `Password` = '" . base64_encode($Password) . "';";
            $data = SQL::DataQuery($query);
            $row = mysql_fetch_array($data);
            $count = $row["Count"];

            if($count > 0) {
                return new User($Username, $Password);
            }
            else {
               return null;
            }
        }

        public function GetUser() {
            return $this->User;
        }

        public function Refresh() {
            // Included for completeness sake.
        }

        public function Postback() {
            if(isset($_POST["Username"]) && isset($_POST["Password"])) {
                $this->User = Validate($_POST["Username"], $_POST["Password"]);
                if($this->User != null) {
                    session_start();
                    $_SESSION["USER"] = $this->User;
                    \HTTP\HTTPRedirector("calico_compositecalendar.php");
                }
            }
            $this->LoginError = true;
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
        private $CalendarList = Array();

        public function __construct($User) {
            $this->User = $User;
            $this->Refresh();
        }

        private function RenderControl() {
            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            //@todo: Finish this design. A slight variation on the previous edition, but something easier to programmatically edit (hopefully).
            $html .= "Name:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"name\" />";
            $html .= "<BR>";
            //@todo: Checkboxes to select a calendar, and a button to delete them.
            foreach($this->CalendarList as $calendar) {

                $html .= "<INPUT TYPE=\"checkbox\" NAME=\"\" VALUE=\"\" />";
                $html .= $calendar;
                $html .= "<BR>";
            }
            $html .= "<INPUT TYPE=\"submit\" VALUE=\"Delete\" />";
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo $this->RenderControl();
        }

        public function Refresh() {
            //@todo: Pull from database here. Fill with calendars as per the user.
            $query = "SELECT `CalendarName` FROM `calico`.`calendars` WHERE `UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL\SQL::DataQuery($query);


            // Lock this down to a single row.
            while($row = mysql_fetch_array($data))
            {
                $this->CalendarList[] = base64_decode($row['CalendarName']);
            }
        }

        //@todo: Change this.
        public function UpdateCallback($HTMLName, $Value) {
            if(!($HTMLName == $this->HTMLName)) {
                return;
            }
        }

        public function Postback() {

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
        private $User = null;
        private $HTMLName = "SuperFeedManagerControl";
        private $CSSClass = "SuperFeedManagerControl";
        private $FeedData = Array();
        private $CalendarData = Array();

        public function __construct($User) {
            $this->User = $User;
            $this->Refresh();
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
            $html .= "Calendar:";
            $html .= "<SELECT NAME=\"CalendarSelect\">";
            foreach($this->CalendarData as $calendar) {
                $html .= "<OPTION VALUE=\"" . $calendar . "\">" . $calendar . "</OPTION>";
            }

            $html .= "</SELECT>";
            $html .= "<BR>";

            for($i = 0; $i < count($this->FeedData["FeedURL"]); $i++) {
                //@todo: Rethink this name (Feed[]);
                $html .= "<INPUT TYPE=\"checkbox\" NAME=\"Feed[]\" VALUE=\"" . $i . "\">";
                $html .= $this->FeedData["CalendarName"][$i];
                $html .= $this->FeedData["FeedURL"][$i];
                $html .= "<BR>";
            }
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo $this->RenderControl();
        }

        public function Refresh() {


            $this->GetCalendarNames();
            $this->GetURLs();

        }

        //@todo: Need another query to grab distinct Calendar Names.
        private function GetCalendarNames() {
            $this->CalendarData["CalendarName"] = Array();

            $query = "SELECT `CalendarName` FROM `calico`.`calendars` WHERE `UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $this->CalendarData["CalendarName"][] = base64_decode($row['CalendarName']);
                //$this->FeedData["FeedURL"][] = base64_decode($row['FeedURL']);
            }

        }

        //@todo: Finish this query. Full Join.
        private function GetURLs() {
            $this->FeedData["CalendarName"] = Array();
            $this->FeedData["FeedURL"] = Array();

            $query = "SELECT `S`.`FeedURL`, `C`.`CalendarName` FROM `calico`.`calendars` AS `C` INNER JOIN `calico`.`superfeeds` AS `S` ON `C`.`CalendarID` = `S`.`CalendarID` WHERE `C`.`UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $this->FeedData["CalendarName"][] = base64_decode($row['CalendarName']);
                $this->FeedData["FeedURL"][] = base64_decode($row['FeedURL']);
            }

        }

        public function Postback() {
            //@todo: get submit button postbacl here.

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
        private $Event = null;
        private $HTMLName = "EventEditorControl";
        private $CSSClass = "EventEditorControl";
        private $User = null;

        public function __construct($User, $Event = null) {
            $this->User = $User;
            $this->Event = $Event;
            $this->Refresh();
        }

        private function GetFeedURLs() {
            $feeds = Array();

            $query = "SELECT `S`.`FeedURL` FROM `calico`.`calendars` AS `C` INNER JOIN `calico`.`superfeeds` AS `S` ON `C`.`CalendarID` = `S`.`CalendarID` WHERE `C`.`UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $feeds[] = base64_decode($row['FeedURL']);
            }
            return $feeds;
        }

        private function GetFeedData() {
            $feeddata = Array();
            $feeddata["FeedURL"] = Array();
            $feeddata["FeedUsername"] = Array();
            $feeddata["FeedPassword"] = Array();

            $query = "SELECT `S`.`FeedURL`, `S`.`FeedUsername`, `S`.`FeedPassword` FROM `calico`.`calendars` AS `C` INNER JOIN `calico`.`superfeeds` AS `S` ON `C`.`CalendarID` = `S`.`CalendarID` WHERE `C`.`UserID` = '" . $this->User->GetUserID() . "';";
            $data = SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $feeddata["FeedURL"][] = base64_decode($row['FeedURL']);
                $feeddata["FeedUsername"][] = base64_decode($row['FeedUsername']);
                $feeddata["FeedPassword"][] = base64_decode($row['FeedPassword']);
            }
            return $feeddata;
        }

        private function RenderControl() {

            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<SCRIPT LANGUAGE=\"javascript\" SRC=\"calendar\calendar.js\"></SCRIPT>";
            if($this->Event == null) {
                $feeds = GetFeedURLs();
                $html .= "<SELECT NAME=\"SelectedFeed\">";
                for($i = 0; $i < count($feeds); $i++) {
                    $html .= "<OPTION VALUE=\"" . $i . "\">" . $feeds[$i] . "</OPTION>";
                }
                $html .= "</SELECT>";
            }
            $html .= "Title:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Summary\" SIZE=\"40%\" VALUE=\"" . $this->Event->GetSummary() . "\">"; //@todo: Possibly extract Size component here to CSS.
            $html .= "Location:";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Location\" SIZE=\"40%\" VALUE=\"" . $this->Event->GetLocation() . "\">";
            $html .= $this->RenderPanel("Start", $this->Event->GetStartDate());
            $html .= $this->RenderPanel("End",  $this->Event->GetEndDate());

            /*
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
            */

            $html .= "<script type=\"text/javascript\">
            var tabLinks = new Array();
            var contentDivs = new Array();

            function init() {

                // Grab the tab links and content divs from the page
                var tabListItems = document.getElementById('tabs').childNodes;
              for ( var i = 0; i < tabListItems.length; i++ ) {
                if ( tabListItems[i].nodeName == \"LI\" ) {
                        var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
                  var id = getHash( tabLink.getAttribute('href') );
                  tabLinks[id] = tabLink;
                  contentDivs[id] = document.getElementById( id );
                }
              }

              // Assign onclick events to the tab links, and
              // highlight the first tab
              var i = 0;

              for ( var id in tabLinks ) {
                tabLinks[id].onclick = showTab;
                tabLinks[id].onfocus = function() { this.blur() };
                if ( i == 0 ) tabLinks[id].className = 'selected';
                i++;
              }

              // Hide all content divs except the first
              var i = 0;

              for ( var id in contentDivs ) {
                if ( i != 0 ) contentDivs[id].className = 'tabContent hide';
                i++;
              }
            }

            function showTab() {
                var selectedId = getHash( this.getAttribute('href') );

                // Highlight the selected tab, and dim all others.
                // Also show the selected content div, and hide all others.
              for ( var id in contentDivs ) {
                    if ( id == selectedId ) {
                  tabLinks[id].className = 'selected';
                  contentDivs[id].className = 'tabContent';
                } else {
                  tabLinks[id].className = '';
                  contentDivs[id].className = 'tabContent hide';
                }
                }

              // Stop the browser following the link
              return false;
            }

            function getFirstChildWithTagName( element, tagName ) {
              for ( var i = 0; i < element.childNodes.length; i++ ) {
                if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
              }
            }

            function getHash( url ) {
                var hashPos = url.lastIndexOf ( '#' );
                return url.substring( hashPos + 1 );
            }


            </script>";

            // Should load the javascript we need for the tabs to work.
            $html .= "<SPAN onload=\"init()\"></SPAN>";
            //@todo: Verify where to place this for the Repeat section.
            $html .= "<ul id=\"tabs\">";
            $html .= "<li><a href=\"#daily\">Daily</a></li>";
            $html .= "<li><a href=\"#weekly\">Weekly</a></li>";
            $html .= "<li><a href=\"#yearly\">Yearly</a></li>";
            $html .= "</ul>";

            //Prototype code for Repeat section -> tabbed.
            $html .= "<div class=\"tabContent\" id=\"daily\">";
            $html .= "<h2>Daily</h2>";
            $html .= "<div>";
            $html .= "<p>JavaScript tabs partition your Web page content into tabbed sections. Only one section at a time is visible.</p>";
            $html .= "<p>The code is written in such a way that the page degrades gracefully in browsers that don't support JavaScript or CSS.</p>";
            $html .= "</div>";
            $html .= "</div>";

            $html .= "<div class=\"tabContent\" id=\"weekly\">";
            $html .= "<h2>Weekly</h2>";
            $html .= "<div>";
            $html .= "<p>JavaScript tabs partition your Web page content into tabbed sections. Only one section at a time is visible.</p>";
            $html .= "<p>The code is written in such a way that the page degrades gracefully in browsers that don't support JavaScript or CSS.</p>";
            $html .= "</div>";
            $html .= "</div>";

            $html .= "<div class=\"tabContent\" id=\"monthly\">";
            $html .= "<h2>Monthly</h2>";
            $html .= "<div>";
            $html .= "<p>JavaScript tabs partition your Web page content into tabbed sections. Only one section at a time is visible.</p>";
            $html .= "<p>The code is written in such a way that the page degrades gracefully in browsers that don't support JavaScript or CSS.</p>";
            $html .= "</div>";
            $html .= "</div>";

            $html .= "Description:";
            $html .= "<TEXTAREA TYPE=\"text\" NAME=\"Description\" ROWS=\"5\" COLS=\"60\" WRAP=\"soft\">";
            $html .= $this->Event->GetDescription();
            $html .= "</TEXTAREA>";


            $html .= "</DIV>";

            return $html;
        }


        private function RenderPanel($Prefix, $DefaultTime) {
            require_once('calendar/classes/tc_calendar.php');

            $html = "";
            $html .= $Prefix . " Date:";
            //@todo: give an appropriate html name to this.
            $myCalendar = new tc_calendar($Prefix . "datepicker", true, false); //date5->HTML name.
            $myCalendar->setIcon("calendar/images/iconCalendar.gif");
            $myCalendar->setDate(date('d', strtotime($DefaultTime))
                , date('m', strtotime($DefaultTime))
                , date('Y', strtotime($DefaultTime)));
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

            $html .= "<SELECT NAME=\"" . $Prefix . "hour\">"; // $_POST["starthour"], $_POST["endhour"]
            for($hour = 1; $hour <= 12; $hour++)
            {
                $html .= "<OPTION value=\"" . str_pad($hour, 2, "0", STR_PAD_LEFT) . "\"";
                if($hour == date("g", srttotime($DefaultTime))) {
                    $html .= " selected=\"selected\"";
                }
                $html .= ">" . $hour . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<SELECT NAME=\"" . $Prefix . "minute\">"; // $_POST["startminute"], $_POST["endminute"]
            for($minute = 0; $minute < 60; $minute++)
            {
                $html .= "<OPTION VALUE=\"" . str_pad($minute, 2, "0", STR_PAD_LEFT) . "\"";
                if($minute == date("i", srttotime($DefaultTime))) {
                    $html .= " selected=\"selected\"";
                }
                $html .= ">" . str_pad($minute, 2, "0", STR_PAD_LEFT) . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<SELECT NAME=\"" . $Prefix . "period\">"; // $_POST["startperiod"], $_POST["startperiod"]
            $html .= "<OPTION VALUE=\"AM\"";
            if("AM" == date("A", srttotime($DefaultTime))) {
                $html .= " selected=\"selected\"";
            }
            $html .= ">AM</OPTION>";
            $html .= "<OPTION VALUE=\"PM\"";
            if("PM" == date("A", srttotime($DefaultTime))) {
                $html .= " selected=\"selected\"";
            }
            $html .= ">PM</OPTION>";
            $html .= "</SELECT>";

            return $html;
        }

        private function GetPanelDateTime($Prefix) {
            $date = isset($_REQUEST[$Prefix . "datepicker"]) ? $_REQUEST[$Prefix . "datepicker"] : ""; //Year-Month-Day
            $time = $_POST[$Prefix . "hour"] . ":" . $_POST[$Prefix . "minute"] . ":" .$_POST[$Prefix . "period"];

            return strtotime($date . " " . $time);
        }

        public function Create() {
            $this->Event = \Data\Event::Create(  );
        }



        public function Postback() {
            if(isset($_POST["Summary"])) {
                $summary = $_POST["Summary"];
                $location = $_POST["Location"];
                $description = $_POST["Description"];
                $startdate = $this->GetPanelDateTime("Start");
                $enddate = $this->GetPanelDateTime("End");

                if($this->Event == null) {
                    $id = $_POST["SelectedFeed"];
                    $feeddata = GetFeedData();
                    $feedurl = $feeddata["FeedURL"][$id];
                    $feedusername = $feeddata["FeedUsername"][$id];
                    $feedpassword = $feeddata["FeedPassword"][$id];
                    //@todo: Will want to finalize this later.
                    \Data\Event::Create($feedurl, $feedusername, $feedpassword, $summary, $startdate, $enddate, $location, $description);
                }
                else {

                    $this->Event->Update($summary, $location, $description, $startdate, $enddate);
                }
            }

            HTTP\HTTPRedirector("calico_compositecalendar.php");

        }

        public function Delete() {
            $this->Event->Delete();
        }

        public function Draw() {
            echo $this->RenderControl();
        }

        public function Refresh() {
            $this->Event->Refresh();
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

        public function __construct($Username, $Password) {
            // Probably want to Base64 encode the values going into and out of the MySQL database, to prevent a SQL Injection attack.
            $query = "SELECT `UserID` FROM `calico`.`users` WHERE `Username` = '" . base64_encode($Username) . "' AND `Password` = '" . base64_encode($Password) . "';";
            $data = SQL::DataQuery($query);
            $row = mysql_fetch_array($data);
            $this->SQL_ID = $row["UserID"];
        }

        public function GetUserID() {
            return $this->SQL_ID;
        }
    }
    // Calendar -> class for containg user-defined calendars.
    class Calendar {
        private $SQL_ID = "";
        //private $CalendarName = "";
        private $SuperFeedList = Array();

        public function __construct($CalendarID) {
            $this->SQL_ID = $CalendarID;
            $this->Refresh();
        }

        public function GetSuperFeedList() {
            return $this->SuperFeedList;
        }

        public function Refresh() {
            $query = "SELECT `SuperFeedID` FROM `calico`.`superfeeds` WHERE `CalendarID` = '" . $this->SQL_ID . "';";
            $data = SQL\SQL::DataQuery($query);

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
        private $FeedURL = "";
        private $ETAG = ""; // I may have some use for this.
        private $FeedUsername = "";
        private $FeedPassword = "";
        private $EventList = Array();



        // @todo: Rewrite this more intelligently.
        public function __construct($SuperFeedID) {
            $this->SQL_ID = $SuperFeedID;
            $this->Refresh();
        }

        public function GetEventList() {
            return $this->EventList;
        }

        public function Refresh() {
            $query = "SELECT `FeedURL`, `FeedUsername`, `FeedPassword` FROM `calico`.`superfeeds` WHERE `SuperFeedID` = '" . $this->SuperFeedID . "';";
            $data = SQL\SQL::DataQuery($query);

            $row = mysql_fetch_array($data);
            $this->FeedURL = base64_decode($row['FeedURL']);
            $this->FeedUsername = base64_decode($row['FeedUsername']);
            $this->FeedPassword = base64_decode($row['FeedPassword']);
        }

        private function Propfind() {
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Depth"] = "0";
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);

            $content = Array();
            $content[] = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $content[] = "<D:propfind xmlns:D=\"DAV:\">";
            $content[] = "<D:prop>";
            $content[] = "<D:getcontenttype/>";
            $content[] = "<D:resourcetype/>";
            $content[] = "<D:getetag/>";
            $content[] = "</D:prop>";
            $content[] = "</D:propfind>";

            $this->ParsePropfind(\HTTP\HTTPRequests::Propfind($this->URL, $headers, $content));

        }

        private function ParsePropfind($String) {

            $Xml = new SimpleXMLElement($String);
            $ResponseList = $Xml->multistatus->response->children();
            // Don't need the first one.
            for($i = 1; $i < count($ResponseList); $i++) {
                $feedurl = parse_url($this->FeedURL, PHP_URL_SCHEME) . "://" . parse_url($this->FeedURL, PHP_URL_HOST) . $ResponseList[$i]->href; //$Xml->xpath("/multistatus/response/href"); // Modify these for iteration.
                $etag = $ResponseList[$i]->propstat->prop->getetag;//$Xml->xpath("/multistatus/response/propstat/prop/getetag");
                $this->EventList[] = new Event($feedurl, $this->FeedUsername, $this->FeedPassword, $etag);
            }
        }

    }

    // Event -> class for storing event information. Due to this redesign, Event will now be handling some of the functions previously found in the Feed class.
    class Event {
        private $FeedURL = "";
        private $FeedUsername = "";
        private $FeedPassword = "";
        private $ETAG = "";
        private $Summary = "";
        private $Location = "";
        private $Description = "";
        private $UID = "";
        private $StartDate = null;
        private $EndDate = null;
        private $XMozGeneration = 0;
        private $DateStamp = null;
        private $Created = null;
        private $LastModified = null;
        private static $BannedUIDs = Array(); // Sanity check, to ensure that we aren't going to use an existing UID.

        public static function GetBannedUIDs() {
            return $this->BannedUIDs;
        }

        public function GetSummary() {
            return $this->Summary;
        }

        public function GetLocation() {
            return $this->Location;
        }

        public function GetDescription() {
            return $this->Description;
        }

        public function GetStartDate() {
            return $this->StartDate;
        }

        public function GetEndDate() {
            return $this->EndDate;
        }

        //@todo: Verify that this is the correct, or at least, a very good idea. A default constructor that just takes in the string containing VEVENT information (raw).
        public function __construct($FeedURL, $FeedUsername, $FeedPassword, $ETAG) {
            //ParseVEvent($String);
            $this->FeedUsername = $FeedUsername;
            $this->FeedPassword = $FeedPassword;
            $this->FeedURL = $FeedURL;
            $this->ETAG = $ETAG;
            $this->Refresh();

        }

        // @todo: Store this here until I know what to do with it.
        public function GetNewUniqueID() {
            $isnew = true;
            $newUID = "";
            do {
                $newUID = str_replace(".", "", uniqid("", true));
                if(in_array($newUID, $this->GetBannedUIDs())) {
                        $isnew = false;
                }
            } while($isnew == false);

            return $newUID;
        }

        public function Refresh() {
            $this->Report();
        }

        public function Report() {
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($this->FeedUsername . ":" . $this->FeedPassword);
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

            $this->ParseReport(\HTTP\HTTPRequests::Report($this->URL, $headers, $content));

        }


        public function Update($Summary, $Location, $Description, $StartDate, $EndDate, $RRule = null) {
            $this->Summary = $Summary;
            $this->Location = $Location;
            $this->Description = $Description;
            $this->StartDate = $StartDate;
            $this->EndDate = $EndDate;

            $this->Put();

        }

        private function Put() {
            // @todo: Rewrite the HTTP requests in this object to flow more.
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($this->FeedUsername . ":" . $this->FeedPassword);
            $headers["If-Match"] = $this->ETAG;

            $content = Array();
            $content[] = "BEGIN:VCALENDAR";
            $content[] = "PRODID:Calico";
            $content[] = "VERSION:2.0";

            $content[] = "BEGIN:VTIMEZONE";
            $content[] = "TZID:America/New_York"; // date_default_timezone_get()
            $content[] = "X-LIC-LOCATION:America/New_York";

            //@todo: Implement Daylight-Savings / Other Timezones, instead of hard coding them.

            //Verify which one is Daylight, if it has Daylight.

            //Algorithm -> create a date on June 1st, then set it to December 1st. Check timezones on both.
            // If they match, there is no DayLight savings.

            //New idea: nevermind this nonsense, for now. Apparently, not only are date / times a level of insanity (as I already knew),
            //but timezones + daylight savings times are moving targets. It appears that some countries are randomly trying out Daylight-Savings times.

            $content[] = "BEGIN:DAYLIGHT";
            $content[] = "TZOFFSETFROM:-0500";
            $content[] = "TZOFFSETTO:-0400";
            $content[] = "TZNAME:EDT";
            $content[] = "DTSTART:19700308T020000";
            $content[] = "RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3";
            $content[] = "END:DAYLIGHT";

            $content[] = "BEGIN:STANDARD";
            $content[] = "TZOFFSETFROM:-0400";
            $content[] = "TZOFFSETTO:-0500";
            $content[] = "TZNAME:EST";
            $content[] = "DTSTART:19701101T020000";
            $content[] = "RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11";
            $content[] = "END:STANDARD";
            $content[] = "END:VTIMEZONE";
            array_merge($content, $this->BuildVEvent($this->UID, $this->Summary, $this->StartDate, $this->EndDate, $this->Location, $this->Description, time(), $this->Created, time())); //GenerateUID goes in here.
            $content[] = "END:VCALENDAR";

            //array_merge($content, $this->BuildVEvent($uid, $Summary, $StartDate, $EndDate, $Location, $Description, $LastModified, $Created, $DateStamp));


            //$headers["Content-Length"] = $this->ContentLength($content);

            $this->ParsePut(\HTTP\HTTPRequests::Put($this->URL, $headers, $content));

        }

        public function Delete() {
            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Authorization"] = base64_encode($this->FeedUsername . ":" . $this->FeedPassword);
            $headers["If-Match"] = $this->ETAG;

            $this->ParseDelete(\HTTP\HTTPRequests::Delete($this->URL, $headers));
        }


        private function ParseDelete($String) {
            // HTTP/1.1 204 No Content
            if (strlen(strstr($String,"HTTP/1.1 204 No Content"))>0) {
                return true;
            }

            return false;
        }

        private function ParseReport($String) {
            // HTTP/1.1 207 Multi-Status
            if (!(strlen(strstr($String,"HTTP/1.1 207 Multi-Status"))>0)) {
                 return false;
            }

            $Xml = SimpleXMLElement(strstr($String, "\r\n\r\n"));
            $this->ETAG = $Xml->multistatus->response[0]->propstat->prop->getetag;
            $vevent = $Xml->multistatus->response[0]->propstat->prop->children("urn:ietf:params:xml:ns:caldav");
            ParseVEvent($vevent[0]);

            return true;

        }

        //@todo: Move creation functions to Event.
        public static function Create($FeedURL, $FeedUsername, $FeedPassword, $Summary, $StartDate, $EndDate, $Location, $Description, $RRule = null) {

            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($FeedUsername . ":" . $FeedPassword);
            $headers["If-None-Match"] = "*";

            $uid = GetNewUniqueID();
            $content = Array();
            $content[] = "BEGIN:VCALENDAR";
            $content[] = "PRODID:Calico";
            $content[] = "VERSION:2.0";

            $content[] = "BEGIN:VTIMEZONE";
            $content[] = "TZID:America/New_York"; // date_default_timezone_get()
            $content[] = "X-LIC-LOCATION:America/New_York";

            //@todo: Implement Daylight-Savings / Other Timezones, instead of hard coding them.

            //Verify which one is Daylight, if it has Daylight.

            //Algorithm -> create a date on June 1st, then set it to December 1st. Check timezones on both.
            // If they match, there is no DayLight savings.

            //New idea: nevermind this nonsense, for now. Apparently, not only are date / times a level of insanity (as I already knew),
            //but timezones + daylight savings times are moving targets. It appears that some countries are randomly trying out Daylight-Savings times.

            $content[] = "BEGIN:DAYLIGHT";
            $content[] = "TZOFFSETFROM:-0500";
            $content[] = "TZOFFSETTO:-0400";
            $content[] = "TZNAME:EDT";
            $content[] = "DTSTART:19700308T020000";
            $content[] = "RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3";
            $content[] = "END:DAYLIGHT";

            $content[] = "BEGIN:STANDARD";
            $content[] = "TZOFFSETFROM:-0400";
            $content[] = "TZOFFSETTO:-0500";
            $content[] = "TZNAME:EST";
            $content[] = "DTSTART:19701101T020000";
            $content[] = "RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11";
            $content[] = "END:STANDARD";
            $content[] = "END:VTIMEZONE";
            array_merge($content, $this->BuildVEvent($uid, $Summary, $StartDate, $EndDate, $Location, $Description, time(), time(), time())); //GenerateUID goes in here.
            $content[] = "END:VCALENDAR";

            $url = $FeedURL . $uid . ".ics"; //@todo: Construct URL (UID) to post to here.
            $response = \HTTP\HTTPRequests::Put($url, $headers, $content);

            if (strlen(strstr($response,"HTTP/1.1 201 Created"))>0) {
                $Event = new Event($url);
                return $Event;
            }

            return null;
        }

        private function ParsePut($String) {
            if (strlen(strstr($String,"HTTP/1.1 204 No Content"))>0) {
                $this->ETAG = Extract\Extract::GetETag($String);
                return true;
            }
            return false;
        }

        private function ParseVEvent($String) {

            $daylight = \Extract\Extract::GetDaylight($String);
            $vevent = \Extract\Extract::GetVEvent($String);

            $this->Summary = \Extract\Extract::GetSummary($vevent);


            $start = explode(":", \Extract\Extract::GetStartDate($vevent));
            $startdatetime = new DateTime($start[1]);
            $startdatetimezone = timezone_open($start[0]);
            $startdatetime->setTimezone($startdatetimezone);
            $this->StartDate =  $startdatetime->getTimestamp();

            $end = explode(":", \Extract\Extract::GetEndDate($vevent));
            $enddatetime = new DateTime($end[1]);
            $enddatetimezone = timezone_open($end[0]);
            $enddatetime->setTimezone($enddatetimezone);
            $this->EndDate = $enddatetime->getTimestamp();

            $this->Location = \Extract\Extract::GetLocation($vevent);
            $this->Description = \Extract\Extract::GetDescription($vevent);
            $this->Created = \Extract\Extract::GetCreated($vevent);
            $this->LastModified = \Extract\Extract::GetLastModified($vevent);
            $this->DateStamp =  \Extract\Extract::GetDateStamp($vevent);
            $this->UID = \Extract\Extract::GetUID($vevent);
            //$this->XMozGeneration = \Extract\Extract::GetXMozGeneration($vevent);
            //$this->rrule = \Extract\Extract::GetRRule($vevent);

            if(!in_array($this->UID, $this->BannedUIDs)) {
                $this->BannedUIDs[] = $this->UID;
            }



        }

        public static function BuildVEvent($UID, $Summary, $StartDate, $EndDate, $Location, $Description, $LastModified, $Created, $DateStamp, $RRule = null) {
            $content = Array();
            $content[] = "BEGIN:VEVENT";
            $content[] = "CREATED:" . gmdate("Ymd\THi00\Z",$Created); //gmdate()
            $content[] = "LAST-MODIFIED:" . gmdate("Ymd\THi00\Z",$LastModified);
            $content[] = "DTSTAMP:" . gmdate("Ymd\THi00\Z", $DateStamp);
            $content[] = "UID:" . $UID;
            $content[] = "SUMMARY:" . $Summary;
            //@todo: Overhaul RRule.
            /*
            if($RRule != null && $RRule != "") {
                $content[] = "RRULE:" . $RRule;
            }
            */
            $content[] = "DTSTART;TZID=" . date("e", time()) . ":" . date("Ymd\THi00", $StartDate);  //date_default_timezone_get()
            $content[] = "DTEND;TZID=" . date("e", time()) . ":" . date("Ymd\THi00", $EndDate); //date()

            if($Location != null && $Location != "") {
                $content[] = "LOCATION:" . $Location;
            }
            if($this->Description != null && $Description != "") {
                $content[] = "DESCRIPTION:" . $Description;
            }
            //Mozilla extension.
            /*
            if($this->XMozGeneration == 0) {

            }
            else {
                 $this->XMozGeneration += 1;
                $content[] = "X-MOZ-GENERATION:" . $this->XMozGeneration;
            }
            */
            //X-MOZ-GENERATION:1 // Probably want to work this in here.
            $content[] = "END:VEVENT";
            return $content;
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

            // Open a connection to the server.
            $connection = fsockopen($server, $port, $errno, $errstr);
            if (!$connection) {
                die($errstr($errno));
            }

            fwrite($connection, $Data);

            $response = "";
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

            $content = "";
            foreach($Content as $data) {
                $content .= $data . "\r\n";
            }

            $contentlength = $this->ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

            return $this->Send($request);

        }

        public static function Report($URL, $Headers, $Content) {
            $request = "";
            $request .= "REPORT " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            $content = "";
            foreach($Content as $data) {
                $content .= $data . "\r\n";
            }


            $contentlength = $this->ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

            return $this->Send($request);
        }

        //@todo: Fully compartmentalize these functions.
        public static function Propfind($URL, $Headers, $Content) {
            $request = "";
            $request .= "PROPFIND " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            $content = "";
            foreach($Content as $data) {
                $content .= $data . "\r\n";
            }


            $contentlength = $this->ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

            return $this->Send($request);
        }


        public static function Delete($URL, $Headers) {

            $request = "";
            $request .= "DELETE " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            return $this->Send($request);
        }

        public static function Options($URL, $Headers, $Content) {
            $request = "";
            $request .= "OPTIONS " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST)  . "\r\n";

            $content = "";
            foreach($Content as $data) {
                $content .= $data . "\r\n";
            }


            $contentlength = $this->ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

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