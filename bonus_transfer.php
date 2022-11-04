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
** File bonus_transfer.php 2022-11-02 00:00:00 Thor
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
else
{
    define("IN_AN602",true);
}
require_once("common.php");
$user->set_lang('profile',$user->ulanguage);
$template = new Template();
set_site_var($user->lang['BONUS_TRAN_TITTLE']);
if(!$user->user || $user->id==0)loginrequired("user", true);
$action = request_var('do', '');
if($action)
{
    switch ($action)
    {
        case 'take_trans':
            $iduser=$_GET["iduser"];
            $sql="SELECT * FROM ".$db_prefix."_users WHERE id ='$iduser';";
            $res = $db->sql_query($sql)or btsqlerror($sql);
            $rowuser=$db->sql_fetchrow($res);
            $username   = request_var('username', '');
            $bonus  = 0 + request_var('bonus', '0');
            //die($username);
            $why    = request_var('why', '');
            $anonym = request_var('anonym', '');
            $error = array();
            if($username=="")$error[] = $user->lang['NO_NAME_SET'];
            if($why=="")$error[] = $user->lang['NO_REASON_GIVEN'];
            if ($bonus <=0)$error[] = $user->lang['ERROR_NOT_NUMBER'];
            if($bonus > $user->seedbonus)$error[] = $user->lang['BONUS_TRAN_TO_MUCH'];
            if($user->name == $username || $user->nick == $username)$error[] = $user->lang['BONUS_TO_SELF'];
            $kapo2 = getuser($username);
            $kuldo = $user->id;
            if ($kapo2 <= 0)$error[] = $user->lang['NO_SUCH_USER'] . " " . $username;
            if (count($error) > 0){
                $template->assign_vars(array(
                    'S_NOTICE'          => true,
                    'S_ERROR'           => true,
                    'L_MESSAGE'         => $user->lang['BT_ERROR'],
                    'S_ERROR_MESS'          => implode("<br />",$error),
                ));
            break;
             }
             //die($anonym);
            $db->sql_query("UPDATE ".$db_prefix."_users SET seedbonus = seedbonus + $bonus WHERE id = '$kapo2'") or sqlerr(__FILE__, __LINE__);
            $db->sql_query("UPDATE ".$db_prefix."_users SET seedbonus = seedbonus - $bonus WHERE id = '$kuldo'") or sqlerr(__FILE__, __LINE__);
            include_once('include/function_posting.php');
            if(!$why)$why=$user->lang['NO_REASON_GIVEN'];
            if ($anonym != 'anonym') {
                //pm message text here
                $from = true;
                $msg = sprintf($user->lang['BONUS_TRANSFER_PM'],$user->name,$bonus,$why);
            }else{
                $from = false;
                $msg = sprintf($user->lang['BONUS_TRANSFER_PM'],$user->lang['UNKNOWN'],$bonus,$why);
            }
            system_pm($msg,$user->lang['BONUS_TRANSFER_PM_SUB'],$kapo2,0,$from);
                $template->assign_vars(array(
                    'S_NOTICE'          => true,
                    'S_ERROR'           => false,
                    'L_MESSAGE'         => $user->lang['SUCCESS'],
                    'S_ERROR_MESS'      => sprintf($user->lang['BONUS_TRANSFERD'],$username),
                ));
        break;
    }
}
                $template->assign_vars(array(
                    'L_TITTLE'          =>  $user->lang['BONUS_TRAN_TITTLE'],
                    'L_TITTLE_EXP'      =>  $user->lang['BONUS_TRAN_TITTLE_EXP'],
                    'ACTION'            =>  'donate_bonus',
                    'U_ACTION'          =>  './bonus_transfer.' . $phpEx,
                    'HIDDEN'            =>  build_hidden_fields(array('do'=>'take_trans')),
                ));
            echo $template->fetch('ucp_bonus.html');
            close_out();

?>