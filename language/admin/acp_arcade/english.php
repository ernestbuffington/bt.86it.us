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
** File acp_arcade/english.php 2018-10-17 10:53:00 Thor
**
** CHANGES
**
** 2018-09-23 - Updated Masthead, Github, !defined('IN_AN602')
** 2018-10-17 - Added Missing Language
**/

if (!defined('IN_AN602'))
{
    require_once($_SERVER['DOCUMENT_ROOT'].'/security.php');
    die ("Error 404 - Page Not Found");
}

if (empty($lang) || !is_array($lang))
{
    $lang = array();
}

$lang = array_merge($lang, array(
    'TITLE'              => 'Arcade',
    'ACP_ADDED'          => 'ACP Modules Added Successfully.',
    'ACP_EXISTS'         => 'ACP Modules Already Exist.  Nothing Changed!',
    'ACP_MODULES'        => 'ACP Modules',
    'ADDED_GAME'         => 'The following Game has been Added Successfully to the Database.',
    'ADD_GAME'           => 'Add Game',
    'ADD_GAME_DESC'      => 'Add a Game to the Arcade.',
    'ADD_MODULES'        => 'Add Modules',
    'ALLOW_COMMENTS'     => 'Allow Games to be Commented On',
    'ALLOW_GUEST'        => 'Allow Guest to View',
    'ARCADE'             => 'Arcade Room',
    'ARCADE_WELCOME'     => 'Welcome to the Arcade Room.  From here you can View and Remove your Favourite Games.',

    'AR_EXPLAIN'         => 'This Installer was written for RC7 Only and has NOT been Tested on any other version of phpBB3.  If you wish to Install/Update and are using a Different Version of phpBB3, then please consult the Install.xml file in the zip that you have Downloaded.  We are going to walk you through Installing the Arcade Room today beginning with Adding MySQL Databases.',

    'AR_SETTINGS'        => 'Arcade Room Settings',
    'AR_TASKS'           => 'Arcade Room Tasks',
    'AR_TO_BEGIN'        => 'To Begin the Installation Click below.',
    'AR_VERSION'         => '0.6.9c',
    'AR_WELCOME'         => 'Welcome to the Arcade Mod Installation.',
    'A_SETTINGS'         => 'Arcade Settings',
    'A_MANAGE'           => 'Manage Arcade',
    'A_SETTINGS_DESC'    => 'Here you can Enable/Disable Several Arcade Room Features.',

    'BEGIN'              => 'Begin',
    'CAT'                => 'Categories',
    'CAT_MANAGE'         => 'Category Management',
    'CLICK_UPDATE'       => 'Click Here to Update your phpAR Mod',
    'COMMENT'            => ' Comment',
    'COMMENTS'           => 'Comments',
    'COPY_DONE'          => 'File Copying Finished',
    'COPY_FILES'         => 'Copy Files',
    'COPY_PROBLEM'       => 'There was a Problem Copying ',
    'COPY_SUCCESS'       => ' Copied Successfully to ',
    'CREATE_CAT'         => 'Create Category',
    'DATABASE_ERROR'     => ' had an Error whilst trying to Add to the Database.',
    'DATABASE_EXISTS'    => ' Already Exists in the Database.',
    'DATABSE_SUCCESS'    => ' Successfully Added to the Database.',
    'EDIT_POST'          => 'Edit Comment',
    'DELETE_COMMENT'     => 'Delete Comment',
    'DELETE_PROBLEM'     => 'There was a Problem Deleting ',
    'DISABLE'            => 'Disable',
    'ENABLE'             => 'Enable',
    'EDITED_ALREADY'     => '  was already Previously Edited.',
    'EDITED_GAME'        => 'The Database was Updated Successfully for the following Game.',

    'EDITS_DONE'         => 'File Edits Completed.  If there were any Issues please Read the install.xml to Manually Edit the Files.',

    'EDIT_FILES'         => 'Edit Files',
    'EDIT_GAME'          => 'Edit Game',
    'PREVIOUS'           => 'Previous',
    'EDIT_GAME_DESC'     => 'Here you can Edit the Values of the Game.',
    'EDIT_SUCCESS'       => ' Edited Successfully.',
    'ENABLE_FAVORITES'   => 'Enable Game Favourites',
    'ENABLE_HOTLINK'     => 'Enable Hotlink Protection',
    'ERROR_GAME'         => 'There was an Error Uploading the Game File.  Please Try Again!',
    'ERROR_IMAGE'        => 'There was an Error Uploading the Image File.  Please Try Again!',
    'FILE_COPIES'        => 'File Copies',
    'FILE_EDITS'         => 'File Edits',
    'FINISH'             => 'Finish',
    'GAME'               => ' Game',
    'GAMES'              => ' Games',
    'GAMES_IN_CAT'       => ' Game in this Category.',
    'GAME_ADD'           => 'Add',
    'GAME_ADDED'         => 'The Game has been Added.',
    'GAME_CAT_C'         => 'Category',
    'GAME_DESC'          => 'Description',
    'GAME_DESC_C'        => 'Description',
    'GAME_DIR'           => 'Directions',
    'GAME_DIR_C'         => 'Directions',
    'GAME_DUP'           => 'A Game on the Server already Uses that File Name.  Please Rename the File and try Uploading Again.',
    'GAME_FAVORITES'     => 'Game Favourites',
    'GAME_FILE_C'        => 'File',
    'GAME_HEIGHT_C'      => 'Height',
    'GAME_HIGHSCORES'    => 'High Scores',
    'GAME_HIGHSCORE_C'   => 'High Score',
    'GAME_IMAGE'         => 'Image',
    'GAME_IMAGE_C'       => 'Image',
    'GAME_IN_CAT'        => ' Game in this Category.',
    'GAME_MANAGE'        => 'Game Management',
    'GAME_NAME'          => 'Name',
    'GAME_NAME_C'        => 'Name',
    'GAME_NO_HIGHSCORE'  => 'There are No High Scores for this Game.',
    'GAME_PLAY_C'        => 'Plays',
    'GAME_RATING'        => 'Rating',
    'GAME_RATINGS_C'     => 'Ratings',
    'GAME_RATING_C'      => 'Rating',
    'GAME_REMOVE'        => 'Remove',
    'GAME_REMOVED'       => 'The Game has been Removed',
    'GAME_SAVED'         => 'The Game has been Saved.',
    'GAME_SIZE'          => 'Size',
    'GAME_SIZE_C'        => 'Size',
    'GAME_TASKS'         => 'Game Tasks',
    'GAME_WIDTH_C'       => 'Width',
    'GUEST_INCREASE'     => 'Guest Increases Game Plays',
    'HIGHEST_SCORE'      => 'Highest Score',
    'HIGHSCORES_FOR'     => 'High Scores for ',
    'HIGHSCORES_RESET'   => 'The High Scores for ALL Games have been Reset.',
    'HIGHSCORE_RESET'    => 'The Game you asked for the High Score to be Reset has now had its High Score Reset.',

    'IF_OK'              => 'The Installation is Complete.  If everything is OK Click Delete to Remove the Install File and Return to the Index.',

    'IMAGE_DUP'          => 'An Image on the Server already Uses that Filename.  Please Rename the File and try Uploading Again.',
    'LATEST'             => 'Latest Games',
    'LIMIT'              => '10MB Limit',
    'MANAGE_CAT'         => 'Manage Categories',
    'MANAGE_CAT_DESC'    => 'Here you can Add/Remove Game Categories/Genres.<br /><br />',
    'MANAGE_GAMES'       => 'Manage Games',
    'MANAGE_GAMES_DESC'  => 'Here you can Add/Edit/Remove Games.',

    'MODULES_DONE'       => 'Finished Adding Modules to the ACP.  If there were any Issues Adding them or they did NOT Show Up in the ACP, then Manually Add them.',

    'MYSQL_DONE'         => 'The MySQL Edits are Complete.  If there were any Issues then please Read the install.xml to Manually Add them to the Database.',

    'MYSQL_EDITS'        => 'MySQL Edits',
    'MINUTES'            => 'Minutes',
    'NEWSCORE_DESC'      => 'newscore.php Games Only',
    'NONE_IN_CAT'        => 'There are No Games in this Category.',
    'NO_FAVORITES_USER'  => 'This Member has No Favourite Games',
    'OUT_NOW'            => 'is Out Now.',
    'OUT_OF_DATE'        => 'of phpAR is Out of Date, the New ',
    'RATINGS_RESET'      => 'The Ratings for ALL Games have been Reset.',
    'RATING_RESET'       => 'The Game you asked for Ratings to be Reset has had its Ratings Reset.',
    'REMOVE_IMAGE_C'     => 'Remove Image',
    'RESET_HIGHSCORE'    => 'Reset High Scores for this Game',
    'RESET_HIGHSCORES'   => 'Reset ALL High Scores for Games',
    'RESET_RATING'       => 'Reset Ratings for this Game',
    'RESET_RATINGS'      => 'Reset ALL Ratings for Games',
    'RESET_VIEW'         => 'Reset Views for this Game',
    'RESET_VIEWS'        => 'Reset ALL Views for Games',
    'RUN_TASK'           => 'Run Task',
    'SAVE_GAME'          => 'Save Game',
    'STATISTIC'          => 'Statistics',
    'SERVER_ERROR'       => 'Error Contacting Update Server.',
    'SETTINGS_UPDATED'   => 'The Settings have been Updated.',
    'SPECIFY_CAT'        => 'Please Specify a Category for the Game.',
    'SPECIFY_DESC'       => 'Please Specify a Description for the Game.',
    'SPECIFY_DIR'        => 'Please Specify some Directions for the Game.',
    'SPECIFY_HEIGHT'     => 'Please Specify a Height.',
    'SPECIFY_NAME'       => 'Please Specify a Game Name.',
    'SPECIFY_WIDTH'      => 'Please Specify a Width.',
    'TOP_PLAY'           => 'Top Played',
    'TOP_RATE'           => 'Top Rated',
    'UP_GAME'            => 'You Need to Upload a Game File.',
    'UP_TO_DATE'         => 'of phpAR is Up to Date.',
    'UPDATE_NOTIF'       => 'Update Notifications',
    'VALUE'              => 'Value',
    'VIEW'               => 'View',
    'VIEWS_RESET'        => 'The Views for ALL Games have been Reset.',
    'VIEW_RESET'         => 'The Game you asked for Views to be Reset has had its Views Reset.',
    'WRONG_GAME_TYPE'    => 'Incorrect Game File Type.  Must be a SWF Flash File.',
    'WRONG_IMAGE_TYPE'   => 'Incorrect Image File Type.  Must be a gif, jpeg, or png File.',
    'YOUR'               => 'Your',
    'YOUR_FAVORITE'      => 'Your Favourite Games',
    'GAME_REV_SCORE_C'   => 'Reverse Scoring',
    'REV_DESC'           => 'Means the Lower the Score the Better',
    'INFO'               => 'Info',
    'GAME_FILENAME'      => 'Filename',
    'GAME_ENABLED_C'     => 'Enabled',
    'GAME_FILENAME_C'    => 'Filename',
    'GAME_IMAGENAME_C'   => 'Image Name',
    'GAME_COST_C'        => 'Cost',
    'GAME_PPT_C'         => 'Points Per Ticket',
    'GAME_PPT_EXPLAIN'   => 'Every this many Points means they Earn One Ticket',
    'GAME_NUM_RATING_C'  => 'Ratings',
    'GAME_NUM_FAVS_C'    => 'Favourites',
    'GAME_ID_C'          => 'ID',
    'GAME_PLAYS_C'       => 'Plays',
    'IMAGE_LIMIT'        => 'Images Larger than 50x50 will be Scaled Down',
    'GAME_NUM_RATINGS'   => 'Ratings',
    'GAME_PLAYED'        => 'Plays',
    'SAVE'               => 'Save',
    'CATEGORY_UPDATED'   => 'The Category has been Updated.',
    'NUM_FAVORITES'      => 'Favourites',
    'GAME_ADD_REMOVE'    => 'Favourite',
    'TROPHIES'           => 'Trophies',
    'YOUR_INFO'          => 'Your Info',
    'FAVORITES'          => 'Favourites',
    'ALL_GAMES'          => 'ALL Games',
    'GAME_COST_C'        => 'Cost',
    'GAME_COST'          => 'Cost',
    'OF'                 => 'of',
    'GAMES_LOWERCASE'    => 'Games',
    'PLAYED'             => 'Played',
    'RATED'              => 'Rated',
    'FAVORITE_GAMES'     => 'Favourite Games',
    'RANDOM_GAMES'       => 'Random Games',
    'CATEGORY_ADDED'     => 'The Category has been Added to the List.',
    'CATEGORY_REMOVED'   => 'The Category has been Removed from the List.',
    'CAT_HAS_GAMES'      => 'You can\'t Delete a Category that contains any Games.',
    'YOUR_INFO_WARNING'  => 'Register or Login to View your Info',
    'NO_HIGHSCORE'       => 'User has No High Score',
    'TROPHIES_WARNING'   => 'Trophies DO NOT Show up until 3 Users have Received a High Score on this Game.',

    'NO_FAVS'            => 'You have No Favourite Games to Display.',
    'VISIT_ROOM'         => 'Visit the Arcade Room',
    'TOP_PLAYERS'        => 'Top Players',
    'AR_LINK'            => '<a href="http://www.phpAR.com">patrikStar</a>',
    'AR_YEAR'            => '&copy; 2007, 2008, 2009',
    'DATABASES'          => 'Databases',
    'ARCADE_FILES'       => 'Arcade Core Files',
    'FILES'              => 'phpBB File Edits',
    'PROSILVER'          => 'subSilver File Edits',
    'MODULES'            => 'Arcade ACP Modules',
    'GAME_KEYBOARD_C'    => 'Keyboard',
    'GAME_MOUSE_C'       => 'Mouse',
    'GAME_USES'          => 'Uses',
    'FINISHED'           => 'Finish',

    'RESIZING'           => 'Resizing Requires JavaScript to be Enabled',
    'CLICK_UPDATE_ALT'   => 'Click Here if you wish to Manually Update',
    'GAME_ARCHIVE_ERROR' => 'Game Archive Missing game.xml.  You can NOT Auto Install this Game',
    'ARCADE_QUICK'       => 'Quick Links',
    'ARCADE_RANDOM'      => 'Random Game',
    'GAME_ENABLED'       => 'Game Enabled',
    'GAME_DISABLED'      => 'Game Disabled',
    'VIEWING_ARCADE'     => 'Viewing the Arcade',
    'VIEWING_CAT'        => 'Viewing a Category in the Arcade',
    'VIEWING_GAME'       => 'Playing a Game',
    'ARCADE_STATS'       => 'Arcade Statistics',
    'TOTAL_GAMES'        => 'Total Number of Games',
    'TOTAL_PLAYS'        => 'Total Amount of Play Sessions',
    'TOTAL_RATINGS'      => 'Total Number of Ratings',
    'AVG_RATING'         => 'Average Rating',
    'TOTAL_FAVORITES'    => 'Total Number of Favourites',
    'TOTAL_COMMENTS'     => 'Total Number of Comments',
    'TOKENS_SPENT'       => 'Total Tokens Spent',
    'TICKETS_DISPENSED'  => 'Total Tickets Dispensed',
    'TOTAL_SWF_SIZE'     => 'Total Flash Size',
    'TOTAL_IMG_SIZE'     => 'Total Image Size',
    'CHOOSE_GAME'        => 'Choose a Game',
    'CHOOSE_FILE'        => 'Choose a File',
    'GAME_XML_ERROR'     => 'The game.xml File Doesn\'t have ALL the Required Parts to it.',
    'UPLOAD_ARCHIVE'     => 'Upload Archive',
    'ARCHIVE_UPLOADED'   => 'The Archive has been Uploaded',
    'UPLOAD_ERROR'       => 'Error Uploading the Selected Archive',
    'MANAGE_HIGHSCORES'  => 'Manage High Scores',
    'HIGHSCORES'         => 'High Scores',
    'HIGHSCORE'          => 'High Score',
    'HIGHSCORE_UPDATED'  => 'High Score Updated Successfully',
    'HIGHSCORE_DELETED'  => 'High Score Deleted Successfully',
    'ARCADE_STARTED'     => 'Arcade Started',
    'PLAYS_PER_DAY'      => 'Plays Per Day',
    'ARCADE_PM_ONE'      => 'You Lost the ',
    'ARCADE_PM_TWO'      => ' Trophy because of ',
    'ARCADE_PM_THREE'    => ' who Scored ',
    'ARCADE_PM_FOUR'     => ' on ',
    'DISPLAY_STATS'      => 'Display Arcade Statistics in Arcade',
    'HOTLINK_LENGTH'     => 'Hotlink Protection Length',
    'SEARCH_MINI'        => 'Search Keyword',
    'SEARCH_KEYWORDS'    => 'Enter Search Criteria',
    'DISABLED'           => ' Disabled',
));

?>