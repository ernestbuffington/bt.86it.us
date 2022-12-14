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
** File include/auth.php 2022-11-02 00:00:00 Thor
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

class auth
{
    var $acl = array();
    var $cache = array();
    var $acl_options = array();
    var $acl_forum_ids = false;

    /**
    * Init permissions
    */
    function acl(&$userdata)
    {
        if(is_array($userdata))
        {
            $uperm_set = $userdata;
        }
        else
        {
            $uperm_set = array('id'=>$userdata->id,'user_type'=>$userdata->data['user_type'],'user_permissions'=>$userdata->user_permissions);
        }
        global $db, $db_prefix, $user, $pmbt_cache;

        $this->acl = $this->cache = $this->acl_options = array();
        $this->acl_forum_ids = false;

        if (($this->acl_options = $pmbt_cache->get('_acl_options')) === false)
        {

            //die();
            $sql = 'SELECT auth_option_id, auth_option, is_global, is_local
                FROM ' . $db_prefix . '_acl_options
                ORDER BY auth_option_id';
            $result = $db->sql_query($sql) or btsqlerror($sql);

            $global = $local = 0;
            $this->acl_options = array();
            while ($row = $db->sql_fetchrow($result))
            {
                if ($row['is_global'])
                {
                    $this->acl_options['global'][$row['auth_option']] = $global++;
                }

                if ($row['is_local'])
                {
                    $this->acl_options['local'][$row['auth_option']] = $local++;
                }

                $this->acl_options['id'][$row['auth_option']] = (int) $row['auth_option_id'];
                $this->acl_options['option'][(int) $row['auth_option_id']] = $row['auth_option'];
            }
            $db->sql_freeresult($result);

            $pmbt_cache->put('_acl_options', $this->acl_options);
        }

        if (!trim($uperm_set['user_permissions']))
        {
            $this->acl_cache($userdata);
        }

        // Fill ACL array
        $this->_fill_acl($uperm_set['user_permissions']);

        // Verify bitstring length with options provided...
        $renew = false;
        $global_length = sizeof($this->acl_options['global']);
        $local_length = sizeof($this->acl_options['local']);

        // Specify comparing length (bitstring is padded to 31 bits)
        $global_length = ($global_length % 31) ? ($global_length - ($global_length % 31) + 31) : $global_length;
        $local_length = ($local_length % 31) ? ($local_length - ($local_length % 31) + 31) : $local_length;

        // You thought we are finished now? Noooo... now compare them.
        foreach ($this->acl as $forum_id => $bitstring)
        {
            if (($forum_id && strlen($bitstring) != $local_length) || (!$forum_id && strlen($bitstring) != $global_length))
            {
                $renew = true;
                break;
            }
        }

        // If a bitstring within the list does not match the options, we have a user with incorrect permissions set and need to renew them
        if ($renew)
        {
            $this->acl_cache($userdata);
            $this->_fill_acl($uperm_set['user_permissions']);
        }

        return;
    }

    function _fill_acl($user_permissions)
    {
        $this->acl = array();
        $user_permissions = explode("\n", $user_permissions);

        foreach ($user_permissions as $f => $seq)
        {
            if ($seq)
            {
                $i = 0;

                if (!isset($this->acl[$f]))
                {
                    $this->acl[$f] = '';
                }

                while ($subseq = substr($seq, $i, 6))
                {
                    // We put the original bitstring into the acl array
                    $this->acl[$f] .= str_pad(base_convert($subseq, 36, 2), 31, 0, STR_PAD_LEFT);
                    $i += 6;
                }
            }
        }
    }
    function acl_get($opt, $f = 0)
    {
        $negate = false;

        if (strpos($opt, '!') === 0)
        {
            $negate = true;
            $opt = substr($opt, 1);
        }

        if (!isset($this->cache[$f][$opt]))
        {
            // We combine the global/local option with an OR because some options are global and local.
            // If the user has the global permission the local one is true too and vice versa
            $this->cache[$f][$opt] = false;

            // Is this option a global permission setting?
            if (isset($this->acl_options['global'][$opt]))
            {
                if (isset($this->acl[0]))
                {
                    $this->cache[$f][$opt] = $this->acl[0][$this->acl_options['global'][$opt]];
                }
            }

            // Is this option a local permission setting?
            // But if we check for a global option only, we won't combine the options...
            if ($f != 0 && isset($this->acl_options['local'][$opt]))
            {
                if (isset($this->acl[$f]) && isset($this->acl[$f][$this->acl_options['local'][$opt]]))
                {
                    $this->cache[$f][$opt] |= $this->acl[$f][$this->acl_options['local'][$opt]];
                }
            }
        }

        // Founder always has all global options set to true...
        return ($negate) ? !$this->cache[$f][$opt] : $this->cache[$f][$opt];
    }
    function acl_getf($opt, $clean = false)
    {
        $acl_f = array();
        $negate = false;

        if (strpos($opt, '!') === 0)
        {
            $negate = true;
            $opt = substr($opt, 1);
        }

        // If we retrieve a list of forums not having permissions in, we need to get every forum_id
        if ($negate)
        {
            if ($this->acl_forum_ids === false)
            {
                global $db, $db_prefix;

                $sql = 'SELECT forum_id
                    FROM ' . $db_prefix . '_forums';

                if (sizeof($this->acl))
                {
                    $sql .= ' WHERE ' . $db->sql_in_set('forum_id', array_keys($this->acl), true);
                }
                $result = $db->sql_query($sql) or btsqlerror($sql);

                $this->acl_forum_ids = array();
                while ($row = $db->sql_fetchrow($result))
                {
                    $this->acl_forum_ids[] = $row['forum_id'];
                }
                $db->sql_freeresult($result);
            }
        }

        if (isset($this->acl_options['local'][$opt]))
        {
            foreach ($this->acl as $f => $bitstring)
            {
                // Skip global settings
                if (!$f)
                {
                    continue;
                }

                $allowed = (!isset($this->cache[$f][$opt])) ? $this->acl_get($opt, $f) : $this->cache[$f][$opt];

                if (!$clean)
                {
                    $acl_f[$f][$opt] = ($negate) ? !$allowed : $allowed;
                }
                else
                {
                    if (($negate && !$allowed) || (!$negate && $allowed))
                    {
                        $acl_f[$f][$opt] = 1;
                    }
                }
            }
        }

        // If we get forum_ids not having this permission, we need to fill the remaining parts
        if ($negate && sizeof($this->acl_forum_ids))
        {
            foreach ($this->acl_forum_ids as $f)
            {
                $acl_f[$f][$opt] = 1;
            }
        }

        return $acl_f;
    }
    function acl_getf_global($opt)
    {
        if (is_array($opt))
        {
            // evaluates to true as soon as acl_getf_global is true for one option
            foreach ($opt as $check_option)
            {
                if ($this->acl_getf_global($check_option))
                {
                    return true;
                }
            }

            return false;
        }

        if (isset($this->acl_options['local'][$opt]))
        {
            foreach ($this->acl as $f => $bitstring)
            {
                // Skip global settings
                if (!$f)
                {
                    continue;
                }

                // as soon as the user has any permission we're done so return true
                if ((!isset($this->cache[$f][$opt])) ? $this->acl_get($opt, $f) : $this->cache[$f][$opt])
                {
                    return true;
                }
            }
        }
        else if (isset($this->acl_options['global'][$opt]))
        {
            return $this->acl_get($opt);
        }

        return false;
    }

    /**
    * Get permission settings (more than one)
    */
    function acl_gets()
    {
        $args = func_get_args();
        $f = array_pop($args);

        if (!is_numeric($f))
        {
            $args[] = $f;
            $f = 0;
        }

        // alternate syntax: acl_gets(array('m_', 'a_'), $forum_id)
        if (is_array($args[0]))
        {
            $args = $args[0];
        }

        $acl = 0;
        foreach ($args as $opt)
        {
            $acl |= $this->acl_get($opt, $f);
        }

        return $acl;
    }

    /**
    * Get permission listing based on user_id/options/forum_ids
    */
    function acl_get_list($user_id = false, $opts = false, $forum_id = false)
    {
        if ($user_id !== false && !is_array($user_id) && $opts === false && $forum_id === false)
        {
            $hold_ary = array($user_id => $this->acl_raw_data_single_user($user_id));
        }
        else
        {
            $hold_ary = $this->acl_raw_data($user_id, $opts, $forum_id);
        }

        $auth_ary = array();
        foreach ($hold_ary as $user_id => $forum_ary)
        {
            foreach ($forum_ary as $forum_id => $auth_option_ary)
            {
                foreach ($auth_option_ary as $auth_option => $auth_setting)
                {
                    if ($auth_setting)
                    {
                        $auth_ary[$forum_id][$auth_option][] = $user_id;
                    }
                }
            }
        }

        return $auth_ary;
    }

    /**
    * Cache data to user_permissions row
    */
    function acl_cache(&$userdata)
    {
        global $db, $db_prefix;

        // Empty user_permissions

        if(!is_array($userdata))$userdata->user_permissions = '';
        else
        $userdata['user_permissions'] = '';

        if(!is_array($userdata))$hold_ary = $this->acl_raw_data_single_user($userdata->id);
        else
        $hold_ary = $this->acl_raw_data_single_user($userdata['id']);

        // Key 0 in $hold_ary are global options, all others are forum_ids

        // If this user is founder we're going to force fill the admin options ...
        if ($userdata->user_type == 3)
        {
            foreach ($this->acl_options['global'] as $opt => $id)
            {
                if (strpos($opt, 'a_') === 0)
                {
                    $hold_ary[0][$this->acl_options['id'][$opt]] = 1;
                }
            }
        }

        $hold_str = $this->build_bitstring($hold_ary);

        if ($hold_str)
        {
        if(!is_array($userdata))
        {
            $userdata->user_permissions = $hold_str;
            $sql_in = $userdata->user_permissions;
            $sql_is = $userdata->id;
        }
        else
        {
            $userdata['user_permissions'] = $hold_str;
            $sql_in = $userdata['user_permissions'];
            $sql_is = $userdata['id'];
        }

            $sql = 'UPDATE ' .  $db_prefix . "_users
                SET user_permissions = '" . $db->sql_escape($sql_in) . "',
                    user_perm_from = 0
                WHERE id = " . $sql_is;
                //die($sql);
            $db->sql_query($sql);// or btsqlerror($sql);
        }

        return;
    }
    function build_bitstring(&$hold_ary)
    {
        $hold_str = '';

        if (sizeof($hold_ary))
        {
            ksort($hold_ary);

            $last_f = 0;

            foreach ($hold_ary as $f => $auth_ary)
            {
                $ary_key = (!$f) ? 'global' : 'local';

                $bitstring = array();
                foreach ($this->acl_options[$ary_key] as $opt => $id)
                {
                    if (isset($auth_ary[$this->acl_options['id'][$opt]]))
                    {
                        $bitstring[$id] = $auth_ary[$this->acl_options['id'][$opt]];

                        $option_key = substr($opt, 0, strpos($opt, '_') + 1);

                        // If one option is allowed, the global permission for this option has to be allowed too
                        // example: if the user has the a_ permission this means he has one or more a_* permissions
                        if ($auth_ary[$this->acl_options['id'][$opt]] == 1 && (!isset($bitstring[$this->acl_options[$ary_key][$option_key]]) || $bitstring[$this->acl_options[$ary_key][$option_key]] == 0))
                        {
                            $bitstring[$this->acl_options[$ary_key][$option_key]] = 1;
                        }
                    }
                    else
                    {
                        $bitstring[$id] = 0;
                    }
                }

                // Now this bitstring defines the permission setting for the current forum $f (or global setting)
                $bitstring = implode('', $bitstring);

                // The line number indicates the id, therefore we have to add empty lines for those ids not present
                $hold_str .= str_repeat("\n", $f - $last_f);

                // Convert bitstring for storage - we do not use binary/bytes because PHP's string functions are not fully binary safe
                for ($i = 0, $bit_length = strlen($bitstring); $i < $bit_length; $i += 31)
                {
                    $hold_str .= str_pad(base_convert(str_pad(substr($bitstring, $i, 31), 31, 0, STR_PAD_RIGHT), 2, 36), 6, 0, STR_PAD_LEFT);
                }

                $last_f = $f;
            }
            unset($bitstring);

            $hold_str = rtrim($hold_str);
        }

        return $hold_str;
    }
    function acl_clear_prefetch($user_id = false)
    {
        global $db, $db_prefix, $pmbt_cache;

        // Rebuild options cache
        $pmbt_cache->remove_file('_role_cache.php');

        $sql = 'SELECT *
            FROM ' . $db_prefix . '_acl_roles_data
            ORDER BY role_id ASC';
        $result = $db->sql_query($sql) or btsqlerror($sql);

        $this->role_cache = array();
        while ($row = $db->sql_fetchrow($result))
        {
            $this->role_cache[$row['role_id']][$row['auth_option_id']] = (int) $row['auth_setting'];
        }
        $db->sql_freeresult($result);

        foreach ($this->role_cache as $role_id => $role_options)
        {
            $this->role_cache[$role_id] = serialize($role_options);
        }

        $pmbt_cache->put('_role_cache', $this->role_cache);

        // Now empty user permissions
        $where_sql = '';

        if ($user_id !== false)
        {
            $user_id = (!is_array($user_id)) ? $user_id = array((int) $user_id) : array_map('intval', $user_id);
            if(!empty($user_id))
            {
                $where_sql = ' WHERE ' . $db->sql_in_set('id', $user_id);
            }
        }

        $sql = 'UPDATE ' .$db_prefix . "_users
            SET user_permissions = '',
                user_perm_from = 0
            $where_sql";
        $db->sql_query($sql) or btsqlerror($sql);

        return;
    }

    /**
    * Get assigned roles
    */
    function acl_role_data($user_type, $role_type, $ug_id = false, $forum_id = false)
    {
        global $db, $db_prefix;

        $roles = array();

        $sql_id = ($user_type == 'user') ? 'user_id' : 'group_id';

        $sql_ug = ($ug_id !== false) ? ((!is_array($ug_id)) ? "AND a.$sql_id = $ug_id" : 'AND ' . $db->sql_in_set("a.$sql_id", $ug_id)) : '';
        $sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? "AND a.forum_id = $forum_id" : 'AND ' . $db->sql_in_set('a.forum_id', $forum_id)) : '';

        // Grab assigned roles...
        $sql = 'SELECT a.auth_role_id, a.' . $sql_id . ', a.forum_id
            FROM ' . (($user_type == 'user') ? $db_prefix . '_acl_users' : $db_prefix . '_acl_groups') . ' a, ' . $db_prefix . "_acl_roles r
            WHERE a.auth_role_id = r.role_id
                AND r.role_type = '" . $db->sql_escape($role_type) . "'
                $sql_ug
                $sql_forum
            ORDER BY r.role_order ASC";
        $result = $db->sql_query($sql) or btsqlerror($sql);

        while ($row = $db->sql_fetchrow($result))
        {
            $roles[$row[$sql_id]][$row['forum_id']] = $row['auth_role_id'];
        }
        $db->sql_freeresult($result);

        return $roles;
    }

    /**
    * Get raw acl data based on user/option/forum
    */
    function acl_raw_data($user_id = false, $opts = false, $forum_id = false)
    {
        global $db, $db_prefix;

        $sql_user = ($user_id !== false) ? ((!is_array($user_id)) ? 'user_id = ' . (int) $user_id : $db->sql_in_set('user_id', array_map('intval', $user_id))) : '';
        $sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? 'AND a.forum_id = ' . (int) $forum_id : 'AND ' . $db->sql_in_set('a.forum_id', array_map('intval', $forum_id))) : '';

        $sql_opts = $sql_opts_select = $sql_opts_from = '';
        $hold_ary = array();

        if ($opts !== false)
        {
            $sql_opts_select = ', ao.auth_option';
            $sql_opts_from = ', ' . $db_prefix . '_acl_options ao';
            $this->build_auth_option_statement('ao.auth_option', $opts, $sql_opts);
        }

        $sql_ary = array();

        // Grab non-role settings - user-specific
        $sql_ary[] = 'SELECT a.user_id, a.forum_id, a.auth_setting, a.auth_option_id' . $sql_opts_select . '
            FROM ' . $db_prefix . '_acl_users a' . $sql_opts_from . '
            WHERE a.auth_role_id = 0 ' .
                (($sql_opts_from) ? 'AND a.auth_option_id = ao.auth_option_id ' : '') .
                (($sql_user) ? 'AND a.' . $sql_user : '') . "
                $sql_forum
                $sql_opts";

        // Now the role settings - user-specific
        $sql_ary[] = 'SELECT a.user_id, a.forum_id, r.auth_option_id, r.auth_setting, r.auth_option_id' . $sql_opts_select . '
            FROM ' . $db_prefix . '_acl_users a, ' . $db_prefix . '_acl_roles_data r' . $sql_opts_from . '
            WHERE a.auth_role_id = r.role_id ' .
                (($sql_opts_from) ? 'AND r.auth_option_id = ao.auth_option_id ' : '') .
                (($sql_user) ? 'AND a.' . $sql_user : '') . "
                $sql_forum
                $sql_opts";

        foreach ($sql_ary as $sql)
        {
            $result = $db->sql_query($sql) or btsqlerror($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $option = ($sql_opts_select) ? $row['auth_option'] : $this->acl_options['option'][$row['auth_option_id']];

                $hold_ary[$row['user_id']][$row['forum_id']][$option] = $row['auth_setting'];
            }
            $db->sql_freeresult($result);
        }

        $sql_ary = array();

        // Now grab group settings - non-role specific...
        $sql_ary[] = 'SELECT ug.user_id, a.forum_id, a.auth_setting, a.auth_option_id' . $sql_opts_select . '
            FROM ' . $db_prefix . '_acl_groups a, ' . $db_prefix . '_user_group ug' . $sql_opts_from . '
            WHERE a.auth_role_id = 0 ' .
                (($sql_opts_from) ? 'AND a.auth_option_id = ao.auth_option_id ' : '') . '
                AND a.group_id = ug.group_id
                AND ug.user_pending = 0
                ' . (($sql_user) ? 'AND ug.' . $sql_user : '') . "
                $sql_forum
                $sql_opts";

        // Now grab group settings - role specific...
        $sql_ary[] = 'SELECT ug.user_id, a.forum_id, r.auth_setting, r.auth_option_id' . $sql_opts_select . '
            FROM ' . $db_prefix . '_acl_groups a, ' . $db_prefix . '_user_group ug, ' . $db_prefix . '_acl_roles_data r' . $sql_opts_from . '
            WHERE a.auth_role_id = r.role_id ' .
                (($sql_opts_from) ? 'AND r.auth_option_id = ao.auth_option_id ' : '') . '
                AND a.group_id = ug.group_id
                AND ug.user_pending = 0
                ' . (($sql_user) ? 'AND ug.' . $sql_user : '') . "
                $sql_forum
                $sql_opts";

        foreach ($sql_ary as $sql)
        {
            $result = $db->sql_query($sql) or btsqlerror($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $option = ($sql_opts_select) ? $row['auth_option'] : $this->acl_options['option'][$row['auth_option_id']];

                if (!isset($hold_ary[$row['user_id']][$row['forum_id']][$option]) || (isset($hold_ary[$row['user_id']][$row['forum_id']][$option]) && $hold_ary[$row['user_id']][$row['forum_id']][$option] != 0))
                {
                    $hold_ary[$row['user_id']][$row['forum_id']][$option] = $row['auth_setting'];

                    // If we detect 0, we will unset the flag option (within building the bitstring it is correctly set again)
                    if ($row['auth_setting'] == 0)
                    {
                        $flag = substr($option, 0, strpos($option, '_') + 1);

                        if (isset($hold_ary[$row['user_id']][$row['forum_id']][$flag]) && $hold_ary[$row['user_id']][$row['forum_id']][$flag] == 1)
                        {
                            unset($hold_ary[$row['user_id']][$row['forum_id']][$flag]);

/*                          if (in_array(1, $hold_ary[$row['user_id']][$row['forum_id']]))
                            {
                                $hold_ary[$row['user_id']][$row['forum_id']][$flag] = 1;
                            }
*/
                        }
                    }
                }
            }
            $db->sql_freeresult($result);
        }

        return $hold_ary;
    }

    /**
    * Get raw user based permission settings
    */
    function acl_user_raw_data($user_id = false, $opts = false, $forum_id = false)
    {
        global $db, $db_prefix;

        $sql_user = ($user_id !== false) ? ((!is_array($user_id)) ? 'user_id = ' . (int) $user_id : $db->sql_in_set('user_id', array_map('intval', $user_id))) : '';
        $sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? 'AND a.forum_id = ' . (int) $forum_id : 'AND ' . $db->sql_in_set('a.forum_id', array_map('intval', $forum_id))) : '';

        $sql_opts = '';
        $hold_ary = $sql_ary = array();

        if ($opts !== false)
        {
            $this->build_auth_option_statement('ao.auth_option', $opts, $sql_opts);
        }

        // Grab user settings - non-role specific...
        $sql_ary[] = 'SELECT a.user_id, a.forum_id, a.auth_setting, a.auth_option_id, ao.auth_option
            FROM ' . $db_prefix . '_acl_users a, ' . $db_prefix . '_acl_options ao
            WHERE a.auth_role_id = 0
                AND a.auth_option_id = ao.auth_option_id ' .
                (($sql_user) ? 'AND a.' . $sql_user : '') . "
                $sql_forum
                $sql_opts
            ORDER BY a.forum_id, ao.auth_option";

        // Now the role settings - user-specific
        $sql_ary[] = 'SELECT a.user_id, a.forum_id, r.auth_option_id, r.auth_setting, r.auth_option_id, ao.auth_option
            FROM ' . $db_prefix . '_acl_users a, ' . $db_prefix . '_acl_roles_data r, ' . $db_prefix . '_acl_options ao
            WHERE a.auth_role_id = r.role_id
                AND r.auth_option_id = ao.auth_option_id ' .
                (($sql_user) ? 'AND a.' . $sql_user : '') . "
                $sql_forum
                $sql_opts
            ORDER BY a.forum_id, ao.auth_option";

        foreach ($sql_ary as $sql)
        {
            $result = $db->sql_query($sql) or btsqlerror($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $hold_ary[$row['user_id']][$row['forum_id']][$row['auth_option']] = $row['auth_setting'];
            }
            $db->sql_freeresult($result);
        }

        return $hold_ary;
    }

    /**
    * Get raw group based permission settings
    */
    function acl_group_raw_data($group_id = false, $opts = false, $forum_id = false)
    {
        global $db, $db_prefix;

        $sql_group = ($group_id !== false) ? ((!is_array($group_id)) ? 'group_id = ' . (int) $group_id : $db->sql_in_set('group_id', array_map('intval', $group_id))) : '';
        $sql_forum = ($forum_id !== false) ? ((!is_array($forum_id)) ? 'AND a.forum_id = ' . (int) $forum_id : 'AND ' . $db->sql_in_set('a.forum_id', array_map('intval', $forum_id))) : '';

        $sql_opts = '';
        $hold_ary = $sql_ary = array();

        if ($opts !== false)
        {
            $this->build_auth_option_statement('ao.auth_option', $opts, $sql_opts);
        }

        // Grab group settings - non-role specific...
        $sql_ary[] = 'SELECT a.group_id, a.forum_id, a.auth_setting, a.auth_option_id, ao.auth_option
            FROM ' . $db_prefix . '_acl_groups a, ' . $db_prefix . '_acl_options ao
            WHERE a.auth_role_id = 0
                AND a.auth_option_id = ao.auth_option_id ' .
                (($sql_group) ? 'AND a.' . $sql_group : '') . "
                $sql_forum
                $sql_opts
            ORDER BY a.forum_id, ao.auth_option";

        // Now grab group settings - role specific...
        $sql_ary[] = 'SELECT a.group_id, a.forum_id, r.auth_setting, r.auth_option_id, ao.auth_option
            FROM ' . $db_prefix . '_acl_groups a, ' . $db_prefix . '_acl_roles_data r, ' . $db_prefix . '_acl_options ao
            WHERE a.auth_role_id = r.role_id
                AND r.auth_option_id = ao.auth_option_id ' .
                (($sql_group) ? 'AND a.' . $sql_group : '') . "
                $sql_forum
                $sql_opts
            ORDER BY a.forum_id, ao.auth_option";

        foreach ($sql_ary as $sql)
        {
            $result = $db->sql_query($sql) or btsqlerror($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $hold_ary[$row['group_id']][$row['forum_id']][$row['auth_option']] = $row['auth_setting'];
            }
            $db->sql_freeresult($result);
        }

        return $hold_ary;
    }

    /**
    * Get raw acl data based on user for caching user_permissions
    * This function returns the same data as acl_raw_data(), but without the user id as the first key within the array.
    */
    function acl_raw_data_single_user($user_id)
    {
        global $db, $db_prefix, $pmbt_cache;

        // Check if the role-cache is there
        if (($this->role_cache = $pmbt_cache->get('_role_cache')) === false)
        {
            $this->role_cache = array();

            // We pre-fetch roles
            $sql = 'SELECT *
                FROM ' . $db_prefix . '_acl_roles_data
                ORDER BY role_id ASC';
            $result = $db->sql_query($sql) or btsqlerror($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $this->role_cache[$row['role_id']][$row['auth_option_id']] = (int) $row['auth_setting'];
            }
            $db->sql_freeresult($result);

            foreach ($this->role_cache as $role_id => $role_options)
            {
                $this->role_cache[$role_id] = serialize($role_options);
            }

            $pmbt_cache->put('_role_cache', $this->role_cache);
        }

        $hold_ary = array();

        // Grab user-specific permission settings
        $sql = 'SELECT forum_id, auth_option_id, auth_role_id, auth_setting
            FROM ' . $db_prefix . '_acl_users
            WHERE user_id = ' . $user_id;
        $result = $db->sql_query($sql) or btsqlerror($sql);

        while ($row = $db->sql_fetchrow($result))
        {
            // If a role is assigned, assign all options included within this role. Else, only set this one option.
            if ($row['auth_role_id'])
            {
                $hold_ary[$row['forum_id']] = (empty($hold_ary[$row['forum_id']])) ? unserialize($this->role_cache[$row['auth_role_id']]) : $hold_ary[$row['forum_id']] + unserialize($this->role_cache[$row['auth_role_id']]);
            }
            else
            {
                $hold_ary[$row['forum_id']][$row['auth_option_id']] = $row['auth_setting'];
            }
        }
        $db->sql_freeresult($result);

        // Now grab group-specific permission settings
        $sql = 'SELECT a.forum_id, a.auth_option_id, a.auth_role_id, a.auth_setting
            FROM ' . $db_prefix . '_acl_groups a, ' . $db_prefix . '_user_group ug
            WHERE a.group_id = ug.group_id
                AND ug.user_pending = 0
                AND ug.user_id = ' . $user_id;
        $result = $db->sql_query($sql) or btsqlerror($sql);

        while ($row = $db->sql_fetchrow($result))
        {
            if (!$row['auth_role_id'])
            {
                $this->_set_group_hold_ary($hold_ary[$row['forum_id']], $row['auth_option_id'], $row['auth_setting']);
            }
            else if (!empty($this->role_cache[$row['auth_role_id']]))
            {
                foreach (unserialize($this->role_cache[$row['auth_role_id']]) as $option_id => $setting)
                {
                    $this->_set_group_hold_ary($hold_ary[$row['forum_id']], $option_id, $setting);
                }
            }
        }
        $db->sql_freeresult($result);

        return $hold_ary;
    }

    /**
    * Private function snippet for setting a specific piece of the hold_ary
    */
    function _set_group_hold_ary(&$hold_ary, $option_id, $setting)
    {
        if (!isset($hold_ary[$option_id]) || (isset($hold_ary[$option_id]) && $hold_ary[$option_id] != 0))
        {
            $hold_ary[$option_id] = $setting;

            // If we detect 0, we will unset the flag option (within building the bitstring it is correctly set again)
            if ($setting == 0)
            {
                $flag = substr($this->acl_options['option'][$option_id], 0, strpos($this->acl_options['option'][$option_id], '_') + 1);
                $flag = (int) $this->acl_options['id'][$flag];

                if (isset($hold_ary[$flag]) && $hold_ary[$flag] == 1)
                {
                    unset($hold_ary[$flag]);

/*                  This is uncommented, because i suspect this being slightly wrong due to mixed permission classes being possible
                    if (in_array(1, $hold_ary))
                    {
                        $hold_ary[$flag] = 1;
                    }*/
                }
            }
        }
    }


    /**
    * Fill auth_option statement for later querying based on the supplied options
    */
    function build_auth_option_statement($key, $auth_options, &$sql_opts)
    {
        global $db, $db_prefix;

        if (!is_array($auth_options))
        {
            if (strpos($auth_options, '%') !== false)
            {
                $sql_opts = "AND $key " . $db->sql_like_expression(str_replace('%', $db->any_char, $auth_options));
            }
            else
            {
                $sql_opts = "AND $key = '" . $db->sql_escape($auth_options) . "'";
            }
        }
        else
        {
            $is_like_expression = false;

            foreach ($auth_options as $option)
            {
                if (strpos($option, '%') !== false)
                {
                    $is_like_expression = true;
                }
            }

            if (!$is_like_expression)
            {
                $sql_opts = 'AND ' . $db->sql_in_set($key, $auth_options);
            }
            else
            {
                $sql = array();

                foreach ($auth_options as $option)
                {
                    if (strpos($option, '%') !== false)
                    {
                        $sql[] = $key . ' ' . $db->sql_like_expression(str_replace('%', $db->any_char, $option));
                    }
                    else
                    {
                        $sql[] = $key . " = '" . $db->sql_escape($option) . "'";
                    }
                }

                $sql_opts = 'AND (' . implode(' OR ', $sql) . ')';
            }
        }
    }
}

?>