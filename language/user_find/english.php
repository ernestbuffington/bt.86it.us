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
** File user_find/english.php 2018-09-23 00:00:00 Thor
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
    'FIND_USER_PM'            => 'Find a User to Private Message',
    'FIND_USER_PM_EXP'        => 'Enter the Username that you wish to Find',
    'ERROR_FIND_USER_PM'      => 'NO User was Found to PM',
    'ERROR_FIND_USER_PM_EXP'  => 'NO User was Found!<br />If you tried using the Full Name, try using a Partial Name instead!',
    'ERROR_TO_MANY_FOUND'     => 'Too Many Users were Found.',

    'ERROR_TO_MANY_FOUND_EXP' => 'Your Search Returned Too Many Users!<br />Please Narrow your Search by Adding more Characters to the Search Field.',

    'USER_NAME'               => 'Username:',
    'RANK'                    => 'Rank',
    'SEARCH_USER_POST'        => 'Search User\'s Posts',
    'USER_FOUND'              => 'Found',
    'MEMBERS_FOUND'           => 'Members',
));

?>