	<div class="sub-head mypage-head">
		<div class="inner">
			<h2 class="h2">마이 클린디</h2>
		</div>
	</div>
	
	<div class="inner">
		<div class="mypage">
			<?php $this->load->view('common/myNav'); ?>
            <div class="container">
                <h3 class="h3"><a href="<?php echo $move;?>" class="link m back">나의 문의</a></h3>
                <div class="request-form">
                	<form id="frmSave">
                    <dl>
                        <dt>제목</dt>
                        <dd><input type="text" class="inp1" name="cqa_title" placeholder="제목을 입력해주세요"></dd>
                    </dl>
                    <dl class="last mb50">
                        <dt>내용</dt>
                        <dd>
                            <textarea class="textarea" name="cqa_content"></textarea>
                        </dd>
                    </dl>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd>
                            <div class="file-box">
                            	<input type="file" id="add_file" style="display:none"  multiple/>

                                <label for="add_file" style="cursor:pointer;" class="btn-upload"><i class="xi-paperclip"></i> <span>첨부파일</span></label>
                                <div style="font-size:14px">
                                	5MB 이하의 jpg, pdf, png, jpeg, gif, doc, docx, ppt, pptx, xls, xlsx, zip, pdf 파일만 등록 가능합니다.
                                </div><br>
                                <div class="files" id="files_wrap" style="margin-top:10px;">
                                </div>
                            </div>
                        </dd>
                    </dl>
                    </form>
                </div>
                <div class="btn-box-common1">
                    <button class="btn btn-type2 btn-m" onclick="javascript:location.href='<?php echo $move;?>';">취소</button>
                    <button class="btn btn-type1 btn-m" onclick="javascript:fnSave();">저장</button>
                </div>
            </div>
        </div>
	</div>
<script>
var uploadFiles = [];
$(document).ready(function(e) {
	$('#add_file').on('change', function() {
		if($(this).val() == '') {
			return;	
		}
		var maxSize = 5 * 1024 * 1024; // 5MB
		var files = $('#add_file')[0].files;
		for(var i = 0; i < files.length; i++) {
			var ext = files[i].name.split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg', 'pdf', 'png', 'jpeg', 'gif', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'zip', 'pdf']) == -1) {
				showAlert('error', '등록불가능한 파일종류 입니다.');
				$(this).val('');
				return false;
			}

			var fileSize = files[i].size;
			if(fileSize > maxSize){
				alert("첨부파일 사이즈는 5MB 이내로 등록 가능합니다.");
				$(this).val("");
				return false;
			}
		} 
		
	  	var formData = new FormData();

	  	formData.append('target', 'qna');
		for(var i = 0; i < files.length; i++) {
		  	formData.append('files[]', files[i]);
		}
			  // Use `jQuery.ajax` method for example
	  	$.ajax('/common/ajaxFileUpload', {
			method: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success : function(res, textStatus, jqXHR) {
				res = JSON.parse(res);
				if(res.status == 'fail') {
					showAlert('error', res.msg);	
				}
				else {
					for(var i = 0; i < res.fileinfo.length; i++) {
						var str = '<div style="margin-right:20px">'
								+ ' <a class="btn-under" href="/common/img_view?img_path=' + res.fileinfo[i].filepath + '&img_file=' + res.fileinfo[i].newname + '" target="_blank">' + res.fileinfo[i].orgname + '</a>'
								+ ' <input type="hidden" name="orgname[]" value="' + res.fileinfo[i].orgname + '" />'
								+ ' <input type="hidden" name="newname[]" value="' + res.fileinfo[i].newname + '" />'
								+ ' <input type="hidden" name="filepath[]" value="' + res.fileinfo[i].filepath + '" />'
								+ ' <input type="hidden" name="ext[]" value="' + res.fileinfo[i].ext + '" />'
								+ ' <input type="hidden" name="size[]" value="' + res.fileinfo[i].size + '" />'
								+ ' <button class="btn-del" onclick="javascript:fnDeleteFile(this);"><i class="xi-close-thin"></i></button></div>';
						$('#files_wrap').append(str);
					}
				}
			},
	      	error: function(request,status,error){
   				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
		
		$(this).val('');
	});
});

function fnDeleteFile(obj, idx)
{
	$(obj).parent().remove();
}

function fnSave()
{
	$.ajax({
			type:'POST',
			url:'/my/make/ajaxInsertQna',
			data : $('#frmSave').serialize(),
			dataType:"json",
			success:function(res){
				if(res.status == 'succ') {
					showAlert('success', res.msg, function() {location.href='<?php echo $move; ?>';});
				}
				else if(res.status == 'login') {
					showAlert('error', res.msg, function() {location.href="/member/login";});
				}
				else {
					showAlert('error', res.msg);
				}
			},
			error:function(data){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
			}
	});
}
</script>