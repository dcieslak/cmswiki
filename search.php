<?php

require("common.php");

@$sText = $_REQUEST["text"];

if(isset($_REQUEST["text"]) && $_REQUEST["text"])
{
	$sSearch = $_REQUEST["text"];
	$arr = array();
	$dir = opendir(PAGES_DIRECTORY);
	while($file = readdir($dir))
	{
		if($file[0] == ".")
			continue;
		if(!strpos($file, ".html"))
			continue;
		$lines = file(PAGES_DIRECTORY . "/" . $file);

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
		$sAppendBody .= "<A HREF=\"" . VIEW_PREFIX . $sFile\">$pageName</A>";
		$sAppendBody .= "<BR>";
	}

    $pageBody = $sAppendBody;
    $pageName = "Search Results";
    $pageID = "";
    $lastModified = "";

    include(VIEW_TEMPLATE);
}
else {
    header("Location: changes.php");
}


?>
