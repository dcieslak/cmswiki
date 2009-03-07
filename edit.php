<?php

require("common.php");

if(isset($_REQUEST["zapisz"]) || isset($_REQUEST["save"])) {
    if (isset($_REQUEST["originalText"])) {
        $originalText = stripslashes($_REQUEST["originalText"]);
    }
    else {
        $originalText = "";
    }

    savePage($page,
        stripslashes($_REQUEST["text"]),
        $originalText);

    if(isset($_REQUEST["zapisz"])) {
        header("Location: view.php?" . $page);
    }
    else {
        header("Location: edit.php?" . $page);
    }
}
else if(isset($_REQUEST["anuluj"])) {
    header("Location: view.php?" . $page);
}
else {
    $pageUrl = urlencode($page);

    $sAppendBody = loadPage(EDIT_PAGE_NAME, array(
        "[page]" => $page,
        "[pageUrl]" => $pageUrl,
        "[body]" => htmlspecialchars(loadPage($page, array()))
    ));

    $pageUrl = urlencode($page);
    //$page = 
    $modified = @pageModified($page);
    $pageBody = $sAppendBody;

    echo $pageBody;
}

?>
