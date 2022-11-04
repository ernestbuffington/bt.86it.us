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
** File donate.php 2022-11-02 00:00:00 Thor
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
$user->set_lang('donate',$user->ulanguage);
$template = new Template();
set_site_var($user->lang['DONATIONS']);
    if($nodonate == "US")$type = "$";
    elseif($nodonate == "EU")$type = "&euro;";
    elseif($nodonate == "UK")$type = "&pound;";
 eval('$page = "' . html_entity_decode($donatepagecontents) . '";');
    $template->assign_vars(array(
                    'CURENTSY'          =>  $type,
                    'ASKING'            =>  $donateasked,
                    'RECEAVED'          =>  $donatein,
                    'CONTENT'           =>  $page,
                ));
echo $template->fetch('donate.html');
close_out();
?>