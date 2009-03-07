<?php

if(!isset($db)) require("common.php");

$pages = array();
if (isset($_REQUEST["title"])) {
    $title = $_REQUEST["title"];
}
else {
    $title = "CMSWiki printAll preview";
}

clearstatcache();
$arr = array();
$dir = opendir($db);
while($file = readdir($dir))
{
	if($file[0] == ".")
		continue;
	if(!strpos($file, ".html"))
		continue;
	$k = strrpos($file, ".");

	$encodedPageName = substr($file, 0, $k);
    $pageName = urldecode($encodedPageName);
    $pageBody = getWikiPage($pageName);

    $pages[] = array($pageName, $pageBody);
}

sort($pages);

include(PRINT_TEMPLATE);


?>
