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
** File ucp/edit_friends.php 2022-11-02 00:00:00 Thor
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

        # Add New Friend To Users Account
        if (isset($new_friend[0]) AND $new_friend[0] != ''){
              $new_friend = preg_split("/\\n[\\s]*/",$new_friend);
              foreach($new_friend as $s){
                   $res_friend = $db->sql_query("SELECT id FROM ".$db_prefix."_users WHERE username ='".escape($s)."' OR name = '".escape($s)."' OR clean_username = '".escape(strtolower($s))."';");
                   if (!$res_friend) echo "No Such user found";
                   $row_friend = $db->sql_fetchrow($res_friend);
                   $sql = "INSERT INTO ".$db_prefix."_private_messages_bookmarks (master, slave) VALUES ('".$user->id."','".$row_friend['id']."');";
                   $db->sql_query($sql) or btsqlerror($sql);
                   $sql = "DELETE FROM ".$db_prefix."_private_messages_blacklist WHERE master = '".$user->id."' AND slave = '".$row_friend['id']."';";
                   $db->sql_query($sql) or btsqlerror($sql);
              }
        }
        #Remove Friend From Users Account
        if (isset($remove_friend[0]) AND $remove_friend[0] != ''){
              foreach($remove_friend as $s){
                    if (isset($s) AND is_numeric($s)){
                    $sql = "DELETE FROM ".$db_prefix."_private_messages_bookmarks WHERE master='".$user->id."' AND slave = '".$s."';";
                    $db->sql_query($sql) or btsqlerror($sql);
                    }
              }
        }

?>