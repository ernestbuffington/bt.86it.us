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
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File httperror/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_AN602')
**/

if (!defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ('Error 404 - Page Not Found');
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'A_ERROR_TTL' => 'HTTP 400 Error - Bad Request',

    'A_ERROR_EXP' => 'A 400 Error Occurred while Processing your Request.<br />Please Check your Browser Settings and try again Accessing the Requested Page.<br />Contact %1$s if you\'re still having Issues.',

    'B_ERROR_TTL' => 'HTTP 401 Error - Access Denied',

    'B_ERROR_EXP' => 'A 401 HTTP Error Occurred while Processing your Request.<br />You can\'t Access the Requested Page because you are NOT Authorised.<br />Please provide your Access Credentials.<br />Contact %1$s if you\'re still having Issues.',

    'C_ERROR_TTL' => 'HTTP 403 Error - Access Denied',

    'C_ERROR_EXP' => 'A 403 HTTP Error Occurred while Processing your Request.<br />You can\'t Access the Requested Page because the Server Configuration doesn\'t allow you to.<br />Please Check the URL in your Browser and correct it if needed.',

    'D_ERROR_TTL' => 'HTTP 404 Error - Access Denied',

    'D_ERROR_EXP' => 'A 404 HTTP Error Occurred while Processing your Request.<br />The Requested Page DOES NOT Exist.<br />Please Check the URL in your Browser and correct it if needed.<br />Contact %1$s if you\'re still having Issues.',

    'E_ERROR_TTL' => 'HTTP 500 Error - Access Denied',

    'E_ERROR_EXP' => 'A 500 HTTP Error Occurred while Processing your Request.<br />An Error Occurred while processing Your Data.<br />Detailed Information can be found in the Server Logs.<br />Please Send a Detailed Report about this to %1$s',
));

?>