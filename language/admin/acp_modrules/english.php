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
** File modrules/english.php 2018-09-23 00:00:00 Thor
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
    'TITLE'                => 'Site Rules',
    'EXPLAIN'              => 'In this Section you can Add, Edit and Delete the Site Rules<br /><br />',
    'MESSAGE_BODY_EXP'     => '',
    'SELECT_GROUP'         => 'Select Group',
    'SELECT_GROUP_EXP'     => 'Select a Group for this Rule (Note: you can Select more than one Group)',
    'SECTION_TITTLE'       => 'Rule Section Title',
    'SECTION_TITTLE_EXP'   => 'Give a Title for the Group of Rules',
    'PUBLIC_VIEW'          => 'Public View',
    'PUBLIC_VIEW_EXP'      => 'Are these Rules Viewable by the Public?',
    'RULES_FEALD_BLANK'    => 'Rules Field was left Blank.  Please go back and Fill in the Missing Fields!',
    'TITLE_BLANK'          => 'Rules Title Field was left Blank.  Please go back and Fill in the Missing Fields!',
    'PUPLIC_FEALD_BLANK'   => 'You did NOT Set these Rules as Public or Private',
    'GROUP_NOT_SET'        => 'You did NOT Specify what Group these Rules are for?',
    'GO_BACK'              => 'Go Back!',
    'RULE_ADDED'           => 'New Rules have been Added.',
    'RULE_UPDATED'         => 'Rules have been Updated.',
    'ADD_NEW_RULE_SECTION' => 'Add a New Rules Section.',
    'ADVANCED_RULE_INFO'   => 'Advanced Rule Information',
    'IS_PUBLIC'            => 'Is this a Public Rule?',
    'IS_PUBLIC_EXP'        => 'Public Rules can be seen by Unregistered Users and ALL Groups',
    'VIEWABL_BY'           => 'Select a Group for this Rule.',
    'VIEWABL_BY_EXP'       => 'These Rules Apply to these Groups and will ONLY be seen by them.',
    'CONFIRM_DELETE_RULE'  => 'Are You Sure you wish to Remove this Rule?',
    'DELETE_SUCCESS'       => 'Rule has been Removed.',
));

?>