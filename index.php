<?php
include('./includes/config.inc.php');
echo $_SERVER['REQUEST_URI'];
$url = $_SERVER['REQUEST_URI'];
$pageArray = explode("/", $url);
$page = $pageArray[count($pageArray) - 1];
if ($page != "") {
    if (isset($pages[$page]) && file_exists("./templates/pages/{$pages[$page]['file']}.tpl.php")) {
        $requestedPage = $pages[$page];
    } else if (isset($extrak[$page]) && file_exists("./templates/pages/{$extrak[$page]['file']}.tpl.php")) {
        $requestedPage = $extrak[$page];
    } else {
        $requestedPage = $hiba_page;
        header("HTTP/1.0 404 Not Found");
    }
} else $requestedPage = $pages['/'];
include('./templates/index.tpl.php');
