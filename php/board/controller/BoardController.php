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
            renderView(function() {
                $this->data = (object)$this->boardService->openBoardList();
                $list = $this->data->list;
                $listNum = $this->data->totalCount;
                require_once(_VIEW."board/boardList.php");
            });
        }

        function openBoardSearchList(){
            renderView(function() {
                $this->data = (object)$this->boardService->openBoardSearchList();
                $list = $this->data->list;
                $listNum = $this->data->totalCount;
                require_once(_VIEW."board/boardList.php");
            });
        }

        function openBoardDetail() {
            renderView(function() {
                $data = $this->boardService->openBoardDetail();
                require_once(_VIEW."board/boardDetail.php");
            });
        }

        function openBoardWrite() {
            renderView(function() {
                require_once(_VIEW."board/boardWrite.php");
            });
        }
        
        function insertBoard() {
            $this->boardService->insertBoard();
            alert("완료되었습니다.");
            move(_URL."board");
        }
        
        function openBoardUpdate() {
            renderView(function() {
                $data = $this->boardService->openBoardDetail();
                require_once(_VIEW."board/boardUpdate.php");
            });
        }

        function updateBoard() {
            if($this->boardService->updateBoard()) {
                alert("완료되었습니다.");
                move(_URL."board/{$this->param->idx}");
            }
            else {
                alert("비밀번호가 일치하지 않습니다.");
                renderView(function() {
                    $data = (object)$_POST;
                    require_once(_VIEW."board/boardUpdate.php");
                });
            }
        }

        function openBoardDelete() {
            renderView(function() {
                require_once(_VIEW."board/boardDelete.php");
            });
        }

        function deleteBoard() {
            if($this->boardService->deleteBoard()) {
                alert("완료되었습니다.");
                move(_URL."board");
            }
            else {
                alert("비밀번호가 일치하지 않습니다.");
                renderView(function() {
                    require_once(_VIEW."board/boardDelete.php");
                });
            }
        }      
    }
?>