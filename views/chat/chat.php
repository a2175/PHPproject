<div class="auto-center">
    <div id="chat_list" class="chat_list">
        <div class='table'>
            <?php foreach ($list as $key => $data): ?>
                <div class='tr'>
                    <div class='lbl'><?php echo $data->name ?></div> 
                    <div class='desc'><?php echo $data->content ?></div> 
                    <div class='date'><?php echo $data->date ?></div> 
                </div>  
            <?php endforeach ?>
        </div>
    </div>

    <div class="submit_chat">
        <span class="input"><input type="text" id='name' placeholder="닉네임" autofocus></span>
        <span class="desc"><textarea id="content" rows="5" placeholder="내용"></textarea></span>
        <div class="btn_group">
            <a class="btn-submit" id="submit" href="">등록</a>
        </div>
    </div>
</div>

<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script type="text/javascript">
    fn_moveScrollEnd();

    const pusher = new Pusher("<?php echo $_ENV['PUSHER_APP_KEY'] ?>", {
        cluster: "<?php echo $_ENV['PUSHER_APP_CLUSTER'] ?>",
    });

    const channel = pusher.subscribe('chats');

    channel.bind('MessageSend', function (data) {
        var body = document.getElementById("chat_list");
        var prevScrollHeight = body.scrollHeight;

        var str =  "<div class='tr'>" +
                        "<div class='lbl'>" + data.name + "</div>" +
                        "<div class='desc'>" + data.content + "</div>" +
                        "<div class='date'>" + data.date + "</div>" +
                    "</div>";

        body.querySelector('.table').innerHTML += str;

        if(body.scrollTop == (prevScrollHeight - body.offsetHeight))
            fn_moveScrollEnd();
    });

    document.getElementById("content").addEventListener('keydown', function(e){
        if (e.keyCode == 13) {
            e.preventDefault();
            fn_insertChat();
        }
    });
    
    document.getElementById("submit").addEventListener('click', function(e){
        e.preventDefault();
        fn_insertChat();
    });

    function fn_checkComment() {
        var name = document.getElementById("name").value;
        var content = document.getElementById("content").value;

        if(name.length == 0) { alert("닉네임을 입력해주세요."); return false; }
        if(content.length == 0) { alert("내용을 입력해주세요."); return false; }

        return true;
    }

    function fn_insertChat() {
        var name = document.getElementById("name").value;
        var content = document.getElementById("content").value;

        if(fn_checkComment()) {
            document.getElementById("content").value = '';
            document.getElementById("content").focus();

            var comAjax = new ComAjax();
            comAjax.setUrl("<?php echo _URL."chat/write"?>");
            comAjax.addParam("request", "insert");
            comAjax.addParam("name", name);
            comAjax.addParam("content", content);
            comAjax.ajax();
        }
    }

    function fn_moveScrollEnd() {
        var body = document.getElementById("chat_list");
        body.scrollTop = body.scrollHeight;
    }
</script>