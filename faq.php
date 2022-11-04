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
** File faq.php 2022-11-02 00:00:00 Thor
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
require_once("common.php");
require_once("include/torrent_functions.php");
//$user->set_lang('faq',$user->ulanguage);
include_once('include/function_posting.php');
include_once('include/message_parser.php');
include_once('include/class.bbcode.php');
include_once('include/bbcode.' . $phpEx);
$template = new Template();
set_site_var($user->lang['TITTLE']);
$res1 = "SELECT * FROM `".$db_prefix."_faq` ORDER BY `id` ASC;";
$res = $db->sql_query($res1);
$help_set = array();
while ($arr = $db->sql_fetchrow($res)) {
        $bbcode = false;
        $text = censor_text($arr['answer']);
        // Instantiate BBCode if need be
        if ($arr['bbcode_bitfield'])
        {
            $bbcode = new bbcode($arr['bbcode_bitfield']);
            $bbcode->bbcode_second_pass($text, $arr['bbcode_uid'], $arr['bbcode_bitfield']);
        }
        // Parse the message and subject
        $text = bbcode_nl2br($text);
        $text = smiley_text($text);
    if($arr['type'] == 'categ')
    {
        $help_set[$arr['id']] = array(0=>'--', 1=>$arr['question'],2=>array(),3=>$arr['id']);
    }
    else
    {
        $help_set[$arr['categ']][2][] = array(0=>$arr['question'], 1=>$text);
    }
}
$db->sql_freeresult($res);
$help = array();
$i = 0;
foreach($help_set as $var)
{
    array_push($help,array('--',stripslashes($var[1]),$var[3]));
    if($var[2])
    {
        foreach($var[2] as $val)
        {
            array_push($help,array(stripslashes($val[0]),stripslashes($val[1])));
        }
    }
    $i++;
    if($i == '5')
    {
        array_push($help,array('--','--'));
    }
}
//die(print_r($help));
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
            'FAQ_ID'            => $help_ary[2],
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
    'L_FAQ_TITLE'               => $user->lang['FAQ_EXPLAIN'],
    'L_BACK_TO_TOP'             => $user->lang['BACK_TO_TOP'],

    'SWITCH_COLUMN_MANUALLY'    => (!$found_switch) ? true : false,
));
    echo $template->fetch('faq.html');
    close_out();
?>