<?php
    class CommentDAO {
        var $param;
        var $db;

        function __construct($param) {
            $this->param = $param;
            $this->db = getPDO();
        }

        function selectCommentList() {
            $stmt = $this->db->prepare("SELECT * FROM comment WHERE board_idx='{$this->param->idx}' ORDER BY idx");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function commentCount() {
            $stmt = $this->db->prepare("SELECT * FROM comment WHERE board_idx='{$this->param->idx}'");
            $stmt->execute();
            return $stmt->rowCount();
        }

        function insertComment($values) {
            $stmt = $this->db->prepare("INSERT INTO comment SET name = :name, pw = :pw, content = :content, board_idx='{$this->param->idx}', date=now()");
            $stmt->execute($values);
        }

        function deleteComment() {
            $stmt = $this->db->prepare("DELETE FROM comment WHERE idx='{$this->param->idx}' AND pw='{$_POST['pw']}'");
            $stmt->execute();
            return $stmt->rowCount();
        }
    }
?>