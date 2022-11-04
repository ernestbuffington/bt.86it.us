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
    die ('Error 404 - Page Not Found');
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'BITBUCKET_MANAGER'    => 'Image Manager',

    'BTMNGR_EXP'           => 'Select the File you wish to Add to your Torrent and Image Bucket.<br />You will NOT need to Upload this Image in the future.<br />Valid File Extensions: %1$s.',

    'BITBUCKET_GALERY'     => 'Image Gallery',

    'BTGALLERY_EXP'        => 'Here are ALL the Images you have in your Gallery<br />You can Add Images by Clicking on the Name of the Image or View the Full Image by Clicking the Thumb.<br />You can also use it elsewhere with [img]%1$s[/img]',

    'BITBUCKET_CLOSED'     => 'Image Bucket is Closed',
    'BITBUCKET_CLOSED_EXP' => 'We are NOT allowing Image Bucket Uploads at this time.',
    'ERROR_NOT_U_AUTH'     => 'Your Group is NOT Authorised to Use Image Bucket at this time',
    'BIT_FILE_TO_BIG'      => 'File Too Big',
    'BIT_FILE_TO_BIG_EXP'  => 'The Size of the File %1$s is Larger than Allowed by this System %2$s',
    'IMAGE_STATS'          => 'You are Currently using %1$s to Store %2$s Uploaded Images.',
    'STATS_BLOCK'          => 'Image Statistics',
    'SELECT_ATTACH_ERROR'  => 'Please Select a File to Attach.',
    'UPLOADING_WAIT'       => 'Uploading File(s) - Please Wait',
    'BITBUCKET_FULL'       => 'Image Bucket is Full',
    'BITBUCKET_FULL_EXP'   => 'Your Image Bucket is Full!<br />Please Delete some of your Images and try again.',
    'SERVER_ERROR'         => 'Server Error',
    'SERVER_ERROR_EXP'     => 'Server Configuration Error.  Sorry for the Inconvenience.',
    'INVALID_FILE'         => 'Invalid File',
    'INVALID_FILE_EXP'     => 'You may Only Upload File Types with the Extensions:- bmp, gif, jpe, jpeg, jpg, png<br /><br />',
    'FILE_NAME'            => 'File Name: %1$s',
    'FILE_TYPE'            => 'File Type: %1$s',
    'FILE_SIZE'            => 'File Size: %1$s',
));

?>