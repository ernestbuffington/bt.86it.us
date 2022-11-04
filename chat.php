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
** File chat.php 2022-11-02 00:00:00 Thor
**
** CHANGES
**
** 2022-11-02 - Updated Masthead, Github, !defined('IN_AN602')
**/

if (defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}
else
{
    define("IN_AN602",true);
}
require_once("common.php");
$template = new Template();
set_site_var($user->lang['IRC_CHAT']);
function build_hidden_parms($field_ary, $specialchar = false, $stripslashes = false)
{
    $s_hidden_fields = '';

    foreach ($field_ary as $name => $vars)
    {
        $name = ($stripslashes) ? stripslashes($name) : $name;
        $name = ($specialchar) ? htmlspecialchars($name, ENT_COMPAT, 'UTF-8') : $name;

        $s_hidden_fields .= _build_hidden_parms($name, $vars, $specialchar, $stripslashes);
    }

    return $s_hidden_fields;
}
function _build_hidden_parms($key, $value, $specialchar, $stripslashes)
{
    $hidden_fields = '';

    if (!is_array($value))
    {
        $value = ($stripslashes) ? stripslashes($value) : $value;
        $value = ($specialchar) ? htmlspecialchars($value, ENT_COMPAT, 'UTF-8') : $value;
        echo $val;

        $hidden_fields .= '<param name="' . $key . '" value="' . $value . '">' . "\n";
    }
    else
    {
        foreach ($value as $_key => $_value)
        {
            $_key = ($stripslashes) ? stripslashes($_key) : $_key;
            $_key = ($specialchar) ? htmlspecialchars($_key, ENT_COMPAT, 'UTF-8') : $_key;

            $hidden_fields .= _build_hidden_parms($key . '[' . $_key . ']', $_value, $specialchar, $stripslashes);
        }
    }

    return $hidden_fields;
}
$ircconfig = parse_ini_file("include/irc.ini");
$nick = preg_replace("/[^a-z0-9_]/i","",$user->name);
if($user->nick != "")$nick2 = preg_replace("/[^a-z0-9_]/i","",$user->nick);
else
$nick2 = $nick."@bittorrent.".$cookiedomain;
$parms = array(
            'CABINETS'                  =>  'pjirc/irc.cab,pjirc/securedirc.cab,pjirc/pixx.cab',
            'nick'                      =>  $nick,
            'alternatenick'             =>  $nick2,
            'name'                      =>  $user->name,
            'host'                      =>  $ircconfig["server"],
            'port'                      =>  '6667',
            'language'                  =>  "pjirc/".$language,
            'pixx:language'             =>  "pjirc/pixx-".$language,
            'gui'                       =>  'pixx',
            'soundbeep'                 =>  'pjirc/snd/bell2.au',
            'soundquery'                =>  'pjirc/snd/ding.au',
            'command1'                  =>  "/join ".$ircconfig["channel"],
            'style:bitmapsmileys'       =>  'true',
            );



    $sql = "SELECT code, file FROM ".$db_prefix."_smiles ORDER BY code ASC;";
$res = $db->sql_query($sql);
$i = 1;
$num = $db->sql_numrows($res);
$smlilie_list = '';
while (list($code, $file) = $db->fetch_array($res)) {
        $parms['style:smiley' . $i]     = $code . " smiles/" . $file;
        $i++;
}
$db->sql_freeresult($res);
//Other eventual parameters by .ini file
foreach ($ircconfig as $key=>$val) {
        if ($key == "server" OR $key == "channel") continue;
        $parms[$key]        = ($val == '')? 'false' : $val;
}
$template->assign_vars(array(
                        'PARMS'             =>  build_hidden_parms($parms),
                        ));
echo $template->fetch('chat.html');
close_out();

?>