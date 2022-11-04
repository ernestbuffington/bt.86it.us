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
** File pm_ajax.php 2022-11-02 00:00:00 Thor
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
$template = new Template();
set_site_var('');
  $error = "OK";
  $sql = "SELECT msg_id FROM ".$db_prefix."_privmsgs_to WHERE user_id = ".$user->id." AND pm_unread = 1  LIMIT 1;";
  $res = $db->sql_query($sql) or $error = "sql: ".$sql;
  $has_newpm = ($db->sql_numrows($res) > 0) ? true : false;
  $db->sql_freeresult($res);

  if ($has_newpm AND $user->pm_popup) $pmout = $user->lang['NEW_MESAGE'];
  else $pmout = "false";
  if ($pmout != "false") $confirmtext = "<confirm>".$user->lang['JAVA_NEW_PM']."</confirm>";
  else $confirmtext = "";

  $xmldata = "<response><status>".$error."</status><pm>".$pmout."</pm>".$confirmtext."</response>";
  header('Content-Type: text/xml');
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>\n";
  echo $xmldata;
$db->sql_close();
exit();

?>