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
** File search_block.php 2022-11-02 00:00:00 Thor
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

global $db_prefix, $user, $db, $shout_config,$template,$siteurl,$language,$pmbt_cache, $search, $wherecatina;
$wherecatina = (is_array($wherecatina)? $wherecatina : array());
$cat_main = array();
$cat_sub = array();
        if(! $res = $db->sql_query(
        "SELECT *
            FROM `".$db_prefix."_categories`
            ORDER BY `".$db_prefix."_categories`.`parent_id` ,
            `".$db_prefix."_categories`.`id` ,
            `".$db_prefix."_categories`.`sort_index` ASC"
        ))bterror("SELECT id, name FROM ".$db_prefix."_categories ORDER BY sort_index, id ASC");
        $ncats = 0;
        $tabs = 0;
        $first=true;
        while ($row = $db->sql_fetchrow($res))
        {
            if($row['parent_id'] == '-1')
            {
            $tabs++;
                $cat_main[] = array(
                        "ID"           => $row['id'],
                        "NAME"         => $row['name'],
                        "IMAGE"        => (file_exists("themes/".$theme."/pics/cat_pics/".$row["image"])) ? "<img class=\"cat_main_im\" src=\"themes/".$theme."/pics/cat_pics/".$row["image"]."\" title=\"".$row["name"]."\" border=\"0\" alt=\"".$row["name"]."\" >" : "<img class=\"cat_main_im\" src=\"cat_pics/".$row["image"]."\" border=\"0\" title=\"".$row["name"]."\" alt=\"".$row["name"]."\" >",
                        "PARENT_ID"    =>  $row['parent_id'],
                        "TABLETYPE"    =>  $tabs,
                        "SUBSCOUNT"    =>  $row['subcount'],
                        'CHECKED'       =>  ((in_array($row['id'],$wherecatina))?true : false),
                        'TABS'          =>  $tabs,
                   );
                $ncats = ($ncats + 1);
            }
            else
            {//subcount
            $cat_sub[$row['parent_id']][] = array(
                        "ID"           => $row['id'],
                        "NAME"         => $row['name'],
                        "IMAGE"        => (file_exists("themes/".$theme."/pics/cat_pics/".$row["image"])) ? "<img class=\"cat_sub_im\" src=\"themes/".$theme."/pics/cat_pics/".$row["image"]."\" title=\"".$row["name"]."\" border=\"0\" alt=\"".$row["name"]."\" width=\"30px\">" : "<img class=\"cat_sub_im\" src=\"cat_pics/".$row["image"]."\" border=\"0\" title=\"".$row["name"]."\" alt=\"".$row["name"]."\" >",
                        "PARENT_ID"    =>  $row['parent_id'],
                        "TABLETYPE"    =>  $row['tabletype'],
                        "SUBSCOUNT"    =>  $row['subcount'],
                        'CHECKED'       =>  ((in_array($row['id'],$wherecatina))?true : false)
                   );
                if($first_id == $row['parent_id'] and !isset($count)) $count = 0;
                if($count == 0)$count = $row['subcount'];
                $count = ($count -1);
            }
        }
    //  print_r($cat_sub);
        foreach($cat_main as $key=>$val)
        {
            $template->assign_block_vars('cats_main',$val);
            //print_r($val);
            if(!isset($cat_sub[$val['ID']]))
            {
                $cat_sub[$val['ID']] = array();
            }
            foreach($cat_sub[$val['ID']] as $keys => $vals)
            {
                $template->assign_block_vars('cats_main.sub',$vals);
            }
        }
    $template->assign_vars(array(
            'NCATS_VAR'     => $ncats,
            'FIRST_SUB'     => $first_id,
            'SEARCH_TEXT'   =>  $search,
    ));

?>