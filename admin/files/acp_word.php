<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor
** File files/acp_word.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

/**
* @todo [words] check regular expressions for special char replacements (stored specialchared in db)
* @package acp
*/
class acp_words
{
    var $u_action;

    function main($id, $mode)
    {
        global $db, $db_prefix,$user, $auth, $template, $pmbt_cache;
        global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

        //$user->set_lang('admin/posting');

        // Set up general vars
        $action = request_var('action', '');
        $action_b = request_var('action_b', '');
        $action = (isset($_POST['add_words'])) ? 'add' : ((isset($_POST['save_words'])) ? 'save' : $action);
        if($action == 'words')$action = $action_b;

        $s_hidden_fields = '';
        $word_info = array();

        $this->tpl_name = 'acp_words';
        $this->page_title = 'ACP_WORDS';

        $form_name = 'acp_words';
        add_form_key($form_name);

        $template->assign_vars(array(
                    'ICON_EDIT' => $user->img('icon_edit', 'EDIT'),
                    'ICON_DELETE'   => $user->img('icon_delete', 'DELETE'),
        ));
        switch ($action)
        {
            case 'edit':

                $word_id = request_var('id', 0);

                if (!$word_id)
                {
                    trigger_error($user->lang['NO_WORD'] . adm_back_link($this->u_action), E_USER_WARNING);
                }

                $sql = 'SELECT *
                    FROM ' . $db_prefix . "_words
                    WHERE word_id = $word_id";
                $result = $db->sql_query($sql);
                $word_info = $db->sql_fetchrow($result);
                $db->sql_freeresult($result);

                $s_hidden_fields .= '<input type="hidden" name="id" value="' . $word_id . '" />';

            case 'add':

                $template->assign_vars(array(
                    'S_EDIT_WORD'       => true,
                    'U_ACTION'          => $this->u_action,
                    'U_BACK'            => $this->u_action,
                    'WORD'              => (isset($word_info['word'])) ? $word_info['word'] : '',
                    'REPLACEMENT'       => (isset($word_info['replacement'])) ? $word_info['replacement'] : '',
                    'S_HIDDEN_FIELDS'   => $s_hidden_fields)
                );

                return;

            break;

            case 'save':

                if (!check_form_key($form_name))
                {
                    trigger_error($user->lang['FORM_INVALID']. adm_back_link($this->u_action), E_USER_WARNING);
                }

                $word_id        = request_var('id', 0);
                $word           = utf8_normalize_nfc(request_var('word', '', true));
                $replacement    = utf8_normalize_nfc(request_var('replacement', '', true));

                if ($word === '' || $replacement === '')
                {
                    trigger_error($user->lang['ENTER_WORD'] . adm_back_link($this->u_action), E_USER_WARNING);
                }

                // Replace multiple consecutive asterisks with single one as those are not needed
                $word = preg_replace('#\*{2,}#', '*', $word);

                $sql_ary = array(
                    'word'          => $word,
                    'replacement'   => $replacement
                );

                if ($word_id)
                {
                    $db->sql_query('UPDATE ' . $db_prefix . '_words SET ' . $db->sql_build_array('UPDATE', $sql_ary) . ' WHERE word_id = ' . $word_id);
                }
                else
                {
                    $db->sql_query('INSERT INTO ' . $db_prefix . '_words ' . $db->sql_build_array('INSERT', $sql_ary));
                }

                $pmbt_cache->remove_file('_word_censors.php');

                $log_action = ($word_id) ? 'LOG_WORD_EDIT' : 'LOG_WORD_ADD';
                add_log('admin', $log_action, $word);

                $message = ($word_id) ? $user->lang['WORD_UPDATED'] : $user->lang['WORD_ADDED'];
                trigger_error($message . adm_back_link($this->u_action));

            break;

            case 'delete':

                $word_id = request_var('id', 0);

                if (!$word_id)
                {
                    trigger_error($user->lang['NO_WORD'] . adm_back_link($this->u_action), E_USER_WARNING);
                }

                if (confirm_box(true))
                {
                    $sql = 'SELECT word
                        FROM ' . $db_prefix . "_words
                        WHERE word_id = $word_id";
                    $result = $db->sql_query($sql);
                    $deleted_word = $db->sql_fetchfield('word');
                    $db->sql_freeresult($result);

                    $sql = 'DELETE FROM ' . $db_prefix . "_words
                        WHERE word_id = $word_id";
                    $db->sql_query($sql);

                    $pmbt_cache->remove_file('_word_censors.php');

                    add_log('admin', 'LOG_WORD_DELETE', $deleted_word);

                    trigger_error($user->lang['WORD_REMOVED'] . adm_back_link($this->u_action));
                }
                else
                {
                    confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
                        'i'         => 'siteinfo',
                        'op'        => 'setting_forum_conf',
                        'mode'      => $mode,
                        'id'        => $word_id,
                        'action'    => 'words',
                        'action_b'  => 'delete',
                    )));
                }

            break;
        }


        $template->assign_vars(array(
            'U_ACTION'          => $this->u_action,
            'S_HIDDEN_FIELDS'   => $s_hidden_fields)
        );

        $sql = 'SELECT *
            FROM ' . $db_prefix . '_words
            ORDER BY word';
        $result = $db->sql_query($sql);

        while ($row = $db->sql_fetchrow($result))
        {
            $template->assign_block_vars('words', array(
                'WORD'          => $row['word'],
                'REPLACEMENT'   => $row['replacement'],
                'U_EDIT'        => $this->u_action . '&amp;action_b=edit&amp;id=' . $row['word_id'],
                'U_DELETE'      => $this->u_action . '&amp;action_b=delete&amp;id=' . $row['word_id'])
            );
        }
        $db->sql_freeresult($result);
    }
}

?>