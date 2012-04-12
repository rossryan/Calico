<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryan
 * Date: 4/9/12
 * Time: 11:01 PM
 * To change this template use File | Settings | File Templates.
 */

include_once("calico_classes_v2.php");

// I'll explain this once.
$account = new \GUI\NewAccount(); // Declare object here.
$account->Postback(); // Call object, and have it check if anything has changed (PostED Back from the page)
$account->Refresh(); // The MS equivalent of DataBind(), also known as "I have set all the flags I want, we are good to go, get the data, and prepare to write the HTML"

echo "<HTML>
<HEAD>
<TITLE>Calico: New Account</TITLE>
<link rel=\"stylesheet\" type=\"text/css\" href=\"calico.css\">
<link rel=\"SHORTCUT ICON\" href=\"favicon.ico\">
</HEAD>
<BODY>";
echo $account->Draw();
echo "</BODY>
</HTML>";



?>