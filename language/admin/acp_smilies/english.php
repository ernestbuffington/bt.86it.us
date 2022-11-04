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
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File smilies/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_AN602')
**/

if (!defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'CHOSE'          => 'Choose',
    'PL_AT_END'      => 'Place at the End',
    'PL_AFT_'        => 'Place After ',
    'PL_AT_BEGGIN'   => 'Place at the Beginning',
    'SMILIES'        => 'Smilies',

    'SMILIES_EXP'    => 'In this Section you can Manage Smilies that Users can Upload.<br />Installation provides this Tracker with some Common Smilies for the Shoutbox, Descriptions and Forums.  You can Add your Own or Edit Others.<br />Be careful that every Smiley MUST be Represented by a Significant Tag for the best experience.  Images are in the Smiles Directory off of the Tracker\'s Root Directory.<br /><br />',

    'NO_SET_SMILIES' => 'No Smilies are Set',
    'SMILE_CODE'     => 'Code',
    'SM_IMAGECODE'   => 'Image/Smiley',
    'SMILE_ALT'      => 'Alternate',
    'SMILE_ALT_NAME' => 'Alternate Name',
    'SMILE_SELEC'    => 'Smile Code',
    'SMILE_IMAGE'    => 'Smile Image',
    'AD_EDIT_SMILE'  => 'Add/Edit Smilies',
    'POSITION'       => 'Position',
));

?>