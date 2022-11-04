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
** File rate/english.php 2018-09-23 00:00:00 Thor
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
    'TORRENT_RATING'     => 'Torrent Rating',
    'VOTE_FAIL'          => 'Vote Failed!',
    'INVALID_VOTE'       => 'Invalid Vote',
    'INVALID_ID'         => 'Invalid ID.  Torrent DOES NOT Exist',
    'CANT_RATE_OWN'      => 'You can NOT Rate your Own Torrents',
    'TORRENT_RATED'      => 'Torrent already Rated',
    'CANT_RATE_TWICE'    => 'We\'re Sorry, but you can\'t Rate a Torrent Twice',
    'VOTE_TAKEN'         => 'Vote Successful.  You will be Redirected back to the Torrent Details Page in 3 seconds.',
    'NO_COMPLAINT_ERR'   => 'Complaint Field Empty!',
    'BANNED_COMPLAINTS'  => 'This Torrent has been Banned due to a number of Complaints.',
    'TWO_COMPLAINTS_ERR' => 'We\'re Sorry, but you can\'t send a Complaint Twice.',
    'COMPLAINT_TAKEN'    => 'Complaint Received.  You will be Redirected back to the Torrent\'s Detail Page in 3 seconds.',

    'COMPLAINT_REG'      => 'Your Complaint has been Received.  Your Username and IP have been Logged.  Please DO NOT Abuse the System.<br />',

    'COMPLAINT_RANK'     => 'User\'s Sent Positive Feedback <strong>%1$s</strong> times and Negative Feedback <strong>%2$s</strong> times.<br />',
));

?>