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
** File torrents_needseed.php 2022-11-02 00:00:00 Thor
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

global $db_prefix, $user, $db, $shout_config,$template,$siteurl,$language,$pmbt_cache;
$sql = ("SELECT id, name, downloaded, completed, seeders, leechers, added FROM ".$db_prefix."_torrents WHERE leechers > 0 AND seeders = 0 ORDER BY leechers DESC LIMIT 10");
$res = $db->sql_query($sql) or btsqlerror($sql);
$need_seed = array();
if ($db->sql_numrows($res) > 0)
    {
    $template->assign_vars(array(
    'IS_NEED_SEEDS' => true,
    ));
    $i=0;
        while ($arr = $db->sql_fetchrow($res))
            {
            $torrname = htmlspecialchars($arr['name']);
            $torrname = str_replace(array('-','_'),array(' ',' '),$torrname);
                if (strlen($torrname) > 55)
                $torrname = substr($torrname, 0, 55) . "...";
$need_seed[] = array_push($need_seed,array(
'SEED_NAME_SHORT' => $torrname,
'SEED_ID' => $arr['id'],
'SEED_NAME' => htmlspecialchars(stripslashes($arr['name'])),
'SEED_LEECH' => number_format($arr['leechers']),
'SEED_DOWN' => number_format($arr['downloaded']),
'SEED_ADDED' => $arr['added'],
'SEED_COMPL' => number_format($arr['completed'])));
}
$i++;
}
else
{
    $template->assign_vars(array(
    'IS_NEED_SEEDS' => false
    ));
}
foreach($need_seed as $val){
if(is_array($val))$template->assign_block_vars('need_seeded',$val);
}
echo $template->fetch('need_seeders.html');

?>