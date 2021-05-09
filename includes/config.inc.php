<?php

session_start();

$pageTitle = array(
    'title' => 'CsodaCsoport Foundation'
);

$header = array(
    'imgsrc' => 'img/logo.png',
    'imgalt' => 'logo',
    'title' => 'CsodaCsoport Foundation'
);

$footer = array(
    'copyright' => 'Copyright ' . date("Y") . '.',
    'company' => 'CsodaCsoport Foundation'
);

$defaultPages = array(
    '/' => array('file' => 'main', 'text' => 'Main'),
    'aboutus' => array('file' => 'aboutus', 'text' => 'About'),
    'gallery' => array('file' => 'gallery', 'text' => 'Gallery'),
    'contact' => array('file' => 'contact', 'text' => 'Contact'),
    'messages' => array('file' => 'messages', 'text' => 'Messages'),
    'login' => array('file' => 'login', 'text' => 'Login'),
    'signup' => array('file' => 'signup', 'text' => 'Sign Up'),
    'logout' => array('file' => 'logout', 'text' => 'Logout')
);

$err_page = array('file' => '404', 'text' => 'The requested page cannot be found!');

$debug = true;

function adjustMenuOnLogin($currentPages)
{
    $result = new ArrayObject($currentPages);
    $result = $result->getArrayCopy();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        unset($result['login']);
        unset($result['signup']);
    } else {
        unset($result['logout']);
    }

   return $result;
}
