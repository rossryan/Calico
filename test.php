<?php

$xml = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<multistatus xmlns=\"DAV:\" xmlns:C=\"urn:ietf:params:xml:ns:caldav\">
 <response>
  <href>/davical/caldav.php/rwr26/home/</href>
  <propstat>
   <prop>
    <getcontenttype>httpd/unix-directory</getcontenttype>
    <resourcetype>
     <collection/>
     <C:calendar/>
    </resourcetype>
   </prop>
   <status>HTTP/1.1 200 OK</status>
  </propstat>
  <propstat>
   <prop>
    <getetag/>
   </prop>
   <status>HTTP/1.1 404 Not Found</status>
  </propstat>
 </response>
 <response>
  <href>/davical/caldav.php/rwr26/home/c9bfc6b0-064e-4316-83fe-753db34e67ee.ics</href>
  <propstat>
   <prop>
    <getcontenttype>text/calendar</getcontenttype>
    <resourcetype/>
    <getetag>\"bf63630321bf89bbf7a51da56be9b362\"</getetag>
   </prop>
   <status>HTTP/1.1 200 OK</status>
  </propstat>
 </response>
 <response>
  <href>/davical/caldav.php/rwr26/home/4e6e3500e89673.63357057.ics</href>
  <propstat>
   <prop>
    <getcontenttype>text/calendar</getcontenttype>
    <resourcetype/>
    <getetag>\"46d6c0ce188977c7d9f8dd836fed0278\"</getetag>
   </prop>
   <status>HTTP/1.1 200 OK</status>
  </propstat>
 </response>
 <response>
  <href>/davical/caldav.php/rwr26/home/4e6e42d394f9e5.08299254.ics</href>
  <propstat>
   <prop>
    <getcontenttype>text/calendar</getcontenttype>
    <resourcetype/>
    <getetag>\"84bba82e667f6144516cec7bb02deade\"</getetag>
   </prop>
   <status>HTTP/1.1 200 OK</status>
  </propstat>
 </response>
</multistatus>

";


$xml2 = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>
<multistatus xmlns=\"DAV:\" xmlns:C=\"urn:ietf:params:xml:ns:caldav\">
 <response>
  <href>/davical/caldav.php/rwr26/home/c9bfc6b0-064e-4316-83fe-753db34e67ee.ics</href>
  <propstat>
   <prop>
    <getetag>\"bf63630321bf89bbf7a51da56be9b362\"</getetag>
    <C:calendar-data>BEGIN:VCALENDAR
PRODID:-//Mozilla.org/NONSGML Mozilla Calendar V1.1//EN
VERSION:2.0
BEGIN:VTIMEZONE
TZID:America/New_York
X-LIC-LOCATION:America/New_York
BEGIN:DAYLIGHT
TZOFFSETFROM:-0500
TZOFFSETTO:-0400
TZNAME:EDT
DTSTART:19700308T020000
RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:-0400
TZOFFSETTO:-0500
TZNAME:EST
DTSTART:19701101T020000
RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11
END:STANDARD
END:VTIMEZONE
BEGIN:VEVENT
CREATED:20111219T194407Z
LAST-MODIFIED:20111219T194431Z
DTSTAMP:20111219T194431Z
UID:c9bfc6b0-064e-4316-83fe-753db34e67ee
SUMMARY:New Test
DTSTART;TZID=America/New_York:20111219T150000
DTEND;TZID=America/New_York:20111219T160000
LOCATION:Philadelphia
DESCRIPTION:Propfind test.
END:VEVENT
END:VCALENDAR
</C:calendar-data>
   </prop>
   <status>HTTP/1.1 200 OK</status>
  </propstat>
 </response>
 <response>
  <href>/davical/caldav.php/rwr26/home/4e6e3500e89673.63357057.ics</href>
  <propstat>
   <prop>
    <getetag>\"46d6c0ce188977c7d9f8dd836fed0278\"</getetag>
    <C:calendar-data>BEGIN:VCALENDAR
PRODID:-//Mozilla.org/NONSGML Mozilla Calendar V1.1//EN
VERSION:2.0
BEGIN:VTIMEZONE
TZID:America/New_York
X-LIC-LOCATION:America/New_York
BEGIN:DAYLIGHT
TZOFFSETFROM:-0500
TZOFFSETTO:-0400
TZNAME:EDT
DTSTART:19700308T020000
RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:-0400
TZOFFSETTO:-0500
TZNAME:EST
DTSTART:19701101T020000
RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11
END:STANDARD
END:VTIMEZONE
BEGIN:VEVENT
CREATED:20110912T163616Z
LAST-MODIFIED:20120217T173356Z
DTSTAMP:20120217T173356Z
UID:4e6e3500e89673.63357057
SUMMARY:Test
DTSTART;TZID=America/New_York:20130717T081400
DTEND;TZID=America/New_York:19691231T190000
DESCRIPTION:Testhhhh
X-MOZ-GENERATION:1
END:VEVENT
END:VCALENDAR
</C:calendar-data>
   </prop>
   <status>HTTP/1.1 200 OK</status>
  </propstat>
 </response>
 <response>
  <href>/davical/caldav.php/rwr26/home/4e6e42d394f9e5.08299254.ics</href>
  <propstat>
   <prop>
    <getetag>\"84bba82e667f6144516cec7bb02deade\"</getetag>
    <C:calendar-data>BEGIN:VCALENDAR
PRODID:-//Mozilla.org/NONSGML Mozilla Calendar V1.1//EN
VERSION:2.0
BEGIN:VTIMEZONE
TZID:America/New_York
X-LIC-LOCATION:America/New_York
BEGIN:DAYLIGHT
TZOFFSETFROM:-0500
TZOFFSETTO:-0400
TZNAME:EDT
DTSTART:19700308T020000
RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3
END:DAYLIGHT
BEGIN:STANDARD
TZOFFSETFROM:-0400
TZOFFSETTO:-0500
TZNAME:EST
DTSTART:19701101T020000
RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11
END:STANDARD
END:VTIMEZONE
BEGIN:VEVENT
CREATED:20110912T173515Z
LAST-MODIFIED:20110912T173515Z
DTSTAMP:20110912T173515Z
UID:4e6e42d394f9e5.08299254
SUMMARY:Grade for Ryan
DTSTART;TZID=America/New_York:20120101T010000
DTEND;TZID=America/New_York:20120101T010100
DESCRIPTION:Turn in grades for Ryan
END:VEVENT
END:VCALENDAR</C:calendar-data>
   </prop>
   <status>HTTP/1.1 200 OK</status>
  </propstat>
 </response>
</multistatus>
";

$multistatus = new SimpleXMLElement($xml2);
//$multistatus->registerXPathNamespace("C","urn:ietf:params:xml:ns:caldav");

echo "Href: " . $multistatus->response[0]->href . "<BR>";
echo "Etag: " . $multistatus->response[0]->propstat->prop->getetag . "<BR>";

//print_r($multistatus->response[0]->propstat->prop->children("urn:ietf:params:xml:ns:caldav"));

$node = $multistatus->response[0]->propstat->prop->children("urn:ietf:params:xml:ns:caldav");
echo $node[0];

//echo "Calendar Data:" . $multistatus->response[0]->propstat->prop->{"calendar-data"} . "<BR>";

echo "Count: " . count($multistatus->response) . "<BR>";

//$root->registerXPathNamespace("C", "urn:ietf:params:xml:ns:caldav");
//echo $xml;

//print_r($root);

//$result = $root->children();

//echo $movies->movie->{'great-lines'}->line;
/*
while(list( , $node) = each($result)) {
    echo $node,"\n";
}
*/
//echo 'Test';


?>