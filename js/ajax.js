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
** File js/ajax.js 2018-10-03 00:00:00 Thor
**
** CHANGES
**
** 2022-11-02 - Updated Masthead, Github, !defined('IN_AN602')
** 2018-10-03 - Changed Path to js Files
**/

var req;
var offset = 1;
function doAjax() {
    if ( trackers[offset] == null )
        return;

    var command = 'op=scrape&tracker=' + trackers[offset] + '&info_hash=' + hash;
    document.getElementById('scrape_' + offset).innerHTML = 'connecting...';

    req = false;
    // branch for native XMLHttpRequest object
    if (window.XMLHttpRequest && !(window.ActiveXObject)) {
        try {
            req = new XMLHttpRequest();
        } catch(e) {
            req = false;
        }
    // branch for IE/Windows ActiveX version
    } else if (window.ActiveXObject) {
        try {
            req = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                req = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                req = false;
            }
        }
    }

    if (req) {
        req.onreadystatechange=state;
        req.open('POST', 'ajax.php', true);
        req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        req.setRequestHeader('Content-length', command.length);
        req.send(command);

    } else {
        alert('Your browser is not supported.');
    }
}

function state()
{
    if (req.readyState==4)
    {
        if (req.status==200)
        {
            if ( document.getElementById('scrape_' + offset) )
            {
                document.getElementById('scrape_' + offset).innerHTML = req.responseText;
                if ( req.responseText == 'Tracker has not seen this torrent.' )
                {
                    document.getElementById('tracker_' + offset ).style.background = '#FFFF80';
                }
                else if ( req.responseText.indexOf( "Seed" ) != 0 && req.responseText.indexOf( "Unsupported" ) != 0 )
                {
                    document.getElementById('tracker_' + offset ).style.background = '#000000';
                }
            }
            offset++;
            doAjax();
        }
        else
        {
            alert("Ajax error");
        }
    }
}