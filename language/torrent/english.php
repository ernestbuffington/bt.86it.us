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
** File torrent/english.php 2018-09-23 00:00:00 Thor
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
    'ORDER_BY'         => 'Order by',
    'SEEDS'            => 'Seeds',
    'INCLUDE_DEAD'     => 'Include Dead Torrents',
    'ANONUMUS'         => 'Anonymous',
    'DISPLAY_BY'       => 'Display Torrents by',
    'SORT_CAT'         => 'Sort by Type',
    'SORT_NAME'        => 'Sort by Name',
    'SORT_NUM_FILES'   => 'Sort by Number of Files',
    'SORT_SEED'        => 'Sort by Seeds',
    'SORT_LEECH'       => 'Sort by Leechers',
    'SORT_SIZE'        => 'Sort by Size of File',
    'SORT_COMP'        => 'Sort by Times Completed',
    'SORT_COMMENTS'    => 'Sort by Number of Comments',
    'UPLOADED_BY'      => 'Uploaded by',
    'AVERAGE_SPEED'    => 'Average Speed',

    'DHT_SUPPORT_EXP'  => 'This Torrent supports DHT.  With a State-of-the-art Client, you\'ll be able to Download this Torrent even if a Central Tracker goes down.',

    'STATS_UPTO_DATE'  => 'Statistics Updated less than 30 Minutes ago.',
    'TORRENT_DETAILS'  => 'Torrent Details',
    'REFRESHPEER_DATA' => 'Refresh Peer Data',
    'BANNED_TORRENT'   => 'Banned Torrent',
    'BANN_TORRENT'     => 'Ban Torrent',
    'FREE_TORRENT'     => 'Free Torrent',
    'EXTERNAL_TORRENT' => 'External Torrent',

    #Added For 3.0.1
    'NUMB_FILES'       => 'Number of Files',
    'DOWNLOAD'         => 'Download',
    'PAGES'            => 'Pages',
    'EXPAND_ITEM'      => 'Expand Item',
));

?>