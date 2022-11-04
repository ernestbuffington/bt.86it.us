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
** File include/rewrite.php 2022-11-02 00:00:00 Thor
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

if ($rewrite_engine) {
$buffer = ob_get_clean();

//Valid HTML
$buffer = preg_replace("(&(?!([a-zA-Z]{2,6}|[0-9\#]{1,6})[\;]))", "&amp;", $buffer);
$buffer = str_replace(array("&amp;&amp;", "&amp;middot", "&amp;nbsp"), array("&&", "?", " ;"), $buffer);


        $rewrite_search = Array();
        $rewrite_replace = Array();

        $rewrite_search[] = "'(?<!//)index\.php\?cat=([0-9]*)&amp;page=([0-9]*)'";
        $rewrite_replace[] = "torrent-page-\\2-cat-\\1.html";

        $rewrite_search[] = "'(?<!//)index\.php\?page=([0-9]*)'";
        $rewrite_replace[] = "home-page-\\1";

        $rewrite_search[] = "'(?<!//)index\.php\?cat=([0-9]*)'";
        $rewrite_replace[] = "home-cat-\\1";

        $rewrite_search[] = "'(?<!//)index\.php'";
        $rewrite_replace[] = "home";

        $rewrite_search[] = "'(?<!//)phpBB\.php?page=([a-zA-Z]*)\.php\&amp;([a-zA-Z0-9]*)'";
        $rewrite_replace[] = "forum-\\1";

        $rewrite_search[] = "'(?<!//)phpBB\.php'";
        $rewrite_replace[] = "forum";

        $rewrite_search[] = "'(?<!//)phpBB\.php\?index\.php'";
        $rewrite_replace[] = "forum";

        $rewrite_search[] = "'(?<!//)user\.php\?op=([a-zA-Z]*)\&amp;id=([0-9]*)'";
        $rewrite_replace[] = "user-\\1-\\2";

        $rewrite_search[] = "'(?<!//)download\.php\?id=([0-9]*)'";
        $rewrite_replace[] = "export-\\1";

       /* $rewrite_search[] = "'(?<!//)download\.php\?id=([0-9]*)&password=([a-zA-Z]*)'";
        $rewrite_replace[] = "download-\\1-pass-\\2.torrent";

        $rewrite_search[] = "'(?<!//)download\.php\?id=([0-9]*)'";
        $rewrite_replace[] = "download-\\1.torrent";

        $rewrite_search[] = "'(?<!//)edit\.php\?id=([0-9]*)'";
        $rewrite_replace[] = "edit-\\1.html";

        $rewrite_search[] = "'(?<!//)edit\.php\?op=delete&amp;id=([0-9]*)'";
        $rewrite_replace[] = "delete-\\1.html";

        $rewrite_search[] = "'(?<!//)mytorrents\.php\?op=displaytorrent&amp;id=([0-9]*)'";
        $rewrite_replace[] = "displaytorrent-\\1.html";

        $rewrite_search[] = "'(?<!//)mytorrents\.php'";
        $rewrite_replace[] = "mytorrents.html";

        $rewrite_search[] = "'(?<!//)user\.php\?op=editprofile'";
        $rewrite_replace[] = "editprofile.html";

        $rewrite_search[] = "'(?<!//)user\.php\?op=profile&amp;username=([^&\"]*)'";
        $rewrite_replace[] = "viewprofile-\\1.html";

        $rewrite_search[] = "'(?<!//)user\.php\?op=profile&amp;id=([0-9]*)'";
        $rewrite_replace[] = "profile-\\1.html";

        $rewrite_search[] = "'(?<!//)pm\.php?op=inbox'";
        $rewrite_replace[] = "inbox.html";

        $rewrite_search[] = "'(?<!//)pm\.php?op=inbox&page=([0-9]*)'";
        $rewrite_replace[] = "inbox-page-\\1.html";

        $rewrite_search[] = "'(?<!//)pm\.php?op=readmsg&mid=([0-9]*)'";
        $rewrite_replace[] = "msg-\\1.html";

        $rewrite_search[] = "'(?<!//)pm\.php?mid=([0-9]*)'";
        $rewrite_replace[] = "msg-\\1.html";

        $rewrite_search[] = "'(?<!//)pm\.php?op=delall'";
        $rewrite_replace[] = "msg-delall.html";

        $rewrite_search[] = "'(?<!//)pm\.php?op=del&mid=([0-9]*)'";
        $rewrite_replace[] = "msg-\\1-del.html";

        $rewrite_search[] = "'(?<!//)pm\.php?op=send&replyto=([0-9]*)'";
        $rewrite_replace[] = "msg-reply-\\1.html";

        $rewrite_search[] = "'(?<!//)pm\.php'";
        $rewrite_replace[] = "pm.html";*/

        $buffer = preg_replace($rewrite_search,$rewrite_replace,$buffer);
//Restart Output Buffering again
ob_start("ob_gzhandler");
ob_implicit_flush(0);
//echo $_SERVER["PHP_SELF"];
echo $buffer;
}

?>