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
** File rss/backend-php5.php 2022-11-02 00:00:00 Thor
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

header('Content-Type: text/xml');

 $rss = new DomDocument("1.0","UTF-8");
$rss->preserveWhiteSpace = false;
     $rss->formatOutput = true;
// ------------- Interresting part here ------------

//creating an xslt adding processing line
$xslt = $rss->createProcessingInstruction('xml-stylesheet', 'type="text/css" href="' .  $siteurl . '/themes/' . $theme . '/base.css"');

//adding it to the xml
$rss->appendChild($xslt);
{
     $rdf = $rss->appendChild( $rss->createElement( 'rss' ) );
     $rdf->setAttribute( "version" , "2.0" );
     $rdf->setAttribute( "xmlns:dc" , "http://purl.org/dc/elements/1.1/" );
     $rdf->setAttribute( "xmlns:content" , "http://purl.org/rss/1.0/modules/content/" );
     $rdf->setAttribute( "xmlns:atom" , "http://www.w3.org/2005/Atom" );
     $channel = $rss->createElement( "channel" );
     $rdf->appendChild($channel );
       {
         $title = $rss->createElement( "title" );
         $title->appendChild( $rss->createTextNode( $sitename ) );
       }
       $channel->appendChild( $title );
       {
         $link = $rss->createElement( "link" );
         $link->appendChild( $rss->createTextNode( $siteurl ) );
       }
       $channel->appendChild( $link );
       {
         $description = $rss->createElement( "description" );
         $description->appendChild( $rss->createTextNode( sprintf($user->lang[$descr],$descra,$descrb) ) );
       }
       $channel->appendChild( $description );
       {
         $language = $rss->createElement( "language" );
         $language->appendChild( $rss->createTextNode( $user->lang['USER_LANG'] ) );
       }
       $channel->appendChild( $language );
       {
         $lastbuild = $rss->createElement( "lastBuildDate" );
         $lastbuild->appendChild( $rss->createTextNode( date(DATE_RFC2822, time()) ) );
       }
       $channel->appendChild( $lastbuild );
       {
         $generator = $rss->createElement( "generator" );
         $generator->appendChild( $rss->createTextNode( 'Bit Torrent Manager' ) );
       }
       $channel->appendChild( $generator );
       {
         $ttl = $rss->createElement( "ttl" );
         $ttl->appendChild( $rss->createTextNode( '60' ) );
       }
       $channel->appendChild( $ttl );
       {
         $atom = $rss->createElement( "atom:link" );
         $atom->setAttribute( "href" , $siteurl."/backend.php?op=".$op );
         $atom->setAttribute( "rel" , "self" );
         $atom->setAttribute( "type" , "application/rss+xml" );
       }
       $channel->appendChild( $atom );
     for ( $i = 0; $i < count( $ids ); $i++ )
     {
       $item = $rss->createElement( "item" );
       //$item->setAttribute( "rdf:about" , $siteurl . "/details.php?id=" . $ids[ $i ] );
       {
         $title = $rss->createElement( "title" );
         $title->appendChild( $rss->createTextNode( $names[ $i ] ) );
       }
       $item->appendChild( $title );
       {
         $size = $rss->createElement( "size" );
         $size->appendChild( $rss->createTextNode( $sizet[ $i ] ) );
       }
       $item->appendChild( $size );
                {
                        $pubdt = $rss->createElement("pubDate");
                        $pubdt->appendChild($rss->createTextNode($pubd[$i]));
                }
                $item->appendChild($pubdt);
       {
         $link = $rss->createElement( "link" );
         $link->appendChild( $rss->createTextNode( $siteurl."/details.php?id=" . $ids[ $i ] ) );
       }
       $item->appendChild( $link );
       {
         $description = $rss->createElement( "description" );
         $description->appendChild( $rss->createCDATASection( $descrs[ $i ] ) );
       }
       $item->appendChild( $description );
       {
        $enclosures = $rss->createElement( "enclosure" );
        $enclosures->setAttribute( "url" , $siteurl."/download.php?id=" . $ids[ $i ] . (($user->passkey)?"&rsskey=$user->passkey" : '' ));
        $enclosures->setAttribute( "length" , $sizet[ $i ] );
        $enclosures->setAttribute( "Content-ID" , $names[ $i ]  );
        $enclosures->setAttribute( "size" , $sizet[ $i ] );
        $enclosures->setAttribute( "type" , "application/x-bittorrent" );
       }
       $item->appendChild( $enclosures );
       {
         $guid = $rss->createElement( "guid" );
        $guid->setAttribute( "isPermaLink" , 'false' );
         $guid->appendChild( $rss->createTextNode( $siteurl."/details.php?id=" . $ids[ $i ] ) );
       }
       $item->appendChild( $guid );

       $channel->appendChild( $item );
     }
}

$rss->appendChild( $rdf );

echo $rss->saveXML();

?>