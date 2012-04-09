<html>
<head>
    <script language="javascript" src="/calendar/calendar/calendar.js"></script>
</head>
<form action="test.php" method="post">
    <?php
//get class into the page
    require_once('/calendar/calendar/classes/tc_calendar.php');

//instantiate class and set properties
    $myCalendar = new tc_calendar("date2");
    $myCalendar->setIcon("calendar/calendar/images/iconCalendar.gif");
    $myCalendar->setDate(date('d'), date('m'), date('Y'));
    $myCalendar->setPath("calendar/calendar/");
    $myCalendar->setYearInterval(1970, 2020);
    $myCalendar->dateAllow('2008-05-13', '2015-03-01', false);
    $myCalendar->startMonday(true);
    $myCalendar->disabledDay("Sat");
    $myCalendar->disabledDay("sun");
    $myCalendar->writeScript();
    ?>
</form>
</html>
