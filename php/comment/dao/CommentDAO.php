<?php
    class CommentDAO {
        var $param;
        var $db;

        function __construct($param) {
            $this->param = $param;
            $this->db = new PDO("mysql:host=localhost;port=3307;dbname=mydb;charset=utf8", 'root', '000000');
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
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
    }
?>