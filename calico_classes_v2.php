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
            //@todo: Finish this. Need to verify that extraction will work properly, and that the design is simplistic.

            return;
        }




    }
}

namespace GUI {
    class Event {
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
            $html .= "</DIV>";

            return $html;
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

        public function __construct($Event) {
            $this->Event = $Event;
            Refresh();
        }

        private function RenderControl() {

            require_once('calendar/classes/tc_calendar.php'); // Require once to get the Calendar control on the page.

            $myCalendar = new tc_calendar("date5", true, false);
            $myCalendar->setIcon("calendar/images/iconCalendar.gif");
            $myCalendar->setDate(date('d'), date('m'), date('Y'));
            $myCalendar->setPath("calendar/");
            $myCalendar->setYearInterval(2000, 2050);
            $myCalendar->dateAllow('2008-05-13', '2015-03-01');
            $myCalendar->setDateFormat('j F Y');
            $myCalendar->setAlignment('left', 'bottom');

            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<script language=\"javascript\" src=\"calendar\calendar.js\"></script>";

            $myCalendar->writeScript();
            $html .= "</DIV>";

            return $html;
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
            //@todo: Get data function goes here.
        }

        public function Update() {
            //@todo: Update function goes here -> need to decide what data to grab from the Event Editor control.

        }

        public function Delete() {
            //@todo: Delete -> should be simple, with the general exception of getting the right eTag.

            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Authorization"] = base64_encode($this->FeedUsername) . ":" . base64_encode($this->FeedPassword);
            $headers["If-Match"] = "\"" . $this->ETAG . "\"";

            \HTTP\HTTPRequests::Delete($this->URL, $headers);
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

        private $StandardHeaders = Array("User-Agent" => "Calico v.02", "Accept" => "text/xml", "Accept-Language" => "en-us,en;q=0.5", "Accept-Encoding" => "gzip,deflate", "Accept-Charset" => "utf-8,*;q=0.1",
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

            $headers = Array();
            $headers = $this->StandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = base64_encode($username) . ":" . base64_encode($password);
            $headers["If-Match"] = "\"" . $etag . "\"";
            $headers["Content-Length"] = $this->ContentLength($Content);

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
            $request .= "<D:href>/davical/caldav.php/rwr26/home/c9bfc6b0-064e-4316-83fe-753db34e67ee.ics</D:href>"; //@todo: parse_url path extraction might work here.
            $request .= "<D:href>/davical/caldav.php/rwr26/home/4e6e3500e89673.63357057.ics</D:href>";
            $request .= "<D:href>/davical/caldav.php/rwr26/home/4e6e42d394f9e5.08299254.ics</D:href>";
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

            $headers = Array();
            $headers = $this->StandardHeaders();

            return $this->Send($request);

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