<?php
    Class CommentController {
        var $param;
        var $commentService;
        var $data;

        function __construct($param) {
            header("Content-type:text/html;charset=utf8");
            $this->param = $param;
            $this->commentService = new CommentService($this->param);

            if(isset($_POST['request'])) {
                switch($_POST['request']) {
                    case 'insert' : $this->insertComment(); break;
                }
            }
            else {
                switch($this->param->action) {
                    default : $this->selectCommentList(); break;
                }
            }
        }

        function selectCommentList() {
            $this->data = (object)$this->commentService->selectCommentList();
            echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
        }

        function insertComment() {
            $this->commentService->insertComment();
        }

        function deleteComment() {
        }
    }
?>