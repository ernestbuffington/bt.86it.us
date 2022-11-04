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
** File mcp_filter/english.php 2018-09-23 00:00:00 Thor
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
    'INTRO'           => 'Keyword Filter',

    'INTRO_EXP'       => 'With the Keyword Filter, you can Stop Users from Uploading Torrents that may Violate the Tracker\'s Rules or Local Laws of your Country.<br /><br /><br />This Checks the Names of the Files within a torrent.  Be careful NOT to Insert any Common Words.<br /><br />',

    'KEYWORD'         => 'KeyWord',
    'ADD_EDIT_KEYW'   => 'Add/Edit Keyword',
    'REASON'          => 'Reason',
    'KEYWORD_ADDED'   => 'Your New Keyword has been Successfully Added',
    'KEYWORD_UPDATED' => 'Your Keyword has been Successfully Updated',
    'KEYWORD_REMOVED' => 'Your Keyword has been Successfully Removed',
    'NOSET_KEY_WORDS' => 'No Filter Keywords',
    'MISSING_KEYWORD' => 'Missing Keyword',
    'MISSING_REASON'  => 'Missing Reason',
    'BAD_KEY_WORD'    => 'Keyword must be between 5 and 50 Alphanumeric Characters',
    'BAD_REASON'      => 'Reason must be a Maximum of 255 Characters Long',
));

?>