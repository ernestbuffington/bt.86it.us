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
** File files/acp_asettings_bbcodercade.php 2022-11-02 00:00:00 Thor
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

        $sql = 'SELECT * FROM `'.$db_prefix.'_settings`';
        $avres = $db->sql_query($sql) or btsqlerror($avsql);
        $cfgrow = array();
        while($adv_sett = $db->sql_fetchrow($avres))$cfgrow[$adv_sett['config_name']] = $adv_sett['config_value'] ;
    $do             = request_var('do', '');
    if(isset($do) && $do == "save")
    {
        $new_config = array();
        foreach($new_config as $key => $value)
        {
                        set_config($config_name, $config_value);

            $db->sql_query('UPDATE ' . $db_prefix . '_settings SET config_value = \'' . $value . "' WHERE config_name = '" . $key . "' LIMIT 1;")or mysql_error();
        }
                                $template->assign_vars(array(
                                        'S_SUCCESS'            => true,
                                        'S_FORWARD'         => $siteurl."/admin.php?i=siteinfo&op=sig_settings",
                                        'TITTLE_M'          => $user->lang['SUCCESS'],
                                        'MESSAGE'            => $user->lang['_admsaved'],
                                ));
        echo $template->fetch('message_body.html');
        die();
    }
                $hidden = build_hidden_fields(array(
                            'do'        => 'save',
                            'i'         => 'siteinfo',
                            'op'        => 'sig_settings',
                        ));
                $template->assign_vars(array(
                'L_TITLE'                   => $user->lang['MENU_SIG_SETTINGS'],
                'L_TITLE_EXPLAIN'           => $user->lang['MENU_SIG_SETTINGS_EXP'],
                'U_ACTION'                  => "./admin.php",
                'S_FORM_TOKEN'          => $hidden,
                ));
echo $template->fetch('admin/site_settings.html');
        close_out();

?>