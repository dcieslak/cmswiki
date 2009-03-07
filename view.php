<?php

if(!isset($db)) require("common.php");

$pageBody = getWikiPage($pageName);

include(VIEW_TEMPLATE);


?>
