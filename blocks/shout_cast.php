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
** File shout_cast.php 2022-11-02 00:00:00 Thor
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

global $db_prefix, $user, $db, $shout_config,$template,$siteurl,$language,$pmbt_cache,$theme, $auth,$phpEx;
$user->set_lang('shout_cast',$user->ulanguage);
if(!$pmbt_cache->get_sql("shout_cast")){
        $sql = "SELECT * FROM `".$db_prefix."_shout_cast`";
        $res = $db->sql_query($sql);
        $radio = $db->sql_fetchrow($res);
        $db->sql_freeresult($res);
$pmbt_cache->set_sql("shout_cast", $radio);
}else{
$radio = $pmbt_cache->get_sql("shout_cast");
}
$scip = $radio['ip'];  // IP adress or domain
$scport = $radio['port'];     // Port
$scpass = $radio['admin_pass'];   // SHOUTcast Password
function time_elapsed_A($secs){
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
        );

    foreach($bit as $k => $v)
        if($v > 0)$ret[] = $v . $k;

    return join(' ', $ret);
    }
$scfp = fsockopen($scip, $scport, $errno, $errstr, 1);
 if(!$scfp) {
  $scsuccs=1;
 }
if($scsuccs!=1){
 fputs($scfp,"GET /admin.cgi?pass=$scpass&mode=viewxml HTTP/1.0\r\nUser-Agent: SHOUTcast Song Status (Mozilla Compatible)\r\n\r\n");
 while(!feof($scfp)) {
  $page .= fgets($scfp, 1000);
 }


 $loop = array("STREAMSTATUS", "BITRATE", "SERVERTITLE", "CURRENTLISTENERS", "MAXLISTENERS", "BITRATE");
 $y=0;
 while($loop[$y]!=''){
  $pageed = ereg_replace(".*<$loop[$y]>", "", $page);
  $scphp = strtolower($loop[$y]);
  $$scphp = ereg_replace("</$loop[$y]>.*", "", $pageed);
  if($loop[$y]=='SERVERGENRE' || $loop[$y]=='SERVERTITLE' || $loop[$y]=='SONGTITLE' || $loop[$y]=='SERVERTITLE')
   $$scphp = urldecode($$scphp);

  $y++;
 }

 $pageed = ereg_replace(".*<SONGHISTORY>", "", $page);
 $pageed = ereg_replace("<SONGHISTORY>.*", "", $pageed);
 $songatime = explode("<SONG>", $pageed);
 $r=1;
 while($songatime[$r]!=""){
  $t=$r-1;
  $playedat[$t] = ereg_replace(".*<PLAYEDAT>", "", $songatime[$r]);
  $playedat[$t] = ereg_replace("</PLAYEDAT>.*", "", $playedat[$t]);
  $song[$t]['SONG'] = ereg_replace(".*<TITLE>", "", $songatime[$r]);
  $song[$t]['SONG'] = ereg_replace("</TITLE>.*", "", $song[$t]['SONG']);
  $song[$t]['SONG'] = urldecode($song[$t]['SONG']);
  $song[$t]['DATE'] = time_elapsed_A(time()-$playedat[$t]);
  $dj[$t] = ereg_replace(".*<SERVERTITLE>", "", $page);
  $dj[$t] = ereg_replace("</SERVERTITLE>.*", "", $pageed);
$r++;
 }

fclose($scfp);
}
        $template->assign_vars(array(
        'STREAMSTATUS'          =>  $streamstatus,
        "BITRATE"               =>  $bitrate,
        "SERVERTITLE"           =>  $servertitle,
        "CURRENTLISTENERS"      =>  $currentlisteners,
        "MAXLISTENERS"          =>  $maxlisteners,
        "BITRATE"               =>  $bitrate,
        'LAST_TRACK'            =>  $song[0]['SONG'],
        'RADIO_DJ'              =>  $radio['host_dj'],
        'RADIO_IP'              =>  $radio['ip'],
        'RADIO_PORT'            =>  $radio['port'],
        ));
        foreach($song as $val)
        {
        $template->assign_block_vars('last_songs', $val);
        }
echo $template->fetch('shout_cast.html');

?>