<?PHP

$String = "UID:5F12F7DA-10B0-4EE3-820D-B56F0B2FC153\x0D\x0ADTSTAMP:20120408T041113Z\x0D\x0ACLASS:PUBLIC\x0D\x0ACREATED:20120408T041113Z\x0D\x0ADESCRIPTION:Testfghfghfghfghfghfghfghfghfghfghfghfghfghfghfgh\x0D\x0ADTSTART;TZID=America/New_York:20120410T000000\x0D\x0ADTEND;TZID=America/New_York:20120419T010000\x0D\x0ALAST-MODIFIED:20120408T041228Z\x0D\x0ALOCATION:Philadelphia\, PA\x0D\x0ASEQUENCE:1\x0D\x0ASUMMARY:Test\x0D\x0ATRANSP:OPAQUE";



$re1='.*?';	# Non-greedy match on filler
$re2='(SUMMARY)';	# Word 1
$re3='(:)';	# Any Single Character 1
$re4='(.*?)';	# Non-greedy match on filler
$re5='(\r\n)';	# Any Single Character 2

if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $String, $matches))
{
    echo "Got here";
    $word1=$matches[1][0];
    $c1=$matches[2][0];
    $word2=$matches[3][0];
    echo $word2;
}










?>