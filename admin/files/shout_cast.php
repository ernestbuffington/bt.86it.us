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
** File files/shout_cast.php 2022-11-02 00:00:00 Thor
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

$user->set_lang('admin/acp_shout_cast',$user->ulanguage);
if(isset($do) && $do == "save")
{
    $errors = array();
    $sqlfields = array();
    $sqlvalues = array();
    $allow              = request_var('sub_allow', '');
    if($allow != ""){
        $sqlfields[] = (($allow == 'false')? "false" : "true");
        $sqlvalues[] = "allow";
    }
    else
        $errors[] = sprintf($user->lang["ERR_NOT_NUMERIC"],$user->lang["_admpallow"],$allow);
    $ip                 = request_var('sub_ip', '');
    if($ip != ""){
        $sqlfields[] = $ip;
        $sqlvalues[] = "ip";
    }
    elseif($allow != false)
        $errors[] = sprintf($user->lang["ERR_NOT_NUMERIC"],$user->lang["_admpip"],$ip);
    $port                   = request_var('sub_port', '0');
    if($port != ""){
        $sqlfields[] = $port;
        $sqlvalues[] = "port";
    }
    elseif($allow != false)
        $errors[] = sprintf($user->lang["ERR_NOT_NUMERIC"],$user->lang["_admpport"],$port);
    $admin_name         = request_var('sub_admin_name', '');
    if($admin_name != ""){
        $sqlfields[] = $admin_name;
        $sqlvalues[] = "admin_name";
    }
    elseif($allow != false)
        $errors[] = sprintf($user->lang["ERR_NOT_NUMERIC"],$user->lang["_admpadmin_name"],$admin_name);
    $admin_pass         = request_var('sub_admin_pass', '');
    if($admin_pass != ""){
        $sqlfields[] = $admin_pass;
        $sqlvalues[] = "admin_pass";
    }
    elseif($allow != false)
        $errors[] = sprintf($user->lang["ERR_NOT_NUMERIC"],$user->lang["_admpadmin_pass"],$admin_pass);
    $host_dj                = request_var('sub_host_dj', '');
    if($host_dj != ""){
        $sqlfields[] = $host_dj;
        $sqlvalues[] = "host_dj";
    }
    elseif($allow != false)
        $errors[] = sprintf($user->lang["ERR_NOT_NUMERIC"],$user->lang["_admphost_dj"],$host_dj);

        $sql = "INSERT INTO ".$db_prefix."_shout_cast (".implode(", ",$sqlvalues).") VALUES ('".implode("', '",$sqlfields)."');";
        if (!$db->sql_query($sql)) btsqlerror($sql);
        $db->sql_query("TRUNCATE TABLE ".$db_prefix."_shout_cast;");
        $db->sql_query($sql);
        $pmbt_cache->remove_file("sql_".md5("shout_cast").".php");
                add_log('admin','LOG_CONFIG_SHOUTCAST');
                                $template->assign_vars(array(
                                        'S_USER_NOTICE'                 => true,
                                        'S_FORWARD'                     => $u_action,
                                        'MESSAGE_TITLE'                 => $user->lang['SUCCESS'],
                                        'MESSAGE_TEXT'                  => sprintf($user->lang['SITTINGS_SAVED'],$user->lang['AVATAR_SETTINGS']).back_link($u_action),
                                ));
        echo $template->fetch('admin/message_body.html');
        close_out();
}
        $sql = "SELECT * FROM `".$db_prefix."_shout_cast`";
        $res = $db->sql_query($sql);
        $cfgrow = $db->sql_fetchrow($res);
        $db->sql_freeresult($res);
    $hidden = build_hidden_fields(array(
    'do'    => 'save',
    ));
        $template->assign_vars(array(
                'S_FORM_TOKEN'      => $hidden,
                'L_TITLE'                   => $user->lang['TITLE'],
                'L_TITLE_EXPLAIN'           => $user->lang['TITLE_EXPLAIN'],
                'U_ACTION'                  => "./admin.php?i=&op=shout_cast",
                'SETTINGS'                  => true,
        ));
    drawRow("allow","text", false ,$user->lang['HEADER_SETTINGS']);
    drawRow("allow","checkbox");
    drawRow("ip","text");
    drawRow("port","text");
    drawRow("admin_name","text");
    drawRow("admin_pass","text");
    drawRow("host_dj","text");
echo $template->fetch('admin/acp_shout_cast.html');

?>