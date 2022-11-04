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
    die ("Error 404 - Page Not Found");
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'TITLE'                  => 'Shoutcast',

    'TITLE_EXPLAIN'          => 'Shoutcast Radio Configuration and Settings.  Here you can Setup your Shoutcast Radio to Display on your Site<br /><br />',

    'HEADER_SETTINGS'        => 'Shoutcast Settings',

    "_admpallow"             => "Allow Shoutcast",
    "_admpallowexplain"      => "With this you can Activate or Deactivate your Shoutcast Radio.",
    "_admpip"                => 'Shoutcast IP Address',
    "_admpipexplain"         => 'Enter the IP Address ONLY for your Shoutcast Radio.',
    "_admpport"              => 'Shoutcast Port',
    "_admpportexplain"       => 'Enter the Port for your Shoutcast Radio.',
    "_admpadmin_name"        => 'Shoutcast Administrator Name',
    "_admpadmin_nameexplain" => 'This is your Shoutcast Administrators Username, by Default this will be Administrator.',
    "_admpadmin_pass"        => 'Shoutcast Password.',

    "_admpadmin_passexplain" => 'Enter your Administrator Password for your Shoutcast Radio.  This is needed to Retrieve the Information from Your Shoutcast.',

    "_admphost_dj"           => 'Current DJ',
    "_admphost_djexplain"    => 'Enter the Name of the Person Disk Jockeying on the Shoutcast.',
));

?>