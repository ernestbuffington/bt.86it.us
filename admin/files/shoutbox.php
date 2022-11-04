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
** File files/shoutbox.php 2022-11-02 00:00:00 Thor
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

$cfgquery = "SELECT * FROM ".$db_prefix."_shout_config;";
$cfgres = $db->sql_query($cfgquery);
$cfgrow = $db->sql_fetchrow($cfgres);
$db->sql_freeresult($cfgres);
$user->set_lang('admin/acp_shout_box',$user->ulanguage);

$do                     = request_var('do', '');

if ($do == "saveshout") {
    $dateformat     = utf8_normalize_nfc(request_var('dateformat', $cfgrow['dateformat'], true));
    $sub_announce_ment                      = request_var('sub_announce_ment', '',true);
    $sub_shoutnewuser                       = request_var('sub_shoutnewuser', '');
    $sub_shout_new_torrent                  = request_var('sub_shout_new_torrent', '');
    $sub_shout_new_porn                     = request_var('sub_shout_new_porn', '');
    $sub_turn_on                            = request_var('sub_turn_on', '');
    $sub_refresh_time                       = request_var('sub_refresh_time', '');
    $sub_shouts_to_show                     = request_var('sub_shouts_to_show', '');
    $sub_bbcode_on                          = request_var('sub_bbcode_on', '');
    $sub_allow_url                          = request_var('sub_allow_url', '');
    $sub_autodelete_time                    = request_var('sub_autodelete_time', '');
    $sub_canedit_on                         = request_var('sub_canedit_on', '');
    $sub_candelete_on                       = request_var('sub_candelete_on', '');
    $sub_autodelet                          = request_var('sub_autodelet', '');
    $sub_can_quote                          = request_var('sub_can_quote', '');
    //First I create the two SQL arrays
    $sql_ary = array(
        "announce_ment"         => $sub_announce_ment,
        "shoutnewuser"          => $sub_shoutnewuser,
        "dateformat"            => $dateformat,
        "shout_new_torrent"     => $sub_shout_new_torrent,
        "shout_new_porn"        => $sub_shout_new_porn,
        "turn_on"               => $sub_turn_on,
        "refresh_time"          => intval($sub_refresh_time),
        "idle_time"             => intval($sub_idle_time),
        "shouts_to_show"        => $sub_shouts_to_show,
        "bbcode_on"             => ($sub_allow_url != "yes")? 'no' : 'yes',
        "allow_url"             => ($sub_allow_url != "yes")? 'no' : 'yes',
        "autodelete_time"       => intval($sub_autodelete_time),
        "canedit_on"            => ($sub_canedit_on != "yes")? 'no' : 'yes',
        "candelete_on"          => ($sub_candelete_on != "yes")? 'no' : 'yes',
        "autodelet"             => ($sub_autodelet != "true")? 'false' : 'true',
        "can_quote"             => ($sub_can_quote != "true")? 'false' : 'true',
    );

    //Now I save the settings
    //but first I test the insertion against SQL errors, or I lose everything in case of error
    $sql = "INSERT INTO ".$db_prefix."_shout_config " . $db->sql_build_array('INSERT', $sql_ary) . ";";
    //die($sql);
    if (!$db->sql_query($sql)) btsqlerror($sql);
    $db->sql_query("TRUNCATE TABLE ".$db_prefix."_shout_config;");
    $db->sql_query($sql);
    $pmbt_cache->remove_file("sql_".md5("shout").".php");

    //Finally, I redirect the user to configuration page
    $template->assign_vars(array(
            'S_SUCCESS'            => true,
            'S_FORWARD'         => $siteurl."/admin.php?i=siteinfo&op=shoutbox",
            'TITTLE_M'          => $user->lang['SUCCESS'],
            'MESSAGE'            => $user->lang['_admsaved'],
    ));
    echo $template->fetch('message_body.html');
    close_out();
}

$dateformat_options = '';
foreach ($user->lang['dateformats'] as $format => $null)
{
    $dateformat_options .= '<option value="' . $format . '"' . (($format == $cfgrow['dateformat']) ? ' selected="selected"' : '') . '>';
    $dateformat_options .= $user->format_date(time(), $format, false) . ((strpos($format, '|') !== false) ? $user->lang['VARIANT_DATE_SEPARATOR'] . $user->format_date(time(), $format, true) : '');
    $dateformat_options .= '</option>';
}

$s_custom = false;

$dateformat_options .= '<option value="custom"';
if (!isset($user->lang['dateformats'][$cfgrow['dateformat']]))
{
    $dateformat_options .= ' selected="selected"';
    $s_custom = true;
}
$dateformat_options .= '>' . $user->lang['CUSTOM_DATEFORMAT'] . '</option>';
$template->assign_vars(array(
        'L_TITLE'                   => $user->lang["SHOUT_CONF"],
        'L_TITLE_EXPLAIN'           => $user->lang["SHOUT_CONF_EXP"],
        'S_DATEFORMAT_OPTIONS'      => $dateformat_options,
        'DATE_FORMAT'               => $cfgrow['dateformat'],
        'S_CUSTOM_DATEFORMAT'       => $s_custom,
        'U_ACTION'                  => "./admin.php?i=siteinfo&op=shoutbox&do=saveshout",
));

drawRow("announce_ment","text", false , $user->lang["BT_SHOUT"]);
drawRow("turn_on","select",$user->lang["YES_NO"]);
drawRow("announce_ment","text", $user->lang["BT_SHOUT_ANNOUNCEMENT"]);
drawRow("shouts_to_show","text");
drawRow("shoutnewuser","select",$user->lang["YES_NO"]);
drawRow("shout_new_torrent","select",$user->lang["YES_NO"]);
drawRow("shout_new_porn","select",$user->lang["YES_NO"]);
drawRow("refresh_time","text");
drawRow("idle_time","text");
drawRow("bbcode_on","select",$user->lang["YES_NO"]);
drawRow("can_quote","select",$user->lang["YES_NO_TF"]);
drawRow("allow_url","select",$user->lang["YES_NO"]);
drawRow("canedit_on","select",$user->lang["YES_NO"]);
drawRow("candelete_on","select",$user->lang["YES_NO"]);
drawRow("autodelet","select",$user->lang["YES_NO_TF"]);
drawRow("autodelete_time","text");
echo $template->fetch('admin/shout_box.html');
close_out();

?>