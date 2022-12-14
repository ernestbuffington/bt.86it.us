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
** File searchcloud/english.php 2018-09-23 00:00:00 Thor
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
    'SC_CONFIG'         => 'Search Cloud Control',
    'USER_ONLY_RC'      => '<strong>Record Only Users</strong>',
    'USER_ONLY_RC_EXP'  => 'Record Only Users Search Terms to Database',
    'HOW_MANY'          => '<strong>How many Search Terms</strong>',
    'HOW_MANY_EXP'      => 'How many Search Terms would you like to Display in the Search Cloud',
    'CONFIG_NOT_SET'    => 'There seems to be a Problem with your Entries.  Configuration NOT Set',
    'ERR_HOWMANY'       => 'The Entered Value for "<strong>How many</strong>" was NOT Numeric',
    'ERR_ACTIVE'        => 'The Entered Value for "<strong>Display Search Cloud</strong>" was NOT Set Properly',
    'ERR_USERONLY'      => 'The Entered Value for "<strong>Record Only Users</strong>" was NOT Set Properly',
    'SCBLOCKDSP'        => '<strong>Display Search Cloud</strong>',

    'SCBLOCK_EXP'       => 'Display a Block with a Search Cloud.  ALL Terms your Users Search for are Recorded and Displayed in a Cloud.  The more often a Term is Searched, the Larger the Font Size/Weight will be.',

    'SCTERM'            => 'Search Term',
    'SCTERMS'           => 'Search Terms',

    'SCTITLEEXP'        => 'This Tool Allows you to List and Remove Search Terms that are Saved in the Database and Displayed in the Search Cloud.  Terms are Ordered by Search Frequency and can be Searched.<br /><br />',

    'SCTIMES'           => 'Times Searched',
    'SCTERM_ID'         => 'Term ID',
    'SCTERM_REMOVED'    => 'Term Removed',
    'SCTERMREMOVE'      => 'Remove Term from the Database',
    'SCLOUD'            => 'Search Cloud',
    'SC_SET_UPDATED'    => 'Settings Updated Successfully',
    'PRUNE_SUCCESS'     => 'ALL Search Terms have been Removed',
    'CONFIRM_OPERATION' => 'Are you sure you wish to Remove ALL Search Terms?<br />This Action can NOT be Undone.',
    'DELETE_ALL'        => 'Delete ALL Terms',
));

?>