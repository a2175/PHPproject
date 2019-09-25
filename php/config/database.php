<?php
    function getPDO(){
        $db = new PDO("mysql:host=localhost;dbname=mydb;charset=utf8", 'root', '0000');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $db;
    }
?>