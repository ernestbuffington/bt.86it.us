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
** File files/filter.php 2022-11-02 00:00:00 Thor
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

$user->set_lang('admin/mcp_filter',$user->ulanguage);
        $page_title = $user->lang['INTRO'];
                $template->assign_vars(array(
                    'PAGE_TITLE'       => $page_title,
                ));
$is_edit = false;
$banedit_key = Array("keyword" => "", "reason" => "");
        $postback_client                    = request_var('postback_client', '');
        $id                                 = request_var('id', 0);
        $do                                 = request_var('do', '');
switch ($do) {

        case "addfilter": {

                        $keyword                    = request_var('keyword', '');
                        $whatfor                    = request_var('whatfor', '');
                $errors = Array();

                if (!$keyword) $errors[] = $user->lang['MISSING_KEYWORD'];

                if (!$whatfor) $errors[] = $user->lang['MISSING_REASON'];

                if (count($errors) > 0) {

                    $err = "<ul>\n";
                    foreach ($errors as $msg)
                    {
                        $err .= "<li>".$msg."</li>\n";
                    }
                    $err .= "</ul>\n";


                                $template->assign_vars(array(
                                            'S_MESSAGE'             => true,
                                            'S_USER_NOTICE'         => false,
                                            'MESSAGE_TITLE'         => $user->lang['BT_ERROR'],
                                            'MESSAGE_TEXT'          => $err,
                                            ));
                        break;

                }

                $keyword = strtolower($db->sql_escape($keyword));

                $whatfor = $db->sql_escape(htmlspecialchars(trim($whatfor)));

                if (!preg_match("/^[\w]{5,50}$/",$keyword)) $errors[] = $user->lang['BAD_KEY_WORD'];

                if (strlen($whatfor) > 255) $errors[] = $user->lang['BAD_REASON'];

                if (count($errors) > 0) {
                    $err = "<ul>\n";
                    foreach ($errors as $msg)
                    {
                        $err .= "<li>".$msg."</li>\n";
                    }
                    $err .= "</ul>\n";


                                $template->assign_vars(array(
                                            'S_MESSAGE'             => true,
                                            'S_USER_NOTICE'         => false,
                                            'MESSAGE_TITLE'         => $user->lang['BT_ERROR'],
                                            'MESSAGE_TEXT'          => $err,
                                            ));
                        break;

                }

                $sql = "INSERT INTO ".$db_prefix."_filter (keyword, reason) VALUES ('" . $keyword . "','" . $whatfor . "');";

                $db->sql_query($sql) or btsqlerror($sql);
                add_log('admin', 'LOG_FILTER_ADD', $keyword);
                                $template->assign_vars(array(
                                            'S_MESSAGE'             => true,
                                            'S_USER_NOTICE'         => true,
                                            'MESSAGE_TITLE'         => $user->lang['SUCCESS'],
                                            'MESSAGE_TEXT'          => $user->lang['KEYWORD_ADDED'],
                                            ));

                break;

        }

        case "editfilter": {

                if ($id AND is_numeric($id))
                {
                        $keyword                    = request_var('keyword', '');
                        $whatfor                    = request_var('whatfor', '');
                        if ($keyword AND $whatfor)
                        {

                                $sql = "UPDATE ".$db_prefix."_filter SET keyword = '".strtolower(escape($keyword))."', reason = '".htmlspecialchars(escape(trim($whatfor)))."' WHERE id = '".$id."'";

                                $db->sql_query($sql) or btsqlerror($sql);
                                add_log('admin', 'LOG_FILTER_EDIT', $keyword);
                                $template->assign_vars(array(
                                            'S_MESSAGE'             => true,
                                            'S_USER_NOTICE'         => true,
                                            'MESSAGE_TITLE'         => $user->lang['SUCCESS'],
                                            'MESSAGE_TEXT'          => $user->lang['KEYWORD_UPDATED'],
                                            ));

                        }
                        else
                        {
                            $sql = "SELECT * FROM ".$db_prefix."_filter WHERE id = '".$id."';";
                            if (!$res_edit = $db->sql_query($sql)) btsqlerror($sql);
                            if ($db->sql_numrows($res_edit) == 1)
                            {
                                $row = $db->sql_fetchrow($res_edit);
                                $db->sql_freeresult($res_edit);
                                $banedit_key["keyword"] = $row["keyword"];
                                $banedit_key["reason"] = $row["reason"];
                                $is_edit = true;
                                break;
                            }
                        }
                }
                break;
        }

        case "delfilter": {
                if ($id AND is_numeric($id)) {

                    $sql = 'SELECT keyword
                        FROM ' . $db_prefix . "_filter
                        WHERE id = $id";
                    $result = $db->sql_query($sql);
                    $deleted_word = $db->sql_fetchfield('keyword');
                    $db->sql_freeresult($result);
                $sql = "DELETE FROM ".$db_prefix."_filter WHERE id = '".intval($id)."'";

                $db->sql_query($sql) or btsqlerror($sql);
                    add_log('admin', 'LOG_FILTER_DELETE', $deleted_word);
                }

                                $template->assign_vars(array(
                                            'S_MESSAGE'             => true,
                                            'S_USER_NOTICE'         => true,
                                            'MESSAGE_TITLE'         => $user->lang['SUCCESS'],
                                            'MESSAGE_TEXT'          => $user->lang['KEYWORD_REMOVED'],
                                            ));
                break;

        }

}
$sql = "SELECT * FROM ".$db_prefix."_filter ORDER BY id ASC;";
$res = $db->sql_query($sql);
if ($db->sql_numrows($res) > 0) {
        while ($row = $db->sql_fetchrow($res)) {
            $template->assign_block_vars('kyewords', array(
                'KEYWORD'               => $row["keyword"],
                'WHATFOR'               => htmlspecialchars($row["reason"]),
                'ID'                            => $row["id"],
                ));
        }
}
$db->sql_freeresult($res);
if (!$is_edit)
{
    $hidden = array(
            'op'        => 'filter',
            'i'         => 'torrentinfo',
            "do"        => "addfilter"
            );
}
else
{
    $hidden = array(
            'op'        => 'filter',
            'i'         => 'torrentinfo',
            "do"        => "editfilter",
            "id"        => intval($id),
            );
}
                                $template->assign_vars(array(
                                'KEYWORD'       => $banedit_key["keyword"],
                                'WHATFOR'       => $banedit_key["reason"],
                                'HIDDEN'                => build_hidden_fields($hidden),
                                'U_ACTION'              => './admin.php',
                                ));
echo $template->fetch('admin/mcp_filter.html');
        close_out();

?>