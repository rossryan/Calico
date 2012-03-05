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


    //TSBuilder -> class for building a Timestamp. Debating whether I need this one.
    class Time {

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
    class TimeInfo {

        const NumberOfDaysInMonth = "NumberOfDaysInMonth";
        const DayOfTheWeek = "DayOfTheWeek";
        const Year = "Year";
        const Month = "Month";
        const Week = "Week";
        const Day = "Day";
        const Hour = "Hour";
        const Second = "Second";

        const String = "String";
        const Integer = "Integer";
        //const Timestamp = "Timestamp";

        // Extract information from a timestamp.
        public static function Extract($timestamp, $arg) {


            return;
        }




    }

    class CompositeDropDown {
        private $HTMLName = "CompositeDropDownControl";
        private $CSSClass = "CompositeDropDownControl";
        private $User;


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

        private $HTMLName = "CompositeCalendarControl";
        private $CSSClass = "CompositeCalendarControl";


        public function __construct($User) {
            $this->User = $User;
            Refresh();

        }

        // List of Calendar names to display alongside the checkboxes.
        // @todo: Create a separate control for the list of calendars. Potentially.

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

            return $html;

        }


        public function RenderWeekly() {
            $html = "";

            return $html;

        }

        public function RenderDaily() {
            $html = "";

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


        // private $Query = "SELECT [CalendarID] FROM [Calendar] WHERE [Displayed] = 1"; // Prototype new query for selecting calendars for display in the composite calendar object.

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
            $query = "SELECT [SuperFeedID] FROM [SuperFeeds] WHERE [CalendarID] = '" . $CalendarID . "';";
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

                $this->EventList[] = new Event();
            }

        }




        private function ParsePropfind($String) {

            $Xml = new SimpleXMLElement($String);
            $URL = $Xml->xpath("/multistatus/response/href"); // Modify these for iteration.
            $Etag = $Xml->xpath("/multistatus/response/propstat/prop/getetag");
        }


    }

    // Event -> class for storing event information. Due to this redesign, Event will now be handling some of the functions previously found in the Feed class.
    class Event {
        private $URL = "";
        private $ETAG = "";
        private $FeedUsername = "";
        private $FeedPassword = "";


        public function __construct() {


        }

        public function Refresh() {

        }

        // @todo: Flesh this out. Might need to move / copy a variant to the Event class.
        private function ParsePropfind($String) {
            $Xml = new SimpleXMLElement($String);
            $Etag = $Xml->xpath("/multistatus/response/propstat/prop/getetag");
            $CCalendarData = $Xml->xpath("/multistatus/response/propstat/prop/C:calendar-data");

        }



        private function ParseDelete() {

        }

        private function ParseReport() {

        }


    }

    // HTTPRequests -> PHP seems to be lacking a lot of the WebDav / CalDav extensions. I'm abstracting these from the V1 versions, so future edits (ostensibly by other programmers) will be easier.
    class HTTPRequests {

        private function ContentLength($Content) {
            return strlen(strstr($Content, "\r\n\r\n")) - 4;
        }


        // parse_url for here.
        // rawurlencode / rawlurldecode for later.
        public function Put($URL, $Headers, $Content) {

            $request = "";

            $request .= "PUT " . $URL . " HTTP/1.1";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST);
            $request .= "User-Agent: Calico (v.01)";

            /*
            Accept: text/xml
            Accept-Language: en-us,en;q=0.5
            Accept-Encoding: gzip,deflate
            Accept-Charset: utf-8,*;q=0.1
            Keep-Alive: 300
            Connection: keep-alive
            Content-Length: 766
            Content-Type: text/calendar; charset=utf-8
            If-Match: "8a3a3d592a5acd5ce43e3cfafaaf8c1b"
            Authorization: Basic cndyMjY6V2FycCRpZzc=
                    Pragma: no-cache
            Cache-Control: no-cache

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
            CREATED:20110912T163616Z
            LAST-MODIFIED:20120217T173356Z
            DTSTAMP:20120217T173356Z
            UID:4e6e3500e89673.63357057
            SUMMARY:Test
            DTSTART;TZID=America/New_York:20130717T081400
            DTEND;TZID=America/New_York:19691231T190000
            DESCRIPTION:Testhhhh
            X-MOZ-GENERATION:1
            END:VEVENT
            END:VCALENDAR
            */


        }

        public function Report($URL, $Headers, $Content) {
            $request = "";


            /*
            $request .= "REPORT " . $URL . " HTTP/1.1";
            Host: calendar.cs.drexel.edu
            User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.5) Gecko/20091211 Sunbird/1.0b1
            Accept: text/xml
            Accept-Language: en-us,en;q=0.5
            Accept-Encoding: gzip,deflate
            Accept-Charset: utf-8,*;q=0.1
            Keep-Alive: 300
            Connection: keep-alive
            Content-Length: 440
            Content-Type: text/xml; charset=utf-8
            Depth: 1
            Authorization: Basic cndyMjY6V2FycCRpZzc=
                            Pragma: no-cache
            Cache-Control: no-cache

                            <?xml version="1.0" encoding="UTF-8"?>
            <calendar-multiget xmlns:D="DAV:" xmlns="urn:ietf:params:xml:ns:caldav">
                <D:prop>
                    <D:getetag/>
                    <calendar-data/>
                </D:prop>
                <D:href>/davical/caldav.php/rwr26/home/c9bfc6b0-064e-4316-83fe-753db34e67ee.ics</D:href>
                <D:href>/davical/caldav.php/rwr26/home/4e6e3500e89673.63357057.ics</D:href>
                <D:href>/davical/caldav.php/rwr26/home/4e6e42d394f9e5.08299254.ics</D:href>
            </calendar-multiget>
            */
        }


        public function Propfind($URL, $Headers, $Content) {
            /*
            PROPFIND https://calendar.cs.drexel.edu/davical/caldav.php/rwr26/home/ HTTP/1.1
            Host: calendar.cs.drexel.edu
            User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.5) Gecko/20091211 Sunbird/1.0b1
            Accept: text/xml
            Accept-Language: en-us,en;q=0.5
            Accept-Encoding: gzip,deflate
            Accept-Charset: utf-8,*;q=0.1
            Keep-Alive: 300
            Connection: keep-alive
            Content-Length: 160
            Content-Type: text/xml; charset=utf-8
            Depth: 0
            Pragma: no-cache, no-cache
            Cache-Control: no-cache, no-cache
            Authorization: Basic cndyMjY6V2FycCRpZzc=

            <D:propfind xmlns:D="DAV:" xmlns:CS="http://calendarserver.org/ns/">
              <D:prop>
                <D:resourcetype/>
                <D:owner/>
                <CS:getctag/>
              </D:prop>
            </D:propfind>

            */
        }


        public function Delete($URL, $Headers, $Content) {

        }

        public function Options($URL, $Headers, $Content) {
            /*
            OPTIONS https://calendar.cs.drexel.edu/davical/caldav.php/rwr26/ HTTP/1.1
            Host: calendar.cs.drexel.edu
            User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.5) Gecko/20091211 Sunbird/1.0b1
            Accept: text/xml
            Accept-Language: en-us,en;q=0.5
            Accept-Encoding: gzip,deflate
            Accept-Charset: utf-8,*;q=0.1
            Keep-Alive: 300
            Connection: keep-alive
            Pragma: no-cache
            Cache-Control: no-cache
            */
        }


    }
    // Login -> a control to handle the login aspect of things. Will be a GUI control.
    class Login {
        private $User;
        private $HTMLName = "LoginControl";
        private $CSSClass = "LoginControl";

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
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo RenderControl();
        }

        // Returns boolean, indicating whether a user was successfully validated.
        public function Validate($Username, $Password) {

            //@todo: SQL query -> check if the user exists, and if so, store in the $User variable for later retrieval.
        }

        public function GetUser() {
            return $this->User;
        }

        public function Refresh() {

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

            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo RenderControl();
        }

        public function Refresh() {

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
            $html .= "";

            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo RenderControl();
        }

        public function Refresh() {

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

    // Going to encapsulate the various pages in the previous version into GUI controls. Going full .NET on this one. ;-)
    class EventEditor {
        private $Event;
        private $HTMLName = "EventEditorControl";
        private $CSSClass = "EventEditorControl";

        public function __construct($Event) {
            $this->Event = $Event;
            Refresh();
        }

        private function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";

            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            echo RenderControl();
        }

        public function Refresh() {

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

    // Simple class to issue a HTTP redirect (to get around some problems). Should be the first thing on the page.
    class HTTPRedirector {
        public static function Redirect($URL) {
            header("Location : " . $URL);
        }
    }

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
                die('Could not connect: ' . mysql_error());
            }

            mysql_select_db(Database, $connection);
            mysql_query($Query);

        }

    }

















?>