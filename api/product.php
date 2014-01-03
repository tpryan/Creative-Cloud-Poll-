<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/poll/config/creds.php';
    
    
    $entries = getProductInfo($DB);
    $rows = array();
    while($r = mysql_fetch_assoc($entries)) {
        $rows[] = $r;
    }
    print json_encode($rows);
    
    
    function getProductInfo($dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        $entries = mysql_query(" SELECT * FROM familiar ", $dbConn) or die(mysql_error()); 
        return $entries;
           
        
    }
    


?>
