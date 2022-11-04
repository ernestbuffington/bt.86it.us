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
** File shout_cast/english.php 2018-09-23 00:00:00 Thor
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
    'REQ_TO_LESTIN'        => 'You will need Windows Media Player 10+ or Real Player to Listen to the Radio Stream!',
    'POWERED_BY'           => 'Radio Powered by Shoutcast and Winamp.',
    'LAST_TRACKS'          => 'Last Tracks Played....',
    'MEMBERS_LESTINING'    => 'Members Listening',
    'CURNETLY_PLAYING'     => 'Currently Playing',
    'CLICK_HERE_TO_LISTEN' => 'Click Here to Tune in and Listen Now.',
    'RADIO_STATUS'         => 'Status',
    'RADIO_DJ'             => 'Radio DJ',
    'CUR_BITRATE'          => 'Current Bitrate',
));

?>