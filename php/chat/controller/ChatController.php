<?php
    Class ChatController {
        var $param;
        var $chatService;
        var $data;

        function __construct($param){
            header("Content-type:text/html;charset=utf8");
            $this->param = $param;
            $this->chatService = new ChatService($this->param);

            if(isset($_POST['request'])) {
                switch($_POST['request']) {
                    case 'insert' : $this->insertChat(); break;
                }
            }

            switch($this->param->action){
                case 'view' : $this->selectChatList(); break;
                case null : $this->openChat(); break;
            }

        }

        function openChat(){
            renderView(function() {
                require_once(_VIEW."chat/chat.php");
            });
        }

        function selectChatList() {
            $this->data = (object)$this->chatService->selectChatList();
            echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
        }
        
        function insertChat() {
            $this->chatService->insertChat();
        }
    }
?>