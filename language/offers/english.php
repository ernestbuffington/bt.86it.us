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
** File offers/english.php 2018-09-23 00:00:00 Thor
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
    'OFFERS'               => 'Offers',
    'MAKE_OFFER'           => 'Make an Offer',

    'DESCRIPTION_EXPLAIN'  => 'Add as much Information as Possible.  This will make it easier for the Uploader to find what your looking for.',

    'OFFER_DELETED'        => 'Your Offer %1$d was Deleted by %2$d',
    'VOTE'                 => 'Vote',
    'VOTES'                => 'Votes',
    'OFFER_VOTE'           => 'Offer Vote',
    'VOTE_FOR'             => 'Vote for this Offer to be Uploaded.',
    'EDIT_OFFER'           => 'Edit Offers',
    'OFFER_BY'             => 'Offered by',
    'OFFER_EDITED'         => 'Offer Edited',
    'OFFER_EDITED_EXP'     => 'The Offer was Successfully Edited!',
    'OFFER_DELETED'        => 'Offer Deleted',
    'OFFER_DELETED_EXP'    => 'The Offer was Successfully Removed!',
    'ERROR_DESCRIP_BLANK'  => 'The Description Field can NOT be Blank',
    'ERROR_EDIT_NOT_SAVED' => 'An Error has Occurred and the Edit was NOT Saved',
    'PM_VOTES_REACHED'     => 'Your Offer "%1$d" has Reached 3 Votes.\nYou can now Upload it',
    'PM_SUB_VOTES_REACHED' => 'Your Offered Torrent for Upload',
    'THANKS_FOR_VOTE'      => 'Thank you for your Vote',

    'VOTED_ALREADY'        => 'You\'ve already Voted on this Offer.  ONLY <strong>1</strong> Vote per Member is Allowed<br />Return to the <a href=\'offers.php\'><strong>Offers List</strong></a>',

    'VOTE_TAKEN'           => 'Your Vote has been Counted<br />Return to the <a href=\'offers.php\'><strong>Offer List</strong></a>',

    'PERMISSION_DENIED'    => 'You DO NOT have Permissions to Access Offers at this time',
    'OFFER_SHOUT'          => '"%1$s" is making a Offer for "%2$s"',
    'NO_NAME_GIVEN'        => 'You should Enter a Name for your Offer',
    'DOWNLOAD'             => 'Download',
    'UPLOAD'               => 'Upload',
    'RATIO'                => 'Ratio',
));

?>