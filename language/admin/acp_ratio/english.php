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
** File acp_ratio/english.php 2018-09-23 00:00:00 Thor
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
    'SEL_YES_NO' => array('true' => 'Yes',
                          'false' => 'No'),

    'TITLE_INDEX'             => 'Site Warning System',
    'TITLE_EXPLAIN_INDEX'     => 'In this Area you are able to View and Edit your Warning Configuration',
    'TITLE_CONFIG'            => 'Warning Configuration',

    'TITLE_EXPLAIN_CONFIG'    => 'Warning Configurations are the Settings Used by the System to Determine Who and When to Warn a User for a Low Ratio.<br /><br />',

    'SECTION_EXPLAIN_CONFIG'  => 'This is Used to Alter and Set your Warning Systems Controls.',
    'TITLE_WARNED'            => 'Ratio Warn System - Warned Users',

    'TITLE_EXPLAIN_WARNED'    => 'This is a List of Users that have been Warned or Banned by the System (NOT including Users Warned or Banned by Moderators.)',

    'SECTION_EXPLAIN_WARNED'  => 'This is a List of Users that have been Warned by the System (NOT including Users Warned by Moderators.)',

    'TITLE_WATCHED'           => 'Ratio Warn System - Watched/Warned Users',
    'TITLE_EXPLAIN_WATCHED'   => 'List of Users being Watched for Low Ratio.',
    'SECTION_EXPLAIN_WATCHED' => 'This is a List of Users being Watched by the System for having a Low Ratio on the Site.',
    'BLOCK_TITLE'             => 'Ratio Warning System',
    'SECTION_TITLE_CONFIG'    => 'Ratio Warning Configuration',
    'SECTION_TITLE_WARNED'    => 'Ratio Warned Users',
    'SECTION_TITLE_WATCHED'   => 'Ratio Watched Users',
    'NO_ERROR'                => 'NO Error Found!',
    'NO_ENTRIES_WARNED'       => 'NO Users have been Warned for Maintaining Poor Ratios.',
    'BANNED'                  => 'Banned',
    'TIME_TO_BAN'             => 'Time Until Ban',
    'TO_GO'                   => '%1$s Days',
    'NO_ENTRIES'              => 'There are No Users Currently being Watched for Poor Ratios.',
    'TIME_TO_WARN'            => 'Time Until Warning',
    'REMOVED_WATCH'           => 'Remove from Watch',

    'USER_STST_UPDATE'        => 'Status for User %1$s have now been Updated!<br />If the User still has a Bad Ratio they will be Added Back to the Watch List but their Warning will be Removed.',

    '_admpenable'             => 'Enable Ratio Warning',
    '_admpenableexplain'      => 'Enable Ratio Warning System',
    '_admpratio_mini'         => 'Ratio Warn Amount',
    '_admpratio_miniexplain'  => 'Set the Ratio Amount to where you want Members to be Added to the Watched List',
    '_admpratio_warn'         => 'Warning Time',
    '_admpratio_warnexplain'  => 'How Long in Days do you want the User to be Watched before they are Warned',
    '_admpratio_ban'          => 'Banning Time',
    '_admpratio_banexplain'   => 'How Long in Days do you want the User to be Warned before they are Banned',
));

?>