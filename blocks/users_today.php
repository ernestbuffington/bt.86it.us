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
** File users_today.php 2022-11-02 00:00:00 Thor
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

global $db_prefix, $user, $db, $pmbt_cache,$template;
if(!$pmbt_cache->get_sql("today_online")){
        unset($rowsets);
        $rowsets = array();
        $sql = "SELECT U.id as id, IF(U.name IS NULL, U.username, U.name) as name, U.donator as donator, U.warned as warned, (UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(lastlogin)) as def, U.can_do as can_do, U.level as level, UNIX_TIMESTAMP(U.lastlogin) as lastlogin, L.group_colour as color
            FROM ".$db_prefix."_users U , ".$db_prefix."_level_settings L
        WHERE U.active = 1
        AND UNIX_TIMESTAMP(U.lastlogin) > UNIX_TIMESTAMP(NOW()) - 86400
        AND L.group_id = U.can_do
        ORDER BY username  ASC;";
        $res = $db->sql_query($sql);
    while ($rowset = $db->sql_fetchrow($res) ) {
        $rowsets[] = $rowset;
    }
        $db->sql_freeresult($res);
$pmbt_cache->set_sql("today_online", $rowsets);
}else{
$rowsets = $pmbt_cache->get_sql("today_online");
}
if (sizeof($rowsets)){
        foreach ($rowsets  as $id=>$row) {
            $template->assign_block_vars('user_today', array(
            "USERNAME"          => htmlspecialchars($row["name"]),
            "DONER"             => ($row["donator"] == 'true') ? true : false,
            "WARNED"            => ($row["warned"] == '1') ? true : false,
            "ID"                =>  $row['id'],
            "COLOR"             => $row["color"],
            "LEVEL_ICON"        => ($row["level"] == "admin") ? pic("icon_admin.gif",'','admin') : (($row["level"] == "moderator") ? pic("icon_moderator.gif",'','moderator') : (($row["level"] == "premium") ?  pic("icon_premium.gif",'','premium') : '')),
            'LAST_CLICK'        =>  get_formatted_timediff($row["lastlogin"])
         ));
        }
}
echo $template->fetch('users_today.html');

?>