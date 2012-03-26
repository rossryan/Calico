<?php
require_once("calico_classes_v2.php");

$superfeedmanager = new \GUI\SuperFeedManager();

$superfeedmanager->EventCallback();
$superfeedmanager->Refresh();


$superfeedmanager->Draw();


/*
<html>
<HEAD>
<link rel="stylesheet" type="text/css" href="calico.css">
</HEAD>
<body style="background-image:url('DrexelLogo.png'); background-repeat:no-repeat; background-position:right top; background-color:#21467B;position:relative;z-index:0;">

<form action="calico_feed.php" method="post">
<h2><span class="headerText">Calico:</span></h2><hr/>
<b><span class="headerText">Feed:</span></b><br/><p/>

<span class="regularText">Username: </span><input type="text" name="username" />
<span class="regularText">Password: </span><input type="password" name="password" />
<span class="regularText">Feed URL: </span><input type="text" name="feedurl" />
<?php

$con_calendars = mysql_connect("localhost","root","mysql");
if (!$con_calendars)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("calico", $con_calendars);

$result = mysql_query("SELECT Name FROM Calendars");


echo "<select name=\"calendar\">";

while($row = mysql_fetch_array($result))
  {

	echo "<option>" . $row['Name'] . "</option>";

}
echo "</select>";

?>

<input class="standardButton" type="submit" /><br/><br/>
<?php

// Check for new feed. Add it to the db if there is one.
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["feedurl"])) {

	$con_in = mysql_connect("localhost","root","mysql");
	if (!$con_in)
	  {
	  die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("calico", $con_in);

	mysql_query("INSERT INTO Feeds (Username, Password, Feed, Calendar) VALUES ('" . $_POST["username"] . "', '" . $_POST["password"] . "', '" . $_POST["feedurl"]  . "', '" . $_POST["calendar"] . "')");

	mysql_close($con_in);
}


// Output all the feeds from the db. Make this per UserID at a later point.

$con_out = mysql_connect("localhost","root","mysql");
if (!$con_out)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("calico", $con_out);

$result = mysql_query("SELECT Username, Feed, Calendar FROM Feeds");

echo "<table width=\"100%\">";

echo "<tr>";
  	echo "<td><b>Username</b></td>";
  	echo "<td><b>Feed URL</b></td>";
	echo "<td><b>Calendar</b></td>";
  	echo "</tr>";
while($row = mysql_fetch_array($result))
  {
	echo "<tr>";
  	echo "<td>" . $row['Username'] . "</td>";
  	echo "<td>" . "<a href=\"" . $row['Feed'] . "\">" . $row['Feed'] . "</a>" . "</td>";
	echo "<td>" . $row['Calendar'] . "</td>";
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


