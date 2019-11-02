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
            else {
                switch($this->param->action){
                    case 'view' : $this->openBoardDetail(); break;
                    case 'write' : $this->openBoardWrite(); break;
                    case 'update' : $this->openBoardUpdate(); break;
                    case 'delete' : $this->openBoardDelete(); break;
                    case 'searchpage' : $this->openBoardSearchList(); break;
                    default : $this->openBoardList(); break;
                }
            }
        }

        function openBoardList(){
            $this->data = (object)$this->boardService->openBoardList();
            getHeader();
            $list = $this->data->list;
            $listNum = $this->data->totalCount;
            require_once(_VIEW."board/boardList.php");
            getFooter();
        }

        function openBoardSearchList(){
            $this->data = (object)$this->boardService->openBoardSearchList();
            getHeader();
            $list = $this->data->list;
            $listNum = $this->data->totalCount;
            require_once(_VIEW."board/boardList.php");
            getFooter();
        }

        function openBoardDetail() {
            $data = $this->boardService->openBoardDetail();
            getHeader();
            require_once(_VIEW."board/boardDetail.php");
            getFooter();
        }

        function openBoardWrite() {
            getHeader();
            require_once(_VIEW."board/boardWrite.php");
            getFooter();
        }
        
        function insertBoard() {
            $this->boardService->insertBoard();
            alert("완료되었습니다.");
            move(_URL."board");
        }
        
        function openBoardUpdate() {
            $data = $this->boardService->openBoardDetail();
            getHeader();
            require_once(_VIEW."board/boardUpdate.php");
            getFooter();
        }

        function updateBoard() {
            if($this->boardService->updateBoard()) {
                alert("완료되었습니다.");
                move(_URL."board/{$this->param->idx}");
            }
            else {
                $data = (object)$_POST;
                alert("비밀번호가 일치하지 않습니다.");
                getHeader();
                require_once(_VIEW."board/boardUpdate.php");
                getFooter();
            }
        }

        function openBoardDelete() {
            getHeader();
            require_once(_VIEW."board/boardDelete.php");
            getFooter();
        }

        function deleteBoard() {
            if($this->boardService->deleteBoard()) {
                alert("완료되었습니다.");
                move(_URL."board");
            }
            else {
                alert("비밀번호가 일치하지 않습니다.");
                getHeader();
                require_once(_VIEW."board/boardDelete.php");
                getFooter();
            }
        }      
    }
?>