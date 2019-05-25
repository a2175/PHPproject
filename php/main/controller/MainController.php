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
            $this->getTitle();
            $this->header();
            $this->content();
            $this->footer();
        }

        //getTitle
        function getTitle(){
            $this->title = 'MVC Model';
        }

        //header
        function header(){
            require_once(_APP."common/view/header.php");
        }

        //content
        function content(){
            require_once(_APP."main/view/main.php");
        }

        //footer
        function footer(){
            require_once(_APP."common/view/header.php");
        }
    }
?>