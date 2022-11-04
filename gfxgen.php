<?php

/**
*****************************************************************************************
** PHP-AN602  (Titanium Edition) v1.0.0 - Project Start Date 11/04/2022 Friday 4:09 am **
*****************************************************************************************
** https://an602.86it.us/
** https://github.com/php-an602/php-an602
** https://an602.86it.us/index.php (DEMO)
** Apache License, Version 2.0, MIT license 
** Copyright (C) 2022
** Formerly Known As PHP-Nuke by Francisco Burzi <fburzi@gmail.com>
** Created By Ernest Allen Buffington (aka TheGhost or Ghost) <ernest.buffington@gmail.com>
** And Joe Robertson (aka joeroberts/Black_Heart) for Bit Torrent Manager Contribution!
** And Technocrat for the Nuke Evolution Contributions
** And The Mortal, and CoRpSE for the Nuke Evolution Xtreme Contributions
** Project Leaders: TheGhost, NukeSheriff, TheWolf, CodeBuzzard, CyBorg, and  Pipi
** File gfxgen.php 2022-11-02 00:00:00 Thor
**
** CHANGES
**
** 2022-11-02 - Updated Masthead, Github, !defined('IN_AN602')
**/

if (defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_AN602",true);
require_once("common.php");
            $buffer = ob_get_clean();
            if (function_exists('ob_gzhandler') && !ini_get('zlib.output_compression'))
            ob_start('ob_gzhandler');
            else
            ob_start();
            ob_implicit_flush(0);
$code                   = request_var('code', '');
$code = base64_decode($code);
$image = imagecreatefromjpeg("include/code_bg.jpg");
$text_color = imagecolorallocate($image, 80, 80, 80);
header("Content-type: image/jpeg");
imagestring ($image, 5, 12, 2, $code, $text_color);
imagejpeg($image, NULL, 75);
imagedestroy($image);
die();
?>