<?php

if(!isset($db)) require("common.php");

$lastModified = @pageModified($pageName);
$encodedPageBody = getWikiPage($pageName);

include(VIEW_TEMPLATE);


?>
