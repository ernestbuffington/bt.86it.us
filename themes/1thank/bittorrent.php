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
** File index.php 2022-11-02 00:00:00 Thor
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

global $template, $user, $mode, $action, $op, $navoption, $admin_mode, $uid;
                            $template->assign_vars(array(
                                        'PRELOAD'            => true,
                                ));
if(isset($uid) && $uid != $user->id)$uid = '&amp;id=' . $uid; else $uid = '';
                            $template->assign_block_vars('t_block1',array(
                            'L_TITLE'       => $user->lang['OVERVIEW'],
                            'S_SELECTED'    => (($action == 'overview')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=overview&amp;mode=front',));
if ($action == 'overview')
{
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['FRONT_PAGE'],
                            'S_SELECTED'    => (($mode == 'front')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=overview&amp;mode=front',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['MANAGE_SUBS'],
                            'S_SELECTED'    => (($mode == 'subscribed')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=overview&amp;mode=subscribed',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['MANAGE_DRAFTS'],
                            'S_SELECTED'    => (($mode == 'drafts')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=overview&amp;mode=drafts',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['MANAGE_ATTACHMENTS'],
                            'S_SELECTED'    => (($mode == 'attachments')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=overview&amp;mode=attachments',));
}
                            $template->assign_block_vars('t_block1',array(
                            'L_TITLE'       => $user->lang['PROFILE'],
                            'S_SELECTED'    => (($action == 'profile')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=profile&amp;mode=profile_info',));
if ($action == 'profile')
{
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['EDIT_PROFILE'],
                            'S_SELECTED'    => (($mode == 'profile_info')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=profile&amp;mode=profile_info',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['EDIT_SIGNATURE'],
                            'S_SELECTED'    => (($mode == 'signature')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=profile&amp;mode=signature',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['EDIT_AVATAR'],
                            'S_SELECTED'    => (($mode == 'avatar')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=profile&amp;mode=avatar',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['EDIT_SETTINGS'],
                            'S_SELECTED'    => (($mode == 'reg_details')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=profile&amp;mode=reg_details',));
                            if($admin_mode)
                            {
                                $template->assign_block_vars('t_block2',array(
                                'L_TITLE'       => $user->lang['EDIT_ADMIN_SETTINGS'],
                                'S_SELECTED'    => (($mode == 'admin_reg_details')?true : false),
                                'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=profile&amp;mode=admin_reg_details',));
                            }
}
                            $template->assign_block_vars('t_block1',array(
                            'L_TITLE'       => $user->lang['BOARD_PREFS'],
                            'S_SELECTED'    => (($action == 'preferences')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=preferences&amp;mode=personal',));
if ($action == 'preferences')
{
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['EDIT_GLOBAL_SETTINGS'],
                            'S_SELECTED'    => (($mode == 'personal')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=preferences&amp;mode=personal',));
}
if($uid == '')
{
                            $template->assign_block_vars('t_block1',array(
                            'L_TITLE'       => $user->lang['_PRIVATE_MESSAGE'],
                            'S_SELECTED'    => $navoption,
                            'U_TITLE'       => 'pm.php?op=folder&i=0',));
if($navoption)
{
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['UCP_PM_COMPOSE'],
                            'S_SELECTED'    => (($op == 'send')?true : false),
                            'U_TITLE'       => 'pm.php?op=send',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['UCP_PM_DRAFTS'],
                            'S_SELECTED'    => (($op == 'drafts')?true : false),
                            'U_TITLE'       => 'pm.php?op=drafts',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['FOLDER_OPTIONS'],
                            'S_SELECTED'    => (($op == 'options')?true : false),
                            'U_TITLE'       => 'pm.php?op=options',));
}
}
                            $template->assign_block_vars('t_block1',array(
                            'L_TITLE'       => $user->lang['FRIEND_FOE'],
                            'S_SELECTED'    => (($action == 'friends')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=friends&mode=friends',));
if ($action == 'friends')
{
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['MANAGE_FRIENDS'],
                            'S_SELECTED'    => (($mode == 'friends')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=friends&amp;mode=friends',));
                            $template->assign_block_vars('t_block2',array(
                            'L_TITLE'       => $user->lang['MANAGE_FOES'],
                            'S_SELECTED'    => (($mode == 'foes')?true : false),
                            'U_TITLE'       => 'user.php?op=editprofile' . $uid . '&amp;action=friends&amp;mode=foes',));
}
?>