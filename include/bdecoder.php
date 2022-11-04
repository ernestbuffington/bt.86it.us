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
** File include/bdecoder.php 2022-11-02 00:00:00 Thor
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

/*
WINDOWS WARNING
ICONV.DLL MUST BE IN C:\WINDOWS\SYSTEM32 OR
EXTENSION LOADING WILL FAIL
*/
if (phpversion() < 5) {
        if (!extension_loaded("domxml") AND !defined("DOMXML_LOADED")) dl((PHP_OS=="WINNT" OR PHP_OS=="WIN32") ? "include/extensions/domxml.dll" : "include/extensions/domxml.so");
        require_once("include/bencoder/bdecoder-domxml.php");
        define("DOMXML_LOADED",1);
} else {
        require_once("include/bencoder/bdecoder-domxml.php");
        require_once'include/extensions/domxml-php4-to-php5.php';
}
function joinXML($parent, $child, $tag = null)
    {
        $DOMChild = new DOMDocument();
        $DOMChild->preserveWhiteSpace = false;
        $DOMChild->loadXML($child->dump_mem(true,"UTF-8"));
        $node = $DOMChild->getElementsByTagName("files")->item(0);
        $getnode = array();
        foreach($node->childNodes as $childs)
        {
            if($childs->nodeName != '#text')
            {
                $getnode[] = $childs->tagName;
            }
        }
        $DOMParent = new DOMDocument();
        $DOMParent->preserveWhiteSpace = false;
        $DOMParent->formatOutput = true;
        $DOMParent->loadXML($parent->dump_mem(true,"UTF-8"));
        $node = $DOMParent->importNode($node, true);
        if ($tag !== null)
        {
            $tag = $DOMParent->getElementsByTagName($tag)->item(0);
            foreach($getnode as $children)
            {
                $tag->appendChild($node->getElementsByTagName($children)->item(0));
            }
        }
        else
        {
            foreach($getnode as $children)
            {
                $tag->appendChild($node->getElementsByTagName($children)->item(0));
            }
        }
        $DOMParent->formatOutput = true;
        return $DOMParent->saveXML();
}

?>