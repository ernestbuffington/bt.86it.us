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
** File include/bittorrent.php 2022-11-02 00:00:00 Thor
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

if ($use_rsa) require_once("include/rsalib.php");
require_once("include/functions.php");
require_once("include/class.user.php");
require_once("include/class.email.php");
if ($use_rsa) $rsa = New RSA($rsa_modulo, $rsa_public, $rsa_private);
if(!function_exists('str_ireplace')) {
    function str_ireplace($search, $replacement, $string){
        $delimiters = array(1,2,3,4,5,6,7,8,14,15,16,17,18,19,20,21,22,23,24,25,
        26,27,28,29,30,31,33,247,215,191,190,189,188,187,186,
        185,184,183,182,180,177,176,175,174,173,172,171,169,
        168,167,166,165,164,163,162,161,157,155,153,152,151,
        150,149,148,147,146,145,144,143,141,139,137,136,135,
        134,133,132,130,129,128,127,126,125,124,123,96,95,94,
        63,62,61,60,59,58,47,46,45,44,38,37,36,35,34);
        foreach ($delimiters as $d) {
            if (strpos($string, chr($d))===false){
                $delimiter = chr($d);
                break;
            }
        }
        if (!empty($delimiter)) {
            return preg_replace($delimiter.quotemeta($search).$delimiter.'i', $replacement, $string);
        }
        else {
            trigger_error('Homemade str_ireplace could not find a proper delimiter.', E_USER_ERROR);
        }
    }
}
function search_word($word, $search){
if(empty($search))return $word;
$search = str_replace("+"," ",$search);
$newterm = str_ireplace($search,"<span class=\"highlight\">$search</span>",$word);
return $newterm;
}

?>