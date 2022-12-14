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
** File whois.php 2022-11-02 00:00:00 Thor
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

define("IN_AN602",true);
require_once("common.php");
$template = new Template();
set_site_var($user->lang['WHOIS'] . ': ' . long2ip($ip));
if(!checkaccess("m_view_whois"))
{
                $template->assign_vars(array(
                    'S_ERROR'           => true,
                    'S_FORWARD'         => false,
                    'TITTLE_M'          => $user->lang['BT_ERROR'],
                    'MESSAGE'           => $user->lang['NO_AUTH'],
                ));
                echo $template->fetch('message_body.html');
                close_out();
}
if (!function_exists('htmlspecialchars_decode'))
{
    /**
    * A wrapper for htmlspecialchars_decode
    * @ignore
    */
    function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT)
    {
        return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
    }
}
if (!function_exists('user_ipwhois'))
{
    function user_ipwhois($ip)
    {
        $ipwhois = '';

        // Check IP
        // Only supporting IPv4 at the moment...
        if (empty($ip) || !preg_match(get_preg_expression('ipv4'), $ip))
        {
            return '';
        }

        if (($fsk = fsockopen('whois.arin.net', 43, $errno, $errstr, 10)))
        {
            // CRLF as per RFC3912
            fputs($fsk, "$ip\r\n");
            while (!feof($fsk))
            {
                $ipwhois .= fgets($fsk, 1024);
            }
            fclose($fsk);
        }

        $match = array();

        // Test for referrals from ARIN to other whois databases, roll on rwhois
        if (preg_match('#ReferralServer: whois://(.+)#im', $ipwhois, $match))
        {
            if (strpos($match[1], ':') !== false)
            {
                $pos    = strrpos($match[1], ':');
                $server = substr($match[1], 0, $pos);
                $port   = (int) substr($match[1], $pos + 1);
                unset($pos);
            }
            else
            {
                $server = $match[1];
                $port   = 43;
            }

            $buffer = '';

            if (($fsk = fsockopen($server, $port)))
            {
                fputs($fsk, "$ip\r\n");
                while (!feof($fsk))
                {
                    $buffer .= fgets($fsk, 1024);
                }
                @fclose($fsk);
            }

            // Use the result from ARIN if we don't get any result here
            $ipwhois = (empty($buffer)) ? $ipwhois : $buffer;
        }

        $ipwhois = htmlspecialchars($ipwhois);

        // Magic URL ;)
        return trim(make_clickable($ipwhois, false, ''));
    }
}
        $ip = request_var('ip', '');

        $template->assign_var('WHOIS', user_ipwhois(long2ip($ip)));

echo $template->fetch('viewonline_whois.html');
$db->sql_close();

?>