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
** File files/bbcode.php 2018-10-10 09:19:00 Thor
**
** CHANGES
**
** 2022-11-02 - Updated Masthead, Github, !defined('IN_AN602')
** 2018-10-10 - Added Missing Language
**/

if (!defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

include_once'include/class.bbcode.php';

$user->set_lang('admin/acp_bbcode',$user->ulanguage);
    $template->assign_vars(array(
        'ICON_EDIT'                 => '<img src="themes/' . $themne . '/pics/edit.gif" alt="' . $user->lang['BBCODE_EDIT'] . '" title="' . $user->lang['BBCODE_EDIT'] . '" border="0">',

        'ICON_DELETE'               => '<img src="themes/' . $themne . '/pics/drop.gif" alt="' . $user->lang['BBCODE_DELETE'] . '" title="' . $user->lang['BBCODE_DELETE'] . '" border="0">',

        'ACP_BBCODES'               => 'BBCodes',
));

$bbcode  =  new acp_bbcodes();
$bbcode->u_action = $siteurl . '/admin.php?i=staff&op=bbcode';
$bbcode->main('1','edit');

echo $template->fetch('admin/acp_bbcodes.html');

?>