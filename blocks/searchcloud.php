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
** File searchcloud.php 2022-11-02 00:00:00 Thor
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

global $db_prefix, $user, $db, $shout_config,$template,$siteurl,$language,$pmbt_cache,$search_cloud_limmit;
if(!$pmbt_cache->get_sql("searchcloud")){
unset($rowsets);
$rowsets = array();
                        $sql ="SELECT text, hit FROM ".$db_prefix."_search_text ORDER BY RAND() LIMIT " . $search_cloud_limmit . " ;";
                        $result = $db->sql_query($sql);
                        while($row = $db->sql_fetchrow($result)){
        $rowsets[] = (isset($row))? $row : array();
    }
$pmbt_cache->set_sql("searchcloud", $rowsets);
}else{
$rowsets = $pmbt_cache->get_sql("searchcloud");
}
        foreach ($rowsets  as $id=>$row) {
                        $hit = $row['hit']/2;
                        if($hit>=5) $hit = "5";
                        $text = str_replace(' ','+',$row["text"]);
           $template->assign_block_vars('seach_cloud', array(
                "HIT"                =>  $hit,
                "TEXT"                =>  $text,
           ));
                        }
        $db->sql_freeresult($result);
echo $template->fetch('search_cloud.html');

?>