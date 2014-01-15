<?php
    
    function outputToJSON($entries) {
        $rows = array();
        while($r = mysql_fetch_assoc($entries)) {
            $rows[] = $r;
        }
        print json_encode($rows);
    }
    
    function getOtherInfo($dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        $entries = mysql_query(" SELECT * FROM `other` ORDER BY `role` DESC", $dbConn) or die(mysql_error()); 
        return $entries;
    }
    
    function getRoleInfo($dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        $entries = mysql_query(" SELECT * FROM `role` ", $dbConn) or die(mysql_error()); 
        return $entries;
    }
    
    function getQuestionInfo($dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        $entries = mysql_query(" SELECT * FROM question ORDER BY asked_on DESC", $dbConn) or die(mysql_error()); 
        return $entries;
    }
    
    function getProductInfo($dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        $entries = mysql_query(" SELECT * FROM familiar ", $dbConn) or die(mysql_error()); 
        return $entries;
    }
    


?>
