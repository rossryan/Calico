<?php

require_once("calico_classes_v2.php");

if(!isset($_SESSION["USER"])) {
    HTTP\HTTPRedirector("calico_login.php");
}

$compositecalendar = new \GUI\CompositeCalendar($_SESSION["USER"]);
$compositecalendar->Postback();
$compositecalendar->Refresh();
$compositecalendar->Draw();



/*
foreach(array_keys($_REQUEST) as $str) {
   if(strpos($str, "ENT:") > 0) {
        
        $_SESSION["EVENT"] = $str;
		$_SESSION["USER"] = "";
		$_SESSION["FEED"] = "";
		
        
        // And the redirect works. This code must be up here, before anything else.
        header('Location : calico_event.php');             
    } 
    
}



?>

<html>
<HEAD>
<link rel="stylesheet" type="text/css" href="calico.css">
<script type="text/javascript">
function submitform()
{
    document.forms["compositeForm"].submit();
}
</script>
</HEAD>


<body style="background-image:url('DrexelLogo.png'); background-repeat:no-repeat; background-position:right top; background-color:#21467B;position:relative;z-index:0;">

<form action="calico_compositecalendar.php" method="post" id="compositeForm">
<h2><span class="headerText">Calico:</span></h2><hr/>
<table width="100%"><tr><td align="left"><b><span class="headerText">Composite Calendar:</span></b><br/></td><td align="right"><input type="button" class="standardButton" value="Print Composite Calendar" onClick="window.print()" /></td></tr></table>
<p/>
<select name="TypeOfView" onChange="submitform();">
<option value="Daily" <?php if(isset($_POST["TypeOfView"]) && ($_POST["TypeOfView"] == "Daily")) echo "SELECTED"?>>Daily</option>
<option value="Weekly" <?php if(isset($_POST["TypeOfView"]) && ($_POST["TypeOfView"] == "Weekly")) echo "SELECTED"?>>Weekly</option>
<option value="Monthly" <?php if(isset($_POST["TypeOfView"]) && ($_POST["TypeOfView"] == "Monthly")) echo "SELECTED"?>>Monthly</option>
</select>


<?php

require_once 'HTTP/Request2.php';
require_once 'HTTP.php';
require_once 'calico_classes.php';

// Output all the feeds from the db. Make this per UserID at a later point.

$con_out = mysql_connect("localhost","root","mysql");
if (!$con_out)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("calico", $con_out);

$result = mysql_query("SELECT Name FROM Calendars");

while($row = mysql_fetch_array($result)) {
		//echo $_POST[$row["Name"]];
		if(isset($_POST[$row["Name"]])) {
			echo "<input onClick=\"submitform();\" type=\"checkbox\" name = \"" . $row["Name"] . "\" value=\"" . $row["Name"] . "\"  checked /><span class=\"regularText\">" . $row["Name"] . "</span>";
			$calendars[] = new Calendar($row["Name"]);
		}
		else {
			echo "<input onClick=\"submitform();\" type=\"checkbox\" name = \"" . $row["Name"] . "\" value=\"" . $row["Name"] . "\" /><span class=\"regularText\">" . $row["Name"] . "</span>";
		}
}

mysql_close($con_out);


if($_POST["TypeOfView"] == "Daily") {
	$type = 0;
}
else if($_POST["TypeOfView"] == "Weekly") {
	$type = 1;
}
else {
	$type = 2;
}

if(count($calendars) > 0) {
$composite = new CompositeCalendar($type, $calendars); 
$composite->GenerateView();
}    


?>


</form>
</body>
</html> 

*/

?>

