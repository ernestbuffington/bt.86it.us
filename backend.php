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
** File backend.php 2018-09-22 00:00:00 Thor
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
else
{
    define("IN_BTM",true);
}
require_once("common.php");
$user->set_lang('backend',$user->ulanguage);
//Last Torrents
$op = request_var('op', '');
$sql = "SELECT
        T.id,
        T.name,
        T.descr,
        T.seeders,
        T.leechers,
        T.category,
        T.added,
        T.bbcode_bitfield as tbbcode_bitfield,
        T.bbcode_uid as tbbcode_uid,
        UNIX_TIMESTAMP(T.added) AS pubDate,
        T.size,
        C.name as cat_name
        FROM ".$db_prefix."_torrents T,
        ".$db_prefix."_categories C ";
                $descra = "";
                $descrb = "";
switch($op) {
        case "category": {
                $cat    = (int)request_var('cat', 0);
                $sql .= "WHERE
                T.banned = 'no'
                AND T.visible = 'yes'
                AND T.category = '".$cat."'
                AND C.id = '".$cat."'
                AND password IS NULL
                ORDER BY
                T.tot_peer,
                T.seeders,
                T.completed,
                T.added
                DESC LIMIT 10;";
                $descr = "RSS_BY_CAT";
                $descra = "";
                $descrb = $sitename;
                break;
        }
        case "best": {
                $sql .= "WHERE
                banned = 'no'
                AND T.visible = 'yes'
                AND T.password IS NULL
                AND C.id = T.category
                ORDER BY T.tot_peer, T.seeders, T.completed, T.added DESC LIMIT 10;";
                $descr = "RSS_BY_BEST";
                $descra = $sitename;
                $descrb = "";
                break;
        }
        case "search": {
                $dead   = request_var('dead', '');
                if(!isset($dead))
                $rssdead ="AND T.visible = 'yes' ";
                else
                $rssdead = "";
                $search = request_var('search', '',true);
                $cat    = (int)request_var('cat', 0);
                $orderby    = request_var('orderby', '');
                $ordertype  = request_var('ordertype', '');
                $incldead   = request_var('incldead', '');
                $cat = (isset($cat)) ? intval($cat) : 0;
                $orderby = (isset($orderby)) ? intval($orderby) : -1;
                $sql .= "WHERE
                T.banned = 'no'
                ".$rssdead."
                AND C.id = T.category
                AND T.password IS NULL ";
                if (!empty($search)) $sql .= " AND T.search_text LIKE ('%".$db->sql_escape(searchfield($search))."%') ";
                if (!isset($ordertype) OR $ordertype != "ASC") $ordertype = "DESC";
                else
                $ordertype = "ASC";
                if (isset($incldead) AND $incldead != "true") $sql .= "AND T.visible = 'yes' ";
                if ($cat > 0) $sql .= " AND T.category = '".$cat."' ";
                switch ($orderby) {
                    case 0: {
                            $sql .= "ORDER BY T.added ".$ordertype;
                            break;
                    }
                    case 1: {
                            $sql .= "ORDER BY T.seeders ".$ordertype;
                            break;
                    }
                    case 2: {
                            $sql .= "ORDER BY T.leechers ".$ordertype;
                            break;
                    }
                    case 3: {
                            $sql .= "ORDER BY T.tot_peer ".$ordertype;
                            break;
                    }
                    case 4: {
                            $sql .= "ORDER BY T.downloaded ".$ordertype;
                            break;
                    }

                    case 5: {
                            $sql .= "ORDER BY T.ratingsum ".$ordertype;
                            break;
                    }
                    case 6: {
                            $sql .= "ORDER BY T.name ".$ordertype;
                            break;
                    }
                    case 7: {
                            $sql .= "ORDER BY T.size ".$ordertype;
                            break;
                    }
                    case 8: {
                            $sql .= "ORDER BY T.numfiles ".$ordertype;
                            break;
                    }
                    default: {
                            $sql .= "ORDER BY T.id ".$ordertype;
                    }
                }
                $sql .= " LIMIT 10;";
                $descr = "RSS_BY_SEARCH";
                $descrb = $sitename;
                $descra = $search;
                break;
        }
        case "last":
        default: {
                $sql .= "WHERE
                T.banned = 'no'
                AND C.id = T.category
                AND T.password IS NULL
                ORDER BY added DESC LIMIT 10;";
                $descr = "RSS_BY_LAST";
                $descra = $sitename;
                $descrb = "";
        }
}

$res = $db->sql_query($sql);
$ids = Array();
$names = Array();
$category = Array();
$descrs = Array();
$seeds = Array();
$leeches = Array();
$pubd = Array();
$sizet = Array();
    include_once('include/function_posting.php');
    include_once('include/class.bbcode.php');

    // Grab icons
    $icons = $pmbt_cache->obtain_icons();
    $bbcode = false;
while ($row = $db->sql_fetchrow($res)) {
        $descript = censor_text($row['descr']);
        // Instantiate BBCode if need be
        if ($row['tbbcode_bitfield'])
        {
            include_once('include/bbcode.' . $phpEx);
            $bbcode = new bbcode($row['tbbcode_bitfield']);
            $bbcode->bbcode_second_pass($descript, $row['tbbcode_uid'], $row['tbbcode_bitfield']);
        }
        // Parse the message and subject
        $descript = bbcode_nl2br($descript);
        $descript = parse_smiles($descript);
        $pubd[] = date(DATE_RFC2822, $row['pubDate']);
        $category[] = $row["cat_name"];
        if($op == 'category')$descra = $row["cat_name"];
        $ids[] = $row["id"];
        $sizet[] = $row["size"];
        $names[] = $row["name"];
        $descrs[] = "<font size=\"3\">
                        <b>" . $user->lang['CATEGORY'] . ":</b>
                    </font> ".$row["cat_name"]."<br />
                    <font size=\"3\">
                        <b>" . $user->lang['DESCRIPTION'] . ":</b>
                    <br /></font> ".$descript."<br />
                    <font size=\"3\"><b>" . $user->lang['SEEDERS'] . ": </b></font>".$row["seeders"]."<br />
                    <font size=\"3\"><b>" . $user->lang['LEECHERS'] . ": </b></font>".$row["leechers"];
        $seeds[] = $row["seeders"];
        $leeches[] = $row["leechers"];
}
$db->sql_freeresult($res);
if (!$persistency) $db->sql_close();
if (phpversion() < '5') {
    require("include/rss/backend-php4.php");
}else{
    require("include/rss/backend-php5.php");
}
die();

?>