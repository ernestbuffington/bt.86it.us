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
** File files/webupdate.php 2022-11-02 00:00:00 Thor
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

$user->set_lang('admin/acp_webupdate',$user->ulanguage);
$serverurl = "https://an602.86it.us";
$u_action = 'admin.php?i=siteinfo&op=webupdate';

do {
        if (! $ver = @file_get_contents($serverurl."/version")) {
            $template->assign_vars(array(
            'S_VERSION_CHECK'   => false,
            ));
                break;
        }
        $announcement = @file_get_contents($serverurl."/admmessage");
        //echo $announcement;
        $announcement = explode("\n", $announcement);
        $latest_version = trim($ver);
        $announcement_url = trim($announcement[1]);
        $announcement_url = (strpos($siteurl.'/', '&amp;') === false) ? str_replace('&', '&amp;', $announcement_url) : $announcement_url;
        $update_link = append_sid($siteurl.'/setup/index.' . $phpEx, 'mode=update');
        $next_feature_version = $next_feature_announcement_url = false;
        $up_to_date_automatic = (version_compare(str_replace('rc', 'RC', strtolower($version)), str_replace('rc', 'RC', strtolower($latest_version)), '<')) ? false : true;
        $up_to_date = (version_compare(str_replace('rc', 'RC', strtolower($version)), str_replace('rc', 'RC', strtolower($latest_version)), '<')) ? false : true;
        if (isset($announcement[0]) && trim($announcement[0]) !== '')
        {
            $next_feature_version = trim($announcement[0]);
            $next_feature_announcement_url = trim($announcement[1]);
        }
            $template->assign_vars(array(
            'S_UP_TO_DATE'      => $up_to_date,
            'S_UP_TO_DATE_AUTO' => $up_to_date_automatic,
            'S_VERSION_CHECK'   => true,
            'U_ACTION'          => $u_action,
            'U_VERSIONCHECK_FORCE' => append_sid($u_action . '&amp;versioncheck_force=1'),

            'LATEST_VERSION'    => $latest_version,
            'CURRENT_VERSION'   => $version,
            'AUTO_VERSION'      => $version_update_from,
            'NEXT_FEATURE_VERSION'  => $next_feature_version,

            'UPDATE_INSTRUCTIONS'   => sprintf($user->lang['UPDATE_INSTRUCTIONS'], $announcement_url, $update_link),
            'UPGRADE_INSTRUCTIONS'  => $next_feature_version ? $user->lang('UPGRADE_INSTRUCTIONS', $next_feature_version, $next_feature_announcement_url) : false,
            ));

} while (false);
$pmbt_cache->put('source_version',array('LATEST_VERSION'=>$latest_version));
echo $template->fetch('admin/webupdate.html');
        close_out();

?>