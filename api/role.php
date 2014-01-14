<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/poll/config/creds.php';
    
    
    $entries = getRoleInfo($DB);
    $rows = array();
    while($r = mysql_fetch_assoc($entries)) {
        $rows[] = $r;
    }
    print json_encode($rows);
    
    
    function getRoleInfo($dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        $entries = mysql_query(" SELECT * FROM `role` ", $dbConn) or die(mysql_error()); 
        return $entries;
           
        
    }
    


?>
