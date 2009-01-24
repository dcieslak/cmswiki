<?php

if(!isset($db)) require("common.php");

$pageUrl = urlencode($page);
//$page = 
$modified = @pageModified($page);
$pageBody = getWikiPage($page);

include(TEMPLATE);


?>
