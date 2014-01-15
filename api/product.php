<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/poll/config/creds.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/poll/api/lib.php';
    
    $entries = getProductInfo($DB);
    outputToJSON($entries);
?>
