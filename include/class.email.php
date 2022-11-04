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
** File include/class.email.php 2022-11-02 00:00:00 Thor
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

class eMail {

        var $sender;
        var $recipient = Array();
        var $subject;
        var $body;

    /**
    * Constuctor
    * Set Admin mail
    */
        function __construct() {
                global $admin_email, $sitename;
                $this->sender = $admin_email;
        }

    /*To not break everyone using your library, you have to keep backwards compatibility:
    Add the PHP5-style constructor, but keep the PHP4-style one. */
        function eMail()
        {
            $this->__construct();
        }
        function Send() {
                global $admin_email, $sitename, $siteurl,$cookiedomain;
                ini_set("SMTP","smtp.".$this->sender);
                ini_set('sendmail_from', $this->sender);
                $line_break = "\r\n";
                $headers = 'From: "' . $sitename . '" <'.$this->sender . '>' . $line_break .
                'Reply-To: ' .$this->sender . $line_break .
                'Date: ' . gmdate('D, d M Y H:i:s') . ' -0000' . $line_break .
                'MIME-Version: 1.0' . $line_break .
                'Content-type: text/plain; charset=utf-8' . $line_break .
                'X-Mailer: PHP'. $line_break ;
                //die($headers);
                mail(implode(", ", $this->recipient),$this->subject,$this->body,$headers,"-f ".$this->sender);
                return true;

        }

        function get_mail_text($file, $file_lang = NULL)
        {
            global $language;
            if($file_lang AND file_exists("language/email/" . $file_lang . "/" . $file . ".txt")) $file_lang = $file_lang;
            else
            $file_lang = $language;
            if (($data = @file_get_contents('language/email/' . $file_lang . '/' . $file . '.txt')) === false)
            {
                trigger_error("Failed opening template file [ language/email/" . $file_lang . "/authgrant.txt ]", E_USER_ERROR);
            }
            return $data;
        }

        function clean_body($pass)
        {
            global $siteurl, $sitename;
            $args = func_get_args();
            $mode           = array_shift($args);
            foreach($pass as $i=>$v)
            {
            $$i = $v;
            }
            eval('$data = "' . $data . '";');
            if (!function_exists('utf8_wordwrap'))
            {
             include_once("include/utf/utf_tools.php");
            }
            $this->body = wordwrap(utf8_wordwrap($data), 70, "\r\n", true);
        }

        function Add($email, $name = false) {
                if (is_email($email)){
                    if($name)
                    {
                        $this->recipient[] = $name . ' <' . $email . '>';
                    }
                    else
                    {
                        $this->recipient[] = $email;
                    }
                }
        }
}



class MailingList {

                var $mails = Array();

                function Insert($mail) {

                        $this->mails[] = $mail;

                }

                function Sendmail() {

                        if (count($this->mails) <1 ) return;

                        foreach ($this->mails as $mail) {

                                $mail->Send();

                        }

                }



}

?>