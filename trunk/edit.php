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
        header("Location: view.php?" . $pageID);
    }
    else {
        header("Location: edit.php?" . $pageID);
    }
}
else if(isset($_REQUEST["anuluj"])) {
    header("Location: view.php?" . $pageID);
}
else {
    $lastModified = @pageModified($page);
    $pageBody = $sAppendBody;

    $encodedPageBody = htmlspecialchars(loadPage($pageName, array()));

    include(EDIT_TEMPLATE);
}

?>
