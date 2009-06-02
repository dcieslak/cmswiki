<?php

require("common.php");

if(isset($_REQUEST["zapisz"]) || isset($_REQUEST["save"])) {
    if (isset($_REQUEST["originalText"])) {
        $originalText = stripslashes($_REQUEST["originalText"]);
    }
    else {
        $originalText = "";
    }

    savePage($pageName,
        stripslashes($_REQUEST["text"]),
        $originalText);

    if(isset($_REQUEST["zapisz"])) {
        header("Location: " . VIEW_PREFIX . $pageID);
    }
    else {
        header("Location: edit.php?page=" . $pageID);
    }
}
else if(isset($_REQUEST["anuluj"])) {
    header("Location: " . VIEW_PREFIX . $pageID);
}
else {
    $lastModified = @pageModified($pageID);
    $pageBody = $sAppendBody;

    $encodedPageBody = htmlspecialchars(loadPage($pageName, array()));

    include(EDIT_TEMPLATE);
}

?>
