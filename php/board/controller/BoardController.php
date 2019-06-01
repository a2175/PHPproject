<?php
    Class BoardController {
        var $param;
        var $boardService;
        var $data;

        function __construct($param){
            header("Content-type:text/html;charset=utf8");
            $this->param = $param;
            $this->boardService = new BoardService($this->param);

            if(isset($_POST['request'])) {
                switch($_POST['request']) {
                    case 'insert' : $this->insertBoard(); break;
                    case 'update' : $this->updateBoard(); break;
                    case 'delete' : $this->deleteBoard(); break;
                }
            }

            switch($this->param->action){
                case 'view' : $this->openBoardDetail(); break;
                case 'write' : $this->openBoardWrite(); break;
                case 'update' : $this->openBoardUpdate(); break;
                case 'delete' : $this->openBoardDelete(); break;
                case 'searchpage' : $this->openBoardSearchList(); break;
                default : $this->openBoardList(); break;
            }
        }
        
        function openBoardList(){
            $this->data = (object)$this->boardService->openBoardList();
            $this->getTitle();
            $this->header();
            $list = $this->data->list;
            $listNum = $this->data->totalCount;
            require_once(_APP."board/view/boardList.php");
            $this->footer();
        }

        function openBoardSearchList(){
            $this->data = (object)$this->boardService->openBoardSearchList();
            $this->getTitle();
            $this->header();
            $list = $this->data->list;
            $listNum = $this->data->totalCount;
            require_once(_APP."board/view/boardList.php");
            $this->footer();
        }

        function openBoardDetail() {
            $data = $this->boardService->openBoardDetail();

            $this->getTitle();
            $this->header();
            require_once(_APP."board/view/boardDetail.php");
            $this->footer();
        }

        function openBoardWrite() {
            $this->getTitle();
            $this->header();
            require_once(_APP."board/view/boardWrite.php");
            $this->footer();
        }
        
        function insertBoard() {
            $this->boardService->insertBoard();
            alert("완료되었습니다.");
            move(_URL."board");
        }
        
        function openBoardUpdate() {
            $data = $this->boardService->openBoardDetail();

            $this->getTitle();
            $this->header();
            require_once(_APP."board/view/boardUpdate.php");
            $this->footer();
        }

        function updateBoard() {
            if($this->boardService->updateBoard()) {
                alert("완료되었습니다.");
                move(_URL."board/view/{$this->param->idx}");
            }
            else {
                alert("비밀번호가 일치하지 않습니다.");
            }
        }

        function openBoardDelete() {
            $this->getTitle();
            $this->header();
            require_once(_APP."board/view/boardDelete.php");
            $this->footer();
        }

        function deleteBoard() {
            if($this->boardService->deleteBoard()) {
                alert("완료되었습니다.");
                move(_URL."board");
            }
            else {
                alert("비밀번호가 일치하지 않습니다.");
            }
        }

        //getTitle
        function getTitle(){
            $this->title = 'MVC Model';
        }

        //header
        function header(){
            require_once(_APP."common/view/header.php");
        }

        //footer
        function footer(){
            require_once(_APP."common/view/footer.php");
        }
    }
?>