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
** File ajax/scrape.php 2022-11-02 00:00:00 Thor
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

require_once("include/bdecoder.php");
require_once("include/bencoder.php");

$infohash_hex = $info_hash;
$info_hash    = urlencode(pack('H*', $info_hash ? $info_hash : $info_hash));
$tmp_tracker  = str_replace("announce", "scrape", $tracker) . ((strpos($tracker, "?")) ? "&" : "?") . "info_hash=" . $info_hash;

if ($fp = @fopen($tmp_tracker, "rb"))
{
    stream_set_timeout($fp, 10);

    $page = "";

    while (!feof($fp))
    {
        $page .= @fread($fp, 1000000);
    }
    @fclose($fp);
}

$scrape    = Bdecode($page, "Scrape");
$seeders   = 0 + entry_read($scrape,"files/a" . strtolower($infohash_hex) . "/complete(Integer)", "Scrape");
$leechers  = 0 + entry_read($scrape,"files/a" . strtolower($infohash_hex) . "/incomplete(Integer)", "Scrape");
$completed = 0 + entry_read($scrape,"files/a" . strtolower($infohash_hex) . "/downloaded(Integer)", "Scrape");
$xmldata   = "Seeds: {$seeders}, Peers: {$leechers}, Completed: {$completed}";

header('Content-Type: text/xml');
header('status: 200');
header('Seed: 200');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\" ?>\n";
echo $xmldata;

?>