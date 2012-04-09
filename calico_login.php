<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryan
 * Date: 3/26/12
 * Time: 6:50 PM
 * To change this template use File | Settings | File Templates.
 */

require_once("calico_classes_v2.php");

// I'll explain this once.
$login = new \GUI\Login(); // Declare object here.
$login->Postback(); // Call object, and have it check if anything has changed (PostED Back from the page)
$login->Refresh(); // The MS equivalent of DataBind(), also known as "I have set all the flags I want, we are good to go, get the data, and prepare to write the HTML"

echo "<HTML>
<HEAD>
<TITLE>Calico:Login</TITLE>
</HEAD>
<BODY>" . $login->Draw() . "</BODY>
</HTML>";



















?>