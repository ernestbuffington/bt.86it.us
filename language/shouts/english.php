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
** File shouts/english.php 2018-09-23 00:00:00 Thor
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
    'SHOUT_COMAND_HELP_USER' => '[quote]<strong>As a User, you have the following Commands:</strong>
        If you want to View this Message in the Shoutbox Use:- <strong>/help</strong>
        If you want to Slap a User Use:- <strong>/slapuser</strong> Username
        If you want to Send a Quick Private Message Use:- <strong>/pmuser</strong> Username or ID Plus the Message
        If you want to Speak as a 3rd Person Use:- <strong>/me</strong> Message[/quote]',

    'SHOUT_COMAND_HELP_ADMIN' => '[quote]<strong>As a Staff Member, you have the following Commands:</strong>
        If you want to Delete or Edit a Shout, you need to <strong>Double Click</strong> on the relevant Icon
        If you want to make a Notice use:- <strong>/notice</strong>
        If you want to Empty Shouts use:- <strong>/empty</strong>
        If you want to Warn or Unwarn a User use:- <strong>/warn</strong> Username <strong>/unwarn</strong> Username
        If you want to Ban(Disable) or Unban(Enable) a User use:- <strong>/ban</strong> Username <strong>/unban</strong> Username
        If you want to Delete ALL Notices use:- <strong>/deletenotice</strong>
        If you want to Slap a User use:- <strong>/slapuser</strong> Username
        If you want to Send a Quick Private Message use:- <strong>/pmuser</strong> Username or ID + Message
        If you want to Speak as a 3rd Person use:- <strong>/me</strong> Message[/quote]',

    'NO_SHOUTS'           => 'NO Shouts at this Time!',
    'SHOUTBOX_ARCHIVE'    => 'Shoutbox Archive',
    'TOTAL_SHOUTS_POSTED' => 'Total Shouts Posted',
    'SHOUTS_IN_TWFOUR'    => 'Shouts in Past 24 Hours',
    'YOUR_SHOUTS'         => 'Your Shouts',
    'TOPFIFTEEN_SHOUTERS' => 'Top 15 Shouters',
    'SORT_BY'             => 'Sort Results by',
    'NEW_FIRST'           => 'Newest First',
    'OLD_FIRST'           => 'Oldest First',
    'SEARCH_TIME'         => 'Within Past <em>\'x\'</em> Hours',
    'USERNAME_CONTAINS'   => 'Username Contains',
    'SEARCH_CONTAINS'     => 'Shout Contains',
    'SEARCH_TERM'         => 'Search Terms',
    'SEARCH_SHOUTS'       => 'Search Shouts',
    'LEGEND_ADMIN'        => 'Legend: Admin ',
    'LEGEND_MODERATOR'    => ', Moderator',
    'LEGEND_PREMIUM'      => ', Premium',
    'DELETE_SHOUT'        => 'Delete Shout?',
));

?>