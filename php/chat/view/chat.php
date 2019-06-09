<div class="auto-center">
    <div id="chat_list" class="chat_list"></div>

    <div class="submit_chat">
        <div class="input"><input type="text" id='name' placeholder="닉네임" autofocus></div>
        <div class="desc"><textarea id="content" cols="137" rows="5" placeholder="내용"></textarea></div>
        <div class="btn_group">
            <a class="btn-submit" id="submit" href="">등록</a>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        fn_selectChatList();

        setInterval(function() {
            fn_selectChatList();
        }, 1500);
        
        $("#submit").on("click", function(e){ 
            e.preventDefault();
            fn_insertChat();
        });
    });

    function fn_checkComment() {
        var name = $("#name").val();
        var content = $("#content").val();

        if(name.length == 0) { alert("닉네임을 입력해주세요."); return false; }
        if(content.length == 0) { alert("내용을 입력해주세요."); return false; }

        return true;
    }

    function fn_insertChat() {
        var name = $("#name").val();
        var content = $("#content").val();

        if(fn_checkComment()) {
            var comAjax = new ComAjax();
            comAjax.setUrl("<?php echo _URL."chat/write"?>");
            comAjax.addParam("request", "insert");
            comAjax.addParam("name", name);
            comAjax.addParam("content", content);
            comAjax.ajax();
            $("#content").val('');
            $("#content").focus();
            fn_selectChatList();
        }
         
    }

    function fn_selectChatList() {
        var comAjax = new ComAjax();
        comAjax.setUrl("<?php echo _URL."chat/view"?>");
        comAjax.setCallback("fn_selectChatListCallback");
        comAjax.ajax();
    }

    function fn_selectChatListCallback(data) {
        data = JSON.parse(data);
        var body = $("#chat_list");
        var length = $("#chat_list>.table>.tr").length;
        body.empty();

        var str = "";
        str += "<div class='table'>";
        $.each(data, function(key, value){
            str +=  "<div class='tr'>" +
                        "<div class='lbl'>" + value.name + "</div>" +
                        "<div class='desc'>" + value.content + "</div>" +
                        "<div class='date'>" + value.date + "</div>" +
                        "<input type='hidden' id='idx' value=" + value.idx + ">" +
                    "</div>";
        });
        str += "</div>";
        body.append(str);

        if(Object.keys(data).length != length)
            $('#chat_list').scrollTop($('#chat_list')[0].scrollHeight);
    }
</script>