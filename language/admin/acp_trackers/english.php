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
** File acp_trackers/english.php 2018-09-23 00:00:00 Thor
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
    'INTRO'                => 'External Trackers',
    'TRACKER_ACTIVE'       => 'Tracker is Active',
    'TRACKER_OFF_LINE'     => 'Tracker is Offline',
    'TRACKER_BLACK_LISTED' => 'Tracker is <strong>Blacklisted</strong>',
    'BLACK_LIST'           => 'Blacklist',
    'UNBLACK_LIST'         => 'Remove Blacklist',

    'INTRO_EXP'            => 'With this Panel you can Monitor the Status of External Trackers associated to Torrents.  You can Set a Filter that Prevents the Uploading of Torrents from certain Trackers or you can Force the Tracker Update Viewing Debug Information.<br /><br />',

    'NO_ENTRIES'           => 'No Torrent Entries for this Period.',
    'TOR_NAME'             => 'Torrent Name',
    'ANNOUNCE_URL'         => 'Announce URL',
    'BLACK_LISTED'         => 'Blacklisted',
    'VIEW_LIST'            => 'View Torrents',
    'UPDATE_TOR_NOW'       => 'Update Torrent Now',
    'BANNED_ANNOUNCE'      => 'Blacklist a Tracker',
    'EXCLUDE_TOR'          => 'Exclude',
    'VIEW'                 => 'View',

    'BANNED_ANNOUNCE_EXP'  => 'Insert the Announce URL of the Tracker you want to Blacklist.  ALL Torrents Associated to it will be Refused during Upload.',

    'CANCEL_MOD'           => 'Cancel',
    'INVALID_INCODING'     => 'Can NOT Decode Tracker Response.  Invalid Encoding!',
    'TRKRAWDATA'           => 'Tracker Reached.  Here is the Encoded Response.',
    'TRACKER_OFFLINE'      => 'Can NOT Contact Tracker.  Tracker will be Set to OffLine',
    'UPDATING'             => 'Updating',
    'DECODED_DATA'         => 'Decoding Completed.  Here is ALL the Scrape Data Obtained.',
    'NOTOR_ERR'            => 'There was an Error ',
    'INFO_HASH'            => 'Info Hash',
    'INVALID_ANNOUNCE'     => 'Invalid Announce URL.<br /><strong>"%1$s"</strong>',
    'BLANK_ANNOUNCE_URL'   => 'The Announce URL is Blank',
    'NO_TORRENTS_LISTED'   => '"%1$s" has NO Torrents OR has Been Blacklisted (If NOT Blacklisted it has been Removed from the Database.)',

    'PEER_SUMERY'          => 'Found <strong>"%1$s"</strong> Seeds, <strong>"%2$s"</strong> Leechers, <strong>"%3$s"</strong> Completed Downloads for Torrent "%4$s" Info Hash "%5$s"."',
 ));

?>