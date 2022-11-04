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
** File acp_prune/english.php 2018-09-23 00:00:00 Thor
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
    'TITLE'                     => 'Automated Pruning System',
    'TITLE_EXP'                 => 'Configure the Automated Pruning System<br /><br />',
    'SETTING_SAVED'             => 'Settings have been Saved to the Database',
    'USERPRUNE_HEADER'          => 'User Prune Settings',
    '_admpautodel_users'        => 'Turn ON User Prune System',
    '_admpautodel_usersexplain' => 'Enable or Disable User Prune System',
    '_admpinactwarning_time'    => 'Time before email Warning in Days',

    '_admpinactwarning_timeexplain'  => 'How long to Allow a User to be Inactive before a Notice is Sent to them and their Account is Set to Inactive',

    '_admpautodel_users_time'        => 'Time before Delete In Days',

    '_admpautodel_users_timeexplain' => 'How Long after their Account is Set as Inactive before it gets Pruned (Deleted)<br>This DOES NOT Include Parked or Banned Accounts',
));

?>