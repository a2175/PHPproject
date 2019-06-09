<div class="board_view auto-center">
    <h3>글보기</h3>
    <div class="table">
        <div class="tr">
            <div class="lbl">작성자</div>
            <div class="desc"><?php echo $data->name?></div>
        </div>
        <div class="tr">
            <div class="lbl">제목</div>
            <div class="desc"><?php echo $data->subject?></div>
        </div>
        <div class="tr">
            <div class="lbl">내용</div>
            <div class="desc content"><?php echo nl2br($data->content)?></div>
        </div>
    </div>
    <div id="comment_list"></div>
    <div class="submit_comment">
        <div class="input">
            <div class="tr"><input type="text" id='name' placeholder="닉네임"></div>
            <div class="tr"><input type="password" id='pw' placeholder="비밀번호"></div>
        </div>
        <div class="desc"><textarea id="content" cols="137" rows="5" placeholder="내용"></textarea></div>
        <div class="btn_group">
            <a class="btn-submit" id="submit" href="">등록</a>
        </div>
    </div>
    <div class="btn_group">
        <a class="btn-default" href="<?php echo $this->param->get_page?>">목록</a>
        <a class="btn-submit" href="<?php echo $this->param->get_page?>/update/<?php echo $this->param->idx?>">수정</a>
        <a class="btn-submit" href="<?php echo $this->param->get_page?>/delete/<?php echo $this->param->idx?>">삭제</a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        fn_selectCommentList();
        
        $("#submit").on("click", function(e){ 
            e.preventDefault();
            fn_insertComment();
        });
    });

    function fn_selectCommentList() {
        var comAjax = new ComAjax();
        comAjax.setUrl("<?php echo _URL."comment/view/".$this->param->idx?>");
        comAjax.setCallback("fn_selectCommentListCallback");
        comAjax.ajax();
    }

    function fn_selectCommentListCallback(data) {
        data = JSON.parse(data);
        var body = $("#comment_list");
        body.empty();
        body.append("<h4>총 댓글 수 : " + data.totalCount + "</h4>")
        var str = "";
        str += "<div class='table'>";
        $.each(data.list, function(key, value){
            str +=  "<div class='tr'>" +
                        "<div class='lbl'>" + value.name + "</div>" +
                        "<div class='desc'>" + value.content + "</div>" +
                        "<div class='date'>" + value.date + "</div>" +
                        "<div class='delete'>" + "<a href='#' id='opendel'><img src='<?php echo _IMG.'delete.jpg'?>'></a>" + "</div>" +
                        "<input type='hidden' id='idx' value=" + value.idx + ">" +
                    "</div>";
        });
        str += "</div>";
        body.append(str);

        $("a[id='opendel']").on("click", function(e){
            e.preventDefault();
            fn_openDeleteComment($(this).parent());
        });
    }
    
    function fn_checkComment() {
        var name = $("#name").val();
        var pw = $("#pw").val();
        var content = $("#content").val();

        if(name.length == 0) { alert("닉네임을 입력해주세요."); return false; }
        if(pw.length == 0) { alert("비밀번호를 입력해주세요."); return false; }
        if(content.length == 0) { alert("내용을 입력해주세요."); return false; }

        return true;
    }

    function fn_insertComment() {
        var name = $("#name").val();
        var pw = $("#pw").val();
        var content = $("#content").val();

        if(fn_checkComment()) {
            var comAjax = new ComAjax();
            comAjax.setUrl("<?php echo _URL."comment/write/{$this->param->idx}"?>");
            comAjax.addParam("request", "insert");
            comAjax.addParam("name", name);
            comAjax.addParam("pw", pw);
            comAjax.addParam("content", content);
            comAjax.ajax();
            $("#name").val('');
            $("#pw").val('');
            $("#content").val('');
            fn_selectCommentList();
        }
    }

    function fn_openDeleteComment(obj) {
        var div = obj.parent().find(".btn_group").length;
        var str = '';
        if(div == 0) {
            str  =  "<div class='btn_group'>" +
                        "<input type='password' id='commentpw' placeholder='비밀번호'>" +
                        "<a id='commentdelete' class='btn-submit' href=''>확인</a>" +
                        "<a id='commentcencel' class='btn-submit' href=''>취소</a>" +
                    "</div>";
        }
        obj.parent().append(str);

        $("a[id='commentdelete']").on("click", function(e){
            e.preventDefault();
            fn_deleteComment($(this));
        });

        $("a[id='commentcencel']").on("click", function(e){
            e.preventDefault();
            fn_deleteCencel($(this));
        });
    }

    function fn_deleteComment(obj) {
        var idx = obj.parent().parent().find("#idx").val();
        var pw = obj.parent().find("#commentpw").val();

        var comAjax = new ComAjax();
        comAjax.setUrl("<?php echo _URL."comment/delete/"?>"+idx);
        comAjax.setCallback("fn_deleteCommentCallback");
        comAjax.addParam("request", "delete");
        comAjax.addParam("pw", pw);
        comAjax.ajax();
    }

    function fn_deleteCommentCallback(data) {
        if(data == 1) {
            alert("완료되었습니다.");
            fn_selectCommentList();
        }
        else {
            alert("비밀번호가 일치하지 않습니다.");
        }
    }

    function fn_deleteCencel(obj) {
        obj.parent().remove();
    }
</script>