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
** File mcp_filter/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
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