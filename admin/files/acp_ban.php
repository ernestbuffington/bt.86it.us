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
** File files/acp_ban.php 2018-09-26 08:23:00 Thor
**
** CHANGES
**
** 2022-11-02 - Updated Masthead, Github, !defined('IN_AN602')
**/

/**
* @ignore
*/
if (!defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

/**
* @package acp
*/
class acp_ban
{
    var $u_action;

    function main($id, $mode)
    {
        global $config, $db, $db_prefix, $user, $auth, $template, $cache;
        global $phpEx;

        include_once('include/user.functions.' . $phpEx);

        $bansubmit  = (isset($_POST['bansubmit'])) ? true : false;
        $unbansubmit = (isset($_POST['unbansubmit'])) ? true : false;
        $current_time = time();

        $this->tpl_name = 'acp_ban';
        $form_key = 'acp_ban';
        add_form_key($form_key);

        if (($bansubmit || $unbansubmit) && !check_form_key($form_key))
        {
            trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
        }

        // Ban submitted?
        if ($bansubmit)
        {
            // Grab the list of entries
            $ban                = utf8_normalize_nfc(request_var('ban', '', true));
            $ban_len            = request_var('banlength', 0);
            $ban_len_other      = request_var('banlengthother', '');
            $ban_exclude        = request_var('banexclude', 0);
            $ban_reason         = utf8_normalize_nfc(request_var('banreason', '', true));
            $ban_give_reason    = utf8_normalize_nfc(request_var('bangivereason', '', true));

            if ($ban)
            {
                user_ban($mode, $ban, $ban_len, $ban_len_other, $ban_exclude, $ban_reason, $ban_give_reason);

                trigger_error($user->lang['BAN_UPDATE_SUCCESSFUL'] . adm_back_link($this->u_action));
            }
        }
        else if ($unbansubmit)
        {
            $ban = request_var('unban', array(''));

            if ($ban)
            {
                user_unban($mode, $ban);

                trigger_error($user->lang['BAN_UPDATE_SUCCESSFUL'] . adm_back_link($this->u_action));
            }
        }

        // Define language vars
        $this->page_title = $user->lang[strtoupper($mode) . '_BAN'];

        $l_ban_explain = $user->lang[strtoupper($mode) . '_BAN_EXPLAIN'];
        $l_ban_exclude_explain = $user->lang[strtoupper($mode) . '_BAN_EXCLUDE_EXPLAIN'];
        $l_unban_title = $user->lang[strtoupper($mode) . '_UNBAN'];
        $l_unban_explain = $user->lang[strtoupper($mode) . '_UNBAN_EXPLAIN'];
        $l_no_ban_cell = $user->lang[strtoupper($mode) . '_NO_BANNED'];

        switch ($mode)
        {
            case 'user':
                $l_ban_cell = $user->lang['USERNAME'];
            break;

            case 'ip':
                $l_ban_cell = $user->lang['IP_HOSTNAME'];
            break;

            case 'email':
                $l_ban_cell = $user->lang['EMAIL'];
            break;
        }

        $this->display_ban_options($mode);

        $template->assign_vars(array(
            'L_TITLE'               => $this->page_title,
            'L_EXPLAIN'             => $l_ban_explain,
            'L_UNBAN_TITLE'         => $l_unban_title,
            'L_UNBAN_EXPLAIN'       => $l_unban_explain,
            'L_BAN_CELL'            => $l_ban_cell,
            'L_BAN_EXCLUDE_EXPLAIN' => $l_ban_exclude_explain,
            'L_NO_BAN_CELL'         => $l_no_ban_cell,

            'S_USERNAME_BAN'    => ($mode == 'user') ? true : false,

            'U_ACTION'          => $this->u_action,
            'U_FIND_USERNAME'   => append_sid("userfind_to_pm.$phpEx", 'mode=searchuser&amp;form=acp_ban&amp;field=ban'),
        ));
    }

    /**
    * Display ban options
    */
    function display_ban_options($mode)
    {
        global $user, $db, $template;

        // Ban length options
        $ban_end_text = array(0 => $user->lang['PERMANENT'], 30 => $user->lang['30_MINS'], 60 => $user->lang['1_HOUR'], 360 => $user->lang['6_HOURS'], 1440 => $user->lang['1_DAY'], 10080 => $user->lang['7_DAYS'], 20160 => $user->lang['2_WEEKS'], 40320 => $user->lang['1_MONTH'], -1 => $user->lang['UNTIL'] . ' -&gt; ');

        $ban_end_options = '';
        foreach ($ban_end_text as $length => $text)
        {
            $ban_end_options .= '<option value="' . $length . '">' . $text . '</option>';
        }

        switch ($mode)
        {
            case 'user':

                $field = 'username';
                $l_ban_cell = $user->lang['USERNAME'];

                $sql = 'SELECT b.*, u.user_id, u.username, u.username_clean
                    FROM ' . $db_prefix . '_bans b, ' . $db_prefix . '_users u
                    WHERE (b.ban_end >= ' . time() . '
                            OR b.ban_end = 0)
                        AND u.user_id = b.ban_userid
                    ORDER BY u.username_clean ASC';
            break;

            case 'ip':

                $field = 'ban_ip';
                $l_ban_cell = $user->lang['IP_HOSTNAME'];

                $sql = 'SELECT *
                    FROM ' . $db_prefix . '_bans
                    WHERE (ban_end >= ' . time() . "
                            OR ban_end = 0)
                        AND ban_ip <> ''
                    ORDER BY ban_ip";
            break;

            case 'email':

                $field = 'ban_email';
                $l_ban_cell = $user->lang['EMAIL'];

                $sql = 'SELECT *
                    FROM ' . $db_prefix . '_bans
                    WHERE (ban_end >= ' . time() . "
                            OR ban_end = 0)
                        AND ban_email <> ''
                    ORDER BY ban_email";
            break;
        }
        $result = $db->sql_query($sql);

        $banned_options = $excluded_options = array();
        $ban_length = $ban_reasons = $ban_give_reasons = array();

        while ($row = $db->sql_fetchrow($result))
        {
            $option = '<option value="' . $row['ban_id'] . '">' . $row[$field] . '</option>';

            if ($row['ban_exclude'])
            {
                $excluded_options[] = $option;
            }
            else
            {
                $banned_options[] = $option;
            }

            $time_length = ($row['ban_end']) ? ($row['ban_end'] - $row['ban_start']) / 60 : 0;

            if ($time_length == 0)
            {
                // Banned permanently
                $ban_length[$row['ban_id']] = $user->lang['PERMANENT'];
            }
            else if (isset($ban_end_text[$time_length]))
            {
                // Banned for a given duration
                $ban_length[$row['ban_id']] = sprintf($user->lang['BANNED_UNTIL_DURATION'], $ban_end_text[$time_length], $user->format_date($row['ban_end'], false, true));
            }
            else
            {
                // Banned until given date
                $ban_length[$row['ban_id']] = sprintf($user->lang['BANNED_UNTIL_DATE'], $user->format_date($row['ban_end'], false, true));
            }

            $ban_reasons[$row['ban_id']] = $row['ban_reason'];
            $ban_give_reasons[$row['ban_id']] = $row['ban_give_reason'];
        }
        $db->sql_freeresult($result);

        if (sizeof($ban_length))
        {
            foreach ($ban_length as $ban_id => $length)
            {
                $template->assign_block_vars('ban_length', array(
                    'BAN_ID'    => (int) $ban_id,
                    'LENGTH'    => $length,
                    'A_LENGTH'  => addslashes($length),
                ));
            }
        }

        if (sizeof($ban_reasons))
        {
            foreach ($ban_reasons as $ban_id => $reason)
            {
                $template->assign_block_vars('ban_reason', array(
                    'BAN_ID'    => $ban_id,
                    'REASON'    => $reason,
                    'A_REASON'  => addslashes($reason),
                ));
            }
        }

        if (sizeof($ban_give_reasons))
        {
            foreach ($ban_give_reasons as $ban_id => $reason)
            {
                $template->assign_block_vars('ban_give_reason', array(
                    'BAN_ID'    => $ban_id,
                    'REASON'    => $reason,
                    'A_REASON'  => addslashes($reason),
                ));
            }
        }

        $options = '';
        if ($excluded_options)
        {
            $options .= '<optgroup label="' . $user->lang['OPTIONS_EXCLUDED'] . '">';
            $options .= implode('', $excluded_options);
            $options .= '</optgroup>';
        }

        if ($banned_options)
        {
            $options .= '<optgroup label="' . $user->lang['OPTIONS_BANNED'] . '">';
            $options .= implode('', $banned_options);
            $options .= '</optgroup>';
        }

        $template->assign_vars(array(
            'S_BAN_END_OPTIONS' => $ban_end_options,
            'S_BANNED_OPTIONS'  => ($banned_options || $excluded_options) ? true : false,
            'BANNED_OPTIONS'    => $options,
        ));
    }
}

?>