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
    //getTitle
    function getTitle(){
        return 'MVC Model';
    }
    //getHeader
    function getHeader(){
        require_once(_VIEW."common/header.php");
    }
    //getFooter
    function getFooter(){
        require_once(_VIEW."common/footer.php");
    }
    //renderView
    function renderView($content){
        getHeader();
        $content();
        getFooter();
    }
    //database
    function getPDO(){
        $db = new PDO("{$_ENV['DB_CONNECTION']}:".
                        "host={$_ENV['DB_HOST']};".
                        "port={$_ENV['DB_PORT']};".
                        "dbname={$_ENV['DB_DATABASE']};".
                        "charset=utf8",
                        "{$_ENV['DB_USERNAME']}", "{$_ENV['DB_PASSWORD']}");
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        
        return $db;
    }
    //autoload
    spl_autoload_register(function($className) {
        $className2 = preg_replace('/(.*)(application|view|controller|service|dao)/',"$2",strtolower($className)).'/';
        $className3 = preg_replace('/(.*)(application|view|controller|service|dao)/',"$1",strtolower($className)).'/';
        switch($className2){
            case 'application/' : $dir = _APP; break;
            default : $dir = _APP.$className3.$className2; break;
        }
        require_once("{$dir}{$className}.php");
    });
?>