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
** File search/search.php 2022-11-02 00:00:00 Thor
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

/**
* @ignore
*/
define('SEARCH_RESULT_NOT_IN_CACHE', 0);
define('SEARCH_RESULT_IN_CACHE', 1);
define('SEARCH_RESULT_INCOMPLETE', 2);

/**
* search_backend
* optional base class for search plugins providing simple caching based on ACM
* and functions to retrieve ignore_words and synonyms
* @package search
*/
class search_backend
{
    var $ignore_words = array();
    var $match_synonym = array();
    var $replace_synonym = array();

    function __construct(&$error)
    {
        // This class cannot be used as a search plugin
        $error = true;
    }

    /*To not break everyone using your library, you have to keep backwards compatibility:
    Add the PHP5-style constructor, but keep the PHP4-style one. */
    function search_backend(&$error)
    {
        $this->__construct($error);
    }

    /**
    * Retrieves a language dependend list of words that should be ignored by the search
    */
    function get_ignore_words()
    {
        if (!sizeof($this->ignore_words))
        {
            global $user, $phpEx;

            $words = array();

            if (file_exists("language/search_ignore_words/{$user->ulanguage}.$phpEx"))
            {
                // include the file containing ignore words
                include("language/search_ignore_words/{$user->ulanguage}.$phpEx");
            }

            $this->ignore_words = $words;
            unset($words);
        }
    }

    /**
    * Stores a list of synonyms that should be replaced in $this->match_synonym and $this->replace_synonym and caches them
    */
    function get_synonyms()
    {
        if (!sizeof($this->match_synonym))
        {
            global $user, $phpEx;

            $synonyms = array();

            if (file_exists("language/search_synonyms/{$user->ulanguage}.$phpEx"))
            {
                // include the file containing synonyms
                include("language/search_synonyms/{$user->ulanguage}.$phpEx");
            }

            $this->match_synonym = array_keys($synonyms);
            $this->replace_synonym = array_values($synonyms);

            unset($synonyms);
        }
    }

    /**
    * Retrieves cached search results
    *
    * @param int &$result_count will contain the number of all results for the search (not only for the current page)
    * @param array &$id_ary is filled with the ids belonging to the requested page that are stored in the cache
    *
    * @return int SEARCH_RESULT_NOT_IN_CACHE or SEARCH_RESULT_IN_CACHE or SEARCH_RESULT_INCOMPLETE
    */
    function obtain_ids($search_key, &$result_count, &$id_ary, $start, $per_page, $sort_dir)
    {
        global $pmbt_cache;

        if (!($stored_ids = $pmbt_cache->get('_search_results_' . $search_key)))
        {
            // no search results cached for this search_key
            return SEARCH_RESULT_NOT_IN_CACHE;
        }
        else
        {
            $result_count = $stored_ids[-1];
            $reverse_ids = ($stored_ids[-2] != $sort_dir) ? true : false;
            $complete = true;

            // change the start to the actual end of the current request if the sort direction differs
            // from the dirction in the cache and reverse the ids later
            if ($reverse_ids)
            {
                $start = $result_count - $start - $per_page;

                // the user requested a page past the last index
                if ($start < 0)
                {
                    return SEARCH_RESULT_NOT_IN_CACHE;
                }
            }

            for ($i = $start, $n = $start + $per_page; ($i < $n) && ($i < $result_count); $i++)
            {
                if (!isset($stored_ids[$i]))
                {
                    $complete = false;
                }
                else
                {
                    $id_ary[] = $stored_ids[$i];
                }
            }
            unset($stored_ids);

            if ($reverse_ids)
            {
                $id_ary = array_reverse($id_ary);
            }

            if (!$complete)
            {
                return SEARCH_RESULT_INCOMPLETE;
            }
            return SEARCH_RESULT_IN_CACHE;
        }
    }

    /**
    * Caches post/topic ids
    *
    * @param array &$id_ary contains a list of post or topic ids that shall be cached, the first element
    *   must have the absolute index $start in the result set.
    */
    function save_ids($search_key, $keywords, $author_ary, $result_count, &$id_ary, $start, $sort_dir)
    {
        global $pmbt_cache, $config, $db, $user,$db_prefix;

        $length = min(sizeof($id_ary), $config['search_block_size']);

        // nothing to cache so exit
        if (!$length)
        {
            return;
        }

        $store_ids = array_slice($id_ary, 0, $length);

        // create a new resultset if there is none for this search_key yet
        // or add the ids to the existing resultset
        if (!($store = $pmbt_cache->get('_search_results_' . $search_key)))
        {
            // add the current keywords to the recent searches in the cache which are listed on the search page
            if (!empty($keywords) || sizeof($author_ary))
            {
                $sql = 'SELECT search_time
                    FROM ' . $db_prefix . '_search_results
                    WHERE search_key = \'' . $db->sql_escape($search_key) . '\'';
                $result = $db->sql_query($sql);

                if (!$db->sql_fetchrow($result))
                {
                    $sql_ary = array(
                        'search_key'        => $search_key,
                        'search_time'       => time(),
                        'search_keywords'   => $keywords,
                        'search_authors'    => ' ' . implode(' ', $author_ary) . ' '
                    );

                    $sql = 'INSERT INTO ' . $db_prefix . '_search_results ' . $db->sql_build_array('INSERT', $sql_ary);
                    $db->sql_query($sql);
                }
                $db->sql_freeresult($result);
            }

            $sql = 'UPDATE ' . $db_prefix . '_users
                SET user_last_search = ' . time() . '
                WHERE id = ' . $user->id;
            $db->sql_query($sql);

            $store = array(-1 => $result_count, -2 => $sort_dir);
            $id_range = range($start, $start + $length - 1);
        }
        else
        {
            // we use one set of results for both sort directions so we have to calculate the indizes
            // for the reversed array and we also have to reverse the ids themselves
            if ($store[-2] != $sort_dir)
            {
                $store_ids = array_reverse($store_ids);
                $id_range = range($store[-1] - $start - $length, $store[-1] - $start - 1);
            }
            else
            {
                $id_range = range($start, $start + $length - 1);
            }
        }

        $store_ids = array_combine($id_range, $store_ids);

        // append the ids
        if (is_array($store_ids))
        {
            $store += $store_ids;

            // if the cache is too big
            if (sizeof($store) - 2 > 20 * $config['search_block_size'])
            {
                // remove everything in front of two blocks in front of the current start index
                for ($i = 0, $n = $id_range[0] - 2 * $config['search_block_size']; $i < $n; $i++)
                {
                    if (isset($store[$i]))
                    {
                        unset($store[$i]);
                    }
                }

                // remove everything after two blocks after the current stop index
                end($id_range);
                for ($i = $store[-1] - 1, $n = current($id_range) + 2 * $config['search_block_size']; $i > $n; $i--)
                {
                    if (isset($store[$i]))
                    {
                        unset($store[$i]);
                    }
                }
            }
            $pmbt_cache->put('_search_results_' . $search_key, $store, $config['search_store_results']);

            $sql = 'UPDATE ' . $db_prefix . '_search_results
                SET search_time = ' . time() . '
                WHERE search_key = \'' . $db->sql_escape($search_key) . '\'';
            $db->sql_query($sql);
        }

        unset($store);
        unset($store_ids);
        unset($id_range);
    }

    /**
    * Removes old entries from the search results table and removes searches with keywords that contain a word in $words.
    */
    function destroy_cache($words, $authors = false)
    {
        global $db, $pmbt_cache, $config, $db_prefix;

        // clear all searches that searched for the specified words
        if (sizeof($words))
        {
            $sql_where = '';
            foreach ($words as $word)
            {
                $sql_where .= " OR search_keywords " . $db->sql_like_expression($db->any_char . $word . $db->any_char);
            }

            $sql = 'SELECT search_key
                FROM ' . $db_prefix . "_search_results
                WHERE search_keywords LIKE '%*%' $sql_where";
            $result = $db->sql_query($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $pmbt_cache->destroy('_search_results_' . $row['search_key']);
            }
            $db->sql_freeresult($result);
        }

        // clear all searches that searched for the specified authors
        if (is_array($authors) && sizeof($authors))
        {
            $sql_where = '';
            foreach ($authors as $author)
            {
                $sql_where .= (($sql_where) ? ' OR ' : '') . 'search_authors LIKE \'% ' . (int) $author . ' %\'';
            }

            $sql = 'SELECT search_key
                FROM ' . $db_prefix . "_search_results
                WHERE $sql_where";
            $result = $db->sql_query($sql);

            while ($row = $db->sql_fetchrow($result))
            {
                $pmbt_cache->destroy('_search_results_' . $row['search_key']);
            }
            $db->sql_freeresult($result);
        }

        $sql = 'DELETE
            FROM ' . $db_prefix . '_search_results
            WHERE search_time < ' . (time() - $config['search_store_results']);
        $db->sql_query($sql);
    }
}

?>