<?php
    class BoardDAO {
        var $param;
        var $db;

        function __construct($param){
            $this->param = $param;
            $this->db = new PDO("mysql:host=localhost;port=3307;dbname=mydb;charset=utf8", 'root', '000000');
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }

        function openBoardList() {
            $nPageIndex = $this->param->page_num - 1;
            $nPageRow = 15;
            
            $START = $nPageIndex * $nPageRow;
            $END = $nPageRow;
            
            $stmt = $this->db->prepare("SELECT * FROM board ORDER BY idx DESC LIMIT {$START}, {$END}");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function boardCount() {
            $stmt = $this->db->prepare("SELECT * FROM board");
            $stmt->execute();
            return $stmt->rowCount();
        }

        function openBoardDetail() {
            $stmt = $this->db->prepare("SELECT * FROM board WHERE idx='{$this->param->idx}'");
            $stmt->execute();
            return $stmt->fetch();
        }

        function insertBoard($values) {
            $stmt = $this->db->prepare('INSERT INTO board SET name = :name, pw = :pw, subject = :subject, content = :content, date=now()');
            $stmt->execute($values);
        }

        function updateBoard($values) {
            $stmt = $this->db->prepare("UPDATE board SET name = :name, pw = :pw, subject = :subject, content = :content WHERE idx='{$this->param->idx}' AND pw='{$values['pw']}'");
            $stmt->execute($values);
            return $stmt->rowCount();
        }

        function deleteBoard() {
            $stmt = $this->db->prepare("DELETE FROM board WHERE idx='{$this->param->idx}' AND pw='{$_POST['pw']}'");
            $stmt->execute();
            return $stmt->rowCount();
        }
    }
?>