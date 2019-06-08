<?php
    class CommentService {
        var $param;
        var $commentDAO;

        function __construct($param) {
            $this->param = $param;
            $this->commentDAO = new CommentDAO($this->param);
        }

        function selectCommentList() {
            $result['list'] = $this->commentDAO->selectCommentList();
            $result['totalCount'] = $this->commentDAO->commentCount();
            return $result;
        }

        function insertComment() {
            $values = $_POST;
            unset($values['request']);
            $this->commentDAO->insertComment($values);
        }

        function deleteComment() {
            return $this->commentDAO->deleteComment();
        }
    }
?>