<?php

require("common.php");

if(isset($_REQUEST["zapisz"])) {
    if (isset($_REQUEST["originalText"])) {
        $originalText = stripslashes($_REQUEST["originalText"]);
    }
    else {
        $originalText = "";
    }

    savePage($page,
        stripslashes($_REQUEST["text"]), $originalText);
    include('view.php');
}
else if(isset($_REQUEST["anuluj"])) {
    include('view.php');
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
