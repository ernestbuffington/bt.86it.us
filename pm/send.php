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
** File send.php 2022-11-02 00:00:00 Thor
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

require_once("include/ucp/functions_privmsgs.php");
require_once("include/ucp/ucp_pm_compose.php");
require_once("include/class.bbcode.php");
require_once'include/functions_forum.php';
$action = request_var('action', 'post');
        $folder_specified = request_var('folder', '');

        if (!in_array($folder_specified, array('inbox', 'outbox', 'sentbox')))
        {
            $folder_specified = (int) $folder_specified;
        }
        else
        {
            $folder_specified = ($folder_specified == 'inbox') ? 0 : (($folder_specified == 'outbox') ? -2 : -1);
        }

        if (!$folder_specified)
        {
            $mode = (!$mode) ? request_var('mode', 'view') : $mode;
        }
        else
        {
            $mode = 'view';
        }
$template->assign_vars(array(
        'T_TEMPLATE_PATH'         => $siteurl . '/themes/' . $theme . '/templates',
        'S_PRIVMSGS'         => true,
        'ERROR_MESSAGE'         => false,
        'BTM_LINK_BACK'        => 'pm.php?',
        'S_UCP_ACTION'          => 'pm.php?op=inbox',
));
        $sql = "SELECT B.slave, U.username, IF (U.name IS NULL, U.username, U.name) as name, U.can_do as can_do, U.lastlogin as laslogin, U.Show_online as show_online FROM ".$db_prefix."_private_messages_bookmarks B LEFT JOIN ".$db_prefix."_users U ON B.slave = U.id WHERE B.master = '".$user->id."' ORDER BY name ASC;";
        $res = $db->sql_query($sql) or btsqlerror($sql);
        if ($n = $db->sql_numrows($res)) {
                for ($i = 1; list($uid, $username, $user_name, $can_do, $laslogin, $show_online) = $db->fetch_array($res); $i++) {
        $which = (time() - 300 < sql_timestamp_to_unix_timestamp($laslogin) && ($show_online == 'true' || $user->admin)) ? 'online' : 'offline';

        $template->assign_block_vars("friends_{$which}", array(
            'USER_ID'       => $uid,
            'USER_COLOUR'   => getusercolor($can_do),
            'USERNAME'      => $username,
            'USERNAME_FULL' => $user_name)
        );
                }
        }
        $db->sql_freeresult($res);
                $action = request_var('action', 'post');
                get_folder($user->id);
                compose_pm($id, $mode, $action);
echo $template->fetch('pm_send.html');
close_out();

?>