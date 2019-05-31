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
           <td class="al_l"><a href="<?php echo "{$this->param->get_page}/view/{$data->idx}"?>"><?php echo $data->subject ?></a></td>
           <td><?php echo $data->name ?></td>
           <td><?php echo $data->date ?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
   </table>
   <div class="btn_group"><a class="btn-default" href="<?php echo $this->param->get_page?>/write">작성</a></div>
   <div id="PAGE_NAVI" style="margin:auto; display:table;"></div>
</div>

<script type="text/javascript">
   $(document).ready(function(){
      var params = {
         divId : "PAGE_NAVI",
         pageIndex : "<?php echo $this->param->page_num?>",
         totalCount : <?php echo $listNum?>,
         eventName : "<?php echo $this->param->get_page."/page/"?>"
      };
      gfn_renderPaging(params);
   });
</script>