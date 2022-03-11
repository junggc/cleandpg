	<div class="sub-head">
		<div class="inner">
			<h2 class="h2">커뮤니티</h2>
			<div class="tabs">
				<div>
					<a href="javascript:void();" class="active">매거진</a>
					<a href="/event">이벤트</a>
					<a href="/faq">FAQ</a>
					<a href="/notice/list">공지사항</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="inner">
		<div class="board-head">
			<h2 class="h2">슬기로운 양치정보 - <br class="mobole">클린디 매거진 </h2>
			<div class="search">
            	<form id="frmSearch" onSubmit="return false;">
					<input type="text" class="inp-srch" name="searchText"  onkeypress="javascript:if(event.keyCode==13) { $('#offset').val(0); fnSearch(); }" />
					<input type="hidden" id="offset" name="offset"/>    
                </form>
				<button class="btn-srch" onclick="javascript:$('#offset').val('0'); fnSearch();">검색</button>
			</div>
		</div>
		<!-- // board-head -->
		
		<div class="magazine-list">
			<ul id="magazine_list_wrap">
				<li style="font-size:24px; text-align:center; width:100%">
                	등록된 매거진이 없습니다.
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
    	url:'/magazine/ajaxMagazineList',
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
				str += '<li>'
					+ ' 	<a href="/magazine/detail?seq=' + data.list[i].cmg_id + '">'
					+ '			<div class="img"><img src="<?php echo CDN_URL; ?>' + data.list[i].main_img + '"></div>'
					+ '			<dl>'
					+ '				<dt>' + data.list[i].cmg_title + '</dt>'
					+ '				<dd>' + data.list[i].cmg_summary + '</dd>'
					+ '			</dl>'
					+ '		</a>'
					+ '	</li>';
			}
			if(data.offset == data.perpage) {
				if(str != '') {
					$('#magazine_list_wrap').html(str);
				}
				else {
					$('#magazine_list_wrap').html('<li style="font-size:24px; text-align:center; width:100%">등록된 매거진이 없습니다.</li>');	
				}
			}
			else {
				$('#magazine_list_wrap').append(str);
			}
			$('#offset').val(data.offset);
       	},
        error:function(data){
         	alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
        }
   });
}
</script>