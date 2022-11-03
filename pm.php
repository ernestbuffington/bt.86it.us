<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File pm.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_BTM",true);
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