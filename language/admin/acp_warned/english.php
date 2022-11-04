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
** File warned/english.php 2018-09-23 00:00:00 Thor
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
    'ACP_WARNINGS'         => 'Warned Accounts',

    'ACP_WARNINGS_EXPLAIN' => 'Here you can View ALL Users that Currently have Warning\'s Issued against their Account.<br /><br />',

    'NO_ENTRIES'           => 'There are Currently No Warned Users.',
    'USERNAME'             => 'Username',
    'REGISTERED'           => 'Registered',
    'LAST_ACCESS'          => 'Last Access',
    'CLASS_USER'           => 'User Class',
    'DOWNLOADED'           => 'Downloaded',
    'UPLOADED'             => 'Uploaded',
    'U_RATIO'              => 'Ratio',
    'MOD_COMM'             => 'Moderator Comments',
    'SORT_USERNAME'        => 'User Name',
    'SORT_REG_DATE'        => 'Registered Date',
    'SORT_UP'              => 'Uploaded',
    'SORT_DOWN'            => 'Downloaded',
    'SORT_WARN_DATE'       => 'Date Warned',
    'SORT_BY'              => 'Sort by',
    'DISPLAY_WARNED'       => 'Display Entries from previous',
));

?>