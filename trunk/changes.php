<?php

if(!isset($db)) require("common.php");

clearstatcache();
$arr = array();
$dir = opendir($db);
while($file = readdir($dir))
{
	if($file[0] == ".")
		continue;
	if(!strpos($file, ".html"))
		continue;
	$stat = stat("pages/" . $file);
	$lastModified = strftime("%Y-%m-%d %H:%M",$stat[10]);
	$arr[] = "$lastModified\t$file";
}

rsort($arr);
$sOldDay = "";

while(list(,$sLine) = each($arr))
{
	$i = strpos($sLine, "\t");
	$k = strrpos($sLine, ".");

	$sDate = substr($sLine, 0, $i);
	$sDay = substr($sLine, 0, 10);

	if($sDay != $sOldDay)
	{
		$sAppendBody .= "<H3>$sDay</H3>";
		$sOldDay = $sDay;
	}

	$sFile = substr($sLine, $i+1, $k - $i -1);
	$sFileUrl = $sFile;
    $sFile = urldecode($sFileUrl);

	$sText = htmlspecialchars(substr($sLine, $i+1));
	$sAppendBody .= "<A HREF=\"view.php?$sFileUrl\">$sFile</A>";
	$sAppendBody .= "<BR />\n";
}

$pageBody = $sAppendBody;
$pageID = "";
$lastModified = "";
include(VIEW_TEMPLATE);

?>
