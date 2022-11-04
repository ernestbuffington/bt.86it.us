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
** File profile_info.php 2022-11-02 00:00:00 Thor
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

        if(isset($userrow["birthday"]) OR !$userrow["birthday"]=='')$bday = explode("-", $userrow["birthday"]);
        else
        $bday = array('0','0','0');
        $now = getdate(time() - date('Z'));
if ($config['allow_birthdays'])
{
    $template->assign_vars(array(
        'U_BITH_D'              =>  $bday[0],
        'U_BITH_M'              =>  $bday[1],
        'U_BITH_Y'              =>  $bday[2],
        'S_BIRTHDAYS_ENABLED'       => true,
    ));
}
$template->assign_vars(array(
        'LOCATION'              => $countries,
        'U_ICQ'                 => (!empty($userrow["icq"])) ? $userrow["icq"] : '',
        'U_AIM'                 => (!empty($userrow["aim"])) ? $userrow["aim"] : '',
        'U_YIM'                 => (!empty($userrow["yahoo"])) ? $userrow["yahoo"] : '',
        'U_MSN'                 => (!empty($userrow["msn"])) ? $userrow["msn"] : '',
        'U_JABBER'              => (!empty($userrow["jabber"])) ?$userrow["jabber"] : '',
        'U_SKYPE'               => (!empty($userrow["skype"])) ? $userrow["skype"] : '',
));

?>