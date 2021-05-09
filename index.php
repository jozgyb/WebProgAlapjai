<?php
include('./includes/config.inc.php');
echo $_SERVER['REQUEST_URI'];
$url = $_SERVER['REQUEST_URI'];
$pageArray = explode("/", $url);
$page = $pageArray[count($pageArray) - 1];
if ($page != "") {
    if (isset($defaultPages[$page]) && file_exists("./templates/pages/{$defaultPages[$page]['file']}.tpl.php")) {
        $requestedPage = $defaultPages[$page];
    } else if (isset($extrak[$page]) && file_exists("./templates/pages/{$extrak[$page]['file']}.tpl.php")) {
        $requestedPage = $extrak[$page];
    } else {
        $requestedPage = $err_page;
        header("HTTP/1.0 404 Not Found");
    }
} else $requestedPage = $defaultPages['/'];
include('./templates/index.tpl.php');
