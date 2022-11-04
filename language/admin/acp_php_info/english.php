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
** File php_info/english.php 2018-09-23 00:00:00 Thor
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
    'ACP_PHP_INFO_EXPLAIN' => 'This Page Lists Information on the Version of php Installed on this Server.  It Includes Details of Loaded Modules, Available Variables and Default Settings.  This Information maybe useful when Diagnosing Problems.  Please be aware that some Hosting Companies will Limit what Information is Displayed here for Security Reasons.  You are Advised to NOT give out any Details on this Page Except when asked by <a href="http://www.phpbb.com/about/team/">Official Team Members</a> on the Support Forums.<br /><br />',

    'NO_PHPINFO_AVAILABLE' => 'Information about your php Configuration is Unable to be determined. phpinfo() has been Disabled for Security Reasons.',

    'ACP_PHP_INFO'         => 'php Information',
));

?>