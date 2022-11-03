<?php

/**
**********************
** BTManager v3.0.2 **
**********************
** http://www.btmanager.org/
** https://github.com/blackheart1/BTManager3.0.2
** http://demo.btmanager.org/index.php
** Licence Info: GPL
** Copyright (C) 2018
** Formerly Known As phpMyBitTorrent
** Created By Antonio Anzivino (aka DJ Echelon)
** And Joe Robertson (aka joeroberts/Black_Heart)
** Project Leaders: Black_Heart, Thor.
** File torrent.php 2018-09-22 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (defined('IN_BTM'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

define("IN_BTM",true);
require_once("common.php");
require_once("include/torrent_functions.php");
$user->set_lang('torrent',$user->ulanguage);
$template = new Template();
set_site_var($user->lang['BROWES']);
$cats2 = genrelist2();
$wherecatina = array();
$catmain = '1';
$catmid = false;
$catval ='';
foreach($cats2 as $cat3)
{
    $cat_var    =   request_var('cats' . $cat3['id'],  array('0'));
    //die(print_r($catwhere));
    if(isset($cat_var))
    {
        foreach($cat_var as $v)
        {
            $catval .= '&cats' . $cat3['id'] . '[]=' .$v ;
            array_push($wherecatina,$v);
        }
        $catmid = true;
    }
}
require_once('actb.php');
pmbt_include_templ('blocks/search_block.php', 'cats_var');
$sort                                           = request_var('sort', 0);
$type                                           = request_var('type', 'DESC');
//die($sort);
if(!$type == 'DESC')$type = 'ASC';
$orderby = " ORDER BY ".$db_prefix."_torrents.evidence $type, ";//
if ($sort == 1) $orderby = " ORDER BY ".$db_prefix."_torrents.name $type,  ";//

if ($sort == 2){
$orderby = " ORDER BY ".$db_prefix."_torrents.numfiles $type,  ";//
}
if ($sort == 3){
$orderby = " ORDER BY ".$db_prefix."_torrents.comments $type,  ";//
}
if ($sort == 4){
$orderby = " ORDER BY ".$db_prefix."_torrents.category $type,  ";//
}
if ($sort == 5){
$orderby = " ORDER BY ".$db_prefix."_torrents.size $type,  ";
}
if ($sort == 6){
$orderby = " ORDER BY ".$db_prefix."_torrents.times_completed $type,  ";
}
if ($sort == 7){
$orderby = " ORDER BY ".$db_prefix."_torrents.seeders $type,  ";//
}
if ($sort == 8){
$orderby = " ORDER BY ".$db_prefix."_torrents.leechers $type,  ";//
}
        if (!isset($page) OR !is_numeric($page) OR $page < 1) $page = 1;
        $catmain = implode("', '",$wherecatina);
        if ($catmain) $catwhere = " AND ".$db_prefix."_torrents.category IN ('".$catmain."')";
        else $catwhere = "";
        $passwhere = " AND ".$db_prefix."_torrents.password IS NULL ";
        $viswhere = (($user->view_dead_tor)? "banned = 'no'" : "visible = 'yes' AND banned = 'no'");
        if ($user->moderator) $viswhere = (($user->view_dead_tor)? "1" : "visible = 'yes'" );
        if ($user->premium) $passwhere = "";

        $from = ($page - 1) * $torrent_per_page;

        $totsql = "SELECT COUNT(*) as tot FROM ".$db_prefix."_torrents WHERE ".$viswhere.$catwhere.$passwhere.";";
        $sql = "SELECT
                    ".$db_prefix."_torrents.*,
                    IF(".$db_prefix."_torrents.numratings < '".$minvotes."', NULL, ROUND(".$db_prefix."_torrents.ratingsum / ".$db_prefix."_torrents.numratings, 1)) AS rating,
                    ".$db_prefix."_categories.name AS cat_name,
                    ".$db_prefix."_categories.image AS cat_pic,
                    ".$db_prefix."_categories.parent_id AS parent_id,
                    U.username,
                    IF(U.name IS NULL, U.username, U.name) as user_name,
                    U.level as user_level,
                    U.can_do as can_do,
                    L.group_colour AS color,
                    L.group_name AS lname
                FROM
                    ".$db_prefix."_torrents
                LEFT JOIN
                    ".$db_prefix."_categories ON category = ".$db_prefix."_categories.id
                LEFT JOIN
                    ".$db_prefix."_users U ON ".$db_prefix."_torrents.owner = U.id
                LEFT JOIN
                    ".$db_prefix."_level_settings L ON L.group_id = U.can_do
                WHERE
                    ".$viswhere.$catwhere.$passwhere.$orderby.$db_prefix."_torrents.added
                    DESC
                    LIMIT ".$from.",".$torrent_per_page.";";

        $res = $db->sql_query($sql) or mysql_error();
        $totres = $db->sql_query($totsql);

if (isset($sort))
{
$sort1= "&sort=".$sort."&type=".$type;
$sort2= "?sort=".$sort."&type=".$type;
}
else
{
$sort1="";
$sort2="";
}
$t_sort = array('i','a','b','c','d','e','f','g','h');
$t_type = array('asc'=>'desc','desc'=>'asc','DESC'=>'asc','ASC'=>'desc');
        list ($tot) = $db->fetch_array($totres);
        $db->sql_freeresult($totres);
        if ($db->sql_numrows($res) > 0) {
                $template->assign_vars(array(
                        'S_TORRENTS'            => true,
                        'T_SORT'                =>  $t_sort[$sort],
                        'T_SHORT'               =>  $t_type[$type],
                ));
                $pages = ceil($tot / $torrent_per_page);
                generate_torrentpager('torrents.php?page=', $page, $pages, $catval , $sort1 , $sort2 );
                get_tor_vars($res);
        }
        else
        {
                        $template->assign_vars(array(
                        'S_TORRENTS'            => false,
                ));
        }
$template->assign_vars(array(
        'HIT_COUNT'            => ($user->admin) ? false : true,
));
echo $template->fetch('torrents_body.html');
    close_out();

?>