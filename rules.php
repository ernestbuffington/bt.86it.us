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
** File rules.php 2022-11-02 00:00:00 Thor
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
else
{
    define("IN_AN602",true);
}
require_once("common.php");
$template = new Template();
set_site_var($user->lang['RULES']);
$template->assign_vars(array(
'S_RULES' => true,
'S_EDIT' => ($user->admin) ? true : false,
));
$sql_rule = "select * from ".$db_prefix."_rules order by level;";
$res = $db->sql_query($sql_rule);
    include_once('include/function_posting.' . $phpEx);
    include_once('include/class.bbcode.php');

    while ($arr = $db->sql_fetchrow($res)){
    $bbcode = false;
    $rule_text = $arr['text'];
    $descript = censor_text($rule_text);
    // Instantiate BBCode if need be
    if ($arr['bbcode_bitfield'])
    {
        include_once('include/bbcode.' . $phpEx);
        $bbcode = new bbcode($arr['bbcode_bitfield']);
        $bbcode->bbcode_second_pass($descript, $arr['bbcode_uid'], $arr['bbcode_bitfield']);
    }
    // Parse the message and subject
    $descript = bbcode_nl2br($descript);
    $descript = parse_smiles($descript);
        if ($arr["public"]=="yes")
            {
                $template->assign_block_vars('rules_var',array(
                'ID' => $arr["id"],
                'TITLE' => $arr["title"],
                'RULE' => $descript,
                ));
            }
        elseif(in_array('[' . $user->group . ']',explode(',',$arr["level"])))
            {
                $template->assign_block_vars('rules_var',array(
                'ID' => $arr["id"],
                'TITLE' => $arr["title"],
                'RULE' => $descript,
                ));
            }
    }
$db->sql_freeresult($res);
echo $template->fetch('rules_body.html');
close_out();
?>