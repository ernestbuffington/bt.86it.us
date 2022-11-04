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
** File files/irc.php 2022-11-02 00:00:00 Thor
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

$user->set_lang('admin/acp_irc',$user->ulanguage);
        $postback   = request_var('postback', '');
        $u_action   = 'admin.php';

$linebreak = (PHP_OS == "WIN") ? "\r\n" : "\n";
if ($postback) {
        $edit       = request_var('edit', '');
        $server     = request_var('server', '');
        $channel    = request_var('channel', '');
        $advanced   = request_var('advanced', '');
        $delete     = request_var('delete', '');
        if ($edit) {
                $errmsg = array();
                if (!preg_match("/^[a-z][a-z0-9:._-]*$/",$server) AND !preg_match("/^(\d{1,3}\.){3}\d{1,3}$/",$server)) $errmsg[] = $user->lang['IRC_INVALID_HOST'];
                if (!preg_match("/#[a-zA-Z0-9_-]*$/",$channel)) $errmsg[] = $user->lang['IRC_INVALID_CHANNEL'];
                if (!empty($advanced) AND !preg_match("/^[a-z0-9:_]* = [^\"\\t\\r\\n]*$/im", $advanced)) $errmsg[] = $user->lang['IRC_INVALID_SYNTAX'];

                if (count($errmsg) > 0)
                {
        $report = '<ul>';
                foreach ($errmsg as $msg) {
                        $report .= sprintf($user->lang['ERR_ARRAY_MESS'], $msg);
                }
        $report .= '</ul>';
        $template->assign_vars(array(
        'S_ERROR_HEADER'        => $user->lang['ERROR'],
        'S_ERROR_MESS'      => $report,
        ));
        echo $template->fetch('error.html');
        close_out();
                }

                $buffer = "server = ".$server.$linebreak."channel = ".$channel.$linebreak.$advanced;
                @unlink("include/irc.ini");
                @$fp = fopen("include/irc.ini","w");
                if ($fp) {
                        @fputs($fp,$buffer);
                        @fclose($fp);
                } else {
        $template->assign_vars(array(
        'S_ERROR_HEADER'        => $user->lang['ERROR'],
        'S_ERROR_MESS'      => sprintf($user->lang['IRC_WRIET_PROT_SAVE'],nl2br($buffer)),
        ));
        echo $template->fetch('error.html');
        close_out();
                }
        }
        elseif ($delete AND file_exists("include/irc.ini")) {
                if (!@unlink("include/irc.ini"))
                {
                    $template->assign_vars(array(
                    'S_ERROR_HEADER'        => $user->lang['ERROR'],
                    'S_ERROR_MESS'      => $user->lang['IRC_WRIET_PROT'],
                    ));
                    echo $template->fetch('error.html');
                    close_out();
                }
        }
                                $template->assign_vars(array(
                                        'S_SUCCESS'            => true,
                                        'S_FORWARD'         => $siteurl."/admin.php?i=siteinfo&op=irc",
                                        'TITTLE_M'          => $user->lang['IRC_INTRO'],
                                        'MESSAGE'            => $user->lang['SAVED_SET'],
                                ));
        echo $template->fetch('message_body.html');
        close_out();
}

if (file_exists("include/irc.ini")) {
        $irc_enabled = true;
        $ircconfig = parse_ini_file("include/irc.ini");
} else {
        $irc_enabled = false;
        $ircconfig = Array("server" => "", "channel" => "#");
}

$advsettings = "";
foreach ($ircconfig as $key => $val) {
        if ($key == "server" OR $key == "channel") continue;

        $advsettings .= $key." = ".$val.$linebreak;
}
    $hidden = build_hidden_fields(array(
    'postback'  => '1',
    "i"         => 'siteinfo',
    "op"        => 'irc',
    ));
    $template->assign_vars(array(
    'U_ACTION'              => $u_action,
    'HIDEN'                 => $hidden,
    'S_SERVER'              => $ircconfig["server"],
    'S_CHANNEL'             => $ircconfig["channel"],
    'S_ADVANCED'            => $advsettings,
    'ENABL_APLY'            => ((!$irc_enabled) ? $user->lang['IRC_ENABLE'] : $user->lang['APPLY_SETTINGS'] ),
    'IRCENABLED'            => $irc_enabled,
    ));
echo $template->fetch('admin/acp_irc.html');
        close_out();

?>