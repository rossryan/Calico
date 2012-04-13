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



namespace Extract {
    class Extract {


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



        public static function GetXMLETAG($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='()';
            $re3='(".*?")';
            $re4='()';	# Non-greedy match on filler
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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re8='(\n)';	# Any Single Character 4

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re3='(;)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re3='(;)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

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
            $re5='(\n)';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        //@todo: Check this function later. May be missing something.
    /*
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
    */

        public static function GetETag($String) {

            $re1='.*?';	# Non-greedy match on filler
            $re2='(ETag)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='(\n)';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetContentLength($String) {

            $re1='.*?';	# Non-greedy match on filler
            $re2='(Content-Length)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='(\n)';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetDateStamp($String) {

            $re1='.*?';	# Non-greedy match on filler
            $re2='(DTSTAMP)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='(\n)';	# Any Single Character 2

            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
            {

                $word1=$matches[1][0];
                $c1=$matches[2][0];
                $word2=$matches[3][0];
                return $word2;
            }

        }

        public static function GetXMozGeneration($String) {
            $re1='.*?';	# Non-greedy match on filler
            $re2='(X-MOZ-GENERATION)';	# Word 1
            $re3='(:)';	# Any Single Character 1
            $re4='(.*?)';	# Non-greedy match on filler
            $re5='(\n)';	# Any Single Character 2

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

        //private static $start = NULL;
        //private static $timeout = 5;

        //private static $StandardHeaders =

        public static function GetStandardHeaders() {
            return Array("User-Agent" => "Calico v.02", "Accept" => "text/xml", "Accept-Language" => "en-us,en;q=0.5", "Accept-Encoding" => "gzip,deflate", "Accept-Charset" => "utf-8,*;q=0.1",
                "Keep-Alive" => "300", "Connection" => "keep-alive", "Pragma" => "no-cache", "Cache-Control" => "no-cache");
        }


        private static function ContentLength($Content) {
            return strlen(strstr($Content, "\r\n")) - 2;
        }

        private static function Base64UsernamePassword($Username, $Password) {
            return base64_encode($Username . ":" . $Password);

        }

        public static function FixNewlines($String) {

            $String = str_replace("\n ", "", $String);

            return $String;
        }

        public static function FixEverythingElse($String) {

            //$String = str_replace("\r\n ", "", $String);
            $String = str_replace("\\n", "\n", $String);
            $String = str_replace("\\N", "\n", $String);
            //$String = str_replace("\n", "", $String);
            //$String = str_replace("\r", "\n", $String);

            $String = str_replace("\,", ",", $String);
            $String = str_replace("\\\"", "\"", $String);
            $String = str_replace("\;", ";", $String);
            $String = str_replace("\\\\", "\\", $String);
            return $String;
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
            if(\HTTP\HTTPRequests::ProxyEnabled) {
                $server = \HTTP\HTTPRequests::ProxyServer;
                $port = \HTTP\HTTPRequests::ProxyPort;
            }



            // Open a connection to the server.
            $connection = fsockopen($server, $port, $errno, $errstr);
            if (!$connection) {
                die("OMG Ponies!");
            }
            //echo "===========================================================<BR>";
            //echo "Connection Open<BR>";
            //echo "The Time is " . date("H:i:su", time()) . "<BR>";
            //echo "Sending Request<BR>";

            fwrite($connection, $Data);

            //echo "Request Sent.";
            //echo "The Time is " . date("H:i:su", time()) . "<BR>";
            $responseheader = "";
            $responsebody = "";


            /*
            \HTTP\HTTPRequests::$start = NULL;
            \HTTP\HTTPRequests::$timeout = 10;

            // @todo: Rewrite this. Should keep checking for '/r/n/r/n', then check for a content length header. If found, keep grabbing bytes, then close. If not, then close immediately.
            while(!\HTTP\HTTPRequests::safe_feof($connection, \HTTP\HTTPRequests::$start) && (microtime(true) - \HTTP\HTTPRequests::$start) < \HTTP\HTTPRequests::$timeout)
            {
                $response .= fgets($connection);
            }
            */
            //echo "Getting Response<BR>";
            //echo "The Time is " . date("H:i:su", time()) . "<BR>";
            while(!feof($connection) && !(strlen(strstr($responseheader,"\r\n\r\n"))>0)) {
                $responseheader .= fgets($connection);
            }

            //echo "The Header is fully received at " . date("H:i:su", time()) . "<BR>";
            //echo "Header (raw):" . "<BR>";
            //echo "/////////////////////////////////////////////<BR>";
            //echo $responseheader . "<BR>";
            //echo "/////////////////////////////////////////////<BR>";

            if((strlen(strstr($responseheader,"Content-Length:"))>0)) {
                $contentlength = ((int)(\Extract\Extract::GetContentLength($responseheader)));
                //for($i = 0; $i < $contentlength; $i++) {
                    //$responsebody .= fgets($connection, $contentlength);
                $responsebody .= stream_get_line($connection, $contentlength);
                //}
                //echo "The Body is fully received at " . date("H:i:su", time()) . "<BR>";
                //echo "Body (raw):" . "<BR>";
                //echo "{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}<BR>";
                //echo $responsebody . "<BR>";
                //echo "{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}{}<BR>";
                //echo "<B>!Content length is " . strlen($responsebody) . ". It should be " . $contentlength . "!</B><BR>";
            }

            //echo "Response Received.<BR>";
            //echo "The Time is " . date("H:i:su", time()) . "<BR>";
            fclose($connection);

            //echo "Connection Closed.<BR>";
            //echo "The Time is " . date("H:i:su", time()) . "<BR>";
            //echo "Exiting Send() method.<BR>";
            //echo "===========================================================<BR>";
            //echo "<BR>";

            return $responseheader . $responsebody;
        }

        // parse_url for here.
        // rawurlencode / rawlurldecode for later.
        public static function Put($URL, $Headers, $Content) {
            $request = "";
            $request .= "PUT " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            $content = "";
            foreach($Content as $data) {
                $content .= "\r\n" . $data;
            }

            $contentlength = \HTTP\HTTPRequests::ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

            return \HTTP\HTTPRequests::Send($URL, $request);

        }

        public static function Report($URL, $Headers, $Content) {
            $request = "";
            $request .= "REPORT " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            $content = "";
            foreach($Content as $data) {
                $content .= "\r\n" . $data;
            }


            $contentlength = \HTTP\HTTPRequests::ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

            return \HTTP\HTTPRequests::Send($URL, $request);
        }

        //@todo: Fully compartmentalize these functions.
        public static function Propfind($URL, $Headers, $Content) {
            $request = "";
            $request .= "PROPFIND " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            $content = "";
            foreach($Content as $data) {
                $content .= "\r\n" . $data;
            }


            $contentlength = \HTTP\HTTPRequests::ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

            return \HTTP\HTTPRequests::Send($URL, $request);
        }


        public static function Delete($URL, $Headers) {

            $request = "";
            $request .= "DELETE " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST) . "\r\n";

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= "\r\n";

            return \HTTP\HTTPRequests::Send($URL, $request);
        }

        public static function Options($URL, $Headers, $Content) {
            $request = "";
            $request .= "OPTIONS " . $URL . " HTTP/1.1" . "\r\n";
            $request .= "Host: " . parse_url($URL, PHP_URL_HOST)  . "\r\n";

            $content = "";
            foreach($Content as $data) {
                $content .= "\r\n" . $data;
            }


            $contentlength = \HTTP\HTTPRequests::ContentLength($content);
            if($contentlength > 0) {
                $Headers["Content-Length"] = $contentlength;
            }

            foreach($Headers as $key => $value) {
                $request .= $key . ": " . $value . "\r\n";
            }

            $request .= $content; //May need a double /r/n here.

            return \HTTP\HTTPRequests::Send($URL, $request);
        }
    }
}


namespace SQL {


    // SQL -> a basic data access layer for SQL servers. MySQL doesn't seem to differentiate between data and non-data queries, but other databases do.
    class SQL {

        // Keeping these as constants for now. Might be a good idea to pull them out into an XML file at some point.
        const Server = "127.0.0.1";
        const Username = "root";
        const Password = "mysql";
        const Database = "calico";

        // @todo: Perhaps better error handling here?
        public static function DataQuery($Query) {
            $connection = mysql_connect(SQL::Server, SQL::Username, SQL::Password);

            if (!$connection)
            {
                // error_log() here. Quiet logging of errors.
                die('Could not connect: ' . mysql_error());
            }

            mysql_select_db(SQL::Database, $connection);
            $data = mysql_query($Query);

            return $data;
        }


        public static function NonDataQuery($Query) {
            $connection = mysql_connect(SQL::Server, SQL::Username, SQL::Password);

            if (!$connection)
            {
                die("Could not connect: " . mysql_error());
            }

            mysql_select_db(SQL::Database, $connection);
            mysql_query($Query);

        }

    }


}


namespace Data {

    // User -> class for passing around user information. Should only pass around the UserID (a unqiue SQL ID), for security reasons, in a Session object.
    class User {
        private $SQL_ID = "";

        public function __construct($Username = null, $Password = null) {
            if($Username == null && $Password == null) {
                return;
            }
            // Probably want to Base64 encode the values going into and out of the MySQL database, to prevent a SQL Injection attack.
            $query = "SELECT `UserID` FROM `calico`.`users` WHERE `Username` = '" . base64_encode($Username) . "' AND `Password` = '" . base64_encode($Password) . "';";
            $data = \SQL\SQL::DataQuery($query);
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
            //$this->Refresh();
        }

        public function GetSuperFeedList() {
            return $this->SuperFeedList;
        }

        public function Refresh() {
            $query = "SELECT `SuperFeedID` FROM `calico`.`superfeeds` WHERE `CalendarID` = '" . $this->SQL_ID . "';";
            $data = \SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $newsuperfeed = new SuperFeed($row['SuperFeedID']);
                $newsuperfeed->Refresh();
                $this->SuperFeedList[] = $newsuperfeed;
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

            $query = "SELECT `FeedURL`, `FeedUsername`, `FeedPassword` FROM `calico`.`superfeeds` WHERE `SuperFeedID` = " . $this->SQL_ID . ";";
            $data = \SQL\SQL::DataQuery($query);

            $row = mysql_fetch_array($data);
            $this->FeedURL = base64_decode($row['FeedURL']);
            $this->FeedUsername = base64_decode($row['FeedUsername']);
            $this->FeedPassword = base64_decode($row['FeedPassword']);
            //$this->Refresh();
        }

        public function GetEvents() {
            return $this->EventList;
        }

        public function Refresh() {
            $this->Propfind();
        }

        private function Propfind() {
            $headers = Array();
            $headers = \HTTP\HTTPRequests::GetStandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Depth"] = "1";
            $headers["Authorization"] = "Basic " . base64_encode($this->FeedUsername . ":" . $this->FeedPassword);

            $content = Array();
            $content[] = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $content[] = "<D:propfind xmlns:D=\"DAV:\">";
            $content[] = "<D:prop>";
            $content[] = "<D:getcontenttype/>";
            $content[] = "<D:resourcetype/>";
            $content[] = "<D:getetag/>";
            $content[] = "</D:prop>";
            $content[] = "</D:propfind>";

            $this->ParsePropfind(\HTTP\HTTPRequests::Propfind($this->FeedURL, $headers, $content));

        }

        private function ParsePropfind($String) {
            $body = strstr($String, "<?xml version=\"1.0\" encoding=\"utf-8\" ?>");

            $Xml = new \SimpleXMLElement($body);
            $ResponseList = $Xml->response;
            // Don't need the first one.
            for($i = 1; $i < count($ResponseList); $i++) {
                $feedurl = parse_url($this->FeedURL, PHP_URL_SCHEME) . "://" . parse_url($this->FeedURL, PHP_URL_HOST) . $ResponseList[$i]->href; //$Xml->xpath("/multistatus/response/href"); // Modify these for iteration.
                $etag = \Extract\Extract::GetXMLETAG($ResponseList[$i]->propstat->prop->getetag->asXML());

                //$Xml->xpath("/multistatus/response/propstat/prop/getetag");
                $this->EventList[] = new Event($feedurl, $this->FeedUsername, $this->FeedPassword, $etag, $this->FeedURL);
            }
        }

    }

    // Event -> class for storing event information. Due to this redesign, Event will now be handling some of the functions previously found in the Feed class.
    class Event {
        private $SuperFeedURL = "";
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
        private $StartDates = Array();
        private $EndDates = Array();
        private $XMozGeneration = 0;
        private $DateStamp = null;
        private $Created = null;
        private $LastModified = null;
        private $RRule = "";
        private static $BannedUIDs = Array(); // Sanity check, to ensure that we aren't going to use an existing UID.

        public static function GetBannedUIDs() {
            return \Data\Event::$BannedUIDs;
        }

        public function GetETAG() {
            return $this->ETAG;
        }

        public function GetSuperFeedURL() {
            return $this->SuperFeedURL;
        }

        public function GetFeedURL() {
            return $this->FeedURL;
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

        public function GetRRule() {
            return $this->RRule;
        }

        public function GetStartDates() {
            return $this->StartDates();
        }

        public function GetEndDates() {
            return $this->EndDates();
        }



        //@todo: Verify that this is the correct, or at least, a very good idea. A default constructor that just takes in the string containing VEVENT information (raw).
        public function __construct($FeedURL, $FeedUsername, $FeedPassword, $ETAG, $SuperFeedURL) {
            //ParseVEvent($String);
            $this->FeedUsername = $FeedUsername;
            $this->FeedPassword = $FeedPassword;
            $this->FeedURL = $FeedURL;
            $this->ETAG = $ETAG;
            $this->SuperFeedURL = $SuperFeedURL;
            $this->Refresh();

        }

        public static function CreateFromURLs($SuperFeedURL, $FeedURL, $ETAG) {
            $query = "SELECT `FeedUsername`, `FeedPassword` FROM `calico`.`superfeeds` WHERE `FeedURL` = '" . base64_encode($SuperFeedURL) . "';";
            $data = \SQL\SQL::DataQuery($query);

            $row = mysql_fetch_array($data);
            //$this->FeedURL = base64_decode($row['FeedURL']);
            $feedusername = base64_decode($row['FeedUsername']);
            $feedpassword = base64_decode($row['FeedPassword']);

            $event = new \Data\Event($FeedURL, $feedusername, $feedpassword, $ETAG, $SuperFeedURL);
            return $event;
        }

        // @todo: Store this here until I know what to do with it.
        public function GetNewUniqueID() {
            $isnew = true;
            $newUID = "";
            do {
                $newUID = str_replace(".", "", uniqid("", true));
                if(in_array($newUID, \Data\Event::GetBannedUIDs())) {
                    $isnew = false;
                }
            } while($isnew == false);

            return $newUID;
        }

        public function Refresh() {
            $this->Report();
            //$this->ApplyRRule();
        }

        private function ApplyRRule() {
            //$this->= Array();
            switch($this->RRule) {
                case "":
                    break;
                case "RRULE:FREQ=DAILY":
                    strtotime("+1 day");
                    break;
                case "RRULE:FREQ=WEEKLY":
                    strtotime("+1 week");
                    break;
                case "RRULE:FREQ=DAILY;BYDAY=MO,TU,WE,TH,FR":
                    break;
                case "RRULE:FREQ=WEEKLY;INTERVAL=2":
                    strtotime("+2 weeks");
                    break;
                case "RRULE:FREQ=MONTHLY":
                    strtotime("+1 month");
                    break;
                case "RRULE:FREQ=YEARLY":
                    strtotime("+1 year");
                    break;
            }







        }

        public function Report() {
            $headers = Array();
            $headers = \HTTP\HTTPRequests::GetStandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = "Basic " . base64_encode($this->FeedUsername . ":" . $this->FeedPassword);
            $headers["Depth"] = "1";

            $content = Array();
            $content[] = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
            $content[] = "<calendar-multiget xmlns:D=\"DAV:\" xmlns=\"urn:ietf:params:xml:ns:caldav\">";
            $content[] = "<D:prop>";
            $content[] = "<D:getetag/>";
            $content[] = "<calendar-data/>";
            $content[] = "</D:prop>";
            $content[] = "<D:href>" . parse_url($this->FeedURL, PHP_URL_PATH) . "</D:href>";
            $content[] = "</calendar-multiget>";

            $this->ParseReport(\HTTP\HTTPRequests::Report($this->SuperFeedURL, $headers, $content));

        }


        public function Update($Summary, $Location, $Description, $StartDate, $EndDate, $RRule = null) {
            $this->Summary = $Summary;
            $this->Location = $Location;
            $this->Description = $Description;
            $this->StartDate = $StartDate;
            $this->EndDate = $EndDate;
            $this->RRule = $RRule;

            $this->Put();

        }

        private function Put() {
            // @todo: Rewrite the HTTP requests in this object to flow more.
            $headers = Array();
            $headers = \HTTP\HTTPRequests::GetStandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = "Basic " . base64_encode($this->FeedUsername . ":" . $this->FeedPassword);
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
            $content = array_merge($content, $this->BuildVEvent($this->UID, $this->Summary, $this->StartDate, $this->EndDate, $this->Location, $this->Description, time(), $this->Created, time(), $this->RRule)); //GenerateUID goes in here.
            $content[] = "END:VCALENDAR";

            //array_merge($content, $this->BuildVEvent($uid, $Summary, $StartDate, $EndDate, $Location, $Description, $LastModified, $Created, $DateStamp));


            //$headers["Content-Length"] = $this->ContentLength($content);

            $this->ParsePut(\HTTP\HTTPRequests::Put($this->FeedURL, $headers, $content));

        }

        public function Delete() {
            $headers = Array();
            $headers = \HTTP\HTTPRequests::GetStandardHeaders();
            $headers["Authorization"] = "Basic " . base64_encode($this->FeedUsername . ":" . $this->FeedPassword);
            $headers["If-Match"] = $this->ETAG;

            $this->ParseDelete(\HTTP\HTTPRequests::Delete($this->FeedURL, $headers));
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

            $body = strstr($String, "<?xml version=\"1.0\" encoding=\"utf-8\" ?>");

            $Xml = new \SimpleXMLElement($body);
            $this->ETAG = \Extract\Extract::GETXMLETAG($Xml->response[0]->propstat->prop->getetag->asXML());
            $vevent = $Xml->response[0]->propstat->prop->children("urn:ietf:params:xml:ns:caldav");
            $this->ParseVEvent($vevent);

            return true;

        }

        //@todo: Move creation functions to Event.
        public static function Create($FeedURL, $FeedUsername, $FeedPassword, $Summary, $StartDate, $EndDate, $Location, $Description, $RRule = null) {

            $headers = Array();
            $headers = \HTTP\HTTPRequests::GetStandardHeaders();
            $headers["Content-Type"] = "text/calendar; charset=utf-8";
            $headers["Authorization"] = "Basic " . base64_encode($FeedUsername . ":" . $FeedPassword);
            $headers["If-None-Match"] = "*";

            $uid = \Data\Event::GetNewUniqueID();
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
            $content = array_merge($content, \Data\Event::BuildVEvent($uid, $Summary, $StartDate, $EndDate, $Location, $Description, time(), time(), time(), $RRule)); //GenerateUID goes in here.
            $content[] = "END:VCALENDAR";

            $url = $FeedURL . "/" . $uid . ".ics"; //@todo: Construct URL (UID) to post to here.
            $response = \HTTP\HTTPRequests::Put($url, $headers, $content);

            if (strlen(strstr($response,"HTTP/1.1 201 Created"))>0) {
                $etag = \Extract\Extract::GetETag($response);
                $Event = new Event($url, $FeedUsername, $FeedPassword, $etag, $FeedURL);
                return $Event;
            }

            return null;
        }

        private function ParsePut($String) {
            if (strlen(strstr($String,"HTTP/1.1 204 No Content"))>0) {
                $this->ETAG = \Extract\Extract::GetETag($String);
                return true;
            }
            return false;
        }

        private function ParseVEvent($String) {

            $String = \HTTP\HTTPRequests::FixNewlines($String);
            $daylight = \Extract\Extract::GetDaylight($String);
            $vevent = \Extract\Extract::GetVEvent($String);

            //$summary = \Extract\Extract::GetSummary($vevent);
            $this->Summary = \HTTP\HTTPRequests::FixEverythingElse(\Extract\Extract::GetSummary($vevent));

            $start = explode(":", \Extract\Extract::GetDTStart($vevent));
            $startdatetime = new \DateTime($start[1]);
            $startdatetimezone = timezone_open(str_replace("TZID=", "", $start[0]));
            $startdatetime->setTimezone($startdatetimezone);
            $this->StartDate =  $startdatetime->getTimestamp();

            $end = explode(":", \Extract\Extract::GetDTEnd($vevent));
            $enddatetime = new \DateTime($end[1]);
            $enddatetimezone = timezone_open(str_replace("TZID=", "", $end[0]));
            $enddatetime->setTimezone($enddatetimezone);
            $this->EndDate = $enddatetime->getTimestamp();

            $this->Location = \HTTP\HTTPRequests::FixEverythingElse(\Extract\Extract::GetLocation($vevent));
            $this->Description = \HTTP\HTTPRequests::FixEverythingElse(\Extract\Extract::GetDescription($vevent));
            $this->Created = strtotime(\Extract\Extract::GetCreated($vevent));
            $this->LastModified = strtotime(\Extract\Extract::GetLastModified($vevent));
            $this->DateStamp =  strtotime(\Extract\Extract::GetDateStamp($vevent));
            $this->UID = \Extract\Extract::GetUID($vevent);
            //$this->XMozGeneration = \Extract\Extract::GetXMozGeneration($vevent);
            $this->RRule = \Extract\Extract::GetRRule($vevent);

            if(!in_array($this->UID, \Data\Event::$BannedUIDs)) {
                \Data\Event::$BannedUIDs[] = $this->UID;
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

            if($RRule != null && $RRule != "") {
                $content[] = $RRule;
            }

            $content[] = "DTSTART;TZID=" . date("e", time()) . ":" . date("Ymd\THi00", $StartDate);  //date_default_timezone_get()
            $content[] = "DTEND;TZID=" . date("e", time()) . ":" . date("Ymd\THi00", $EndDate); //date()

            if($Location != null && $Location != "") {
                $content[] = "LOCATION:" . $Location;
            }
            if($Description != null && $Description != "") {
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
        private $Options = Array("Monthly" => 0, "Weekly" => 1, "Daily" => 2);
        private $DefaultView = 0;


        public function __construct($User) {
            $this->User = $User;
            $this->GetDefaultView();
            //$this->Refresh();
        }

        public function Draw() {
            return $this->RenderControl();
        }

        private function RenderControl() {
            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<FORM METHOD='post' ACTION='calico_compositecalendar.php'>";
            $html .= "<SPAN CLASS='fieldtext'>View:</SPAN>";
            $html .= "<SELECT NAME=\"DefaultView\" onchange='this.form.submit()'>";
            foreach($this->Options as $key => $value) {
            $html .= "<OPTION VALUE=\"" . $value . "\"";
                if($this->DefaultView == $value) {
                    $html .= " selected=\"selected\"";
                }

            $html .= ">" . $key . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "</FORM>";
            $html .= "</DIV>";

            return $html;
        }

        public function GetDefaultView() {
            $query = "SELECT `DefaultView` FROM `calico`.`settings` WHERE `UserID` = " . $this->User->GetUserID() . ";";
            $data = \SQL\SQL::DataQuery($query);
            $row = mysql_fetch_array($data);
            $this->DefaultView = $row['DefaultView'];

            return $this->DefaultView;
        }

        public function Refresh() {
           $this->GetDefaultView();

        }

        public function Postback() {
            if(isset($_POST["DefaultView"])) {
                $this->DefaultView = $_POST["DefaultView"];
                $query = "UPDATE `calico`.`settings` SET `DefaultView` = " . $this->DefaultView . " WHERE `UserID` = " . $this->User->GetUserID() . ";";
                \SQL\SQL::NonDataQuery($query);
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

    //Calendars here.
    class CompositeCheckBox {
        private $User = null;
        private $CalendarData = Array();
        private $HTMLName = "CompositeCheckBoxControl";
        private $CSSClass = "CompositeCheckBoxControl";

        public function __construct($User) {
            $this->User = $User;
        }


        private function RenderControl() {
            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<FORM METHOD='post' action='calico_compositecalendar.php'>";
            $html .= "<SPAN class='fieldtext'>Calendars: </SPAN>";
            foreach($this->CalendarData["CalendarName"] as $key => $value) {
                $html .= "<INPUT TYPE=\"checkbox\" NAME=\"DisplayedCalendars[]\" VALUE=\"" . $key . "\"";
                if($this->CalendarData["IsDisplayed"][$key] == 1){
                    $html .= " CHECKED";
                }
                $html .= " onchange='this.form.submit()'>";
                $html .= "<SPAN CLASS='fieldtext'>" . $value . "</SPAN>";
            }
            $html .= "</FORM>";
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {

            return $this->RenderControl();

        }

        public function Refresh() {

            $query = "SELECT `CalendarName`, `CalendarID`, `IsDisplayed` FROM `calico`.`calendars` WHERE `UserID` = " . $this->User->GetUserID() . ";";
            $data = \SQL\SQL::DataQuery($query);
            //$this->CalendarData = Array();
            $this->CalendarData["CalendarName"] = Array();
            $this->CalendarData["IsDisplayed"] = Array();
            $this->CalendarData["CalendarID"] = Array();

            while($row = mysql_fetch_array($data))
            {

                $this->CalendarData["CalendarName"][$row["CalendarID"]] = base64_decode($row["CalendarName"]);
                $this->CalendarData["IsDisplayed"][$row["CalendarID"]] = $row["IsDisplayed"];

            }

        }

        public function Postback() {
            //@todo: Bug in here. Has to do with how PHP + $_Post does things. Not going to be able to fix it (too sleep deprived).
            $this->Refresh();
                for($i = 0; $i < count($this->CalendarData["IsDisplayed"]); $i++) {
                    $this->CalendarData["IsDisplayed"][$i] = 0;
                }

            if(isset($_POST["DisplayedCalendars"])) {
                $displayedcalendars = $_POST["DisplayedCalendars"];
                foreach($displayedcalendars as $key => $value) {
                       $this->CalendarData["IsDisplayed"][$value] = 1;
                }
            }

                foreach($this->CalendarData["IsDisplayed"] as $key => $value) {
                    $query = "UPDATE `calico`.`calendars` SET `IsDisplayed` = " . $value . " WHERE `UserID` = " . $this->User->GetUserID() . " AND `CalendarID` = " . $key . ";";
                    \SQL\SQL::NonDataQuery($query);
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
    private $NumRows = 0;
    //private $RowIndexEnd = 0;
    private $ColumnIndex = 0;
    private $Event = null;

    public function __construct($Event, $StartTime, $EndTime, $ColumnIndex, $RowIndexStart, $NumRows) {
        $this->Event = $Event;
        $this->ColumnIndex = $ColumnIndex;
        $this->RowIndexStart = $RowIndexStart;
        $this->NumRows = $NumRows;
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

    public function GetNumRows() {
        return $this->NumRows;
    }

}

class Bitmap {
    private $Data = Array();
    private $Height = 0;

    public function __construct($Height) {
        $this->Height = $Height;
    }

    public function GetNumColumns() {
        return count($this->Data);
    }

    private function FillColumn($Column) {
        for($row = 0; $row < $this->Height; $row++) {
            //echo "Filling Column(" . $Column . ") Row:(" . $row . ") with a 0.<BR>";
            $this->Data[$Column][$row] = 0;
        }
    }

    private function AddColumn() {
        $this->Data[] = Array();
        //echo "Column Added<BR>";
        //$this->Data[count($this->Data) - 1];
        $this->FillColumn(count($this->Data) - 1);
        //return $newcolumn;
    }

    public function FillRows($Row, $NumRows, $Column) {
        for($row = $Row; $row < $Row + $NumRows; $row++) {
            //echo "Filling Column(" . $Column . ") Row:(" . $row . ") with a 1.<BR>";
            $this->Data[$Column][$row] = 1;
        }

        //print_r($this->Data);
    }

    public function FindEmpty($Row, $NumRows) {
        //Columns
        //echo "Number of Columns: " . count($this->Data) . "<BR>";
        for($col = 0; $col < count($this->Data); $col++) {
            //Rows
            $foundempty = true;
            for($row = $Row; $row < $Row + $NumRows; $row++) {
                if($this->Data[$col][$row] != 0) {
                    $foundempty = false;
                }
            }
            if($foundempty == true) {
                //echo "FindEmpty()-> " . $col . "<BR>";
                //print_r($this->Data);
                return $col;
            }
            /*
            else {
                echo "No Empty Column Found At: " . $col . "<BR>";
            }
            */
        }

        $this->AddColumn();
        //echo "FindEmpty(New)-> " . count($this->Data) - 1 . "<BR>";
        //print_r($this->Data);
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
        private $View = 1;
        private $SelectedTime = 0;
        private $CompositeDropDown;
        private $CompositeCheckBox;
        const Monthly = 0;
        const Weekly = 1;
        const Daily = 2;
        /*
        private static $Days = Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
        //@todo: Need to change these strings to html, with superscripts.
        //Prototype code: <span style=\"vertical-align: super;font-size:50%;\"></span>
        private static $Times = Array("12 AM" => "12 <SPAN CLASS=\"period\">AM</SPAN>", "1 AM" => "1 <SPAN CLASS=\"period\">AM</SPAN>", "2 AM" => "2 <SPAN CLASS=\"period\">AM</SPAN>", "3 AM" => "3 <SPAN CLASS=\"period\">AM</SPAN>", "4 AM" => "4 <SPAN CLASS=\"period\">AM</SPAN>", "5 AM"=>"5 <SPAN CLASS=\"period\">AM</SPAN>", "6 AM"=>"6 <SPAN CLASS=\"period\">AM</SPAN>",
            "7 AM"=>"7 <SPAN CLASS=\"period\">AM</SPAN>", "8 AM"=>"8 <SPAN CLASS=\"period\">AM</SPAN>", "9 AM"=>"9 <SPAN CLASS=\"period\">AM</SPAN>", "10 AM"=>"10 <SPAN CLASS=\"period\">AM</SPAN>", "11 AM"=>"11 <SPAN CLASS=\"period\">AM</SPAN>", "12 PM"=>"12 <SPAN CLASS=\"period\">PM</SPAN>", "1 PM"=>"1 <SPAN CLASS=\"period\">PM</SPAN>", "2 PM"=>"2 <SPAN CLASS=\"period\">PM</SPAN>",
        "3 PM"=>"3 <SPAN CLASS=\"period\">PM</SPAN>", "4 PM"=>"4 <SPAN CLASS=\"period\">PM</SPAN>", "5 PM"=>"5 <SPAN CLASS=\"period\">PM</SPAN>", "6 PM"=>"6 <SPAN CLASS=\"period\">PM</SPAN>",
            "7 PM"=>"7 <SPAN CLASS=\"period\">PM</SPAN>", "8 PM"=>"8 <SPAN CLASS=\"period\">PM</SPAN>", "9 PM"=>"9 <SPAN CLASS=\"period\">PM</SPAN>", "10 PM"=>"10 <SPAN CLASS=\"period\">PM</SPAN>", "11 PM"=>"11 <SPAN CLASS=\"period\">PM</SPAN>");
        */
        private $HTMLName = "CompositeCalendarControl";
        private $CSSClass = "CompositeCalendarControl";


        public function __construct($User) {
            $this->User = $User;
            //$this->Refresh();
            if(!isset($_SESSION["TIME"])) {
                $this->SelectedTime = time();
            }
            else {
                //echo "Session Time: " . date("j", $_SESSION["TIME"]) . "<BR>";
                $this->SelectedTime = $_SESSION["TIME"];
                //echo "Day: " . date('d', strtotime($this->SelectedTime)) . " Month: " . date('m', strtotime($this->SelectedTime)) . " Year " . date('Y', strtotime($this->SelectedTime)) . "<BR>";
            }
            $this->CompositeDropDown = new \GUI\CompositeDropDown($this->User);
            $this->CompositeCheckBox = new \GUI\CompositeCheckBox($this->User);

            //@todo: Add in composite dropdown and composite check box here.

        }

        // @todo: Work on this later. Reading pane functionality should be implemented with this kind of code.
        public function Ajax() {
            $javascript = "
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
            }
            xmlhttp.open(\"POST\",\"calico_compositecalendar.php\",true);
            xmlhttp.setRequestHeader(\"Content-type\",\"application/x-www-form-urlencoded\");
            xmlhttp.send(\"User=&\");
            xmlhttp.responseText;
            ";
        }

        // List of Calendar names to display alongside the checkboxes.
        // @todo: Create a separate control for the list of calendars. Potentially.
        // @todo: Create an AJAX-enabled Viewing Pane for selected events on the composite calendar.
        // Make it read only, and have an Edit button that when clicked directs the user to the Edit Event control.
        public function RenderControl() {
            require_once('/calendar/calendar/classes/tc_calendar.php');

            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<SPAN CLASS='header'>Calico: Composite Calendar</SPAN>";
            $html .= "<BR>";
            $html .= "<FORM METHOD=\"Post\" ACTION=\"calico_calendar.php\">";
            $html .= "<INPUT CLASS='button' TYPE=\"Submit\" VALUE=\"Calendar Manager\">";
            $html .= "</FORM>";
            $html .= "<FORM METHOD=\"Post\" ACTION=\"calico_feed.php\">";
            $html .= "<INPUT CLASS='button' TYPE=\"Submit\" VALUE=\"Feed Manager\">";
            $html .= "</FORM>";
            $html .= "<FORM METHOD=\"Post\" ACTION=\"calico_event.php\">";
            $html .= "<INPUT CLASS='button' TYPE=\"Submit\" VALUE=\"New Event\">";
            $html .= "</FORM>";
            $dropdownhtml = $this->CompositeDropDown->Draw();
            $checkboxhtml = $this->CompositeCheckBox->Draw();
            $html .= $dropdownhtml;
            $html .= $checkboxhtml;

            $html .= "<FORM action=\"calico_compositecalendar.php\" method=\"post\" NAME='myCalendar'>";
            $html .= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\"><tr><td nowrap>";
            $html .= "<SPAN CLASS='fieldtext'>Selected Date:</SPAN>";
            $html .= "</td><td>";
            $html .= "<SCRIPT LANGUAGE=\"javascript\" src=\"calendar/calendar/calendar.js\"></SCRIPT>";

            //@todo: give an appropriate html name to this.
            $myCalendar = new \tc_calendar("compositecalendardatepicker", true, false);
            $myCalendar->setIcon("calendar/calendar/images/iconCalendar.gif");
            //$myCalendar->setDate(01, 03, 2010);

            $myCalendar->setDate(date('d', $this->SelectedTime)
                , date('m', $this->SelectedTime)
                , date('Y', $this->SelectedTime));

            //echo "Day: " . date('d', $this->SelectedTime) . " Month: " . date('m', $this->SelectedTime) . " Year " . date('Y', $this->SelectedTime) . "<BR>";

            //$myCalendar->setDate(date('d'), date('m'), date('Y'));
            $myCalendar->setPath("calendar/calendar/");
            $myCalendar->setYearInterval(2000, 2050);
            $myCalendar->dateAllow('2008-05-13', '2015-03-01');
            $myCalendar->setDateFormat('j F Y');
            $myCalendar->setAlignment('left', 'bottom');
            $myCalendar->autoSubmit(true, "myCalendar");
            $myCalendar->zindex = 10;
            // This should, hypothetically, redirect the output from echo to a string.
            // It's either this, or rewrite the control.

            ob_start();
            $myCalendar->writeScript();
            $calendarhtml = ob_get_contents();
            ob_end_clean();
            $html .= "<SPAN CLASS='fieldtext'>";
            $html .= $calendarhtml;
            $html .= "</SPAN>";
            $html .= "</td></tr></table>";
            $html .= "</FORM>";

            $html .= "<DIV NAME=\"CalendarRefreshButton\" CLASS='RefreshButton' style='position:absolute;height:8%;width:9%;z-index:1'>";
            $html .= "<FORM METHOD=\"Get\" ACTION=\"calico_compositecalendar.php\">";
            $html .= "<INPUT CLASS='button' TYPE=\"Submit\" VALUE=\"Refresh\">";
            $html .= "</FORM>";
            $html .= "</DIV>";
            $html .="<BR><BR><BR>";
            $html .= $this->RenderView();

            $html .= "</DIV>";

            return $html;

        }

        private function RenderView() {
            switch($this->View) {
                case CompositeCalendar::Monthly:
                    return $this->RenderMonthly();
                    break;
                case CompositeCalendar::Weekly:
                    return $this->RenderWeekly();
                    break;
                case CompositeCalendar::Daily:
                    return $this->RenderDaily();
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
                    $Timestamp -= date("i", $Timestamp) * 60;
                }
                else{
                    // 0:30 - 7:38 = 8
                    $Timestamp -= ((30 - date("i", $Timestamp)) * 60);
                }

            }

            return $Timestamp;

        }

        // Round up.
        private function RoundEndTime($Timestamp) {
            if(date("i", $Timestamp) != 30 && date("i", $Timestamp) != 0) {
                if(date("i", $Timestamp) < 30) {
                    // 7:11 + 0:19
                    //echo "Minutes Added: " . date("i", ((30 * 60) - date("i", $Timestamp))) . "<BR>";
                    $Timestamp += ((30 - date("i", $Timestamp)) * 60);
                }
                else{
                    // 8:00 - 7:38 = +22
                    $Timestamp += ((60 - date("i", $Timestamp)) * 60);
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



        public function RenderMonthly() {
            $html = "";


            $weekstart = strtotime("-" . date("w", $this->SelectedTime) . " day", strtotime(date("Y-m-d", $this->SelectedTime)));
            $weekend = strtotime("+1 week", strtotime(date("Y-m-d", $weekstart)));

            $weekstarts = Array(strtotime("-2 weeks", $weekstart), strtotime("-1 week", $weekstart), $weekstart, strtotime("+1 week", $weekstart), strtotime("+2 weeks", $weekstart));
            $weekends = Array(strtotime("-2 weeks", $weekend), strtotime("-1 week", $weekend), $weekend, strtotime("+1 week", $weekend), strtotime("+2 weeks", $weekend));
            for($k = 0; $k < count($weekstarts); $k++) {
            $events = $this->GetRelevantEvents($weekstarts[$k], $weekends[$k]);
            //$increment = 30 * 60; // 30 minutes
            $segments = Array();
            $segments["Start"] = Array();
            $segments["End"] = Array();
            //$segments["Width"] = Array(); // The width of each event per day.

            for($t = $weekstarts[$k]; $t < $weekends[$k]; $t = strtotime("+1 day", $t)) {
                $segments["Start"][] = $t;
                $segments["End"][] = strtotime("+1 day", $t);

            }

            //Newline for HTML buttons: &#10;


            //4% for each div, 8% for the column headers.
            //7 days, with row headers -> 100/8 -> 12.5, 7 * 12.5 = 87.5, 13% for, 91%, 9%

            $html .= "<DIV style=\"position:absolute;width:100%;height:100%;\">";
            $html .= "<FORM method='post' action='calico_compositecalendar.php'>";
            //$html .= "<DIV NAME=\"Calendar\">";
            //$html .= "<DIV CLASS='slice' style='position:absolute;top:0%;left:0%;width:12%;height:2%;z-index:1;'>";
            //$html .= "<B>" . date("j", $segment) . "</B>&nbsp;&nbsp;&nbsp;&nbsp;" . date("l", $segment);
            //$html .= "</DIV>";


            $i = 0;
            foreach($segments["Start"] as $segment) {
                $html .= "<DIV  CLASS='slice' style='position:absolute;top:" . $k * 20 . "%;left:" . $i * 12 . "%;width:12%;height:20%;z-index:1;'>";
                $html .= "<B>" . date("j", $segment) . "</B>&nbsp;&nbsp;" . date("l", $segment);
                $html .= "</DIV>";
                $i++;
            }

            /*
            $i = 1;
            for($t = $segments["Start"][0]; $t < $segments["End"][0]; $t += $increment) {
                //Row headers.
                $html .= "<DIV  CLASS='slice' style='position:absolute;top:" . $i * 2 . "%;left:0%;width:12%;height:2%;z-index:1;text-align:center;'>";
                //if(date("i", $t) == 0) {
                $html .= date("g", $t) . ":" . date("i", $t) . "<SPAN Style='font-size:xx-small; vertical-align:top;'>" . date("A", $t) . "</SPAN>";
                //}
                $html .= "</DIV>";
                $i++;
            }
            */

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

                $divevents = Array();
                $bitmap = new \GUI\Bitmap(1);
                //echo "New Bitmap<BR>";
                foreach($events as $event) {

                    $roundstart = $this->RoundStartTime($event->GetStartDate());
                    if($roundstart < $segmentstart) {
                        $roundstart = $segmentstart;
                    }

                    $roundend = $this->RoundEndTime($event->GetEndDate());
                    if($roundend > $segmentend) {
                        $roundend = $segmentend;
                    }

                    if($this->TimeRangeContains($segmentstart, $segmentend, $roundstart, $roundend)) {
                        //$startrow = (int)(((int)(date("H", $roundstart))) * 2 + ((int)(date("i", $roundstart))) / ((int)(30)));
                        //$endrow = (int)(((int)date("H", $roundend)) * 2 + (((int)(date("i", $roundend))) / (int)(30)));

                        $startrow = 0;
                        $endrow = 1;
                        $numrows = 1;
                        /*
                        if($roundend == $segmentend) {
                            $endrow = 1;
                        }

                        $numrows =  $endrow - $startrow;
                        */
                        /*
                        echo "Start Time: " . date("j F Y H:i:s", $event->GetStartDate()) . "<BR>";
                        echo "End Time: " . date("j F Y H:i:s", $event->GetEndDate()) . "<BR>";
                        echo "Rounded Start Time: " . date("j F Y H:i:s", $roundstart) . "<BR>";
                        echo "Rounded End Time: " . date("j F Y H:i:s", $roundend) . "<BR>";
                        echo "Start Row: " . $startrow . "<BR>";
                        echo "End Row: " . $endrow . "<BR>";
                        echo "Num Rows: " . $numrows . "<BR>";
                        */


                        $column = $bitmap->FindEmpty($startrow, $numrows);
                        //echo "Found Empty Column: " . $column . "<BR>";
                        $bitmap->FillRows($startrow, $numrows, $column);
                        //echo "Filling Column<BR>";

                        $divevents[] = new \GUI\DivEvent($event, $roundstart, $roundend, $column, $startrow, $numrows);
                    }
                }


                //echo (int)(15 / $bitmap->GetNumColumns()) . "<BR>";
                $l = 0;
                foreach($divevents as $divevent) {
                    $html .= "<Button TYPE='submit' NAME='EVENTBUTTON' VALUE='" . base64_encode(implode("<CALICO/>", array($divevent->GetEvent()->GetSuperFeedURL(), $divevent->GetEvent()->GetFeedURL(), $divevent->GetEvent()->GetETAG()))) . "' CLASS='event' style='position:absolute;top:" . (20 * $k  + 5 + ((int)(15 / $bitmap->GetNumColumns())) * $l) . "%;left:" . (12 * $t) . "%;width: 12%;height:" . 15 / $bitmap->GetNumColumns() . "%;z-index:2' '>";
                    $html .= "<BR>";
                    $html .= $divevent->GetEvent()->GetSummary();
                    $html .= "<BR>";
                    $html .= "</Button>";
                    $l++;

                }
            }




            // Need to create divs, filled with buttons, that span each segment, and are positioned over the above divs.
            // Relative positioning, with percentage-based sizes should work here.
            //$html .= "</DIV>";
            $html .= "</FORM>";
            $html .= "</DIV>";
            $html .= "<BR>";

            }

            return $html;

        }




        public function RenderWeekly() {
            $html = "";


            $weekstart = strtotime("-" . date("w", $this->SelectedTime) . " day", strtotime(date("Y-m-d", $this->SelectedTime)));
            $weekend = strtotime("+1 week", strtotime(date("Y-m-d", $weekstart)));

            $events = $this->GetRelevantEvents($weekstart, $weekend);
            $increment = 30 * 60; // 30 minutes
            $segments = Array();
            $segments["Start"] = Array();
            $segments["End"] = Array();
            //$segments["Width"] = Array(); // The width of each event per day.

            for($t = $weekstart; $t < $weekend; $t = strtotime("+1 day", $t)) {
                $segments["Start"][] = $t;
                $segments["End"][] = strtotime("+1 day", $t);

            }

            //Newline for HTML buttons: &#10;


            //4% for each div, 8% for the column headers.
            //7 days, with row headers -> 100/8 -> 12.5, 7 * 12.5 = 87.5, 13% for, 91%, 9%

            $html .= "<DIV style=\"position:absolute;width:100%;height:100%;\">";
            $html .= "<FORM method='post' action='calico_compositecalendar.php'>";
            //$html .= "<DIV NAME=\"Calendar\">";
            $html .= "<DIV CLASS='slice' style='position:absolute;top:0%;left:0%;width:12%;height:2%;z-index:1;'>";
            //$html .= "<B>" . date("j", $segment) . "</B>&nbsp;&nbsp;&nbsp;&nbsp;" . date("l", $segment);
            $html .= "</DIV>";


            $columnwidth = 13;
            $columnheight = 8;

            $rowheaderwidth = 9; # of Rows = 24 (hours) * 2 (30 minute increments) = 48 + 1 columnn row
            $rowheadereheight = 2;

            $rowwidth = 13;
            $rowheight = 2;

            // Column headers.

            $i = 1;
            foreach($segments["Start"] as $segment) {
                $html .= "<DIV  CLASS='slice' style='position:absolute;top:0%;left:" . $i * 12 . "%;width:12%;height:2%;z-index:1;'>";
                $html .= "<B>" . date("j", $segment) . "</B>" . date("l", $segment);
                $html .= "</DIV>";
                $i++;
            }

            $i = 1;
            for($t = $segments["Start"][0]; $t < $segments["End"][0]; $t += $increment) {
                //Row headers.
                $html .= "<DIV  CLASS='slice' style='position:absolute;top:" . $i * 2 . "%;left:0%;width:12%;height:2%;z-index:1;text-align:center;'>";
                //if(date("i", $t) == 0) {
                    $html .= date("g", $t) . ":" . date("i", $t) . "<SPAN Style='font-size:xx-small; vertical-align:top;'>" . date("A", $t) . "</SPAN>";
                //}
                $html .= "</DIV>";
                $i++;
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

                $divevents = Array();
                $bitmap = new \GUI\Bitmap(48);
                //echo "New Bitmap<BR>";
                foreach($events as $event) {

                    $roundstart = $this->RoundStartTime($event->GetStartDate());
                    if($roundstart < $segmentstart) {
                        $roundstart = $segmentstart;
                    }

                    $roundend = $this->RoundEndTime($event->GetEndDate());
                    if($roundend > $segmentend) {
                        $roundend = $segmentend;
                    }

                    if($this->TimeRangeContains($segmentstart, $segmentend, $roundstart, $roundend)) {
                        $startrow = (int)(((int)(date("H", $roundstart))) * 2 + ((int)(date("i", $roundstart))) / ((int)(30)));
                        $endrow = (int)(((int)date("H", $roundend)) * 2 + (((int)(date("i", $roundend))) / (int)(30)));
                        if($roundend == $segmentend) {
                            $endrow = 48;
                        }

                        $numrows =  $endrow - $startrow;

                        /*
                        echo "Start Time: " . date("j F Y H:i:s", $event->GetStartDate()) . "<BR>";
                        echo "End Time: " . date("j F Y H:i:s", $event->GetEndDate()) . "<BR>";
                        echo "Rounded Start Time: " . date("j F Y H:i:s", $roundstart) . "<BR>";
                        echo "Rounded End Time: " . date("j F Y H:i:s", $roundend) . "<BR>";
                        echo "Start Row: " . $startrow . "<BR>";
                        echo "End Row: " . $endrow . "<BR>";
                        echo "Num Rows: " . $numrows . "<BR>";
                        */


                        $column = $bitmap->FindEmpty($startrow, $numrows);
                        //echo "Found Empty Column: " . $column . "<BR>";
                        $bitmap->FillRows($startrow, $numrows, $column);
                        //echo "Filling Column<BR>";

                        $divevents[] = new \GUI\DivEvent($event, $roundstart, $roundend, $column, $startrow, $numrows);
                    }
                }



                foreach($divevents as $divevent) {
                    $html .= "<Button TYPE='submit' NAME='EVENTBUTTON' VALUE='" . base64_encode(implode("<CALICO/>", array($divevent->GetEvent()->GetSuperFeedURL(), $divevent->GetEvent()->GetFeedURL(), $divevent->GetEvent()->GetETAG()))) . "' CLASS='event' style='position:absolute;top:" . ($divevent->GetRowIndexStart() * 2 + 2) . "%;left:" . ((12 * $t + 12) + (12 / $bitmap->GetNumColumns()) * $divevent->GetColumnIndex()) . "%;width:" . 12 / $bitmap->GetNumColumns() . "%;height:" . 2 * $divevent->GetNumRows() . "%;z-index:2' '>";
                    $html .= "<BR>";
                    $html .= $divevent->GetEvent()->GetSummary();
                    $html .= "<BR>";
                    $html .= "</Button>";

                }
            }




            // Need to create divs, filled with buttons, that span each segment, and are positioned over the above divs.
            // Relative positioning, with percentage-based sizes should work here.
            //$html .= "</DIV>";
            $html .= "</FORM>";
            $html .= "</DIV>";

            return $html;

        }

        public function RenderDaily() {
            $html = "";

            $daystart = strtotime(date("Y-m-d", $this->SelectedTime));
            $dayend = strtotime("+1 day", strtotime(date("Y-m-d", $this->SelectedTime)));

            //$html = "";


            //$weekstart = strtotime("-" . date("w", $this->SelectedTime) . " day", strtotime(date("Y-m-d", $this->SelectedTime)));
            //$weekend = strtotime("+1 week", strtotime(date("Y-m-d", $weekstart)));
            //echo "Start Date:" . date("Y-m-d H:i:s", $daystart) . "<BR>";
            //echo "End Date:" . date("Y-m-d H:i:s", $dayend) . "<BR>";

            $events = $this->GetRelevantEvents($daystart, $dayend);
            $increment = 30 * 60; // 30 minutes
            $segments = Array();
            $segments["Start"] = Array();
            $segments["End"] = Array();
            //$segments["Width"] = Array(); // The width of each event per day.

            for($t = $daystart; $t < $dayend; $t = strtotime("+1 day", $t)) {
                $segments["Start"][] = $t;
                $segments["End"][] = strtotime("+1 day", $t);

            }


            $html .= "<DIV style=\"position:absolute;width:100%;height:100%;\">";
            $html .= "<FORM method='post' action='calico_compositecalendar.php'>";
            //$html .= "<DIV NAME=\"Calendar\">";
            $html .= "<DIV CLASS='slice' style='position:absolute;top:0%;left:0%;width:12%;height:2%;z-index:1;'>";
            //$html .= "<B>" . date("j", $segment) . "</B>&nbsp;&nbsp;&nbsp;&nbsp;" . date("l", $segment);
            $html .= "</DIV>";

            $i = 1;
            foreach($segments["Start"] as $segment) {
                $html .= "<DIV  CLASS='slice' style='position:absolute;top:0%;left:" . $i * 12 . "%;width:12%;height:2%;z-index:1;'>";
                $html .= "<B>" . date("j", $segment) . "</B>" . date("l", $segment);
                $html .= "</DIV>";
                $i++;
            }

            $i = 1;
            for($t = $segments["Start"][0]; $t < $segments["End"][0]; $t += $increment) {
                //Row headers.
                $html .= "<DIV  CLASS='slice' style='position:absolute;top:" . $i * 2 . "%;left:0%;width:12%;height:2%;z-index:1;text-align:center;'>";
                //if(date("i", $t) == 0) {
                $html .= date("g", $t) . ":" . date("i", $t) . "<SPAN Style='font-size:xx-small; vertical-align:top;'>" . date("A", $t) . "</SPAN>";
                //}
                $html .= "</DIV>";
                $i++;
            }

            for($t = 0; $t < count($segments["Start"]); $t++) {
                $segmentstart = $segments["Start"][$t]; // For weekly, this is days. Segment (of time) Start here = CurrentDay @ 12:00AM
                $segmentend = $segments["End"][$t]; //Segment (of time) End here = NextDay @ 12:00AM

                $divevents = Array();
                $bitmap = new \GUI\Bitmap(48);
                foreach($events as $event) {

                    $roundstart = $this->RoundStartTime($event->GetStartDate());
                    if($roundstart < $segmentstart) {
                        $roundstart = $segmentstart;
                    }

                    $roundend = $this->RoundEndTime($event->GetEndDate());
                    if($roundend > $segmentend) {
                        $roundend = $segmentend;
                    }

                    if($this->TimeRangeContains($segmentstart, $segmentend, $roundstart, $roundend)) {
                        $startrow = (int)(((int)(date("H", $roundstart))) * 2 + ((int)(date("i", $roundstart))) / ((int)(30)));
                        $endrow = (int)(((int)date("H", $roundend)) * 2 + (((int)(date("i", $roundend))) / (int)(30)));
                        if($roundend == $segmentend) {
                            $endrow = 48;
                        }

                        $numrows =  $endrow - $startrow;

                        $column = $bitmap->FindEmpty($startrow, $numrows);
                        $bitmap->FillRows($startrow, $numrows, $column);

                        $divevents[] = new \GUI\DivEvent($event, $roundstart, $roundend, $column, $startrow, $numrows);
                    }
                }



                foreach($divevents as $divevent) {
                    $html .= "<Button TYPE='submit' NAME='EVENTBUTTON' VALUE='" . base64_encode(implode("<CALICO/>", array($divevent->GetEvent()->GetSuperFeedURL(), $divevent->GetEvent()->GetFeedURL(), $divevent->GetEvent()->GetETAG()))) . "' CLASS='event' style='position:absolute;top:" . ($divevent->GetRowIndexStart() * 2 + 2) . "%;left:" . ((12 * $t + 12) + (12 / $bitmap->GetNumColumns()) * $divevent->GetColumnIndex()) . "%;width:" . 12 / $bitmap->GetNumColumns() . "%;height:" . 2 * $divevent->GetNumRows() . "%;z-index:2' '>";
                    $html .= "<BR>";
                    $html .= $divevent->GetEvent()->GetSummary();
                    $html .= "<BR>";
                    $html .= "</Button>";

                }
            }





            $html .= "</FORM>";
            $html .= "</DIV>";

            return $html;


            return $html;

        }

        public function Draw() {
            return $this->RenderControl();
        }

        public function Refresh() {
            $this->CalendarList = Array();

            $query = "SELECT `CalendarID` FROM `calico`.`calendars` WHERE `IsDisplayed` = 1 AND `UserID` = " . $this->User->GetUserID() . ";";
            $data = \SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $newcalendar = new \Data\Calendar($row['CalendarID']);
                $newcalendar->Refresh();
                $this->CalendarList[] = $newcalendar;
            }


            $this->CompositeDropDown->Refresh();
            $this->CompositeCheckBox->Refresh();
            $this->View = $this->CompositeDropDown->GetDefaultView();

        }

        public function Postback() {
            //@todo: Get DatePicker value and what not here.

            if(isset($_POST["EVENTBUTTON"])) {
                //echo "Got Event!<BR>";
                //

                $eventdata = explode("<CALICO/>", base64_decode($_POST["EVENTBUTTON"]));
                $superfeedurl = $eventdata[0];
                $feedurl = $eventdata[1];
                $etag = $eventdata[2];
                $event = \Data\Event::CreateFromURLs($superfeedurl, $feedurl, $etag);

                $_SESSION["EVENT"] = serialize($event);

                \HTTP\HTTPRedirector::Redirect("calico_event.php");
                //echo $superfeedurl . "<BR>";
                //echo $feedurl . "<BR>";

            }

            if(isset($_REQUEST["compositecalendardatepicker"])) {
                $this->SelectedTime = strtotime($_REQUEST["compositecalendardatepicker"]);
                $_SESSION["TIME"] = strtotime($_REQUEST["compositecalendardatepicker"]);
            }




            $this->CompositeDropDown->Postback();
            $this->CompositeCheckBox->Postback();

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

class NewAccount {
    private $HTMLName = "NewAccountControl";
    private $CSSClass = "NewAccountControl";
    private $AccountError = "";
    private $AccountSuccess = "";

    public function __construct() {

    }

    private function RenderControl() {
        $html = "";
        $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
        $html .= "<FORM NAME=\"input\" ACTION=\"calico_newaccount.php\" METHOD=\"post\">";
        $html .= "<SPAN CLASS='header'>Calico: New Account</SPAN>";
        $html .= "<BR>";
        $html .= "<SPAN CLASS='fieldtext'>Username:</SPAN>";
        $html .= "<INPUT TYPE=\"text\" NAME=\"Username\">";
        $html .= "<BR>";
        $html .= "<SPAN CLASS='fieldtext'>Password:</SPAN>";
        $html .= "<INPUT TYPE=\"password\" NAME=\"Password\">";
        $html .= "<BR>";
        $html .= "<INPUT CLASS='button' TYPE=\"Submit\" NAME=\"OK\" VALUE=\"Ok\">";
        $html .= "<BR>";
        $html .= "</FORM>";
        $html .= "<FORM NAME=\"input\" ACTION=\"calico_login.php\" METHOD=\"post\">";
        $html .= "<INPUT CLASS='button' TYPE=\"Submit\" VALUE=\"Return to Login\">";
        $html .= "</FORM>";
        if($this->AccountError != "") {
            $html .= "<BR>";
            $html .= "<SPAN CLASS=\"errortext\">" . $this->AccountError . "</SPAN>";
        }
        if($this->AccountSuccess != "") {
            $html .= "<BR>";
            $html .= "<SPAN CLASS=\"errortext\">" . $this->AccountSuccess . "</SPAN>";
        }
        $html .= "</DIV>";

        return $html;
    }

    public function Draw() {
        return $this->RenderControl();
    }

    public function Refresh() {
        // Included for completeness sake.
    }

    public function Postback() {
        $this->AccountError = "";
        $this->AccountSuccess = "";

        if(isset($_POST["OK"])) {
            if(!isset($_POST["Username"]) || $_POST["Username"] == "") {
                $this->AccountError .= "Username Error: Please enter a valid username.<BR>";
            }

            if(!isset($_POST["Password"]) || $_POST["Password"] == "") {
                $this->AccountError .= "Password Error: Please enter a valid password.<BR>";
            }

            if($this->AccountError == "") {
                $this->AddUser($_POST["Username"], $_POST["Password"]);
                $this->AccountSuccess = "New user account successfully created.<BR>";
            }
        }
            //\HTTP\HTTPRedirector::Redirect("calico_compositecalendar.php");


    }

    private function AddUser($Username, $Password) {
        $insertquery = "INSERT INTO `calico`.`users` (`Username`, `Password`) VALUES ('" . base64_encode($Username) . "','" . base64_encode($Password) . "');";
        \SQL\SQL::NonDataQuery($insertquery);

        $selectquery = "SELECT `UserID` FROM `calico`.`users` WHERE `Username` = '" . base64_encode($Username) . "' AND `Password` = '" . base64_encode($Password) . "';";
        $data = \SQL\SQL::DataQuery($selectquery);
        $row = mysql_fetch_array($data);
        $userid = $row["UserID"];

        $insertquery2 = "INSERT INTO `calico`.`settings` (`DefaultView`, `UserID`) VALUES (1, " . $userid . ");";
        \SQL\SQL::NonDataQuery($insertquery2);

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

    // Login -> a control to handle the login aspect of things. Will be a GUI control.
    class Login {
        private $User = null;
        private $HTMLName = "LoginControl";
        private $CSSClass = "LoginControl";
        private $LoginError = "";

        //@todo: Need to remember to check Update() in general, or whatever I am going to call this callback, and to encode / escape / sanitize the SQL inputs to prevent SQL injection attacks.

        public function __construct() {

        }

        private function RenderControl() {
            $html = "";

            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<FORM NAME=\"input\" ACTION=\"calico_login.php\" METHOD=\"post\">";
            $html .= "<SPAN CLASS='header'>Calico: Login</SPAN>";
            $html .= "<BR>";
            $html .= "<SPAN CLASS='fieldtext'>Username:</SPAN>";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Username\">";
            $html .= "<BR>";
            $html .= "<SPAN CLASS='fieldtext'>Password:</SPAN>";
            $html .= "<INPUT TYPE=\"password\" NAME=\"Password\">";
            $html .= "<BR>";
            $html .= "<INPUT CLASS='button' TYPE=\"Submit\" NAME=\"Login\" VALUE=\"Login\">";
            $html .= "</FORM>";
            $html .= "<FORM NAME=\"input\" ACTION=\"calico_newaccount.php\" METHOD=\"post\">";
            $html .= "<INPUT CLASS='button'TYPE=\"Submit\" VALUE=\"New Account\">";
            $html .= "</FORM>";
            if($this->LoginError != "") {
                $html .= "<BR>";
                $html .= "<SPAN CLASS='errortext'>" . $this->LoginError . "</SPAN>";
            }
            $html .= "</DIV>";


            return $html;
        }

        public function Draw() {
            return $this->RenderControl();
        }

        // Returns boolean, indicating whether a user was successfully validated.
        public function Validate($Username, $Password) {
            $query = "SELECT Count(`Username`) FROM `calico`.`users` WHERE `Username` = '" . base64_encode($Username) . "' AND `Password` = '" . base64_encode($Password) . "';";
            $data = \SQL\SQL::DataQuery($query);
            $row = mysql_fetch_array($data);
            $count = $row["Count(`Username`)"];

            if($count > 0) {
                return new \Data\User($Username, $Password);
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
            $this->LoginError = "";

            if(isset($_POST["Login"])) {

                if(!isset($_POST["Username"]) || $_POST["Username"]) {
                    $this->LoginError .= "Username Error: Please enter a valid username.<BR>";
                }
                if(!isset($_POST["Password"]) || $_POST["Password"]) {
                    $this->LoginError .= "Password Error: Please enter a valid password.<BR>";
                }

                $this->User = $this->Validate($_POST["Username"], $_POST["Password"]);
                if($this->User != null) {
                    //include_once("calico_classes_v2.php");
                    session_start();
                    //session_register("USER");
                    $_SESSION["USER"] = serialize($this->User);
                    unset($_SESSION["EVENT"]);
                    \HTTP\HTTPRedirector::Redirect("calico_compositecalendar.php");
                }
                else {
                    $this->LoginError .= "Validation Error: Please enter a valid username and password.";
                }

            }



            if(isset($_POST["Username"]) && isset($_POST["Password"])) {

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
        private $CalendarList = Array();

        public function __construct($User) {
            $this->User = $User;
            //$this->Refresh();
        }

        private function RenderControl() {
            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<FORM METHOD='post'  ACTION='calico_calendar.php'>";
            $html .= "<SPAN class='header'>Calico: Calendar Manager</SPAN>";
            $html .= "<BR>";
            $html .= "<SPAN class='fieldtext'>Calendar Name:</SPAN>";
            $html .= "<INPUT TYPE=\"text\" NAME=\"CalendarName\" />";
            $html .= "<INPUT CLASS='button' TYPE=\"submit\" NAME=\"AddCalendar\" VALUE=\"Add\" />";
            $html .= "<BR>";
            //@todo: Checkboxes to select a calendar, and a button to delete them.
            foreach($this->CalendarList as $calendar) {

                $html .= "<INPUT TYPE=\"checkbox\" NAME=\"Calendars[]\" VALUE=\"" . base64_encode($calendar) . "\" />";
                $html .= "<SPAN CLASS='fieldtext'>" . $calendar . "</SPAN>";
                $html .= "<BR>";
            }
            $html .= "<INPUT CLASS='button' TYPE=\"submit\" NAME=\"DeleteCalendar\" VALUE=\"Delete\" />";
            $html .= "</FORM>";
            $html .= "<FORM METHOD='post' ACTION='calico_compositecalendar.php'>";
            $html .= "<INPUT CLASS='button' TYPE=\"submit\"  VALUE=\"Composite Calendar\" />";
            $html .= "</FORM>";
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            return $this->RenderControl();
        }

        public function Refresh() {
            //@todo: Pull from database here. Fill with calendars as per the user.
            $query = "SELECT `CalendarName` FROM `calico`.`calendars` WHERE `UserID` = '" . $this->User->GetUserID() . "';";
            $data = \SQL\SQL::DataQuery($query);


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

        private function DeleteCalendars($Calendars) {
            foreach($Calendars as $calendar) {
                $query = "DELETE FROM `calico`.`calendars` WHERE `UserID` = " . $this->User->GetUserID() . " AND `CalendarName`= '" . $calendar . "';";
                $data = \SQL\SQL::NonDataQuery($query);
            }

        }

        private function AddCalendar($CalendarName) {
            $query = "INSERT INTO `calico`.`calendars` (`CalendarName`, `IsDisplayed`, `UserID`) VALUES ('" . $CalendarName . "', 0," . $this->User->GetUserID() . ");";
            $data = \SQL\SQL::NonDataQuery($query);

        }

        public function Postback() {
            if(isset($_POST["AddCalendar"]) && isset($_POST["CalendarName"]) && $_POST["CalendarName"] != "") {
                $this->AddCalendar(base64_encode($_POST["CalendarName"]));
            }
            if(isset($_POST["DeleteCalendar"])) {
                $this->DeleteCalendars($_POST["Calendars"]);
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
        private $User = null;
        private $HTMLName = "SuperFeedManagerControl";
        private $CSSClass = "SuperFeedManagerControl";
        private $FeedData = Array();
        private $CalendarData = Array();

        public function __construct($User) {
            $this->User = $User;
            //$this->Refresh();
        }

        private function RenderControl() {
            $html = "";
            $html .= "<DIV NAME=" . $this->HTMLName . " CLASS=" . $this->CSSClass .  ">";
            $html .= "<SPAN class='header'>Calico: Feed Manager</SPAN>";
            $html .= "<BR>";
            $html .= "<FORM METHOD='Post' ACTION='calico_feed.php'>";
            $html .= "<SPAN CLASS='fieldtext'>Feed Username:</SPAN>";
            $html .= "<INPUT TYPE=\"text\" NAME=\"feedusername\" />";
            $html .= "<SPAN CLASS='fieldtext'>Feed Password:</SPAN>";
            $html .= "<INPUT TYPE=\"password\" NAME=\"feedpassword\" />";
            $html .= "<SPAN CLASS='fieldtext'>Feed URL:</SPAN>";
            $html .= "<INPUT TYPE=\"text\" NAME=\"feedurl\" />";
            $html .= "<SPAN CLASS='fieldtext'>Calendar:</SPAN>";
            $html .= "<SELECT NAME=\"CalendarSelect\">";
            for($i = 0; $i < count($this->CalendarData["CalendarName"]); $i++) {
                $html .= "<OPTION VALUE=\"" . $this->CalendarData["CalendarID"][$i] . "\">" . $this->CalendarData["CalendarName"][$i] . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<INPUT CLASS='button' TYPE=\"submit\" NAME=\"AddFeed\" VALUE=\"Add\" />";
            $html .= "<BR>";

            for($i = 0; $i < count($this->FeedData["FeedURL"]); $i++) {
                $html .= "<INPUT TYPE=\"checkbox\" NAME=\"Feeds[]\" VALUE=\"" . $this->FeedData["SuperFeedID"][$i] . "\">";
                $html .= "<SPAN CLASS='fieldtext'>";
                $html .= $this->FeedData["CalendarName"][$i];
                $html .= "&nbsp;&nbsp;&nbsp;&nbsp;";
                $html .= $this->FeedData["FeedURL"][$i];
                $html .= "</SPAN>";
                $html .= "<BR>";
            }
            $html .= "<INPUT CLASS='button' TYPE=\"submit\" NAME=\"DeleteFeed\" VALUE=\"Delete\" />";
            $html .= "<BR>";
            $html .= "</FORM>";
            $html .= "<FORM METHOD='Post' ACTION='calico_compositecalendar.php'>";
            $html .= "<INPUT CLASS='button' TYPE=\"submit\" VALUE=\"Composite Calendar\" />";
            $html .= "</FORM>";
            $html .= "</DIV>";

            return $html;
        }

        public function Draw() {
            return $this->RenderControl();
        }

        public function Refresh() {


            $this->GetCalendarNames();
            $this->GetURLs();

        }

        //@todo: Need another query to grab distinct Calendar Names.
        private function GetCalendarNames() {
            $this->CalendarData["CalendarName"] = Array();
            $this->CalendarData["CalendarID"] = Array();

            $query = "SELECT `CalendarName`, `CalendarID` FROM `calico`.`calendars` WHERE `UserID` = '" . $this->User->GetUserID() . "';";
            $data = \SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $this->CalendarData["CalendarName"][] = base64_decode($row['CalendarName']);
                $this->CalendarData["CalendarID"][] = $row['CalendarID'];
                //$this->FeedData["FeedURL"][] = base64_decode($row['FeedURL']);
            }

        }

        //@todo: Finish this query. Full Join.
        private function GetURLs() {
            $this->FeedData["CalendarName"] = Array();
            $this->FeedData["FeedURL"] = Array();
            $this->FeedData["SuperFeedID"] = Array();

            $query = "SELECT `S`.`FeedURL`, `S`.`SuperFeedID`,`C`.`CalendarName` FROM `calico`.`calendars` AS `C` INNER JOIN `calico`.`superfeeds` AS `S` ON `C`.`CalendarID` = `S`.`CalendarID` WHERE `C`.`UserID` = '" . $this->User->GetUserID() . "';";
            $data = \SQL\SQL::DataQuery($query);

            while($row = mysql_fetch_array($data))
            {
                $this->FeedData["CalendarName"][] = base64_decode($row['CalendarName']);
                $this->FeedData["FeedURL"][] = base64_decode($row['FeedURL']);
                $this->FeedData["SuperFeedID"][] = $row['SuperFeedID'];
            }

        }

        private function AddFeed($FeedUsername, $FeedPassword, $FeedURL, $Calendar) {
            $query = "INSERT INTO `calico`.`superfeeds` (`CalendarID`, `FeedURL`, `FeedUsername`, `FeedPassword`) VALUES (" . $Calendar . ",'" . base64_encode($FeedURL) . "','" . base64_encode($FeedUsername) . "','" . base64_encode($FeedPassword) . "');";
            $data = \SQL\SQL::NonDataQuery($query);
        }

        private function DeleteFeeds($Feeds) {
            foreach($Feeds as $feed) {
                $query = "DELETE FROM `calico`.`superfeeds` WHERE `SuperFeedID` = " . $feed . ";";
                $data = \SQL\SQL::NonDataQuery($query);
            }
        }

        public function Postback() {
            if(isset($_POST["AddFeed"])) {
                $this->AddFeed($_POST["feedusername"], $_POST["feedpassword"], $_POST["feedurl"], $_POST["CalendarSelect"]);
            }
            if(isset($_POST["DeleteFeed"])) {
                $this->DeleteFeeds($_POST["Feeds"]);
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
        private $Event = null;
        private $HTMLName = "EventEditorControl";
        private $CSSClass = "EventEditorControl";
        private $SelectedTime = 0;
        private $User = null;
        private $Message = "";

        public function __construct($User, $Event = null) {
            $this->User = $User;
            $this->Event = $Event;

            if(isset($_SESSION["TIME"])) {
                $this->SelectedTime = $_SESSION["TIME"];
            }
            //$this->Refresh();
        }

        private function GetFeedURLs() {
            $feeds = Array();

            $query = "SELECT `S`.`FeedURL` FROM `calico`.`calendars` AS `C` INNER JOIN `calico`.`superfeeds` AS `S` ON `C`.`CalendarID` = `S`.`CalendarID` WHERE `C`.`UserID` = '" . $this->User->GetUserID() . "';";
            $data = \SQL\SQL::DataQuery($query);

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
            $data = \SQL\SQL::DataQuery($query);

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
            $html .= "<FORM METHOD='post' ACTION='calico_event.php'>";
            $html .= "<SCRIPT LANGUAGE=\"javascript\" SRC=\"calendar/calendar/calendar.js\"></SCRIPT>";
            $html .= "<SPAN class='header'>Calico: Event Editor</SPAN>";
            $html .= "<BR>";
            if($this->Event == null) {
                $feeds = $this->GetFeedURLs();
                $html .= "<SPAN class='fieldtext'>Feed:</SPAN>";
                $html .= "<SELECT NAME=\"SelectedFeed\">";
                for($i = 0; $i < count($feeds); $i++) {
                    $html .= "<OPTION VALUE=\"" . $i . "\">" . $feeds[$i] . "</OPTION>";
                }
                $html .= "</SELECT>";
                $html .= "<BR>";
            }

            $html .= "<SPAN CLASS='fieldtext'>Title:</SPAN>";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Summary\" SIZE=\"40%\" VALUE=\"";
            if($this->Event != null) {
                $html .=  $this->Event->GetSummary();
            }
            $html .= "\">"; //@todo: Possibly extract Size component here to CSS.
            $html .= "<BR>";
            $html .= "<SPAN CLASS='fieldtext'>Location:</SPAN>";
            $html .= "<INPUT TYPE=\"text\" NAME=\"Location\" SIZE=\"40%\" VALUE=\"";
            if($this->Event != null) {
                $html .= $this->Event->GetLocation();
            }
            $html .= "\">";
            $html .= "<BR>";

            $startdate = 0;
            $enddate = 0;
            if($this->Event != null) {
                $startdate = $this->Event->GetStartDate();
                $enddate = $this->Event->GetEndDate();
            }
            else {
                $startdate = $_SESSION["TIME"];
                $enddate = $_SESSION["TIME"];
            }
            $html .= $this->RenderPanel("Start", $startdate);
            $html .= $this->RenderPanel("End", $enddate);


            $html .= "<BR>";

            $html .= "<SPAN CLASS='fieldtext'>Repeat:</SPAN>";
            $html .= "<SELECT NAME=\"Rrule\">";


            $rrules = array("Does not repeat" => "", "Daily" => "RRULE:FREQ=DAILY", "Weekly" => "RRULE:FREQ=WEEKLY", "Every Weekday" => "RRULE:FREQ=DAILY;BYDAY=MO,TU,WE,TH,FR", "Bi-weekly" => "RRULE:FREQ=WEEKLY;INTERVAL=2", "Monthly" => "RRULE:FREQ=MONTHLY", "Yearly" => "RRULE:FREQ=YEARLY");

            //@todo: Give this a more satisfying variable name.
            //@todo: Possibly build out this panel so it is tabbed.
            foreach($rrules as $key => $value)
            {
                $html .= "<OPTION VALUE=\"" . $value . "\"";
                if($this->Event != null) {
                    if($this->Event->GetRRule() == $value) {
                        $html .= " selected='selected'";
                    }

                }
                $html .= ">" . $key . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<BR>";




            $html .= "<SPAN CLASS='fieldtext'>Description:</SPAN>";
            $html .= "<TEXTAREA TYPE=\"text\" NAME=\"Description\" ROWS=\"5\" COLS=\"60\" WRAP=\"soft\">";
            if($this->Event != null) {
                $html .= $this->Event->GetDescription();
            }
            $html .= "</TEXTAREA>";
            $html .= "<BR>";
            $html .= "<INPUT CLASS='button' TYPE='submit' NAME='NewEvent' VALUE='New'>";
            $html .= "<INPUT CLASS='button' TYPE='submit' NAME='SaveEvent' VALUE='Save'>";
            $html .= "<INPUT CLASS='button' TYPE='submit' NAME='DeleteEvent' VALUE='Delete'>";
            $html .= "<INPUT CLASS='button'TYPE='submit' NAME='CompositeCalendarRedirect' VALUE='Composite Calendar'>";

            $html .= "</FORM>";

            $html .= "<BR>";
            $html .= "<SPAN ='fieldtext'>";
            $html .= $this->Message;
            $html .= "</SPAN>";

            $html .= "</DIV>";

            return $html;
        }


        private function RenderPanel($Prefix, $DefaultTime) {
            require_once('calendar/calendar/classes/tc_calendar.php');

            $html = "";
            $html .= "<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\"><tr><td nowrap>";
            $html .= "<SPAN CLASS='fieldtext'>" . $Prefix . " Date:</SPAN>";
            $html .= "</td><td>";
            //@todo: give an appropriate html name to this.
            $myCalendar = new \tc_calendar($Prefix . "datepicker", true, false); //date5->HTML name.
            $myCalendar->setIcon("calendar/calendar/images/iconCalendar.gif");
            $myCalendar->setDate(date('d', $DefaultTime)
                , date('m', $DefaultTime)
                , date('Y', $DefaultTime));
            //$myCalendar->setDate(date('d'), date('m'), date('Y'));
            $myCalendar->setPath("calendar/calendar/");
            $myCalendar->setYearInterval(2000, 2050);
            $myCalendar->dateAllow('2008-05-13', '2015-03-01');
            $myCalendar->setDateFormat('j F Y');
            $myCalendar->setAlignment('left', 'bottom');
            $myCalendar->zindex = 10;

            // This should, hypothetically, redirect the output from echo to a string.
            // It's either this, or rewrite the control.
            ob_start();
            $myCalendar->writeScript();
            $calendarhtml = ob_get_contents();
            ob_end_clean();
            $html .= "<SPAN CLASS='fieldtext'>";
            $html .= $calendarhtml;
            $html .= "</SPAN>";
            $html .= "</td><td>";

            //$html .= $myCalendar->writeScript();

            $html .= "<SELECT NAME=\"" . $Prefix . "hour\">"; // $_POST["starthour"], $_POST["endhour"]
            for($hour = 1; $hour <= 12; $hour++)
            {
                $html .= "<OPTION value=\"" . str_pad($hour, 2, "0", STR_PAD_LEFT) . "\"";
                if($hour == date("g", $DefaultTime)) {
                    $html .= " selected=\"selected\"";
                }
                $html .= ">" . $hour . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<SELECT NAME=\"" . $Prefix . "minute\">"; // $_POST["startminute"], $_POST["endminute"]
            for($minute = 0; $minute < 60; $minute++)
            {
                $html .= "<OPTION VALUE=\"" . str_pad($minute, 2, "0", STR_PAD_LEFT) . "\"";
                if($minute == date("i", $DefaultTime)) {
                    $html .= " selected=\"selected\"";
                }
                $html .= ">" . str_pad($minute, 2, "0", STR_PAD_LEFT) . "</OPTION>";
            }
            $html .= "</SELECT>";
            $html .= "<SELECT NAME=\"" . $Prefix . "period\">"; // $_POST["startperiod"], $_POST["startperiod"]
            $html .= "<OPTION VALUE=\"AM\"";
            if("AM" == date("A", $DefaultTime)) {
                $html .= " selected=\"selected\"";
            }
            $html .= ">AM</OPTION>";
            $html .= "<OPTION VALUE=\"PM\"";
            if("PM" == date("A", $DefaultTime)) {
                $html .= " selected=\"selected\"";
            }
            $html .= ">PM</OPTION>";
            $html .= "</SELECT>";
            $html .= "</tr></table>";
            $html .= "<BR>";

            return $html;
        }

        private function GetPanelDateTime($Prefix) {
            $date = isset($_REQUEST[$Prefix . "datepicker"]) ? $_REQUEST[$Prefix . "datepicker"] : ""; //Year-Month-Day
            $time = $_POST[$Prefix . "hour"] . ":" . $_POST[$Prefix . "minute"] . ":00" .$_POST[$Prefix . "period"];
            $dt = strtotime($date . " " . $time);
            return $dt;
        }

        /*
        public function Create() {
            $this->Event = \Data\Event::Create();
        }

        */

        public function Postback() {
            $this->Message = "";
            if(isset($_POST["SaveEvent"])) {
                if(isset($_POST["Summary"])) {
                    $summary = $_POST["Summary"];
                    $location = $_POST["Location"];
                    $description = $_POST["Description"];
                    $startdate = $this->GetPanelDateTime("Start");
                    $enddate = $this->GetPanelDateTime("End");
                    $rrule = $_POST["Rrule"];

                    if($this->Event == null) {
                        $id = $_POST["SelectedFeed"];
                        $feeddata = $this->GetFeedData();
                        $feedurl = $feeddata["FeedURL"][$id];
                        $feedusername = $feeddata["FeedUsername"][$id];
                        $feedpassword = $feeddata["FeedPassword"][$id];

                        $_SESSION["EVENT"] = serialize(\Data\Event::Create($feedurl, $feedusername, $feedpassword, $summary, $startdate, $enddate, $location, $description, $rrule));
                    }
                    else {

                        $this->Event->Update($summary, $location, $description, $startdate, $enddate, $rrule);
                        $_SESSION["EVENT"] = serialize($this->Event);
                    }
                    $this->Message = "Event Saved.<BR>";
                    \HTTP\HTTPRedirector::Redirect("calico_event.php");
                }
            }

            if(isset($_POST["NewEvent"])) {
                unset($_SESSION["EVENT"]);
                //$_SESSION["EVENT"] = null;
                $this->Event = null;
                \HTTP\HTTPRedirector::Redirect("calico_event.php");
            }

            if(isset($_POST["DeleteEvent"]) && $this->Event != null) {
                $this->Event->Delete();
                unset($_SESSION["EVENT"]);
                $this->Event = null;
                //$_SESSION["EVENT"] = null;
                $this->Message = "Event Deleted.<BR>";
                \HTTP\HTTPRedirector::Redirect("calico_event.php");
            }


            if(isset($_POST["CompositeCalendarRedirect"])) {
                unset($_SESSION["EVENT"]);
                $this->Event = null;

                \HTTP\HTTPRedirector::Redirect("calico_compositecalendar.php");
            }

            //\HTTP\HTTPRedirector::Redirect("calico_compositecalendar.php");

        }

        public function Delete() {
            $this->Event->Delete();
        }

        public function Draw() {
            return $this->RenderControl();
        }

        public function Refresh() {
            if($this->Event != null) {
                $this->Event->Refresh();
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




?>