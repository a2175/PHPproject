<?php
    function getPDO(){
        $db = new PDO("mysql:host=localhost;port=3307;dbname=mydb;charset=utf8", 'root', '000000');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $db;
    }
?>