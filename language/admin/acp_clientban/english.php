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
** File acp_clientban/english.php 2018-09-23 00:00:00 Thor
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
    'INTRO'     => 'Client Ban',

    'INTRO_EXP' => 'This is where you can Ban Torrent Clients, you can either Ban the Whole Client or One Version of a Client <br /><br /><br />To Add a Client you will need the <strong>pier_id</strong> Information from the Client.<br /><br /><em>Example</em> <strong>&micro;Torrent 1.8.1</strong> you would Add <strong>UT1810</strong><br /><br />The Reason for the Ban will be Shown in the Client, so you\'ll want to keep this Short.<br /><br />',

    'REASON'                => 'Reason',
    'CLIENT'                => 'Client',
    'NO_CLIENT_BANS'        => 'No Banned Client\'s at this Time',
    'BANNED_CLIENTS'        => 'Current Banned Client\'s',
    'BANNED_CLIENTS_EXP'    => 'Here is a List of the Currently Banned Client\'s and the Reason Why!',
    'BANNED_CLIENT'         => 'Add/Edit Banned Client\'s',
    'BANNED_CLIENT_EXP'     => 'Here you can Add/Edit Banned Client\'s and the Reason Why!',
    'CANCEL_MOD'            => 'Cancel',
    'NO_REASON'             => 'No Reason given for the Ban',
    'SUCES_BAN'             => 'Client Successfully Banned',
    'SUCES_BAN_EXP'         => 'The Client %1$s was Successfully Banned with the following Reason:- %2$s',
    'SUCES_DEL'             => 'Client Successfully Removed',
    'SUCES_DEL_EXP'         => 'The Client was Successfully Removed from the Banned List ',
    'SUCES_EDT'             => 'Client Successfully Edited',
    'SUCES_EDT_EXP'         => 'The Client %1$s was Successfully Updated with the following Reason:- %2$s',
    'CONFIRM_OPERATION'     => 'Are you sure you wish to Remove this Client from the Ban List?',
    'NO_CLIENT_DEFINED'     => 'No Client was Defined!',
 ));

?>