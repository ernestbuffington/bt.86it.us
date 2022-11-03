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
** File js/browse.js 2018-10-03 00:00:00 Thor
**
** CHANGES
**
** 2018-09-22 - Updated Masthead, Github, !defined('IN_BTM')
** 2018-10-03 - Changed Path to js Files
**/

function ShowHideMainCats(tableCount)
{
    var MainCats = document.getElementById('cats');
    var MainCatsPic = document.getElementById('pic');
    var DefCats = document.getElementById('defcats');

    if (MainCats.style.display == 'none') {
      MainCats.style.display = 'block';
      DefCats.style.display = 'block';
      MainCatsPic.src = 'images/noncross.gif';
    }
    else {
      MainCats.style.display = 'none';
      DefCats.style.display = 'none';
      MainCatsPic.src = 'images/cross.gif';
    }

    for(i = 1; i <= tableCount; i++) {
        tableID = 'tabletype' + i;
        tabletype = document.getElementById(tableID);
        picID = 'pic' + i;
        picture = document.getElementById(picID);
        tabletype.style.display = 'none';
        picture.src = 'images/cross.gif';
    }

}


function ShowHideMainSubCats(tableNum,tableCount){

    //Modified http://lists.evolt.org/pipermail/javascript/2006-May/010443.html

    if(tableCount > 1)
    for(i = 1; i <= tableCount; i++) {
        tableID = 'tabletype' + i;
        tabletype = document.getElementById(tableID);
        picID = 'pic' + i;
        picture = document.getElementById(picID);

        if(i == tableNum){
            if(tabletype.style.display == 'none')
            {
            tabletype.style.display = 'block';
            picture.src = 'images/noncross.gif';
            }
            else
            {
            tabletype.style.display = 'none';
            picture.src = 'images/cross.gif';
        }
        }
        else
        {
        tabletype.style.display = 'none';
        picture.src = 'images/cross.gif';
    }

    }
}

function checkAllFields(ref,tabletype) {

    //Modified http://www.dustindiaz.com/check-one-check-all-javascript/

    checkAllID = 'checkAll' + tabletype;
    var chkAll = document.getElementById(checkAllID);
    CatsID = 'cats' + tabletype + '[]';
    var checks = document.getElementsByName(CatsID);

    var boxLength = checks.length;
    var allChecked = false;
    var totalChecked = 0;
    if (ref == 1) {
        if (chkAll.checked == true) {
            for (i = 0; i < boxLength; i++) {
                checks[i].checked = true;
            }
        } else {
            for (i = 0; i < boxLength; i++) {
                checks[i].checked = false;
            }
        }
    } else {
        for (i = 0; i < boxLength; i++) {
            if (checks[i].checked == true) {
                allChecked = true;
                continue;
            } else {
                allChecked = false;
                break;
            }
        }
        if (allChecked == true) {
            chkAll.checked = true;
        } else {
            chkAll.checked = false;
        }
    }
    for (j = 0; j < boxLength; j++) {
        if (checks[j].checked == true) {
            totalChecked++;
        }
    }

}

//==========================================
// Check All boxes
//==========================================
function CheckAll(fmobj) {
  for (var i=0;i<fmobj.elements.length;i++) {
    var e = fmobj.elements[i];
    if ( (e.name != 'allbox') && (e.type=='checkbox') && (!e.disabled) ) {
      e.checked = fmobj.allbox.checked;
    }
  }
}

//==========================================
// Check all or uncheck all?
//==========================================
function CheckCheckAll(fmobj) {
  var TotalBoxes = 0;
  var TotalOn = 0;
  for (var i=0;i<fmobj.elements.length;i++) {
    var e = fmobj.elements[i];
    if ((e.name != 'allbox') && (e.type=='checkbox')) {
      TotalBoxes++;
      if (e.checked) {
       TotalOn++;
      }
    }
  }
  if (TotalBoxes==TotalOn) {
    fmobj.allbox.checked=true;
  }
  else {
   fmobj.allbox.checked=false;
  }
}


function hide(){

if(document.layers){

document.appgame.visibility="hidden";
document.music.visibility="hidden";
document.other.visibility="hidden";
document.movie.visibility="hidden";

}
if(document.all){

document.all.appgame.style.visibility="hidden";
document.all.music.style.visibility="hidden";
document.all.other.style.visibility="hidden";
document.all.movie.style.visibility="hidden";

}

if(document.getElementById){

document.getElementById('appgame').style.visibility="hidden";
document.getElementById('music').style.visibility="hidden";
document.getElementById('other').style.visibility="hidden";
document.getElementById('movie').style.visibility="hidden";

}
}

function whatbrowser(){
if(document.layers){
thisbrowser="NN4";
}
if(document.all){
thisbrowser="ie";
}
if(!document.all && document.getElementById){
thisbrowser="NN6";
}
}
// -->

function show(z) {

if(document.layers){

document[z].visibility="visible";
}
if(document.all){

document.all[z].style.visibility="visible";
}
if(document.getElementById){

document.getElementById([z]).style.visibility="visible";
}
}

function whatbrowser(){
if(document.layers){
thisbrowser="NN4";
}
if(document.all){
thisbrowser="ie";
}
if(!document.all && document.getElementById){
thisbrowser="NN6";
}
}
// -->