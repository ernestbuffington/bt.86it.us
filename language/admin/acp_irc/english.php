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
** File irc/english.php 2018-09-23 00:00:00 Thor
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
    'IRC_INTRO'           => 'Configure BTManager\'s Built-in IRC Chat.',

    'IRC_INTRO_EXP'       => 'You can Configure every aspect of the PJIRC Client:  Please Read PJIRC\'s Documentation before Editing Advanced Parameters.<br />

    <strong>NOTICE</strong>: file <em>include/irc.ini</em> MUST be Writeable<br /><br />',

    'IRC_SERVER'          => 'Server',
    'IRC_CHANNEL'         => 'Channel',
    'IRC_ADV_SETTING'     => '<br />Advanced Settings',

    'IRC_ADV_SETTING_EXP' => 'Here you can Configure PJIRC\'s Advanced Settings.  According to PJIRC Documentation, Insert the Parameters with the following Syntax: <em>name</em> = <em>value</em><br /><br />',

    'APPLY_SETTINGS'      => 'Apply Settings',
    'VALUE'               => 'VALUE',
    'RESET'               => 'Reset',
    'IRC_ENABLE'          => 'Enable IRC',
    'IRC_DISABLE'         => 'Disable IRC',

    'IRC_WRIET_PROT'      => 'You can NOT Delete <em>include/irc.ini</em> because it\'s Write Protected.  Please Delete the File Manually.  IRC Chat is still Enabled!',

    'IRC_INVALID_HOST'    => 'Invalid Hostname or IP Address',
    'IRC_INVALID_CHANNEL' => 'Invalid Channel Name',
    'IRC_INVALID_SYNTAX'  => 'Invalid Syntax for Advanced Parameters',

    'IRC_WRIET_PROT_SAVE' => '<p>You can NOT Save <em>include/irc.ini</em> because it\'s Write Protected.  Please Save the File Manually with the Following Content:</p><p>&nbsp;</p><p>%s</p>',

    'ERR_ARRAY_MESS'      => '<li><p>%s</p></li>',
    'ERROR'               =>'Error',
    'SAVED_SET'           =>'Settings Saved!',
));

?>