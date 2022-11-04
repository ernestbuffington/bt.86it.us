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
** File pm.php 2022-11-02 00:00:00 Thor
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

define("IN_AN602",true);
require_once("common.php");
$user->set_lang('ucp',$user->ulanguage);
$user->set_lang('pm',$user->ulanguage);
$template = new Template();
if($user->id == 0 OR !checkaccess('u_sendpm')){
              set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR'           => true,
                                        'S_FORWARD'             => false,
                                        'TITTLE_M'          => $user->lang['GEN_ERROR'],
                                        'MESSAGE'           => sprintf($user->lang['GROUP_NO_ACCESS_PAGE'],getlevel($user->group)).back_link('./index.php'),
                                ));
                            echo $template->fetch('message_body.html');
                            close_out();
}
if (!isset($op)) {
        if (isset($mid1) AND is_numeric($mid)) $op = "readmsg";
        else $op = "inbox";
}
$template->assign_var('S_PRIVMSGS', true);
$navoption = true;

switch($op) {
        case "blacklist": {
                if (!isset($id) OR !is_numeric($id)) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sqlcheck = "SELECT id FROM ".$db_prefix."_users WHERE id = '".$id."';";
                $rescheck = $db->sql_query($sqlcheck);
                $n = $db->sql_numrows($rescheck);
                $db->sql_freeresult($rescheck);
                if (!$n) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sql = "INSERT INTO ".$db_prefix."_private_messages_blacklist (master, slave) VALUES ('".$user->id."','".$id."');";
                $db->sql_query($sql) or btsqlerror($sql);
                $sql = "DELETE FROM ".$db_prefix."_private_messages_bookmarks WHERE master = '".$user->id."' AND slave = '".$id."';";
                $db->sql_query($sql) or btsqlerror($sql);
                header("Location: user.php?op=profile&id=" . $id);
                die();
        }
                case "removeblacklist": {
                if (!isset($id) OR !is_numeric($id)) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sqlcheck = "SELECT id FROM ".$db_prefix."_users WHERE id = '".$id."';";
                $rescheck = $db->sql_query($sqlcheck);
                $n = $db->sql_numrows($rescheck);
                $db->sql_freeresult($rescheck);
                if (!$n) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sql = "DELETE FROM ".$db_prefix."_private_messages_blacklist WHERE master = '".$user->id."' AND slave = '".$id."';";
                $db->sql_query($sql) or btsqlerror($sql);
                header("Location: user.php?op=profile&id=" . $id);
                die();
        }

        case "bookmark": {
                if (!isset($id) OR !is_numeric($id)) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sqlcheck = "SELECT id FROM ".$db_prefix."_users WHERE id = '".$id."';";
                $rescheck = $db->sql_query($sqlcheck);
                $n = $db->sql_numrows($rescheck);
                $db->sql_freeresult($rescheck);
                if (!$n) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sql = "INSERT INTO ".$db_prefix."_private_messages_bookmarks (master, slave) VALUES ('".$user->id."','".$id."');";
                $db->sql_query($sql) or btsqlerror($sql);
                $sql = "DELETE FROM ".$db_prefix."_private_messages_blacklist WHERE master = '".$user->id."' AND slave = '".$id."';";
                $db->sql_query($sql) or btsqlerror($sql);
                header("Location: user.php?op=profile&id=" . $id);
                die();
        }
                case "removebookmark": {
                if (!isset($id) OR !is_numeric($id)) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sqlcheck = "SELECT id FROM ".$db_prefix."_users WHERE id = '".$id."';";
                $rescheck = $db->sql_query($sqlcheck);
                $n = $db->sql_numrows($rescheck);
                $db->sql_freeresult($rescheck);
                if (!$n) bterror($user->lang['NO_SUCH_USER'],'BT_ERROR');
                $sql = "DELETE FROM ".$db_prefix."_private_messages_bookmarks WHERE master='".$user->id."' AND slave = '".$id."';";
                $db->sql_query($sql) or btsqlerror($sql);
                header("Location: user.php?op=profile&id=" . $id);
                die();
        }
        case "send": {
                set_site_var($user->lang['_UCP_PM']);
                include("pm/send.php");
                break;
        }
        case "readmsg": {
                set_site_var($user->lang['_UCP_PM']);
                include("pm/readmsg.php");
                break;
        }
        case "drafts": {
                    set_site_var($user->lang['_UCP_PM']);
                    include("pm/drafts.php");
                    break;
        }
        case "options": {
                    set_site_var($user->lang['_UCP_PM']);
                    include("pm/options.php");
                    break;
        }
        case "folder":
        case "inbox":
        default: {
                set_site_var($user->lang['_UCP_PM']);
                $u_action = 'pm.php';
                include("pm/inbox.php");
                break;
        }
}

?>