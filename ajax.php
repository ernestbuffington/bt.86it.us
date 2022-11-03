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
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File ajax.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_BTM",true);

require_once("common.php");

$template = new Template();
set_site_var('');

define("AUTH_PENDING",0);
define("AUTH_GRANTED",1);
define("AUTH_DENIED",2);
define("AUTH_NONE",3);

include_once("include/torrent_functions.php");

function str_links($text)
{
    $text = preg_replace(
    array("/(\A|[^=\]'\"a-zA-Z0-9])((http|ftp|https|ftps|irc):\/\/[^<>\s]+)/i","/\[url=((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\]((\s|.)+?)\[\/url\]/i","/\[url\]((http|ftp|https|ftps|irc):\/\/[^<>\s]+?)\[\/url\]/i"),
    array("\\1","\\3",""), $text);
    return $text;

}

if (isset($btlanguage) AND is_readable("language/".$btlanguage.".php")) $language = $btlanguage;
if (isset($bttheme) AND is_readable("themes/".$bttheme."/main.php")) $theme = $bttheme;

if (!is_readable("themes/$theme/main.php"))
{
    die("You should not see this...");
}

//Stop Banned Users
if (is_banned($user, $reason))
{
    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
            <html xmlns="http://www.w3.org/1999/xhtml" dir="' . $user->lang['DIRECTION'] .'" lang="' .$user->lang['USER_LANG'] . '" xml:lang="' .$user->lang['USER_LANG'] . '" />
                <head>
                    <meta http-equiv="content-type" content="text/html; charset=' .$user->lang['CONTENT_ENCODING'] . '" />
                    <meta name="generator" content="BTManager ' . $version . '" />
                    <meta http-equiv="pragma" content="no-cache" />
                    <meta http-equiv="expires" content="-1" />
                    <meta http-equiv="cache-control" content="no-cache" />
                    <meta http-equiv="refresh" content="0; url=ban.php?reson='.urlencode($reason).'" />
                </head>
                <body>' . $user->lang['BANNED'] . '</body>
            </html>';
    die();
}

$op = request_var('op', '');
//$username = request_var('username', '');
//if(!$username == '')print($username);
switch ($op)
    {
        case "scrape":
        {
            require_once("ajax/scrape.php");
            ob_end_flush();
            $db->sql_close();
            die();
        }

        case "check_username":
        {
            require_once("ajax/check_username.php");
            ob_end_flush();
            $db->sql_close();
            die();
        }

        case 'getactive':
        case 'activeusers':
        case 'private__chat':
        case 'view_shout':
        case 'edit_shout':
        case 'edit_archive_shout':
        case 'take_delete_shout':
        case 'take_delete_archive_shout':
        case 'take_edit_shout_cancel':
        case 'take_edit_shout':
        case 'take_edit_archive_shout':
        case 'take_shout':
        case 'archivedeleteshout':
        case 'more_smiles':
        {
            $user->set_lang('shouts',$user->ulanguage);
            require_once("ajax/shoutbox.php");
            ob_end_flush();
            $db->sql_close();
            die();
        }

        case 'save_torrent_comment':
        case 'edit_torrent_comment':
        case 'save_type_torrent':
        case 'change_type_torrent':
        case 'delete_torrent_comment':
        case 'change_banned_torrent':
        case 'save_banned_torrent':
        case 'save_torrent_descr':
        case 'edit_torrent_descr':
        {
            require_once("ajax/torrent.php");
            ob_end_flush();
            $db->sql_close();
            die();
        }

        case 'view_peers_page':
        case 'close_view_details':
        case 'close_view_details_page':
        case 'view_files_page':
        case 'view_rate_page':
        case 'view_coments_page':
        case 'view_nfo_page':
        case 'view_details':
        case 'get_imdb':
        case 'view_details_page':
        {
            require_once("ajax/details.php");
            ob_end_flush();
            $db->sql_close();
            die();
        }
    }

ob_end_flush();
$db->sql_close();
die();

?>