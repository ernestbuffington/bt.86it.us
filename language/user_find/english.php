<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File user_find/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
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