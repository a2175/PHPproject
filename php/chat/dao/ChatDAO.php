<?php
    class ChatDAO {
        var $param;
        var $db;

        function __construct($param){
            $this->param = $param;
            $this->db = getPDO();
        }

        function selectChatList() {          
            $stmt = $this->db->prepare("SELECT * FROM chat");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        function selectChatDetail($idx) {          
            $stmt = $this->db->prepare("SELECT * FROM chat WHERE idx='{$idx}'");
            $stmt->execute();
            return $stmt->fetch();
        }

        function insertChat($values) {
            $stmt = $this->db->prepare('INSERT INTO chat SET name = :name, content = :content, date=now()');
            $stmt->execute($values);
            return $this->db->lastInsertId();
        }
    }
?>