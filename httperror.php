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
** File httperror.php 2022-11-02 00:00:00 Thor
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

$errid = request_var('errid', '');

$template = new Template();
$user->set_lang('httperror',$user->ulanguage);

switch ($errid) {
        case 400: {
                header("HTTP/1.0 400 Bad Request");
                $e = 'A';
                break;
        }
        case 401: {
                header("HTTP/1.0 401 Access Denied");
                $e = 'B';
                break;
        }
        case 403: {
                header("HTTP/1.0 403 Forbidden");
                $e = 'C';
                break;
        }
        case 404: {
                header("HTTP/1.0 404 Page Not Found");
                $e = 'D';
                break;
        }
        case 500: {
                header("HTTP/1.0 500 Internal Server Error");
                $e = 'E';
                break;
        }
}
                                set_site_var($user->lang['BT_ERROR']);
                                $template->assign_vars(array(
                                        'S_ERROR'           => true,
                                        'TITTLE_M'          => $user->lang[$e . '_ERROR_TTL'],
                                        'MESSAGE'           => sprintf($user->lang[$e . '_ERROR_EXP'],$admin_email) . $_SERVER["REQUEST_URI"],
                                ));
        echo $template->fetch('message_body.html');

?>