<?php

session_start();

$pageTitle = array(
    'title' => 'CsodaCsoport Alapítvány'
);

$header = array(
    'imgsrc' => 'img/logo.png',
    'imgalt' => 'logo',
    'title' => 'CsodaCsoport Alapítvány'
);

$footer = array(
    'copyright' => 'Copyright ' . date("Y") . '.',
    'company' => 'CsodaCsoport Alapítvány'
);

$defaultPages = array(
    '/' => array('file' => 'main', 'text' => 'Főoldal'),
    'bemutatkozas' => array('file' => 'bemutatkozas', 'text' => 'Bemutatkozás'),
    'kepgaleria' => array('file' => 'gallery', 'text' => 'Képgaléria'),
    'kapcsolat' => array('file' => 'contact', 'text' => 'Kapcsolat'),
    'uzenetek' => array('file' => 'messages', 'text' => 'Üzenetek'),
    'belepes' => array('file' => 'login', 'text' => 'Belépés'),
    'regisztracio' => array('file' => 'signup', 'text' => 'Regisztráció'),
    'kilepes' => array('file' => 'logout', 'text' => 'Kilépés')
);

$hiba_page = array('file' => '404', 'text' => 'A keresett oldal nem található!');

$debug = true;

function adjustMenuOnLogin($currentPages)
{
    $result = new ArrayObject($currentPages);
    $result = $result->getArrayCopy();
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        unset($result['belepes']);
        unset($result['regisztracio']);
    } else {
        unset($result['kilepes']);
    }

   return $result;
}
