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
** File makepoll/english.php 2018-09-23 00:00:00 Thor
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
    'POLL_MANAGER'      => 'Poll Management',
    'MAKE_POLL'         => 'Make Poll',
    'EDIT_POLL'         => 'Edit Poll',
    'REQ_FEALD'         => 'Required Field',
    'QUISTION'          => 'Poll Question',
    'SORT'              => 'Sort',
    'OPTION_A'          => 'Option 1',
    'OPTION_B'          => 'Option 2',
    'OPTION_C'          => 'Option 3',
    'OPTION_D'          => 'Option 4',
    'OPTION_E'          => 'Option 5',
    'OPTION_F'          => 'Option 6',
    'OPTION_G'          => 'Option 7',
    'OPTION_H'          => 'Option 8',
    'OPTION_I'          => 'Option 9',
    'OPTION_J'          => 'Option 10',
    'NEW_POLL_NOTICE'   => 'Note: The Current Poll <em>%1$s</em> is Only %2$s Old.',
    'WARNING'           => 'Warning!',
    'HOUR'              => 'Hour',
    'HOURS'             => 'Hours',
    'DAY'               => 'Day',
    'DAYS'              => 'Days',
    'POLL_EDITED'       => 'Poll Successfully Edited',
    'POLL_TAKEN'        => 'New Poll Has Been Added',
    'NO_POLL_FOUND'     => 'No Poll found with ID <em>%1$s</em>',
    'INVALID_POLL_ID'   => 'Invalid ID <em>%1$s</em>',
    'MISSING_FORM_DATA' => 'Missing Form Data!',
));

?>