<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/poll/config/creds.php';
    
    foreach ($_POST as $key => $value) {
        if ($key != "question"){
            appendProduct($key, $DB);
        } else {
            appendQuestion($value, $DB);
        }
    
    }
    
    function appendProduct($product, $dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        $entries = mysql_query(" SELECT * FROM FAMILIAR WHERE product = '" . $product . "'", $dbConn) or die(mysql_error()); 
        
        if (mysql_num_rows($entries) == 0){
            $sql = "INSERT INTO FAMILIAR(`product`, `votes`) VALUES ('" .$product . "', 1)";
           
        } else {
            $row = mysql_fetch_array($entries);
            $newValue = $row['votes'] + 1;
            $sql = "UPDATE FAMILIAR SET votes = " . $newValue . " WHERE product = '" .$product . "'";
        }
         mysql_query($sql, $dbConn) or die(mysql_error());         
        
    }
    
    function appendQuestion($question, $dbInfo) {
        $dbConn = mysql_connect($dbInfo['host'], $dbInfo['username'], $dbInfo['password']) or die(mysql_error());
        mysql_select_db($dbInfo['db'], $dbConn) or die(mysql_error());
        
        $sql = "INSERT INTO question(`question`, `asked_on`) VALUES ('" . $question . "', NOW())"; 
         
         
         mysql_query($sql, $dbConn) or die(mysql_error());         
        
    }
    


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CC Poll Report</title>
    <meta name="viewport" content="user-scalable=no,initial-scale = 1.0,maximum-scale = 1.0">
    <link rel="stylesheet" type="text/css" href="fonts/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="assets/topcoat/css/topcoat-mobile-light.css">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css"><!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
    <h1>Thanks for answering!</h1>

</body>
</html>