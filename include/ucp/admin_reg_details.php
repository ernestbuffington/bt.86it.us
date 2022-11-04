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
** File ucp/admin_reg_details.php 2022-11-02 00:00:00 Thor
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

if((!checkaccess('m_edit_user')) OR (is_founder($id) && !$user->user_type==3)){
    set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
    meta_refresh('5',$siteurl."/index.php");
            $template->assign_vars(array(
                    'S_ERROR_HEADER'          =>$user->lang['ACCESS_DENIED'],
                    'S_ERROR_MESS'            => $user->lang['NO_EDIT_PREV'],
            ));
    echo $template->fetch('error.html');
    close_out();
}
include 'admin/functions.php';
$hiden = array(
'take_edit'             => '1',
'action'                => 'profile',
'op'                => 'editprofile',
'mode'              => 'admin_reg_details',
);
$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.Columns where TABLE_NAME = '".$db_prefix."_levels'
AND COLUMN_NAME NOT IN ('level','name','group_id','group_type','color','group_desc')";
$result = $db->sql_query($sql);
$val = array();
while ($row = $db->sql_fetchrow($result))
{
    $val[] = $row[0];
}
$db->sql_freeresult($result);
$adminlevel = "<select name=\"level\">";
$adminlevel .= "<option ".(($userrow["level"] == "user") ? "selected " :'' )."value=\"user\">".$user->lang['USER']."</option>";
$adminlevel .= "<option ".(($userrow["level"] == "premium") ? "selected " :'' )."value=\"premium\">".$user->lang['G_PREMIUM_USER']."</option>";
$adminlevel .= "<option ".(($userrow["level"] == "moderator") ? "selected " :'' )."value=\"moderator\">".$user->lang['G_MODERATOR']."</option>";
$adminlevel .= "<option ".(($userrow["level"] == "admin") ? "selected " :'' )."value=\"admin\">".$user->lang['G_ADMINISTRATORS']."</option>";
$adminlevel .= "</select>";
$template->assign_vars(array(
        'S_HIDDEN_FIELDS'       => build_hidden_fields($hiden),
        'CP_MOD_COMENTS'        => $userrow["modcomment"],
        'U_SEEDBOX_IP'          => long2ip($userrow["seedbox"]),
        'U_IS_WARNED'           => ($userrow["warned"]) ? true : false,
        'U_WARNED_TELL'         => ($userrow["warned"]) ? gmdate("Y-m-d H:i:s",($userrow["warn_kapta"]+$userrow["warn_hossz"])) : '',
        'U_ACTIVATED_ACC'       => ($userrow["active"] == "1") ? true : false,
        'U_SITE_HELPER'         => ($userrow['helper'] == 'true') ? true : false,
        'U_FORUM_BANNED'        => ($userrow['forumbanned'] == 'yes') ? true : false,
        'U_SITE_HELP_WITH'      => $userrow["help_able"],
        'CP_TRUEUPLOADED'       => $userrow["uploaded"],
        'CP_TRUEDOWNLOADED'     => $userrow["downloaded"],
        'CP_INVITES'            => $userrow["invites"],
        'CP_SEED_POINTS'        => $userrow["seedbonus"],
        'CP_UUPLOADED'          => mksize($userrow["uploaded"]),
        'CP_UDOWNLOADED'        => mksize($userrow["downloaded"]),
        'CP_URATIO'             => get_u_ratio($userrow["uploaded"], $userrow["downloaded"]),
        'CP_UCOLOR'             => getusercolor($userrow["can_do"]),
        'CP_DISABLED'           => ($userrow["disabled"] == 'true') ? true : false,
        'CP_DISABLED_REASON'    => $userrow["disabled_reason"],
        'CP_UCANSHOUT'          => ($userrow["can_shout"] == 'true') ? true : false,
        'CP_UCAN_DO'            => $userrow["can_do"],
        'CP_UGROUP'             => getlevel($userrow["can_do"]),
        'S_GROUP_OPTIONS'       => selectaccess($al= $userrow["can_do"]),
        'S_SHOW_ACTIVITY'       => true,
        'A_GROUP'               => group_select_options_id($userrow["can_do"]),
        'A_LEVEL'               => $adminlevel,
));

?>