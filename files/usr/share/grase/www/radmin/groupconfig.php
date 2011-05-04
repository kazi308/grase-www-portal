<?php

/* Copyright 2008 Timothy White */

/*  This file is part of GRASE Hotspot.

    http://hotspot.purewhite.id.au/

    GRASE Hotspot is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    GRASE Hotspot is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GRASE Hotspot.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once 'includes/session.inc.php';
require_once 'includes/misc_functions.inc.php';
require_once 'includes/database_functions.inc.php';

$error = array();
$success = array();

if(isset($_POST['submit']))
{
    /* Filter out blanks. Key index is maintained with array_filter so
     * name->expiry association is maintained */
    $groupnames = array_filter($_POST['groupname']);
    $groupexpiry = array_filter($_POST['groupexpiry']);
    
   
    

    if(sizeof($groupnames) == 0)
    {
        $error[] = T_("A minimum of one group is required");
    }
    if(sizeof($groupexpiry) < 1)
    {
        $success[] = T_("It is not recommended having groups without expiries.");
    }
    
    $Expiry = array();
    foreach($groupnames as $key => $name)
    {
        $groupexpiries[clean_text($name)] = $groupexpiry[clean_text($key)];
        
        // Validate expiries
        if(isset($groupexpiry[$key]))
        {
            if(strtotime($groupexpiry[$key]) == FALSE)
            {
                $error[] = sprintf(T_("%s: Invalid expiry format"), $name);
            }
            elseif(strtotime($groupexpiry[$key]) < time())
            {
                $error[] = sprintf(T_("%s: Expiry can not be in the past"), $name);
            }
        }
    }
    
    if(sizeof($error) == 0)
    {
        // No errors. Save groups
        $Settings->setSetting("groups", serialize($groupexpiries));
        $success[] = T_("Groups updated");
    } 
    
    if(sizeof($error) > 0) $smarty->assign("error", $error);	
    if(sizeof($success) > 0) $smarty->assign("success", $success);
    
    
    $smarty->assign("groups", $groupexpiries);
    //$smarty->assign("groups", $Expiry);

	display_page('groups.tpl');
      
/*    
    foreach($singlechillioptions as $singleoption => $attributes)
    {
        switch ($attributes['type'])
        {
            case "string":
                $postvalue = trim(clean_text($_POST[$singleoption]));
                break;
            case "int":
                $postvalue = trim(clean_int($_POST[$singleoption]));
                break;
            case "number":
                $postvalue = trim(clean_number($_POST[$singleoption]));
                break;
                
        }
        
        if($postvalue != $attributes['value'])
        {
            // TODO: Special case to change all machine account passwords
            if($singleoption == 'macpasswd')
            {
                $machineaccounts = DatabaseFunctions::getInstance()->getUsersByGroup(MACHINE_GROUP_NAME);
                foreach($machineaccounts as $machine)
                {
                    database_change_password($machine, $postvalue);
                }
            }
            
            // Update options in database
            DatabaseFunctions::getInstance()->setPortalConfigSingle($singleoption, $postvalue);
            $success[] = sprintf(
                T_("%s portal config option update"),
                $attributes['label']);
        }
        
    }
    
    foreach($multichillioptions as $multioption => $attributes)
    {
        $postvalue = array();
        foreach($_POST[$multioption] as $value)
        {
            switch ($attributes['type'])
            {
                case "string":
                    $postvalue[] = trim(clean_text($value));
                    break;
                case "int":
                    $postvalue[] = trim(clean_int($value));
                    break;
                case "number":
                    $postvalue[] = trim(clean_number($value));
                    break;
                    
            }
        
//        if($postvalue != $attributes['value'])
//        {
//        }
        }
        $postvalue = array_filter($postvalue);
        sort($postvalue);        
        sort($attributes['value']);
     
        if($postvalue != $attributes['value'])
        {
            DatabaseFunctions::getInstance()->delPortalConfig($multioption);
            foreach($postvalue as $value)
            {
                DatabaseFunctions::getInstance()->setPortalConfigMulti($multioption, $value);
            }
            $success[] = sprintf(
                T_("%s portal config option update"),
                $attributes['label']);
        
        }

        
    }
        
    // Call validate&change functions for changed items
*/
}

	
    $smarty->assign("groups", unserialize($Settings->getSetting("groups")));
    //$smarty->assign("groups", $Expiry);

	display_page('groups.tpl');

?>

