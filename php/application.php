<?php
    Class Application {
        //변수
        var $param;
        //생성자
        function __construct(){
            $this->getParam();
            $controller = $this->param->page_type.'Controller';
            $controller = ucfirst($controller);
            new $controller($this->param); // 동적 생성 = $page_type($param)
        }
        //get param
        function getParam(){
            if(isset($_GET['param'])){
                $get = explode("/",$_GET['param']);
            }
            $param = [];
            $param['page_type'] = isset($get[0]) && $get[0] != '' ? $get[0] : 'main';
            $param['action'] = isset($get[1]) && $get[1] != '' ? $get[1] : NULL;
            $param['idx'] = isset($get[2]) && $get[2] != '' ? $get[2] : NULL;
            $param['page_num'] = isset($get[2]) && $get[2] != '' ? $get[2] : 1;
            $param['include_file'] = isset($param['action']) ? $param['action'] : $param['page_type'];
            $param['get_page'] = _URL."{$param['page_type']}";
            $this->param = (object)$param;
        }
    }
?>