<?php

error_reporting(E_ALL);

# common routines to DWiki

require("config.php");

$QUERY_STRING = getenv("QUERY_STRING");

$db = PAGES_DIRECTORY;
if($QUERY_STRING != "")
	$page = urldecode($QUERY_STRING);
else
	$page = MAIN_PAGE_NAME;

$sAppendBody = "";

function getPagePath($pageName) {
    global $db;

	if(strpos(" " . $pageName,"/"))
	{
		return $db . "/bad_page_name.html";
	}
    return $db . "/" . urlencode($pageName) . ".html";

}

# returns page from given directory (db), with given name (sPage)
# and with replacing (replaceMap)
# if no page exists, empty page is returned
function loadPage($sPage, $replaceMap)
{
	$sPath = getPagePath($sPage);
	$f = @fopen($sPath, "rt");
	if($f)
	{
		$s = fread($f, 999999);
		fclose($f);

		while(list($from,$to) = each($replaceMap))
			$s = str_replace($from, $to, $s);

		return $s;
	}
	else
	{
		return "";
	}
}

# Saves page in given directory (db), under given name (sPage)
# with body = sText
function savePage($sPage, $sPageBody)
{
	$sPageBody = trim($sPageBody);
	$sFile = getPagePath($sPage);
	if($sPageBody != "")
	{
		$f = fopen($sFile, "wt");
		fwrite($f, $sPageBody);
		fclose($f);
	}
	else
	{
		@unlink($sFile);
	}
}

# Appends page in given directory (db), under given name (sPage)
# with body = sText
function appendPage($sPage, $sPageBody)
{
	$sPageBody = trim($sPageBody);
	$sFile = getPagePath($sPage);
	if($sPageBody != "")
	{
		$f = fopen($sFile, "at");
		fwrite($f, "\n\n\n\n");
		fwrite($f, $sPageBody);
		fclose($f);
	}
	else
	{
		@unlink($sFile);
	}
}

function pageExists($sPage)
{
	$sFile = getPagePath($sPage);
	return file_exists($sFile);
}

function pageModified($sPage)
{
	$sFile = getPagePath($sPage);
	$stat = stat($sFile);
	$modified = strftime(MODIFIED_FORMAT ,$stat[10]);
	return $modified;
}

function getWikiPage($sPageName)
{
	$lines = loadPage($sPageName, array());

	if($lines)
	{
		$arr = explode("[[", $lines);
		$sBuf = $arr[0];
		for($i=1; $i<count($arr); $i++)
		{
			$sPart = $arr[$i];
			$rBracket = strpos($sPart, "]]");
			$href = substr($sPart,0,$rBracket);
			$hrefUrl = urlencode($href);
			$rest = substr($sPart,$rBracket+2);

			if(strpos($href,":")>0)
				$sBuf .= "<A HREF=\"$href\">$href</A>";

			elseif(pageExists($href))
				$sBuf .= "<A HREF=\"view.php?$hrefUrl\"><span>$href</span></A>";

			else
				$sBuf .= "<A HREF=\"edit.php?$hrefUrl\"><FONT COLOR=RED>$href</FONT></A>";

			$sBuf .= $rest;
		}

		return $sBuf;
	}
}

function render($sPageName) {
    echo getWikiPage($sPageName);
}

?>
