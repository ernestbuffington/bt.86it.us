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
** File comment/english.php 2018-09-23 00:00:00 Thor
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
    'THANK_YOU'         => 'Thank You!',
    'NO_ID_SET'         => 'NO ID was Set.  Please recheck your Link',
    'BAD_ID_NO_FILE'    => 'There are NO Files with that ID.',
    'ALREADY_THANKED'   => 'You have already Posted a Quick "Thank You" on this Torrent.',
    'THANK_TAKEN'       => 'Thank You was Posted',
    'COMMENTNOTIFY_SUB' => 'New Comment on %1$s',
    'COMENT_ON_TOR'     => 'Comments on this Torrent.',

    'COMENT_REMOVED'    => 'Comment Deleted.  You will be Redirected back to the Torrent Details Page in 3 seconds.<br>Click <a href=\'details.php?id=%1$s&comm=startcomments\'>HERE</a> if your Browser doesn\'t forward you.',

    'COMMENT_POSTED'    => 'Your Comment has been Posted.  You will be Redirected back to the Torrent Details Page in 3 seconds.<br>Click <a href=\'details.php?id=%1$s&comm=startcomments\'>HERE</a> if your Browser doesn\'t forward you.'
));

?>