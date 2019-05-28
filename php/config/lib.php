<?php
    //alert
    function alert($str){
        echo "<script>alert('{$str}');</script>";
    }
    //move
    function move($str = false){
        echo "<script>";
            echo $str ? "document.location.replace('{$str}');" : "history.back();";
        echo "</script>";
        exit;
    }
    //access
    function access($bool,$msg,$url = false){
        if(!$bool){
            alert($msg);
            move($url);
        }
    }
    //autoload
    function __autoload($className){
        $className2 = preg_replace('/(.*)(application|view|controller|service|dao)/',"$2",strtolower($className)).'/';
        $className3 = preg_replace('/(.*)(application|view|controller|service|dao)/',"$1",strtolower($className)).'/';
        switch($className2){
            case 'application/' : $dir = _APP; break;
            default : $dir = _APP.$className3.$className2; break;
        }
        require_once("{$dir}{$className}.php");
    }
?>