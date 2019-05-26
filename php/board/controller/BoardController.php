<?php
    Class BoardController {
        var $param;
        var $boardService;
        var $data;

        function __construct($param){
            header("Content-type:text/html;charset=utf8");
            $this->param = $param;
            $this->boardService = new BoardService($this->param);

            //$this->openBoardList();

            switch($this->param->action){
                case 'view' : $this->openBoardDetail(); break;
                case 'write' : $this->openBoardDetail(); break;
                case 'delete' : $this->openBoardDetail(); break;
                default : $this->openBoardList(); break;
            }
        }

        //index
        function openBoardList(){
            $this->data = (object)$this->boardService->openBoardList();
            $this->getTitle();
            $this->header();
            $list = $this->data->list;
            $listNum = $this->data->boardCount;
            require_once(_APP."board/view/boardList.php");
            $this->footer();
        }

        function openBoardDetail() {
            $data = (object)$this->boardService->openBoardDetail();
            $this->getTitle();
            $this->header();
            require_once(_APP."board/view/boardDetail.php");
            $this->footer();
        }

        function openBoardWrite() {

        }
        
        function insertBoard() {

        }
        
        
        function openBoardUpdate() {

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
            
        }

        //footer
        function footer(){
            require_once(_APP."common/view/header.php");
        }
    }
?>