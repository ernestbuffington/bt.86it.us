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
** File upload.php 2022-11-02 00:00:00 Thor
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
$user->set_lang('upload',$user->ulanguage);
$template = new Template();
set_site_var($user->lang['UPLOAD']);
if(!checkaccess("u_upload")){
                $template->assign_vars(array(
                    'S_ERROR'           => true,
                    'S_FORWARD'         => false,
                    'TITTLE_M'          => $user->lang['BT_ERROR'],
                    'MESSAGE'           => $user->lang['GROUP_NO_ACCESS_PAGE'],
                ));
                echo $template->fetch('message_body.html');
                close_out();
}
if($user->parked)
{
                $template->assign_vars(array(
                    'S_ERROR'           => true,
                    'S_FORWARD'         => false,
                    'TITTLE_M'          => $user->lang['BT_ERROR'],
                    'MESSAGE'           => $user->lang['ACCOUNT_PARKED'],
                ));
                echo $template->fetch('message_body.html');
                close_out();
}
if($user->disabled)
{
                $template->assign_vars(array(
                    'S_ERROR'           => true,
                    'S_FORWARD'         => false,
                    'TITTLE_M'          => $user->lang['BT_ERROR'],
                    'MESSAGE'           => sprintf($user->lang['ACCOUNT_DISABLED'], $user->disabled_reason),
                ));
                echo $template->fetch('message_body.html');
                close_out();
}
$pop = request_var('pop','');
if($pop == 'smilies')
{
            $form   = request_var('form', '');
            $area   = request_var('area', '');
                $template->assign_vars(array(
                    'FORM'          => $form,
                    'AREA'          => $area,
                ));
            $sql = "SELECT * FROM ".$db_prefix."_smiles ORDER BY id ASC;";
            $smile_res = $db->sql_query($sql);
            $smile_count = 0;
            while ($smile = $db->sql_fetchrow($smile_res))
            {
                $template->assign_block_vars('smilies',array(
                'ID'            =>  $smile["id"],
                'CODE'          =>  $smile["code"],
                'FILE'          =>  $smile["file"],
                'ALT'           =>  $smile["alt"],
                'S_ROW_COUNT'   =>  $smile_count++,
                ));
            }
                echo $template->fetch('smilies.html');
                close_out();
}
$op = request_var('op', ($allow_magnet == 1)? '' : 'torrent');
    $template->assign_vars(array(
        'L_TITLE'                   => $user->lang['UPLOAD'],
        'L_INTRO'                   => $user->lang['INTRO'],
        'L_INTRO_EXP'               => $user->lang['INTRO_EXP_SEL'],
        'ALLOW_LINK'                => ($allow_magnet == 1)? true : false,
        'S_MESSAGE'                 => false,
        'S_NOTICE'                  => false,
        'S_ACTION'                  => $op,
    ));
        $postback           = request_var('postback', '');
switch ($op) {
        case "torrent": {
                include_once("upload/torrent.php");
                break;
        }
        case "link": {
               if(checkaccess('u_can_add_magnet_links')) include_once("upload/link.php");
                break;
        }
        case "taketorrent": {
                include_once("upload/taketorrent.php");
                break;
        }
        case "takelink": {
               if(checkaccess('u_can_add_magnet_links')) include_once("upload/takelink.php");
                break;
        }
}
echo $template->fetch('upload.html');
close_out();

?>