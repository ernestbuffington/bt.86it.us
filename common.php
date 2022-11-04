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
** File common.php 2022-11-02 00:00:00 Thor
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

/*Set error handling*/
if (!ini_get('display_errors'))
{
    @ini_set('error_reporting', E_ALL);
    @ini_set('display_errors', 1);
}
require_once("include/errors.php");
$old_error_handler = set_error_handler("myErrorHandler");
/*Set start time*/
$startpagetime = microtime(true);

if($_SERVER["PHP_SELF"] == '')$_SERVER["PHP_SELF"] = 'index.php';

if (!function_exists("sha1"))
    require_once("include/sha1lib.php");
/*if config file has not been loaded yet*/
require_once("include/config.php");
include_once('include/class.template.php');
require_once("include/actions.php");
require_once("include/user.functions.php");
include('include/auth.php');

if (is_banned($user, $reason) && !preg_match("/ban.php/",$_SERVER["PHP_SELF"]))
{
    redirect('ban.php?reson='.urlencode($reason));
    die();
}
//die($user->timezone);
if (!preg_match("/cron.php/",$_SERVER['PHP_SELF']))
{
    $auth = new auth();
    $auth->acl($user);

    if ($pivate_mode AND !$user->user AND !newuserpage($_SERVER["PHP_SELF"]))
    {
        $a = 0;
        $returnto = '';
        foreach ($_GET as $var=>$val)
        {
            $returnto .= "&$var=$val";
            $a++;
        }

        $i = strpos($returnto, "&return=");

        if ($i !== false)
        {
            $returnto = substr($returnto, $i + 8);
        }

        $pagename = substr($_SERVER["PHP_SELF"],strrpos($_SERVER["PHP_SELF"],"/")+1);
        $returnto ='?page=' . $pagename . $returnto;
        $template = new Template();
        set_site_var($user->lang['BT_ERROR']);
        meta_refresh(5, $siteurl . "/login.php$returnto");
        $template->assign_vars(array(
                                    'S_ERROR'   => true,
                                    'S_FORWARD' => false,
                                    'TITTLE_M'  => $user->lang['BT_ERROR'],
                                    'MESSAGE'   => $user->lang['LOGIN_SITE'],
                                ));

        echo $template->fetch('message_body.html');
        close_out();
    }

    if($user->user  && !preg_match("/httperror.php/",$_SERVER['PHP_SELF']) && !preg_match("/announce.php/",$_SERVER['PHP_SELF']) && !preg_match("/file.php/",$_SERVER['PHP_SELF']) && !preg_match("/ajax.php/",$_SERVER['PHP_SELF']))
    {
        $sql = "UPDATE ".$db_prefix."_users
                        SET lastip = '".sprintf("%u",ip2long($user->ip))."',
                        lastpage = '".$db->sql_escape(str_replace("/", '',substr($_SERVER['REQUEST_URI'],strrpos($_SERVER["REQUEST_URI"],"/")+1)))."',
                        lastlogin = NOW()
                        WHERE id = '".$user->id."'
                        LIMIT 1;";

        $db->sql_query($sql) or btsqlerror($sql);
    }
}
?>