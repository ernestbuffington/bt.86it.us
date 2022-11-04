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
** File files/info.php 2022-11-02 00:00:00 Thor
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

$user->set_lang('admin/acp_php_info',$user->ulanguage);
        ob_start();
        @phpinfo(INFO_GENERAL | INFO_CONFIGURATION | INFO_MODULES | INFO_VARIABLES);
        $phpinfo = ob_get_clean();

        $phpinfo = trim($phpinfo);

        // Here we play around a little with the PHP Info HTML to try and stylise
        // it along phpBB's lines ... hopefully without breaking anything. The idea
        // for this was nabbed from the PHP annotated manual
        preg_match_all('#<body[^>]*>(.*)</body>#si', $phpinfo, $output);

        if (empty($phpinfo) || empty($output))
        {
            trigger_error($user->lang['NO_PHPINFO_AVAILABLE'], E_USER_WARNING);
        }

        $output = $output[1][0];

        // expose_php can make the image not exist
        if (preg_match('#<a[^>]*><img[^>]*></a>#', $output))
        {
            $output = preg_replace('#<tr class="v"><td>(.*?<a[^>]*><img[^>]*></a>)(.*?)</td></tr>#s', '<tr class="row1"><td><table class="type2"><tr><td>\2</td><td>\1</td></tr></table></td></tr>', $output);
        }
        else
        {
            $output = preg_replace('#<tr class="v"><td>(.*?)</td></tr>#s', '<tr class="row1"><td><table class="type2"><tr><td>\1</td></tr></table></td></tr>', $output);
        }
        $output = preg_replace('#<table[^>]+>#i', '<table class="phpinfo">', $output);
        $output = preg_replace('#<img border="0"#i', '<img', $output);
        $output = str_replace(array('class="e"', 'class="v"', 'class="h"', '<hr />', '<font', '</font>','<tbody>','</tbody>'), array('class="row1"', 'class="row2"', '', '', '<span', '</span>','',''), $output);
        $output = preg_replace('#<td class="row2">(.*?)</td>#i', '<td class="row2">'.wordwrap('\1', 8, "\n", true).'</td>', $output);

        if (empty($output))
        {
            trigger_error($user->lang['NO_PHPINFO_AVAILABLE'], E_USER_WARNING);
        }

        $orig_output = $output;

        preg_match_all('#<div class="center">(.*)</div>#siU', $output, $output);
        $output = (!empty($output[1][0])) ? $output[1][0] : $orig_output;
    $template->assign_vars(array(
        'PHPINFO'                   => $output,
));
echo $template->fetch('admin/acp_php_info.html');
        close_out();

?>