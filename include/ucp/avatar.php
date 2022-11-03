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
** Project Leaders: Black_Heart, Thor.
** File ucp/avatar.php 2018-09-22 00:00:00 Thor
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

$galery = '';
$galery .= "<option value=\"none\">".$user->lang['CHOOSE_AVATAR']."</option>";
$galery .= "<option value=\"blank.gif\">".$user->lang['NONE']."</option>";
$dhandle = opendir("./".$avgal."/");
while ($file = readdir($dhandle)) {
        if (is_dir("./".$avgal."/".$file) OR $file == "blank.gif" OR !preg_match("/\.(gif|jpg|jpeg|png)/",$file)) continue;
        $galery .= "<option value=\"".$file."\">".$file."</option>";
}
$template->assign_vars(array(
        'CP_UAVATAR'            => gen_avatar($userrow["id"]),
        'ALLOW_AVATAR_UPLOAD'   => $avuploadon,
        'ALLOW_AVATAR_LINK'     => $avremoteon,
        'ALLOW_REMOTE_UPLOAD'   => $avremoteupon,
        'ALLOW_AVATAR_GALORY'   => $avgalon,
        'ALLOW_AVATAR'          => $avon,
        'AVATAR_SETHT'          => $userrow["avatar_ht"],
        'AVATAR_SETWT'          => $userrow["avatar_wt"],
        'AVATAR_MAXHT'          => $avmaxht,
        'AVATAR_MAXWT'          => $avmaxwt,
        'AVATAR_MAXSZ'          => mksize($avmaxsz),
        'AVATAR_MAXSZ_SEL'      => $galery,
        'AVATAR_GALORY'         => $avgal,
        '_AVATAR_EXPLAIN'       => sprintf($user->lang['_AVATAR_EXPLAIN'],$avmaxwt,$avmaxht,$avmaxsz),
));

?>