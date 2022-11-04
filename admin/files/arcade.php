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
** Project Leaders: Black_Heart, Thor
** File files/arcade.php 2022-11-02 00:00:00 Thor
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

        $user->set_lang('admin/acp_arcade',$user->ulanguage);
        $mode           = request_var('mode', 'manage');
                            $template->assign_block_vars('l_block1.l_block2',array(
                            'L_TITLE'       => $user->lang['ARCADE'],
                            'S_SELECTED'    => true,
                            'U_TITLE'       => '1',));
                            $template->assign_block_vars('l_block1.l_block2.l_block3',array(
                            'S_SELECTED'    => ('settings' ==$mode)? true:false,
                            'IMG' => '',
                            'L_TITLE' => $user->lang['A_SETTINGS'],
                            'U_TITLE' => append_sid($u_action, 'mode=settings'),
                            ));
                            $template->assign_block_vars('l_block1.l_block2.l_block3',array(
                            'S_SELECTED'    => ('manage' ==$mode)? true:false,
                            'IMG' => '',
                            'L_TITLE' => $user->lang['A_MANAGE'],
                            'U_TITLE' => append_sid($u_action, 'mode=manage'),
                            ));
        require_once 'admin/files/acp_arcade.php';
        $arcade = new acp_arcade($u_action);
        $module_id      = request_var('id', '');
        $arcade->main($module_id, $mode);
        $template->assign_vars(array(
            'ICON_EDIT'                 => '<img src="themes/' . $theme . '/pics/edit.gif" alt="Edit" title="Edit" border="0">',
            'ICON_DELETE'               => '<img src="themes/' . $theme . '/pics/drop.gif" alt="Delete" title="Delete" border="0">',
            'ACP_BBCODES'               => 'BBCodes',
        ));
        echo $template->fetch('admin/' . $arcade->tpl_name . '.html');
        close_out();

?>