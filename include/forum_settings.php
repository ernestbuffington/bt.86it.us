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
** File include/forum_settings.php 2022-11-02 00:00:00 Thor
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

require_once("include/configdata.php");
require_once("include/db/database.php");

//This way we protect database authentication against hacked mods


$sql = "SELECT * FROM ".$db_prefix."_admin_forum LIMIT 1;";

$configquery = $db->sql_query($sql)or btsqlerror($sql);

if (!$row = $db->sql_fetchrow($configquery)) ;
//Config parser start
$forumpx = $row["prefix"];
$cookie_name = $row['cookie_name'];
$cookie_domain = $row["cookie_domain"];
$cookie_path = $row["cookie_path"];
$logintime = $row['cookie_time'];
$forumshare = ($row["forum_share"]=="true") ? true : false;
$forumbase = $row["base_folder"];
$phpEx = substr(strrchr(__FILE__, '.'), 1);
$phpbb2_basefile = $forumbase;
$activate_phpbb2_forum = true;
$phpbb2_folder = "./".$forumbase."/";
$phpbb_root_path = "";
$phpbb_root_path = "./";
$auto_post = $row["auto_post_forum"];
$allow_posting = ($row["auto_post"]=="true") ? true : false;
$db->sql_freeresult($configquery);

#Config Parser end

?>