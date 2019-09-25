<?php
    Class MainController {
        var $param;

        function __construct($param){
            header("Content-type:text/html;charset=utf8");
            $this->param = $param;
            $this->openMain();
        }

        //index
        function openMain(){
            getHeader();
            require_once(_VIEW."main/main.php");
            getFooter();
        }

    }
?>