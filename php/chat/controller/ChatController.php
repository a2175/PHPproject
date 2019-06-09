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
            $this->getTitle();
            $this->header();
            require_once(_APP."chat/view/chat.php");
            $this->footer();
        }

        function selectChatList() {
            $this->data = (object)$this->chatService->selectChatList();
            echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
        }
        
        function insertChat() {
            $this->chatService->insertChat();
        }

        //getTitle
        function getTitle(){
            $this->title = 'MVC Model';
        }

        //header
        function header(){
            require_once(_APP."common/view/header.php");
        }

        //footer
        function footer(){
            require_once(_APP."common/view/footer.php");
        }
    }
?>