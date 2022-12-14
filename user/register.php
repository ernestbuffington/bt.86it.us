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
** File register.php 2022-11-02 00:00:00 Thor
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

require_once("common.php");
require_once("include/recaptchalib.php");
$user->set_lang('profile',$user->ulanguage);
$template = new Template();
set_site_var($user->lang['REGISTOR']);
$sql=("SELECT COUNT(*) FROM ".$db_prefix."_users");
$res = $db->sql_query($sql) or btsqlerror($sql);
$arr = $db->sql_fetchrow($res);
if ($arr[0] >= $invites1)
{
                $template->assign_vars(array(
                    'S_ERROR'           => true,
                    'S_FORWARD'         => false,
                    'TITTLE_M'          => $user->lang['ERROR_LIMMET_REACHED'],
                    'MESSAGE'           => sprintf($user->lang['SIGNUP_LIMMET_REACHED'],$invites1),
                ));
                echo $template->fetch('message_body.html');
                close_out();
}

if($singup_open)
{
                $template->assign_vars(array(
                    'S_ERROR'           => true,
                    'S_FORWARD'         => false,
                    'TITTLE_M'          => $user->lang['BT_ERROR'],
                    'MESSAGE'           => $user->lang['SIGNUPS_CLOSED'],
                ));
                echo $template->fetch('message_body.html');
                close_out();
}
$hide = array('op' => 'takeregister');
if ($gfx_check) {
                    if($recap_puplic_key)
                    {
                               $template->assign_vars(array(
                                        'META'                      => "<script src='https://www.google.com/recaptcha/api.js'></script>",
                                        'RECAPTCHA'                 =>  $recap_puplic_key,
                                ));
                        $gfximage = recaptcha_get_html($recap_puplic_key, null, $recap_https);
                    }else{
                        $rnd_code = strtoupper(RandomAlpha(5));
                        $hide ['gfxcheck'] = md5($rnd_code);
                        $gfximage = "<img src=\"gfxgen.php?code=".base64_encode($rnd_code)."\">";
                    }
        $template->assign_vars(array(
                'GFX_CODE'          => $gfximage,
                'S_CAPTCHA'         => true,
        ));
}
if ($disclaimer_check) {
        $disclaimer = "";
        if (is_readable("disclaimer/".$language.".txt")) {
                $fp = fopen("disclaimer/".$language.".txt","r");
                while (!feof($fp)) $disclaimer.= fread($fp,1000);
        } else {
                $fp = fopen("disclaimer/english.txt","r");
                while (!feof($fp)) $disclaimer.= fread($fp,1000);
        }
        fclose($fp);
        $search = Array("*MYBT*","*URL*","*EMAIL*");
        $replace = Array($sitename,$siteurl,spellmail($admin_email));
        $template->assign_vars(array(
                'U_DISCLAIMER'          => str_replace($search,$replace,$disclaimer),
                'S_DISCLAIMER'          => true,
        ));
}
        $template->assign_vars(array(
                'U_ACTION'          => './user.php',
                'HIDDEN'            => build_hidden_fields($hide),
					'L_NAME_CHARS_EXPLAIN'		=> sprintf($user->lang[$config['allow_name_chars'] . '_EXPLAIN'],$config['min_name_chars'],$config['max_name_chars']),
					'L_CHANGE_PASSWORD_EXPLAIN'	=> sprintf($user->lang[$config['pass_complex'] . '_EXPLAIN'], $config['min_pass_chars'],$config['max_pass_chars']),
        ));
echo $template->fetch('ucp_signup.html');
close_out();

?>