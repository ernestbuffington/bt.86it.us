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
** And Joe Robertson (aka joeroberts/Black_Heart) for Bit Torrent Manager Contribution!
** And Technocrat for the Nuke Evolution Contributions
** And The Mortal, and CoRpSE for the Nuke Evolution Xtreme Contributions
** Project Leaders: TheGhost, NukeSheriff, TheWolf, CodeBuzzard, CyBorg, and  Pipi
** File bbcode.php 2022-11-02 00:00:00 Thor
**
** CHANGES
**
** 2022-11-02 - Updated Masthead, Github, !defined('IN_AN602')
**/

if (defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_AN602",true);
$startpagetime = microtime();
include'common.php';
include_once'language/bbcode/' . $user->ulanguage . '.php';
$template = new Template();
set_site_var($user->lang['BBCODE_GUIDE']);
        $l_title = $user->lang['BBCODE_GUIDE'];
$switch_column = $found_switch = false;
$help_blocks = array();
foreach ($help as $help_ary)
{
    if ($help_ary[0] == '--')
    {
        if ($help_ary[1] == '--')
        {
            $switch_column = true;
            $found_switch = true;
            continue;
        }

        $template->assign_block_vars('faq_block', array(
            'BLOCK_TITLE'       => $help_ary[1],
            'SWITCH_COLUMN'     => $switch_column,
        ));

        if ($switch_column)
        {
            $switch_column = false;
        }
        continue;
    }

    $template->assign_block_vars('faq_block.faq_row', array(
        'FAQ_QUESTION'      => $help_ary[0],
        'FAQ_ANSWER'        => $help_ary[1])
    );
}

// Lets build a page ...
$template->assign_vars(array(
    'L_FAQ_TITLE'               => $l_title,
    'L_BACK_TO_TOP'             => $user->lang['BACK_TO_TOP'],
    'SWITCH_COLUMN_MANUALLY'    => (!$found_switch) ? true : false,
));
echo $template->fetch('bbcode.html');
close_out();

?>