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
** File ucp/edit_profile_info.php 2022-11-02 00:00:00 Thor
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

        $country = request_var('country','0');
        $aim = request_var('aim','');
        $icq = request_var('icq','');
        $msn = request_var('msn','');
        $skype = request_var('skype','');
        $yahoo = request_var('yahoo','');
        $jabber = request_var('jabber','');
        if (!isset($aim) OR $aim == "") $aim = "NULL";
        processinput("aim",$aim);
        if (!isset($icq) OR $icq == "") $icq = "NULL";
        processinput("icq",$icq);
        if (!isset($jabber) OR $jabber == "") $jabber = "NULL";
        processinput("jabber",$jabber);
if ($config['allow_birthdays'])
{
        $bday_day = request_var('bday_day','');
        $bday_month = request_var('bday_month','');
        $bday_year = request_var('bday_year','');
        if (!isset($bday_day) OR $bday_day =='--' OR !isset($bday_month) OR $bday_month == "--" OR !isset($bday_year) OR $bday_year == "--") $birthday = "NULL";
        else
        $birthday = $bday_day.'-'.$bday_month.'-'.$bday_year;
        processinput("birthday",$birthday);
}
if (!isset($msn) OR $msn == "") $msn = "NULL";
        processinput("msn",$msn);
        if (!isset($skype) OR $skype == "") $skype = "NULL";
        processinput("skype",$skype);
        if (!isset($yahoo) OR $yahoo == "") $yahoo = "NULL";
        processinput("yahoo",$yahoo);
        processinput("country",$country);
                $sql = "UPDATE ".$db_prefix."_users SET ";
                for ($i = 0; $i < count($sqlfields); $i++) $sql .= $sqlfields[$i] ." = ".$sqlvalues[$i].", ";
                $sql .= "act_key = ".(($admin_mode) ? "act_key" : "'".RandomAlpha(32)."'")." WHERE id = '".$uid."';"; //useless but needed to terminate SQL without a comma
                //echo $sql;
                //die();
                if (!$db->sql_query($sql)) btsqlerror($sql);
                if (!$admin_mode) userlogin($uname,$btuser); //SQL is executed, cookie is invalid and getusername() function returns nothing, so it must be called earlier
                                $template->assign_vars(array(
                                        'S_REFRESH'             => true,
                                        'META'                  => '<meta http-equiv="refresh" content="5;url=' . $siteurl . '/user.php?op=editprofile' . ((!$admin_mode) ? '' : "&amp;id=" .$uid  ) . '&amp;action=profile&amp;mode=profile_info" />',
                                        'S_ERROR_HEADER'        =>$user->lang['UPDATED'],
                                        'S_ERROR_MESS'          => $user->lang['PROFILE_UPDATED'],
                                ));
                //trigger_error($message);
                echo $template->fetch('error.html');
                die();

?>