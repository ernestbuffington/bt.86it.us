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
** File email/english.php 2018-09-23 00:00:00 Thor
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
    'NEW_PM_EMAIL' => '%1$,' . "\n\n" . 'You are receiving this message because User %2$ has sent you a Private Message on %3$.\nYou can read the message at %4$/pm.php?mid=%5$* after logging in.\nIf you feel bothered by the Sender, use the Blacklist Function.  This way you won\'t receive any more messages from the User.' . "\n\n" . 'Regards,' . "\n" . '%3$ Staff' . "\n" . '%4$',

    'NEW_PM_SUB' => 'New Private Message on %1$',
));

?>