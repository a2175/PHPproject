<div class="board_list auto-center">
   <h3>총 게시물 수 : <?php echo $listNum?></h3>
   <table width="100%">
      <colgroup>
        <col width="10%">
        <col width="60%">
        <col width="15%">
        <col width="15%">
      </colgroup>
      <thead>
        <tr>
           <th>번호</th>
           <th>제목</th>
           <th>작성자</th>
           <th>작성일</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($list as $key => $data): ?>
        <tr>
           <td><?php echo $data->idx ?></td>
           <td class="al_l"><a href="<?php echo "{$this->param->get_page}/view/{$data->idx}"?>"><?php echo $data->subject; if($data->commentNum>0) echo ' ['.$data->commentNum.']' ?></a></td>
           <td><?php echo $data->name ?></td>
           <td><?php echo $data->date ?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
   </table>
   <div class="btn_group">
      제목 검색: <input type="text" id="keyword" name="keyword" value="<?php echo $this->param->keyword?>">
      <a href="#this" class="btn-submit" id="search">검색</a>
      <a class="btn-default" href="<?php echo $this->param->get_page?>/write">작성</a>
   </div>
   <div id="PAGE_NAVI" style="margin:auto; display:table;"></div>
</div>

<script type="text/javascript">
   var params = {
      divId : "PAGE_NAVI",
      pageIndex : "<?php echo $this->param->page_num?>",
      totalCount : <?php echo $listNum?>,
      eventName : "<?php echo isset($this->param->keyword) ? $this->param->get_page.'/searchpage/' : $this->param->get_page.'/page/'?>",
      keyword : "<?php echo $this->param->keyword?>"
   };
   gfn_renderPaging(params);
   
   document.getElementById("search").addEventListener('click', function(e){
      e.preventDefault();
      fn_openBoardSearchList();
   });
   
   function fn_openBoardSearchList() {
      keyword = document.getElementById("keyword").value;
      location.href = "<?php echo $this->param->get_page.'/searchpage/1/'?>"+keyword;
   }
</script>