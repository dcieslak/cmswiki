<?php

if(!isset($db)) require("common.php");

$lastModified = @pageModified($pageName);
$pageBody = getWikiPage($pageName);

include(TEMPLATE);


?>
