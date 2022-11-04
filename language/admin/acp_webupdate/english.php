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
** File webupdate/english.php 2018-09-23 00:00:00 Thor
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
    'CURRENT_VERSION'               => 'Current Version',
    'LATEST_VERSION'                => 'Latest Version',
    'VERSION_CHECK'                 => 'Version Check',
    'VERSION_CHECK_EXPLAIN'         => 'Checks to see if your PHP-AN602 Installation is up-to-date.<br /><br />',
    'VERSION_NOT_UP_TO_DATE'        => 'Your PHP-AN602 Installation is NOT up-to-date.  Please Continue the Update Process.',

    'UPDATE_INSTRUCTIONS'           => '
        <h1>Release Announcement</h1>

        <p>Please Read <a href=\'%1$s\' title=\'%1$s\'><strong>the Release Announcement for the Latest Version</strong></a> before you Continue your Update Process, it may contain useful Information. It also contains Full Download Links as well as the Change Log.</p>

        <br />

        <h1>How to Update your Installation with the Automatic Update Package</h1>

        <p>The Recommended way of Updating your Installation Listed here is Only Valid for the Automatic Update Package.  You are also able to Update your Installation using the Methods Listed within the INSTALL.html Document.  The Steps for Updating PHP-AN602 Automatically are:</p>

        <ul style="margin-left: 20px; font-size: 1.1em;">
            <li>Go to the <a href=\'https://github.com/php-an602/php-an602\' title=\'PHP-AN602\'>PHP-AN602 Downloads Page</a> and Download the "Latest Version" Archive.<br /><br /></li>
            <li>Unpack the Archive.<br /><br /></li>
            <li>Upload the Complete Uncompressed Install Folder to your PHP-AN602 Root Directory (where your config.php file is).<br /><br /></li>
        </ul>

        <p>Once Uploaded, your Board will be Offline for Normal Users due to the Install Directory you Uploaded now being present.<br /><br />
        <strong><a href=\'%2$s\' title=\'%2$s\'>Now Start the Update Process by Pointing your Browser to the Install Folder</a>.</strong><br />
        <br />
        You will then be Guided through the Update Process. You will be Notified once the Update is Complete.
        </p>
    ',
    'UPGRADE_INSTRUCTIONS'          => 'A New Feature Release <strong>%1$s</strong> is Available.  Please Read <a href=\'%2$s\' title=\'%2$s\'><strong>the Release Announcement</strong></a> to Learn about what it has to Offer, and How to Upgrade.',

    'VERSION_UP_TO_DATE_ACP'        => 'Your PHP-AN602 Installation is up-to-date.  There are NO Updates Available at this time.',
    'VERSIONCHECK_FORCE_UPDATE'     => 'Re-Check Version',

    'VERSION_NOT_UP_TO_DATE_ACP'    => 'Your PHP-AN602 Installation is NOT up-to-date.<br />Below is a Link to the Release Announcement, which Contains more Information as well as Instructions on Updating.',
));

?>