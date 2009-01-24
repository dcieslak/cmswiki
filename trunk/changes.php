<?php

if(!isset($db)) require("common.php");

clearstatcache();
$arr = array();
$dir = opendir($db);
while($file = readdir($dir))
{
	if($file == "." || $file == "..")
		continue;
	if(!strpos($file, ".html"))
		continue;
	$stat = stat(PAGES_DIRECTORY . "/" . $file);
	$modified = strftime("%Y-%m-%d %H:%M",$stat[10]);
	$arr[] = "$modified\t$file";
}

rsort($arr);
$sOldDay = "";

while(list(,$sLine) = each($arr))
{
	$i = strpos($sLine, "\t");
	$k = strrpos($sLine, ".");

	$sDate = substr($sLine, 0, $i);
	$sDay = substr($sLine, 0, 10);
	$sTime = substr($sLine, 11, 5);

	if($sDay != $sOldDay)
	{
		$sAppendBody .= "<H3>$sDay</H3>";
		$sOldDay = $sDay;
	}

	$sFile = substr($sLine, $i+1, $k - $i -1);
	$sFileUrl = $sFile;
    $sFile = urldecode($sFileUrl);

	$sText = htmlspecialchars(substr($sLine, $i+1));
	$sAppendBody .= "$sTime <A HREF=\"view.php?$sFileUrl\">$sFile</A>";
	$sAppendBody .= "<BR />\n";
}

$pageBody = $sAppendBody;
$pageUrl = "";
$modified = "";
include(TEMPLATE);

?>
