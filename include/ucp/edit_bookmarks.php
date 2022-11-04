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
** File ucp/edit_bookmarks.php 2022-11-02 00:00:00 Thor
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

set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
$t      = request_var('t', array(0));
$hid    = '';
if(isset($t) && count($t) >=1){
    foreach($t as $key => $value)
    {
        $hid .= "<input type=\"hidden\" name=\"t[".$key."]\" value=\"1\" />";
    }
}
$hidden='<input type="hidden" name="take_edit" value="1" >
<input type="hidden" name="check" value="1" >
<input type="hidden" name="action" value="overview" >
<input type="hidden" name="op" value="editprofile" >
<input type="hidden" name="mode" value="bookmarks" />'.
$hid;
if(isset($check))$check=true;
else
$check = false;
            if(!confirm_box($check, 'bt_fm_del_bookm', $hidden,'confirm_body.html','?overview&mode=bookmarks')){
              set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
              $template->assign_var('S_IN_UCP', true);
            }
$t                                     = request_var('t', array(0));
    if(!isset($t) && !count($t) >=1)bterror("NO_TOPIC_SET",'BT_ERROR');
    foreach($t as $book=> $value){
        $db->sql_query("DELETE FROM ".$db_prefix."_bookmarks WHERE topic_id='".$book."' AND user_id='".$user->id."'");
     }

?>