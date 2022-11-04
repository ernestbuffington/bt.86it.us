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
** File bonous/english.php 2018-09-23 00:00:00 Thor
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
    'BONUS_EXCHANGE'          => 'Bonus Exchange',
    'BONUS_SYSTEM_CLOSED'     => 'Bonus System is Closed',

    'BONUS_SYSTEM_CLOSED_EXP' => 'We\'re sorry to announce, but at this time we are NOT using the Bonus System<br />If you feel you have reached this Error by mistake, please Contact one of the Site\'s Moderators so that they may assist you.',

    'BONUS_SYS_EXP'           => 'Here you can Exchange your Seed Bonus (Currently: %1$s)<br />(If the Button\'s Deactivated, then you DO NOT have enough to Trade.)<br />',

    'OPTIONS_ABOUT'           => 'What\'s this about?',
    'POINTS'                  => 'Points',
    'TRADE'                   => 'Trade',
    'DISABLED'                => 'Disabled!',
    'EXCHANGE'                => 'Exchange!',
    'HOW_TO_GET'              => 'How do I get Points?',
    'POINTS_EACH_TOR'         => ' (for each Torrent) ',
    'POINTS_TOTAL'            => ' (Total) ',

    'POINTS_OPTION_VAR'  => array('A' => 'You will Receive %1$s %2$s Points for every 10 minutes the System Registers you as being a Seeder.',
                                  'B' => 'You will Receive %1$s Points for Uploading a New Torrent.',

                                  'C' => 'You will Receive %1$s Points for Leaving a Comment on a Torrent (that includes a Quick Thanks).',

                                  'D' => 'You will Receive %1$s Points for Filling a Requested Torrent<br />(Note any Comment Deleted by you or Staff will Result in the Loss of those Points so NO Flooding)',

                                  'E' => 'You will Receive %1$s Points for Making an Offer to Upload a Torrent.',),

    'NOT_ENOUPH_POINTS'             => 'NOT enough Points to Trade...',
    'NO_VALID_ACTION'               => 'NO Valid Type',

    'POINT_TRADE_MOD_COM'           => array('TRAFIC' => '- User has Traded %1$s Points for Traffic.\n %2$s\n',
                                             'INVITE' => ' - User has Traded %1$s Points for Invites.\n ',),

    'EXCHANGE_SUC'                  => array('TRAFIC' => 'You have Traded %1$s Points for Traffic',
                                             'INVITE' => 'You have Traded %1$s Points for %2$s Invites',),
    ));

?>