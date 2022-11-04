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
** File include/cache/memcache.php 2021-01-16 00:00:00 Black_Heart
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
class file extends pmbt_cache
{
	function __construct()
	{
		// Call the parent constructor
		parent::__construct();
	}
       function get($file, $expire = 60)
       {
       if($expire > $this->expire)$expire = $expire;
       else
       $expire = $this->expire;
          if (file_exists($this->cache_dir.$file.".php"))
          {
                  if(filemtime($this->cache_dir.$file.".php") < (time() - $expire))
                 {
                 $this->remove_file($file.".php");
                 return false;
                 }

                 $record = unserialize(file_get_contents($this->cache_dir.$file.".php"));
                 return $record;
          }else{
                 return false;
          }
       }
       function remove_file($filename)
        {
			 if (file_exists($this->cache_dir.$filename))
			 {
			//  echo $this->cache_dir.$filename;
				if (!@unlink($this->cache_dir.$filename))
				{
					// E_USER_ERROR - not using language entry - intended.
				   // trigger_error('Unable to remove files within ' . $this->cache_dir . $filename . '. Please check directory permissions.', E_USER_ERROR);
				}
			}
        }
       function put($file, $output)
       {
           $OUTPUT = serialize($output);
           //die($this->cache_dir);
           $fp = fopen($this->cache_dir.$file.".php","w");
          fputs($fp, $OUTPUT);
          fclose($fp);
          @chmod($this->cache_dir.$file.".php", 0755);
       }
    /**
    * Tidy cache
    */
    function tidy()
    {
        global $phpEx;

        $dir = @opendir($this->cache_dir);

        if (!$dir)
        {
            return;
        }

        $time = time();

        while (($entry = readdir($dir)) !== false)
        {
            if (preg_match('/^(imdb_|data_)/', $entry) OR $entry == "." OR $entry == "..")
            {
                continue;
            }

            if (!($handle = @fopen($this->cache_dir . $entry, 'rb')))
            {
                continue;
            }
            if (preg_match('/\.html.php$/', $entry))
            {
            $expires = (int) (filemtime($this->cache_dir.$entry) + $this->theme_expire);
            }
            else
            {
            $expires = (int) (filemtime($this->cache_dir.$entry) + $this->expire);
            }
            fclose($handle);

            if ($time >= $expires)
            {
                $this->remove_file($entry);
            }
        }
        closedir($dir);


        set_config('cache_last_gc', time(), true);
    }
}
?>