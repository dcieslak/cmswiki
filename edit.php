<?php

require("common.php");

if(isset($_POST["zapisz"])) {
    if (isset($_POST["originalText"])) {
        $originalText = stripslashes($_POST["originalText"]);
    }
    else {
        $originalText = "";
    }

    savePage($page,
        stripslashes($_POST["text"]), $originalText);
    include('view.php');
}
else if(isset($_POST["anuluj"])) {
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
