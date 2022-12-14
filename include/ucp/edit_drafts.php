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
** File ucp/edit_drafts.php 2022-11-02 00:00:00 Thor
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

    $do                                     = request_var('do', '');
                switch($do) {
                            case "edit_take" :
                            {
                            $edit_id = request_var('edit_id', '');
                            if($edit_id == '') $error[] = $user->lang['INVALID_ID'];
                            $subject = request_var('subject', '');
                            if($subject == '') $error[] = $user->lang['ERR_NO_SUB'];
                            $message = request_var('message', '');
                            if($message == '') $error[] = $user->lang['ERR_NO_BODY'];
                            if (count($error) > 0){
                            $errmsg = "<p>".$user->lang['BT_ERROR']."</p>\n";
                            $errmsg .= "<ul>\n";
                                    foreach ($error as $msg) {
                                    $errmsg .= "<li><p>".$msg."</p></li>\n";
                                    }
                            $errmsg .= "</ul>\n";
                            }else $errmsg = '';
                            if($errmsg == '')
                            {
                                $subject = $db->sql_escape(stripslashes($subject));
                                $message = $db->sql_escape(stripslashes($message));
                                $sql = 'UPDATE `'.$db_prefix.'_drafts` SET `draft_subject` = \'' . $subject . '\', `draft_message` = \'' . $message . '\' WHERE `'.$db_prefix.'_drafts`.`draft_id` = ' . $edit_id . ' LIMIT 1;';
                                $db->sql_query($sql);
                            }
                            $template->assign_vars(array('ERROR' => $errmsg));
                            break;
                            }
                            case "edit_delete" :
                            {
                                $d                                     = request_var('d', array(0));
                                $hidden = '';
                                if(isset($d) && count($d) >=1){
                                    foreach($d as $key => $value)
                                    $hidden .= build_hidden_fields(array("d[".$key."]"  => 1));
                                }
                                $hidden .= build_hidden_fields(array(
                                "op"            => "editprofile",
                                "take_edit"     => "1",
                                "check"         => 1,
                                "action"        => 'overview',
                                "mode"          => 'drafts',
                                "delete"        => 1,
                                "do"            => "edit_delete"
                                ));
                            if(isset($check))$check=true;
                            else
                            $check = false;
                                        confirm_box($check, 'DELETE_DRAFT', $hidden,'confirm_body.html','');
                                if(!isset($d) OR !count($d) >=1)
                                {
                                $template->assign_vars(array('ERROR' => $user->lang['NO_DRAFTS_SET']));
                                break;
                                }
                                         foreach($d as $book=> $value){
                                         $db->sql_query("DELETE FROM ".$db_prefix."_drafts WHERE draft_id = '" . $book ."' AND user_id = '" . $uid ."' LIMIT 1");
                                         }
                                $template->assign_vars(array('ERROR' => ''));
                                break;
                            }
                }

?>