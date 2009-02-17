<?php

if(!isset($db)) require("common.php");

@$sText = $_GET["text"];

if(isset($_GET["text"]) && $_GET["text"])
{
	$sSearch = $_GET["text"];
	$arr = array();
	$dir = opendir("pages");
	while($file = readdir($dir))
	{
		if($file == "." || $file == "..")
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
		$page = urldecode($sFile);
		$sAppendBody .= "<A HREF=\"view.php?$sFile\">$page</A>";
		$sAppendBody .= "<BR>";
	}

    $pageBody = $sAppendBody;
    $page = "Search Results";
    $pageUrl = "";
    $modified = "";

    include(TEMPLATE);
}
else {
    include("changes.php");
}


?>
