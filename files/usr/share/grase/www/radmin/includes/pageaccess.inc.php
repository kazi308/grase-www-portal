<?php

// Load constants for access levels
require_once 'includes/constants.inc.php';

// Load pages array of levels, key must match the $PAGE and the menubar keys
$PAGESACCESS = array(
    'main'          => ALLLEVEL,
    
    'users'         => NORMALLEVEL,
     'edituser'      => POWERLEVEL | CREATEUSERLEVEL,
     'createuser'    => POWERLEVEL | CREATEUSERLEVEL,
     'createtickets' => POWERLEVEL | CREATEUSERLEVEL,
     'createmachine' => POWERLEVEL | CREATEUSERLEVEL,
    
    'sessions'      => NORMALLEVEL,
     'reports'       => NORMALLEVEL | REPORTLEVEL,
    
    'settings'      => ADMINLEVEL,
     'uploadlogo'    => ADMINLEVEL,
     'netconfig'     => ADMINLEVEL,
     'chilliconfig'  => ADMINLEVEL,
     'loginconfig'   => ADMINLEVEL,
     'groups'        => POWERLEVEL | ADMINLEVEL,
     
    'passwd'        => ADMINLEVEL,
     'adminlog'      => ADMINLEVEL,
     
    'logout'        => ALLLEVEL,
    'login'         => ALLLEVEL,
);

// Default level
$ACCESS_LEVEL = ADMINLEVEL;

if(isset($PAGESACCESS[$PAGE]))
    $ACCESS_LEVEL = $PAGESACCESS[$PAGE];
    
