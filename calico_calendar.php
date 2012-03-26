<?php

require_once("calico_classes_v2.php");

$calendarmanager = new \GUI\CalendarManager();

$calendarmanager->EventCallback();
$calendarmanager->Refresh();



$calendarmanager->Draw();

/*

<html>
<HEAD>
<link rel="stylesheet" type="text/css" href="calico.css">
</HEAD>
<body style="background-image:url('DrexelLogo.png'); background-repeat:no-repeat; background-position:right top; background-color:#21467B;position:relative;z-index:0;">

<form action="calico_calendar.php" method="post">
<h2><span class="headerText">Calico:</span></h2><hr/>
<b><span class="headerText">Calendar:</span></b><br/><p/>

<span class="regularText">Name: </span><input type="text" name="name" />

<input class="standardButton" type="submit" /><br/><br/>
<?php



// Check for new feed. Add it to the db if there is one.
if(isset($_POST["name"])) {

	$con_in = mysql_connect("localhost","root","mysql");
	if (!$con_in)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("calico", $con_in);

	mysql_query("INSERT INTO Calendars (Name) VALUES ('" . $_POST["name"] . "')");

	mysql_close($con_in);
}


// Output all the feeds from the db. Make this per UserID at a later point.

$con_out = mysql_connect("localhost","root","mysql");
if (!$con_out)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("calico", $con_out);

$result = mysql_query("SELECT Name FROM Calendars");

echo "<table width=\"100%\" bgcolor=\"gray\">";

echo "<tr>";
  	echo "<td><b>Calendars</b></td>";
  	//echo "<td><b>Feed URL</b></td>";
	//echo "<td><b>Feed Contents</b></td>";
  	echo "</tr>";
while($row = mysql_fetch_array($result))
  {
	echo "<tr>";
  	echo "<td>" . $row['Name'] . "</td>";
  	//echo "<td>" . "<a href=\"" . $row['Feed'] . "\">" . $row['Feed'] . "</a>" . "</td>";
	//echo "<td>" . file_get_contents($row['Feed']) . "</td>";
  	echo "</tr>";
  }
  
echo "</table>";

mysql_close($con_out);




?>


</form>
</body>
</html> 
*/


?>