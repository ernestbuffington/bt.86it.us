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
** And Joe Robertson (aka joeroberts)
** Project Leaders: Black_heart, Thor.
** File search_synonyms/english.php 2018-09-23 00:00:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_AN602')
**/

if (!defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ('Error 404 - Page Not Found');
}

$synonyms = array(
    'abcense'         => 'absence',
    'abridgement'     => 'abridgement',
    'accomodate'      => 'accommodate',
    'acknowledgment'  => 'acknowledgement',
    'airplane'        => 'aeroplane',
    'allright'        => 'all right ',
    'andy'            => 'Andrew',
    'anemia'          => 'anaemia',
    'anemic'          => 'anaemic',
    'anesthesia'      => 'anaesthesia',
    'apologize'       => 'apologise',
    'archean'         => 'Achaean',
    'archeology'      => 'archaeology',
    'archeozoic'      => 'Archaeozoic',
    'armor'           => 'armour',
    'artic'           => 'Arctic',
    'attachment'      => 'attachment',
    'attendence'      => 'attendance',

    'barbecue'        => 'barbecue',
    'behavior'        => 'behaviour',
    'biassed'         => 'biased',
    'biol'            => 'biology',
    'buletin'         => 'bulletin',

    'calender'        => 'calendar',
    'canceled'        => 'cancelled',
    'car'             => 'auto mobile',
    'catalog'         => 'catalogue',
    'cenozoic'        => 'caenozoic',
    'center'          => 'centre',
    'check'           => 'cheque',
    'color'           => 'colour',
    'comission'       => 'commission',
    'comittee'        => 'committee',
    'commitee'        => 'committee',
    'conceed'         => 'concede',
    'creating'        => 'creating',
    'curiculum'       => 'curriculum',

    'defense'         => 'defence',
    'develope'        => 'develop',
    'discription'     => 'description',
    'dulness'         => 'dullness',

    'encyclopedia'    => 'encyclopaedia',
    'enroll'          => 'enrol',
    'esthetic'        => 'aesthetic',
    'etiology'        => 'aetiology',
    'exhorbitant'     => 'exorbitant',
    'exhuberant'      => 'exuberant',
    'existance'       => 'existence',

    'favorite'        => 'favourite',
    'fetus'           => 'foetus',
    'ficticious'      => 'fictitious',
    'flavor'          => 'flavour',
    'flourescent'     => 'fluorescent',
    'foriegn'         => 'foreign',
    'fourty'          => 'forty',

    'gage'            => 'gauge',
    'geneology'       => 'genealogy',
    'grammer'         => 'grammar',
    'gray'            => 'grey',
    'guerilla'        => 'guerilla',
    'gynecology'      => 'gynaecology',

    'harbor'          => 'harbour',
    'heighth'         => 'height',
    'hemaglobin'      => 'haemoglobin',
    'hematin'         => 'haematin',
    'hematite'        => 'haematite',
    'hematology'      => 'haematology',
    'honor'           => 'honour',

    'innoculate'      => 'inoculate',
    'installment'     => 'instalment',
    'irrelevent'      => 'irrelevant',
    'irrevelant'      => 'irrelevant',

    'jeweler'         => 'jeweller',
    'judgment'        => 'judgement',

    'labeled'         => 'labelled',
    'labor'           => 'labour',
    'laborer'         => 'labourer',
    'laborers'        => 'labourers',
    'laboring'        => 'labouring',
    'licence'         => 'license',
    'liesure'         => 'leisure',
    'liquify'         => 'liquefy',

    'maintainance'    => 'maintenance',
    'maintenence'     => 'maintenance',
    'medieval'        => 'mediaeval',
    'meter'           => 'metre',
    'milage'          => 'mileage',
    'millipede'       => 'millipede',
    'miscelaneous'    => 'miscellaneous',
    'morgage'         => 'mortgage',

    'noticable'       => 'noticeable',

    'occurence'       => 'occurrence',
    'offense'         => 'offence',
    'ommision'        => 'omission',
    'ommission'       => 'omission',
    'optimize'        => 'optimise',
    'organize'        => 'organise',

    'pajamas'         => 'pyjamas',
    'paleography'     => 'palaeography',
    'paleolithic'     => 'palaeolithic',
    'paleontological' => 'palaeontological',
    'paleontologist'  => 'palaeontologist',
    'paleontology'    => 'palaeontology',
    'paleozoic'       => 'Palaeozoic',
    'pamplet'         => 'pamphlet',
    'paralell'        => 'parallel',
    'parl'            => 'parliament',
    'parlt'           => 'parliament',
    'pediatric'       => 'paediatric',
    'pediatrician'    => 'paediatrician',
    'pediatrics'      => 'paediatrics',
    'pedodontia'      => 'Paedodontia',
    'pedodontics'     => 'paedodontics',
    'personel'        => 'personnel',
    'practise'        => 'practice',
    'program'         => 'programme',
    'psych'           => 'psychology',

    'questionaire'    => 'questionnaire',

    'rarify'          => 'rarefy',
    'reccomend'       => 'recommend',
    'recieve'         => 'receive',
    'resistence'      => 'resistance',
    'restaraunt'      => 'restaurant',

    'savior'          => 'saviour',
    'sep'             => 'September',
    'seperate'        => 'separate',
    'sept'            => 'September',
    'sieze'           => 'seize',
    'summarize'       => 'summarise',
    'summerize'       => 'summarise',
    'superceed'       => 'supersede',
    'superintendant'  => 'superintendent',
    'supersede'       => 'supersede',
    'suprise'         => 'surprise',
    'surprize'        => 'surprise',
    'synchronise'     => 'synchronize',

    'temperary'       => 'temporary',
    'theater'         => 'theatre',
    'threshhold'      => 'threshold',
    'transfered'      => 'transferred',
    'truely'          => 'truly',
    'truley'          => 'truly',

    'useable'         => 'usable',

    'valor'           => 'valour',
    'vigor'           => 'vigour',
    'vol'             => 'volume',

    'whack'           => 'whack',
    'withold'         => 'withhold',

    'yeild'           => 'yield',
);

?>