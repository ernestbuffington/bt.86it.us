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
** File reseed/english.php 2018-09-23 00:00:00 Thor
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
    'RESEED_REQ'       => 'Reseed Request',
    'ALREAD_REQUISTED' => 'You have recently made a Request for this Re-Seed.  Please wait a little longer for another Request.',
    'ALREADY_SEEDED'   => 'NO need for this Request as it already has <strong>%1$s</strong> Seeder on this Torrent',
    'RESEED_REQ_SENT'  => 'Your Request for a Re-Seed has been Sent to Members that have Completed this Torrent: <br />%1$s',

    'RESEED_PM'        => '%1$s has Requested a Re-Seed on the %2$s because there are currently Few or NO SEEDERS: <br />Click Here for more on this File %3$s',

    'THANK_YOU'        => 'Thank You!',
));

?>