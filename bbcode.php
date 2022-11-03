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
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File bbcode.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_BTM",true);
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