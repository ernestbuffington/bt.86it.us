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
** File image-bucket/english.php 2018-09-23 00:00:00 Thor
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
    'TITLE'                       => 'Image Bucket',
    'TITLE_EXPLAIN'               => 'Configure your Image Bucket Settings<br /><br />',
    'HEADER_SETTINGS'             => 'Image Bucket Settings',
    '_admpallow'                  => 'Enable/Disable Image Bucket',
    '_admpallowexplain'           => 'This will Turn the Image Bucket System On or Off.',
    '_admplevel'                  => 'Image Bucket Access Level',
    '_admplevelexplain'           => 'Select which User Level\'s can use Image Bucket!',
    '_admpmax_folder_size'        => 'Maximum Size of User Folder?',
    '_admpmax_folder_sizeexplain' => 'Set the Maximum Size of Folder the User is Allowed to have in Bytes!',
    '_admpmax_file_size'          => 'Maximum Allowed Size of Image?',
    '_admpmax_file_sizeexplain'   => 'Set the Maximum Size of an Image a User can Upload in Bytes!',
    'USER_IMAGES'                 => 'User Images',
    'FILE_NAME'                   => 'Filename',
    'FILE_SIZE'                   => 'File Size',
    'FOLDER_SIZE'                 => 'Folder Size',
    'NUM_FILES'                   => 'Total Files',
    'DELETE_FILE'                 => 'Delete File',
));

?>