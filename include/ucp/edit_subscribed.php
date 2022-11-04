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
** File ucp/edit_subscribed.php 2022-11-02 00:00:00 Thor
**
** CHANGES
**
** 2022-11-02 - Updated Masthead, Github, !defined('IN_AN602')
**/

if (!defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

    $to                                    = request_var('to', array(0));
    $f                                     = request_var('f', array(0));
    $t                                     = request_var('t', array(0));
    $hidden = '';
    if(isset($to) && count($to) >=1){
        foreach($to as $key => $value)
        $hidden .= build_hidden_fields(array("to[".$key."]"     => 1));
    }
    if(isset($f) && count($f) >=1){
        foreach($f as $key => $value)
        $hidden .= build_hidden_fields(array("f[".$key."]"  => 1));
    }
    if(isset($t) && count($t) >=1){
        foreach($t as $key => $value)
        $hidden .= build_hidden_fields(array("t[".$key."]"  => 1));
    }
    $hidden .= build_hidden_fields(array(
    "op"        => "editprofile",
    "take_edit"     => "1",
    "check"         => 1,
    "action"        => 'overview',
    "delete"        => 1,
    "mode"          => 'subscribed'
    ));
if(isset($check))$check=true;
else
$check = false;
            confirm_box($check, 'bt_fm_del_subs', $hidden,'confirm_body.html','');
    if((!isset($to) OR !count($to) >=1) AND (!isset($t) OR !count($t) >=1) AND (!isset($f) OR !count($f) >=1))
    {
              set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR_HEADER'          =>$user->lang['DELETE_DRAFTS'],
                                        'S_ERROR_MESS'            => $user->lang['NO_DRAFTS_SET'],
                                ));
             echo $template->fetch('error.html');
             @include_once("include/cleanup.php");
             ob_end_flush();
             die();
     }
     if(isset($to) AND count($to) >=1){
            foreach($to as $sub=> $value){
                if(!is_numeric($value)){
                    set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR_HEADER'          => $user->lang['BT_ERROR'],
                                        'S_ERROR_MESS'            => $user->lang['ERROR_SUBJECT_NUBER'],
                                ));
                    echo $template->fetch('error.html');
                    @include_once("include/cleanup.php");
                    ob_end_flush();
                    die();
                }
                $db->sql_query("DELETE FROM `".$db_prefix."_comments_notify` WHERE `torrent` = $sub AND `user` = $uid LIMIT 1");
            }
     }
     if(isset($t) AND count($t) >=1){
            foreach($t as $sub=> $value){
                if(!is_numeric($value)){
                    set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR_HEADER'          => $user->lang['BT_ERROR'],
                                        'S_ERROR_MESS'            => $user->lang['ERROR_SUBJECT_NUBER'],
                                ));
                    echo $template->fetch('error.html');
                    @include_once("include/cleanup.php");
                    ob_end_flush();
                    die();
                }
                $db->sql_query("DELETE FROM `".$db_prefix."_bookmarks` WHERE `topic_id` = $sub AND `user_id` = $uid LIMIT 1");
            }
     }
     if(isset($f) AND count($f) >=1){
            foreach($f as $sub=> $value){
                if(!is_numeric($value)){
                    set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR_HEADER'          => $user->lang['BT_ERROR'],
                                        'S_ERROR_MESS'            => $user->lang['ERROR_SUBJECT_NUBER'],
                                ));
                    echo $template->fetch('error.html');
                    @include_once("include/cleanup.php");
                    ob_end_flush();
                    die();
                }
                $db->sql_query("DELETE FROM `".$db_prefix."_forums_watch` WHERE `forum_id` = $sub AND `user_id` = $uid LIMIT 1");
            }
     }

?>