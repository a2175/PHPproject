<?php
    class ChatDAO {
        var $param;
        var $db;

        function __construct($param){
            $this->param = $param;
            $this->db = new PDO("mysql:host=localhost;port=3307;dbname=mydb;charset=utf8", 'root', '000000');
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }

        function selectChatList() {          
            $stmt = $this->db->prepare("SELECT * FROM chat");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function insertChat($values) {
            $stmt = $this->db->prepare('INSERT INTO chat SET name = :name, content = :content, date=now()');
            $stmt->execute($values);
        }

    }
?>