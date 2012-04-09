
<?php

require_once("calico_classes_v2.php");

if(!isset($_SESSION["USER"])) {
    HTTP\HTTPRedirector("calico_login.php");
}

$eventeditor = null;
if(isset($_SESSION["EVENT"])) {
    $eventeditor = new \GUI\EventEditor($_SESSION["USER"], $_SESSION["EVENT"]);
}
else {
    $eventeditor = new \GUI\EventEditor($_SESSION["USER"]);
}

$eventeditor->Postback();
$eventeditor->Refresh();
$eventeditor->Draw();


/*
foreach(array_keys($_REQUEST) as $str) {
	if($str == "Save" || $str == "Cancel" || $str == "Delete") {
			if($str == "Save") {
			
				$feed = new Feed("rwr26", "Warp\$ig7", "https://calendar.cs.drexel.edu/davical/caldav.php/rwr26/home/", "1");
				$feed->GetEvents();

				$event = new Event();
				$event->SetCreationdate(time());
				$event->SetLastModified(time());
				$event->SetDatestamp(time());
				$event->SetSummary($_POST["summary"]);
				$event->SetDescription($_POST["description"]);
				$event->SetLocation($_POST["location"]);
				$event->SetRRule($_POST["repeat"]);
				
				if($_POST["periodstart"] == "PM") {
					$_POST["hourstart"] += 12; 
				}
				
				$start = $_POST["yearstart"] . $_POST["monthstart"] . $_POST["daystart"] . "T" . $_POST["hourstart"] . $_POST["minutestart"] . "00";
				//echo "Start: " . $start . "<BR>";
				if($_POST["periodend"] == "PM") {
					$_POST["hourend"] += 12; 
				}
				
				$end = $_POST["yearend"] . $_POST["monthend"] . $_POST["dayend"] . "T" . $_POST["hourend"] . $_POST["minuteend"] . "00";
				//echo "End: " . $end . "<BR>";
				$event->SetStartdate(strtotime($start));
				$event->SetEnddate(strtotime($end));
				$event->SetTimezone(date_default_timezone_get());
				
				if(isset($_SESSION["ETAG"]) && $_SESSION["ETAG"] != null && $_SESSION["ETAG"] != "") {
					$testfeed->EditEvent($event, $_SESSION["ETAG"]);
				}
				else {
					$testfeed->AddEvent($event);
				}
			
			
			}
			else if($str == "Delete") {
				if(isset($_SESSION["ETAG"]) && $_SESSION["ETAG"] != null && $_SESSION["ETAG"] != "") {
					$testfeed->DeleteEvent($event, $_SESSION["ETAG"]);
				}
			
			}
			
			//$_SESSION["USER"] = ""; 
			header('Location : calico_compositecalendar.php'); 
		}
}

if(isset($_SESSION["EVENT"]) && $_SESSION["EVENT"] != null && $_SESSION["EVENT"] != "") {

	echo $_SESSION["EVENT"];
	/*
	// Need to call Propfind for the etag. Need the feed to call propfind. 
	// Need to implement user session variable here. 
    $eventid = trim(str_replace("EVENT:"), "", $_SESSION["EVENT"]);
	echo $eventid;
	
	//$_SESSION["USER"];
    //$feed = new Feed("rwr26", "Warp\$ig7", "https://calendar.cs.drexel.edu/davical/caldav.php/rwr26/home/", "1");
    $feed->GetEvents();
    $event = $feed->GetEventFromID($eventid);
	
	$_SESSION["ETAG"] = "";  

}





echo "<html>";

echo "<HEAD>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"calico.css\">";
echo "</HEAD>";
echo "<body style=\"background-image:url('DrexelLogo.png'); background-repeat:no-repeat; background-position:right top; background-color:#21467B;position:relative;z-index:0;\">";

echo "<form action=\"calico_event.php\" method=\"post\">";
echo "<h2><span class=\"headerText\">Calico:</span></h2><hr/>";
echo "<TABLE><TR VALIGN=\"TOP\"><TD>";
echo "<b><span class=\"headerText\">Event:</span></TD><TD ALIGN=\"RIGHT\"><input type=\"submit\" class=\"standardButton\" name = \"Delete\" value=\"Delete\" /><br/><br/></TD></TR>";

echo "</TABLE>";
echo "<TABLE>";
echo "<TR VALIGN=\"TOP\">";


echo "<TD>";
echo "<span class=\"regularText\">";
echo "Title: </span></TD><TD><input type=\"text\" name=\"summary\" size=\"80\"/><BR></TD></TR><TR VALIGN=\"TOP\"><TD>";
echo "<span class=\"regularText\">Location: </span></TD><TD><input type=\"text\" name=\"location\" size=\"80\"/><BR></TD></TR><TR VALIGN=\"TOP\"><TD>";
echo "<span class=\"regularText\">Start Date:</span></TD><TD>";
       
	   echo "<div class=\"standardButton\" style=\"position:relative;\">" ;
	   echo "<script language=\"javascript\" src=\"calendar\calendar.js\"></script>";
						require_once('calendar/classes/tc_calendar.php');
						 
						 $myCalendar = new tc_calendar("datestart", true, false);
						  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
						  $myCalendar->setDate(date('d'), date('m'), date('Y'));
						  $myCalendar->setPath("calendar/");
						  $myCalendar->setYearInterval(2000, 2050);
						  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
						  $myCalendar->setDateFormat('j F Y');
						  $myCalendar->setAlignment('left', 'bottom');
						  $myCalendar->writeScript();
						  
						  echo "</div>";
						  
	echo "<select name=\"hourstart\" style=\"text-align:right;\">";
		 for($x=1;$x<=12;$x++) 
                 {               
			echo "<option style=\"text-align:right\" value=\"" . str_pad($x, 2, "0", STR_PAD_LEFT) . "\">" . $x . "</option>";
                 }
		 
	echo "</select><B>:</B>";	
	echo "<select name=\"minutestart\" style=\"text-align:right\">";
		 for($x=0;$x<60;$x++) 
                 {               
			echo "<option style=\"text-align:right\" value=\"" . str_pad($x, 2, "0", STR_PAD_LEFT) . "\">" . str_pad($x, 2, "0", STR_PAD_LEFT) . "</option>";
                 }
		
	echo "</select>";
	echo "<select name=\"periodstart\" style=\"text-align:right\">";
                echo "<option value=\"AM\" style=\"text-align:right\">AM</option>";
		echo "<option value=\"PM\" style=\"text-align:right\">PM</option>";	
	echo "</select>";
echo "<BR><BR></TD></TR><TR VALIGN=\"TOP\"><TD><span class=\"regularText\">"; 
echo "End Date: </span></TD><TD>";
		
		echo "<div class=\"standardButton\" style=\"position:relative;z-index:3;\">" ;
		echo "<script language=\"javascript\" src=\"calendar\calendar.js\"></script>";
						require_once('calendar/classes/tc_calendar.php');
						 
						 $myCalendar = new tc_calendar("dateend", true, false);
						  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
						  $myCalendar->setDate(date('d'), date('m'), date('Y'));
						  $myCalendar->setPath("calendar/");
						  $myCalendar->setYearInterval(2000, 2050);
						  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
						  $myCalendar->setDateFormat('j F Y');
						  $myCalendar->setAlignment('left', 'bottom');
						  $myCalendar->writeScript();
						  echo "</div>";
						  
	echo "<select name=\"hourend\" style=\"text-align:right\">";
		 for($x=1;$x<=12;$x++) 
                 {               
			echo "<option style=\"text-align:right\" value=\"" . str_pad($x, 2, "0", STR_PAD_LEFT) . "\">" . $x . "</option>";
                 }
		 
	echo "</select><B>:</B>";	
	echo "<select name=\"minuteend\" style=\"text-align:right\">";
		for($x=0;$x<60;$x++) 
                 {               
			echo "<option style=\"text-align:right\" value=\"" . str_pad($x, 2, "0", STR_PAD_LEFT) . "\">" . str_pad($x, 2, "0", STR_PAD_LEFT) . "</option>";
                 }
		 
	echo "</select>";
	echo "<select name=\"periodend\" style=\"text-align:right\">";
                echo "<option value=\"AM\" style=\"text-align:right\">AM</option>";
		echo "<option value=\"PM\" style=\"text-align:right\">PM</option>";	
	echo "</select>";

echo "<BR>";
echo "<BR></TD></TR><TR VALIGN=\"TOP\"><TD><span class=\"regularText\">";
echo "Repeat:</span></TD><TD>";
        echo "<select name=\"repeat\">";
		
                
                $options = array("Does not repeat", "Daily", "Weekly", "Every Weekday", "Bi-weekly","Monthly", "Yearly");
                $rrules = array("", "RRULE:FREQ=DAILY", "RRULE:FREQ=WEEKLY", "RRULE:FREQ=DAILY;BYDAY=MO,TU,WE,TH,FR", "RRULE:FREQ=WEEKLY;INTERVAL=2", "RRULE:FREQ=MONTHLY", "RRULE:FREQ=YEARLY");
                for($x=0;$x<count($options);$x++) 
                 {               
			echo "<option value=\"" . $rrules[$x] . "\">" . $options[$x] . "</option>";
                 }
		 
	echo "</select>";
echo "<BR><BR></TD></TR>";
echo "<TR VALIGN=\"TOP\"><TD><span class=\"regularText\">Description: </span></TD><TD></TD></TR>";
echo "<TR VALIGN=\"TOP\"><TD></TD><TD><textarea type=\"text\" name=\"description\" rows=\"5\" cols=\"60\">";
echo "</textarea><BR></TD></TR>";

echo "<TR><TD></TD><TD ALIGN=\"RIGHT\"><input type=\"submit\" name = \"Save\" class=\"standardButton\" value=\"Save\" /><input type=\"submit\" class=\"standardButton\" name=\"Cancel\" value=\"Cancel\" /></TD></TR>";
echo "</TABLE>";




echo "</form>";
echo "</body>";
echo "</html>"; 
*/

?>