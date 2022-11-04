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
** File files/prune.php 2022-11-02 00:00:00 Thor
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

$user->set_lang('admin/acp_prune',$user->ulanguage);
if(!checkaccess('a_prune'))
{
                add_log('admin','LOG_ACL_ACCESS_NOTALLOW',$user->lang['USERPRUNE_HEADER']);
                                $template->assign_vars(array(
                                        'S_USER_NOTICE'         => true,
                                        'S_FORWARD'             => false,
                                        'MESSAGE_TITLE'         => $user->lang['GEN_ERROR'],
                                        'MESSAGE_TEXT'          => sprintf($user->lang['DENIACC'],$user->lang['USERPRUNE_HEADER']),
                                ));
                echo $template->fetch('admin/message_body.html');
                close_out();
}
$cfgquery = "SELECT * FROM ".$db_prefix."_userautodel;";
$cfgres = $db->sql_query($cfgquery);
$cfgrow = $db->sql_fetchrow($cfgres);
$db->sql_freeresult($cfgres);
        $do                 = request_var('do', '');
if ($do == 'take_config'){
        $error = array();
        $sub_autodel_users                                  = request_var('sub_autodel_users', 'false');
        $sub_inactwarning_time                              = request_var('sub_inactwarning_time', '0');
        $sub_autodel_users_time                             = request_var('sub_autodel_users_time', '0');
        //First I create the two SQL arrays
        $params = Array();
        $values = Array();
        if (!isset($sub_autodel_users) OR $sub_autodel_users != "true") $sub_autodel_users = "false"; array_push($params,"autodel_users"); array_push($values,$sub_autodel_users);
        if (is_numeric($sub_inactwarning_time)) { array_push($params,"inactwarning_time"); array_push($values,$sub_inactwarning_time); }
        if (is_numeric($sub_autodel_users_time)) { array_push($params,"autodel_users_time"); array_push($values,$sub_autodel_users_time); }
        $sql = "INSERT INTO ".$db_prefix."_userautodel (".implode(", ",$params).") VALUES ('".implode("', '",$values)."');";
        if (!$db->sql_query($sql)) btsqlerror($sql);
        $db->sql_query("TRUNCATE TABLE ".$db_prefix."_userautodel;");
        $db->sql_query($sql);
        $pmbt_cache->remove_file("sql_".md5("userautodel").".php");
                add_log('admin','LOG_PRUNE_SETTING_UPDATE');
                                $template->assign_vars(array(
                                        'S_USER_NOTICE'                 => true,
                                        'S_FORWARD'                 => $u_action,
                                        'MESSAGE_TITLE'             => $user->lang['SUCCESS'],
                                        'MESSAGE_TEXT'              => $user->lang['SETTING_SAVED'].back_link($u_action),
                                ));
        echo $template->fetch('admin/message_body.html');
        close_out();
}

                        $hidden = build_hidden_fields(array(
                            'do'        => 'take_config',
                        ));
$template->assign_vars(array(
        'L_TITLE'                   => $user->lang["TITLE"],
        'L_TITLE_EXPLAIN'           => $user->lang["TITLE_EXP"],
        'U_ACTION'                  => $u_action,
        'HIDDEN'                    => $hidden,
));
drawRow(true,false, false ,$user->lang['USERPRUNE_HEADER']);
drawRow("autodel_users","checkbox");
drawRow("inactwarning_time","text");
drawRow("autodel_users_time","text");
echo $template->fetch('admin/acp_prune.html');
        close_out();
?>