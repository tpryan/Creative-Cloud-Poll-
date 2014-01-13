<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/poll/config/creds.php';
    
    
    $dropsqlfamiliar = "DROP TABLE IF EXISTS `familiar` ";
    $createsqlfamiliar = "CREATE TABLE `familiar` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product` varchar(64) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ";
    
    
    $dropsqlquestion = "DROP TABLE IF EXISTS `question` ";
    $createsqlquestion = "CREATE TABLE `question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` text,
  `asked_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ";
    
    $dropsqlrole = "DROP TABLE IF EXISTS `role` ";
    $createsqlrole = "CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(128) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ";
    
    $dropsqlother = "DROP TABLE IF EXISTS `other` ";
    $createsqlother = "CREATE TABLE `other` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
)";
    
    
    
    
    
    $dbConn = mysql_connect($DB['host'], $DB['username'], $DB['password']) or die(mysql_error());
    mysql_select_db($DB['db'], $dbConn) or die(mysql_error());
    
    
    mysql_query($dropsqlfamiliar, $dbConn) or die(mysql_error());
    echo "<p>Dropped: Familiar</p>";
    mysql_query($dropsqlquestion, $dbConn) or die(mysql_error()); 
    echo "<p>Dropped: Question</p>";
    mysql_query($dropsqlrole, $dbConn) or die(mysql_error());
    echo "<p>Dropped: Role</p>";
    mysql_query($dropsqlother, $dbConn) or die(mysql_error()); 
    echo "<p>Dropped: Other</p>";
    
    
    mysql_query($createsqlfamiliar, $dbConn) or die(mysql_error());
    echo "<p>Re-created: Familiar</p>"; 
    mysql_query($createsqlquestion, $dbConn) or die(mysql_error()); 
    echo "<p>Re-created: Question</p>";
     mysql_query($createsqlrole, $dbConn) or die(mysql_error());
    echo "<p>Re-created: Role</p>"; 
    mysql_query($createsqlother, $dbConn) or die(mysql_error()); 
    echo "<p>Re-created: Other</p>";
    
?>
