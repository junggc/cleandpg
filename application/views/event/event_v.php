	<div class="sub-head">
		<div class="inner">
			<h2 class="h2">커뮤니티</h2>
			<div class="tabs">
				<div>
					<a href="/magazine">매거진</a>
					<a href="javascript:void(0);" class="active">이벤트</a>
					<a href="/faq">FAQ</a>
					<a href="/notice/list">공지사항</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="inner">
		<div class="board-head mb50">
			<h2 class="h2">활짝 웃는 양치생활 - 클린디 이벤트 </h2>
		</div>
		<!-- // board-head -->
		<div class="board-head-status">
			<div class="total">전체 <span id="total"></span>건</div>
			<div>
            <form id="frmSearch">
            	<input type="hidden" name="offset"/>
				<select class="select" name="order_by" onchange="javascript:$('#offset').val(0); fnSearch();">
					<option value="new">최신순</option>
					<option value="end">종료임박순</option>
					<option value="winner">발표일순</option>
				</select>
            </form>
			</div>
		</div>
		
		<div class="event-list">
			<ul id="event_list_wrap">
				<li style="font-size:24px; text-align:center; width:100%">
                	등록된 이벤트가 없습니다.
				</li>
			</ul>
			
			<div class="text-center more" id="more_button">
				<button class="btn btn-type0 btn-m w190" onclick="javascript:fnSearch(); ">더보기</button>
			</div>
		</div>
    </div>
<script>
$(document).ready(function(e) {
	$('#offset').val('0');
    fnSearch();
});

function fnSearch()
{
	$.ajax({
      	type:'POST',
    	url:'/event/ajaxEventList',
		data : $('#frmSearch').serialize(),
		dataType:"json",
       	success:function(data){
			var str = '';
			if(data.list.length < data.perpage) {
				$('#more_button').hide();	
			}
			else {
				$('#more_button').show();	
			}
			for(var i = 0; i < data.list.length; i++) {
				str += '<li class="' + data.list[i].status + '">'
					+ '		<a href="/event/detail?seq=' + data.list[i].cbe_id + '">'
					+ '			<div class="img"><img src="<?php echo CDN_URL; ?>' + data.list[i].main_img + '"><p><span>' + data.list[i].status_text + '</span></p></div>'
					+ '			<dl>'
					+ '				<dt>' + data.list[i].cbe_title + '</dt>'
					+ '				<dd>' + data.list[i].start_date + ' ~ ' + data.list[i].end_date + '</dd>'
					+ '			</dl>'
					+ '		</a>'
					+ '	</li>';
			}
			if(data.offset == data.perpage) {
				if(str != '') {
					$('#event_list_wrap').html(str);
				}
				else {
					$('#event_list_wrap').html('<li style="font-size:24px; text-align:center; width:100%">등록된 이벤트가 없습니다.</li>');	
				}
			}
			else {
				$('#event_list_wrap').append(str);
			}
			$('#offset').val(data.offset);
			$('#total').html(commify(data.total_rows));
       	},
        error:function(data){
         	alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
        }
   });
}
</script>		