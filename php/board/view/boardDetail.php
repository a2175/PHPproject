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
    <div id="comment"></div>
    <div class="submit">
        <div class="input">
            <div class="tr"><input type="text" id='name' value="닉네임" onclick="this.value='';" required></div>
            <div class="tr"><input type="password" id='pw' value="비밀번호" onclick="this.value='';" required></div>
        </div>
        <div class="desc"><textarea id="content" cols="137" rows="5" title="내용" required></textarea></div>
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
            fn_selectCommentList();
        });	
    });

    function fn_selectCommentList() {
        var comAjax = new ComAjax();
        comAjax.setUrl("<?php echo _URL."comment/list/".$this->param->idx?>");
        comAjax.setCallback("fn_selectCommentListCallback");
        comAjax.ajax();
    }

    function fn_selectCommentListCallback(data) {
        data = JSON.parse(data);
        var body = $("#comment");
        body.empty();
        body.append("<h4>총 댓글 수 : " + data.totalCount + "</h4>")
        var str = "";
        str += "<div class='table'>";
        $.each(data.list, function(key, value){
            str +=  "<div class='tr'>" +
                        "<div class='lbl'>" + value.name + "</div>" +
                        "<div class='desc'>" + value.content + "</div>" +
                    "</div>";
        });
        str += "</div>";
        body.append(str);
    }

    function fn_checkComment() {
        var name = $("#name").val();
        var pw = $("#pw").val();
        var content = $("#content").val();

        if(name.length == 0 || name == "닉네임") { alert("닉네임을 입력해주세요."); return false; }
        if(pw.length == 0 || pw == "비밀번호") { alert("비밀번호를 입력해주세요."); return false; }
        if(content.length == 0) { alert("내용을 입력해주세요."); return false; }

        return true;
    }

    function fn_insertComment() {
        var name = $("#name").val();
        var pw = $("#pw").val();
        var content = $("#content").val();

        if(fn_checkComment()) {
            var comAjax = new ComAjax();
            comAjax.setUrl("<?php echo _URL."comment/write/".$this->param->idx?>");
            comAjax.addParam("request", "insert");
            comAjax.addParam("name", name);
            comAjax.addParam("pw", pw);
            comAjax.addParam("content", content);
            comAjax.ajax();
            $("#name").val('닉네임');
            $("#pw").val('비밀번호');
            $("#content").val('');
        } 
    }
</script>