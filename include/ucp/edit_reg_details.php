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
** File ucp/edit_reg_details.php 2022-11-02 00:00:00 Thor
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

include_once("include/utf/utf_tools.php");
$newpasswd                                      = request_var('newpasswd', '');
$newpasswdconf                                  = request_var('newpasswdconf', '');
$new_email                                      = request_var('new_email', '');
$email_confirm                                  = request_var('email_confirm', '');
$name                                           = request_var('name', '');
        //Check for new Password
        if (isset($newpasswd) AND $newpasswd != "") {
                //Make sure newpasswd and newpasswdconf match If not thow a error
                if ($newpasswd != $newpasswdconf) $errors[] = _btpasswnotsame;
                else {
                        $sqlfields[] = "password";
                        $sqlvalues[] = "'".md5($newpasswd)."'";
                }
        }
        //Process New user name
        if (!isset($name) OR $name == "") $name = "NULL";
        processinput("name",htmlspecialchars($name));
        //Process New user email
        if($allow_change_email && $new_email != $userrow["email"] && isset($new_email) && $new_email !='')
        {
            if(!is_email($new_email))
            {
                $errors[] = $user->lang['ERR_EMAIL_NOT_VALID'];
            }
            if ($new_email != $email_confirm)
            {
                $errors[] = $user->lang['EMAILS_NOT_MATCH'];
            }
            if (count($errors) > 0)
            {
            }
            else
            {
                include_once'include/class.email.php';
                $mail_key = RandomAlpha(32);
                processinput("newemail",$new_email);
                processinput("mail_key",$mail_key);
                #Send out new email comfermation
                require_once("include/class.email.php");
                include_once('include/function_messenger.php');
                include_once("include/utf/utf_tools.php");
                        $messenger = new messenger();
                        $messenger->template('emailchange', $user->ulanguage);
                        $messenger->to($new_email);
                        $messenger->assign_vars(array(
                                    'SUB_JECT'      =>  sprintf($user->lang['CONFERM_EMAIL_SUB'],$sitename),
                                    'U_ID'          =>  $uid,
                                    'MAIL_KEY'      =>  $mail_key,
                                    ));
                        $messenger->send(0);
                        $messenger->save_queue();
            }
        }
        if (count($errors) > 0){
                $msg = "<p>".$user->lang['ALERT_ERROR']."</p>\n";
                $msg .= "<ul>\n";
                foreach ($errors as $msge) {
                        $msg .= "<li><p>".$msge."</p></li>\n";
                }
                $msg .= "</ul>\n";

                      set_site_var('- '.$user->lang['USER_CPANNEL'].' - '.$user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR_HEADER'          => $user->lang['EDIT_PROFILE'],
                                        'S_ERROR_MESS'            => $msg,
                                ));
                echo $template->fetch('error.html');
                close_out();
             }
                $sql = "UPDATE ".$db_prefix."_users SET ";
                for ($i = 0; $i < count($sqlfields); $i++) $sql .= $sqlfields[$i] ." = ".$sqlvalues[$i].", ";
                $sql .= "act_key = ".(($admin_mode) ? "act_key" : "'".RandomAlpha(32)."'")." WHERE id = '".$uid."';"; //useless but needed to terminate SQL without a comma
                //echo $sql;
                //die();
                if (!$db->sql_query($sql)) btsqlerror($sql);
                if (!$admin_mode) userlogin($uname,$btuser); //SQL is executed, cookie is invalid and getusername() function returns nothing, so it must be called earlier
                                $template->assign_vars(array(
                                        'S_REFRESH'             => true,
                                        'META'                  => '<meta http-equiv="refresh" content="5;url=' . $siteurl . '/user.php?op=editprofile' . ((!$admin_mode) ? '' : "&amp;id=" .$uid  ) . '&amp;action=profile&amp;mode=reg_details" />',
                                        'S_ERROR_HEADER'        =>$user->lang['UPDATED'],
                                        'S_ERROR_MESS'          => $user->lang['PROFILE_UPDATED'],
                                ));
                //trigger_error($message);
                echo $template->fetch('error.html');
                die();

?>