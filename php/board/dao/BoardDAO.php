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
            $stmt = $this->db->prepare("SELECT * FROM board order by `date` desc");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function boardCount() {
            $stmt = $this->db->prepare("SELECT * FROM board order by `date` desc");
            $stmt->execute();
            return $stmt->rowCount();
        }

        function openBoardDetail() {
            $stmt = $this->db->prepare("SELECT * FROM board where idx='{$this->param->idx}'");
            $stmt->execute();
            return $stmt->fetch();
        }
    }
?>