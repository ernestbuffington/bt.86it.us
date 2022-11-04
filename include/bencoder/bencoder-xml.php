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
** File bencoder/bencoder-xml.php 2022-11-02 00:00:00 Thor
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
ICONV.DLL MUST BE IN C:\WINDOWS\SYSTEM OR
EXTENSION LOADING WILL FAIL
*/

function unescape_hex($str) {
        if (!preg_match("/^[0-9a-f]*$/i",$str)){
                trigger_error("Invalid encoding. String is not hexadecimal.",E_USER_WARNING);
                return null;
        }
        return pack("H*", $str);
}

/*
THIS FUNCTION AUTOMATICALLY ACCESS
THE RECURSIVE FUNCTIONS FAMILY FOR
BENCODING. NONE OF THE OTHERS SHOULD
BE CALLED WHILE HANDLING A DOCUMENT
OBJECT. INSTEAD, THEY ARE GOOD
FOR SINGLE NODES
*/
function Bencode(&$node) {
        return Benc($node->first_child);
}

/*
CONSIDER THE FOLLOWING FUNCTIONS
PRIVATE. NEVER CALL THEM UNLESS
YOU'RE DEALING WITH NODES
*/
function Benc(&$node) {
        $type = null;
        $calcX = new DOMXPath($node->ownerDocument);
        $result = $calcX->evaluate("attribute::type",$node);

        if (empty($result)) {
                trigger_error("Invalid encoding. Missing type attribute inside node ".$node->tagname, E_USER_WARNING);
                return null;
        } else $type = $result->nodeset[0]->value;
        unset($calcX, $result);

        switch ($type){
                case "Integer": {
                        return Benc_integer($node);
                        break;
                }
                case "String": {
                        return Benc_string($node);
                        break;
                }
                case "List": {
                        return Benc_list($node);
                        break;
                }
                case "Dictionary": {
                        return Benc_dict($node);
                        break;
                }
                default: {
                        trigger_error("Invalid encoding. Node type must be one of the following: String, Dictionary, List, Integer", E_USER_WARNING);
                        trigger_error("Node content: ".$node->get_content);
                        return null;
                }
        }
}
function Benc_integer(&$node) {
        $calcX = new DOMXPath($node->ownerDocument);
        $result = $calcX->evaluate("attribute::type",$node);

        if (empty($result) OR $result->nodeset[0]->value != "Integer") {
                trigger_error("Missing or wrong type attribute on node ".$node->tagname, E_USER_WARNING);
                return null;
        }
        unset($calcX, $result);

        $content = $node->get_content();

        if (!is_numeric($content)) {
                trigger_error("Invalid encoding. Value is not an integer number on node ".$node->tagname, E_USER_WARNING);
                return null;
        }

        return "i".$content."e";
}

function Benc_string(&$node) {
        $calcX = new DOMXPath($node->owner_document());
        $result = $calcX->evaluate("attribute::type",$node);

        if (empty($result) OR $result->nodeset[0]->value != "String") {
                trigger_error("Missing or wrong type attribute on node ".$node->tagname, E_USER_WARNING);
                return null;
        }
        unset($calcX, $result);

        $content = $node->get_content();

        if ($node->has_attribute("encode") AND $node->get_attribute("encode") == "hex") $content = unescape_hex($content);


        return strlen($content).":".$content;
}

function Benc_list(&$node) {
        $calcX = new DOMXPath($node->owner_document());
        $result = $calcX->evaluate("attribute::type",$node);

        if (empty($result) OR $result->nodeset[0]->value != "List") {
                trigger_error("Missing or wrong type attribute on node ".$node->tagname, E_USER_WARNING);
                return null;
        }
        unset($result);


        $ret = "l";
        $children = $calcX->evaluate("Item",$node);


        foreach ($children->nodeset as $child) $ret .= Benc($child);

        $ret .= "e";

        return $ret;
}

function Benc_dict(&$node) {
        $calcX = new DOMXPath($node->ownerDocument);
        $result = $calcX->evaluate("attribute::type",$node);

        if (empty($result) OR $result->nodeset[0]->value != "Dictionary") {
                trigger_error("Missing or wrong type attribute  on node ".$node->tagname, E_USER_WARNING);
                return null;
        }
        unset($result);

        $children = $calcX->evaluate("*",$node);

        $ret = "d";
        foreach ($children->nodeset as $child) {
                $name = $child->tagname;
                if ($child->has_attribute("tag_encode") AND $child->get_attribute("tag_encode") == "hex") $name = unescape_hex($name);
                elseif ($child->has_attribute("original")) $name = $child->get_attribute("original");

                $ret .= strlen($name).":".$name;
                $ret .= Benc($child);
        }

        $ret .= "e";

        return $ret;
}
/*
END OF PRIVATE FUNCTIONS
*/


?>