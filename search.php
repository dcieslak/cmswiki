<?php

if(!isset($db)) require("common.php");

@$sText = $_REQUEST["text"];

if(isset($_REQUEST["text"]) && $_REQUEST["text"])
{
	$sSearch = $_REQUEST["text"];
	$arr = array();
	$dir = opendir("pages");
	while($file = readdir($dir))
	{
		if($file[0] == ".")
			continue;
		if(!strpos($file, ".html"))
			continue;
		$lines = file("pages/" . $file);

		if($sSearch == "" ||
		strpos(" " . strtolower($file),
			strtolower($sSearch)) > 0 ||
		strpos(" " . strtolower(join(" ",$lines)),
			strtolower($sSearch)) > 0
		)
			$arr[] = "$file";
	}

	sort($arr);

	while(list(,$sLine) = each($arr))
	{
		$k = strpos($sLine, ".");
		$sFile = substr($sLine, 0, $k);
		$pageName = urldecode($sFile);
		$sAppendBody .= "<A HREF=\"view.php?$sFile\">$pageName</A>";
		$sAppendBody .= "<BR>";
	}

    $pageBody = $sAppendBody;
    $pageName = "Search Results";
    $pageID = "";
    $lastModified = "";

    include(VIEW_TEMPLATE);
}
else {
    include("changes.php");
}


?>
