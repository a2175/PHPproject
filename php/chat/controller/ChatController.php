<?php
    use Pusher\Pusher;

    Class ChatController {
        var $param;
        var $chatService;
        var $data;
        var $pusher;

        function __construct($param){
            header("Content-type:text/html;charset=utf8");
            $this->param = $param;
            $this->chatService = new ChatService($this->param);
            $this->pusher = new Pusher( $_ENV['PUSHER_APP_KEY'], $_ENV['PUSHER_APP_SECRET'], $_ENV['PUSHER_APP_ID'], array('cluster' => $_ENV['PUSHER_APP_CLUSTER']) );

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
                $list = $this->chatService->selectChatList();
                require_once(_VIEW."chat/chat.php");
            });
        }

        function selectChatList() {
            $this->data = (object)$this->chatService->selectChatList();
            echo json_encode($this->data, JSON_UNESCAPED_UNICODE);
        }
        
        function insertChat() {
            $message = $this->chatService->insertChat();
            $this->pusher->trigger('chats', 'MessageSend', $message);
        }
    }
?>