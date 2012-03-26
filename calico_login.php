<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ryan
 * Date: 3/26/12
 * Time: 6:50 PM
 * To change this template use File | Settings | File Templates.
 */

require_once("calico_classes_v2.php");

$login = new \GUI\Login();

$login->EventCallback();
$login->Refresh();
$login->Draw();












































?>