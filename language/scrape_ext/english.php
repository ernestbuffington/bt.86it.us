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
** File scrape/english.php 2018-09-23 00:00:00 Thor
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
    'TITLE'             => 'Peer Update for',
    'AUTH_FAILD'        => 'Authorisation Failed',
    'GROUP_NOT_AU'      => 'Your Group Permissions DO NOT Allow you to Update Peers',
    'TRACKER_MISSING'   => 'Tracker NOT Listed',
    'ERROR_TRACKER_MIS' => 'There appears to be an Error.  The Tracker you Requested %1$s is NOT Listed',
    'INFO_HASH'         => 'Info Hash',
    'DECODED_DATA'      => 'Here is the ID Decoded Response from the Tracker.',
));

?>