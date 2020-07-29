<?php
    class ChatService {
        var $param;
        var $chatDAO;

        function __construct($param) {
            $this->param = $param;
            $this->chatDAO = new ChatDAO($this->param);
        }

        function selectChatList() {
            return $this->chatDAO->selectChatList();
        }

        function insertChat() {
            $values = $_POST;
            unset($values['request']);
            $idx = $this->chatDAO->insertChat($values);
            return $this->chatDAO->selectChatDetail($idx);
        }
    }
?>