<?php
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

$pages = array(
    '/' => array('file' => 'main', 'text' => 'Főoldal'),
    'bemutatkozas' => array('file' => 'bemutatkozas', 'text' => 'Bemutatkozás'),
    'kepgaleria' => array('file' => 'gallery', 'text' => 'Képgaléria'),
    'kapcsolat' => array('file' => 'contact', 'text' => 'Kapcsolat'),
    'uzenetek' => array('file' => 'messages', 'text' => 'Üzenetek'),
    'belepes' => array('file' => 'login', 'text' => 'Belépés')
);

$hiba_page = array('file' => '404', 'text' => 'A keresett oldal nem található!');
