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
** File db/mssql_odbc.php 2022-11-02 00:00:00 Thor
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

/***************************************************************************

 *                              mssql-odbc.php

 *                            -------------------

 *   begin                : Saturday, Feb 13, 2001

 *   copyright            : (C) 2001 The phpBB Group

 *   email                : support@phpbb.com

 *

 *   $Id: mssql-odbc.php,v 1.2 2007/08/08 13:07:07 joerobe Exp $

 *

 ***************************************************************************/



/***************************************************************************

 *

 *   This program is free software; you can redistribute it and/or modify

 *   it under the terms of the GNU General Public License as published by

 *   the Free Software Foundation; either version 2 of the License, or

 *   (at your option) any later version.

 *

 ***************************************************************************/



if(!defined("SQL_LAYER"))

{



define("SQL_LAYER","mssql-odbc");



class sql_db

{



        var $db_connect_id;

        var $result;



        var $next_id;



        var $num_rows = array();

        var $current_row = array();

        var $field_names = array();

        var $field_types = array();

        var $result_rowset = array();



        var $num_queries = 0;



        //

        // Constructor

        //

        function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)

        {

                $this->persistency = $persistency;

                $this->server = $sqlserver;

                $this->user = $sqluser;

                $this->password = $sqlpassword;

                $this->dbname = $database;


                $this->db_connect_id = ($this->persistency) ? odbc_pconnect($this->server, $this->user, $this->password) : odbc_connect($this->server, $this->user, $this->password);



                return ( $this->db_connect_id ) ? $this->db_connect_id : false;

        }

        //

        // Other base methods

        //

        function sql_close()

        {

                if($this->db_connect_id)

                {

                        if( $this->in_transaction )

                        {

                                @odbc_commit($this->db_connect_id);

                        }



                        if( count($this->result_rowset) )

                        {

                                unset($this->result_rowset);

                                unset($this->field_names);

                                unset($this->field_types);

                                unset($this->num_rows);

                                unset($this->current_row);

                        }



                        return @odbc_close($this->db_connect_id);

                }

                else

                {

                        return false;

                }

        }



        //

        // Query method

        //

        function sql_query($query = "", $transaction = FALSE)

        {

                if( $query != "" )

                {

                        $this->num_queries++;



                        if( $transaction == BEGIN_TRANSACTION && !$this->in_transaction )

                        {

                                if( !odbc_autocommit($this->db_connect_id, false) )

                                {

                                        return false;

                                }

                                $this->in_transaction = TRUE;

                        }



                        if( preg_match("/^SELECT(.*?)(LIMIT ([0-9]+)[, ]*([0-9]+)*)?$/s", $query, $limits) )

                        {

                                $query = $limits[1];



                                if( !empty($limits[2]) )

                                {

                                        $row_offset = ( $limits[4] ) ? $limits[3] : "";

                                        $num_rows = ( $limits[4] ) ? $limits[4] : $limits[3];



                                        $query = "TOP " . ( $row_offset + $num_rows ) . $query;

                                }



                                $this->result = odbc_exec($this->db_connect_id, "SELECT $query");



                                if( $this->result )

                                {

                                        if( empty($this->field_names[$this->result]) )

                                        {

                                                for($i = 1; $i < odbc_num_fields($this->result) + 1; $i++)

                                                {

                                                        $this->field_names[$this->result][] = odbc_field_name($this->result, $i);

                                                        $this->field_types[$this->result][] = odbc_field_type($this->result, $i);

                                                }

                                        }



                                        $this->current_row[$this->result] = 0;

                                        $this->result_rowset[$this->result] = array();



                                        $row_outer = ( isset($row_offset) ) ? $row_offset + 1 : 1;

                                        $row_outer_max = ( isset($num_rows) ) ? $row_offset + $num_rows + 1 : 1E9;

                                        $row_inner = 0;



                                        while( odbc_fetch_row($this->result, $row_outer) && $row_outer < $row_outer_max )

                                        {

                                                for($j = 0; $j < count($this->field_names[$this->result]); $j++)

                                                {

                                                        $this->result_rowset[$this->result][$row_inner][$this->field_names[$this->result][$j]] = stripslashes(odbc_result($this->result, $j + 1));

                                                }



                                                $row_outer++;

                                                $row_inner++;

                                        }



                                        $this->num_rows[$this->result] = count($this->result_rowset[$this->result]);

                                }



                        }

                        else if( eregi("^INSERT ", $query) )

                        {

                                $this->result = odbc_exec($this->db_connect_id, $query);



                                if( $this->result )

                                {

                                        $result_id = odbc_exec($this->db_connect_id, "SELECT @@IDENTITY");

                                        if( $result_id )

                                        {

                                                if( odbc_fetch_row($result_id) )

                                                {

                                                        $this->next_id[$this->db_connect_id] = odbc_result($result_id, 1);

                                                        $this->affected_rows[$this->db_connect_id] = odbc_num_rows($this->result);

                                                }

                                        }

                                }

                        }

                        else

                        {

                                $this->result = odbc_exec($this->db_connect_id, $query);



                                if( $this->result )

                                {

                                        $this->affected_rows[$this->db_connect_id] = odbc_num_rows($this->result);

                                }

                        }



                        if( !$this->result )

                        {

                                if( $this->in_transaction )

                                {

                                        odbc_rollback($this->db_connect_id);

                                        odbc_autocommit($this->db_connect_id, true);

                                        $this->in_transaction = FALSE;

                                }



                                return false;

                        }



                        if( $transaction == END_TRANSACTION && $this->in_transaction )

                        {

                                $this->in_transaction = FALSE;



                                if ( !odbc_commit($this->db_connect_id) )

                                {

                                        odbc_rollback($this->db_connect_id);

                                        odbc_autocommit($this->db_connect_id, true);

                                        return false;

                                }

                                odbc_autocommit($this->db_connect_id, true);

                        }



                        odbc_free_result($this->result);



                        return $this->result;

                }

                else

                {

                        if( $transaction == END_TRANSACTION && $this->in_transaction )

                        {

                                $this->in_transaction = FALSE;



                                if ( !@odbc_commit($this->db_connect_id) )

                                {

                                        odbc_rollback($this->db_connect_id);

                                        odbc_autocommit($this->db_connect_id, true);

                                        return false;

                                }

                                odbc_autocommit($this->db_connect_id, true);

                        }



                        return true;

                }

        }



        //

        // Other query methods

        //

        function sql_numrows($query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                return ( $query_id ) ? $this->num_rows[$query_id] : false;

        }



        function sql_numfields($query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                return ( $query_id ) ? count($this->field_names[$query_id]) : false;

        }



        function sql_fieldname($offset, $query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                return ( $query_id ) ? $this->field_names[$query_id][$offset] : false;

        }



        function sql_fieldtype($offset, $query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                return ( $query_id ) ? $this->field_types[$query_id][$offset] : false;

        }



        function sql_fetchrow($query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                if( $query_id )

                {

                        return ( $this->num_rows[$query_id] && $this->current_row[$query_id] < $this->num_rows[$query_id] ) ? $this->result_rowset[$query_id][$this->current_row[$query_id]++] : false;

                }

                else

                {

                        return false;

                }

        }



        function sql_fetchrowset($query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                if( $query_id )

                {

                        return ( $this->num_rows[$query_id] ) ? $this->result_rowset[$query_id] : false;

                }

                else

                {

                        return false;

                }

        }



        function sql_fetchfield($field, $row = -1, $query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                if( $query_id )

                {

                        if( $row < $this->num_rows[$query_id] )

                        {

                                $getrow = ( $row == -1 ) ? $this->current_row[$query_id] - 1 : $row;



                                return $this->result_rowset[$query_id][$getrow][$this->field_names[$query_id][$field]];



                        }

                        else

                        {

                                return false;

                        }

                }

                else

                {

                        return false;

                }

        }



        function sql_rowseek($offset, $query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                if( $query_id )

                {

                        $this->current_row[$query_id] = $offset - 1;

                        return true;

                }

                else

                {

                        return false;

                }

        }



        function sql_nextid()

        {

                return ( $this->next_id[$this->db_connect_id] ) ? $this->next_id[$this->db_connect_id] : false;

        }



        function sql_affectedrows()

        {

                return ( $this->affected_rows[$this->db_connect_id] ) ? $this->affected_rows[$this->db_connect_id] : false;

        }



        function sql_freeresult($query_id = 0)

        {

                if( !$query_id )

                {

                        $query_id = $this->result;

                }



                unset($this->num_rows[$query_id]);

                unset($this->current_row[$query_id]);

                unset($this->result_rowset[$query_id]);

                unset($this->field_names[$query_id]);

                unset($this->field_types[$query_id]);



                return true;

        }



        function sql_error()

        {

                $error['code'] = odbc_error($this->db_connect_id);

                $error['message'] = odbc_errormsg($this->db_connect_id);



                return $error;

        }



} // class sql_db



} // if ... define



?>