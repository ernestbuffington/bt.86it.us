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
** File udl/mysql.php 2018-09-21 00:00:00 Thor
**
** CHANGES
**
** 2018-09-21 - Updated Masthead, Github, !defined('IN_BTM')
**/

if (!defined('IN_BTM'))
    die ("You Can't Access this File Directly");

if(!defined("SQL_LAYER"))
{

define("SQL_LAYER","mysql");

class sql_db

{

        var $db_connect_id;

        var $query_result;

        var $row = array();

        var $rowset = array();

        var $num_queries = 0;



        //

        // Constructor

        //

        function __construct($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
        {
                $this->persistency = $persistency;
                $this->user = $sqluser;
                $this->password = $sqlpassword;
                $this->server = $sqlserver;
                $this->dbname = $database;
                if($this->persistency)
                {
                        $this->db_connect_id = @mysql_pconnect($this->server, $this->user, $this->password);
                }
                else
                {
                        $this->db_connect_id = @mysql_connect($this->server, $this->user, $this->password);
                }
                if($this->db_connect_id)
                {
                        if($database != "")
                        {
                                $this->dbname = $database;
                                $dbselect = @mysql_select_db($this->dbname);
                                if(!$dbselect)
                                {
                                        @mysql_close($this->db_connect_id);
                                        $this->db_connect_id = $dbselect;
                                }
                        }
                        return $this->db_connect_id;
                }
                else
                {
                        return false;
                }
        }

    /*To not break everyone using your library, you have to keep backwards compatibility:
    Add the PHP5-style constructor, but keep the PHP4-style one. */
    function sql_db($sqlserver, $sqluser, $sqlpassword, $database, $persistency = true)
    {
        $this->__construct($sqlserver, $sqluser, $sqlpassword, $database, $persistency);
    }

    function sql_build_array($query, $assoc_ary = false)
    {
        if (!is_array($assoc_ary))
        {
            return false;
        }

        $fields = $values = array();

        if ($query == 'INSERT' || $query == 'INSERT_SELECT')
        {
            foreach ($assoc_ary as $key => $var)
            {
                $fields[] = $key;

                if (is_array($var) && is_string($var[0]))
                {
                    // This is used for INSERT_SELECT(s)
                    $values[] = $var[0];
                }
                else
                {
                    $values[] = $this->_sql_validate_value($var);
                }
            }

            $query = ($query == 'INSERT') ? ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')' : ' (' . implode(', ', $fields) . ') SELECT ' . implode(', ', $values) . ' ';
        }
        else if ($query == 'MULTI_INSERT')
        {
            trigger_error('The MULTI_INSERT query value is no longer supported. Please use sql_multi_insert() instead.', E_USER_ERROR);
        }
        else if ($query == 'UPDATE' || $query == 'SELECT')
        {
            $values = array();
            foreach ($assoc_ary as $key => $var)
            {
                $values[] = "$key = " . $this->_sql_validate_value($var);
            }
            $query = implode(($query == 'UPDATE') ? ', ' : ' AND ', $values);
        }

        return $query;
    }
    function _sql_validate_value($var)
    {
        if (is_null($var))
        {
            return 'NULL';
        }
        else if (is_string($var))
        {
            return "'" . $this->sql_escape($var) . "'";
        }
        else
        {
            return (is_bool($var)) ? intval($var) : $var;
        }
    }
    function sql_escape($msg)
    {
        if (!$this->db_connect_id)
        {
            return @mysql_real_escape_string($msg);
        }

        return @mysql_real_escape_string($msg, $this->db_connect_id);
    }

        //

        // Other base methods

        //

        function sql_close()

        {

                if($this->db_connect_id)

                {

                        if($this->query_result)

                        {

                                @mysql_free_result($this->query_result);

                        }

                        $result = @mysql_close($this->db_connect_id);

                        return $result;

                }

                else

                {

                        return false;

                }

        }



        //

        // Base query method

        //

        function sql_query($query = "", $transaction = FALSE)

        {

                // Remove any pre-existing queries

                unset($this->query_result);
                        $query_result = NULL;
                if($query != "")

                {



                        $this->query_result = @mysql_query($query, $this->db_connect_id);



                }

                if($this->query_result)

                {

                        unset($this->row[$this->query_result]);

                        unset($this->rowset[$this->query_result]);

                        return $this->query_result;

                }

                else

                {

                        return ( $transaction == END_TRANSACTION ) ? true : false;

                }

        }



        //

        // Other query methods

        //

        function sql_numrows($query_id = 0)

        {

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        $result = @mysql_num_rows($query_id);

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_affectedrows()

        {

                if($this->db_connect_id)

                {

                        $result = @mysql_affected_rows($this->db_connect_id);

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_numfields($query_id = 0)

        {

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        $result = @mysql_num_fields($query_id);

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_fieldname($offset, $query_id = 0)

        {

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        $result = @mysql_field_name($query_id, $offset);

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_fieldtype($offset, $query_id = 0)

        {

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        $result = @mysql_field_type($query_id, $offset);

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_fetchrow($query_id = 0)

        {

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        $this->row[$query_id] = @mysql_fetch_array($query_id);

                        return $this->row[$query_id];

                }

                else

                {

                        return false;

                }

        }

        function sql_fetchrowset($query_id = 0)

        {

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        unset($this->rowset[$query_id]);

                        unset($this->row[$query_id]);

                        while($this->rowset[(int)$query_id] = @mysql_fetch_array($query_id))

                        {

                                $result[] = $this->rowset[(int)$query_id];

                        }

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_fetchfield($field, $rownum = -1, $query_id = 0)

        {

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        if($rownum > -1)

                        {

                                $result = @mysql_result($query_id, $rownum, $field);

                        }

                        else

                        {

                                if(empty($this->row[$query_id]) && empty($this->rowset[$query_id]))

                                {

                                        if($this->sql_fetchrow())

                                        {

                                                $result = $this->row[$query_id][$field];

                                        }

                                }

                                else

                                {

                                        if($this->rowset[$query_id])

                                        {

                                                $result = $this->rowset[$query_id][$field];

                                        }

                                        else if($this->row[$query_id])

                                        {

                                                $result = $this->row[$query_id][$field];

                                        }

                                }

                        }

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_rowseek($rownum, $query_id = 0){

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }

                if($query_id)

                {

                        $result = @mysql_data_seek($query_id, $rownum);

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_nextid(){

                if($this->db_connect_id)

                {

                        $result = @mysql_insert_id($this->db_connect_id);

                        return $result;

                }

                else

                {

                        return false;

                }

        }

        function sql_freeresult($query_id = 0){

                if(!$query_id)

                {

                        $query_id = $this->query_result;

                }



                if ( $query_id )

                {

                        unset($this->row[$query_id]);

                        unset($this->rowset[$query_id]);



                        @mysql_free_result($query_id);



                        return true;

                }

                else

                {

                        return false;

                }

        }

        function sql_error($query_id = 0)

        {

                $result["message"] = @mysql_error($this->db_connect_id);

                $result["code"] = @mysql_errno($this->db_connect_id);



                return $result;

        }



} // class sql_db



} // if ... define



?>