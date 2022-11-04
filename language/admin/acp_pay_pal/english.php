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
** File paypal/english.php 2018-09-23 00:00:00 Thor
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
    '_admpnodonateopt'               => array('EU'=>'EURO', 'UK'=>'GBP', 'US' => 'USD'),

    '_admsaved'                      => 'Settings Saved!',
    '_admpdonations'                 => 'Donations Page',

    '_admpdonationsexplain'          => 'In this Section you need to Enter your PayPal Details, Donation Goals and the Default Currency that you\'d like to Accept your Donations in.<br /><br />',

    '_admppaypal_email'              => 'PayPal email Address',

    '_admppaypal_emailexplain'       => 'The email Address used with your Paypal Account.  Donations to this Account will Update the Progress Bar in the Donations Block on the Front Page.<br /><br />Log in to your PayPal Account, go to My Account > Profile > Instant Payment Notification Preferences, and Set the URL to http://YOUR_SITE_URL/paypal.php',

    '_admpsitecost'                  => 'Donations Goal',
    '_admpsitecostexplain'           => 'Enter a Goal for your Donation Drive in your Chosen Currency',
    '_admpreseaved_donations'        => 'Donations Collected',

    '_admpreseaved_donationsexplain' => 'Amount of Donations you\'ve already Received.  Any Donations Reported by PayPal will be Added to this.',

    '_admpdonatepage'                => 'Donations Page',

    '_admpdonatepageexplain'         => 'Enter your Donations Page Information (i.e. the Page that is Linked from the Donations Block on the Front Page).  When Pasting the Code for the Donate Button from PayPal, remember to Click on \'Source\' in the Editor First.',

    '_admpdonation_block'            => 'Donation Block',
    '_admpdonation_blockexplain'     => 'Check if you want a Donations Block to be shown on the Main Page.',
    '_admpnodonate'                  => 'Indicator for Zero Donations',

    '_admpnodonateexplain'           => '<ul><li><strong>EU</strong> Displays a EURO Symbol when NO Donations have been Received<li><strong>UK</strong> Displays a British Pound Symbol when NO Donations have been Received<li><strong>US</strong> Displays a Dollar Symbol when NO Donations have been Received</ul>This Setting DOES NOT affect the Donation Currency in any way, it\'s purely Optical.',
));

?>