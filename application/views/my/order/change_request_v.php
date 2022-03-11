	<div class="sub-head mypage-head">
		<div class="inner">
			<h2 class="h2">마이 클린디</h2>
		</div>
	</div>
	
	<div class="inner">
		<!-- 마이페이지 -->
		<div class="mypage">
			<?php $this->load->view('common/myNav'); ?>
			<div class="container">
				<h3 class="h3"><a href="<?php echo $move; ?>" class="link m back">교환신청</a></h3>
				
				<hr class="hr pc">
				<div class="flex reverse f18 mb20">
					<div>주문일 : <?php echo $info['ins_dtm']; ?>  |  주문번호 : <?php echo $info['order_id']; ?></div>	
					<div>교환할 상품을 먼저 선택하고 수량을 입력하세요.</div>	
				</div>
				
			    <form id="frmSave" onSubmit="return false;">
				<!-- pc -->
				<div class="table1 pc mb40">
					<table>
						<colgroup>
							<col style="width:90px">
							<col style="width:140px">
							<col style="">
							<col style="width:120px">
							<col style="width:120px">
							<col style="width:120px">
							<col style="width:120px">
						</colgroup>
						<thead>
							<tr>
								<th><label><input type="checkbox" class="checkbox" id="chkAll"><em></em></label></th>
								<th>주문일</th>
								<th>상품</th>
								<th>주문수량</th>
								<th>가능수량</th>
								<th>신청수량</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							if($info['order_type'] == 'starter') {
								$org_price = 0;
								$items = array();
								foreach($info['list'] as $row) {
									$org_price += $row['cit_price'] * $row['qty'];
									$items[] = $row['cit_name'] . (!empty($row['cde_title']) ? '(' . $row['cde_title'] . ')' : '');
								}
								$sum_price = $info['total_price'];
								$sum_dis = $org_price - $sum_price;
						?>
								<tr>
									<td><label><input type="checkbox" class="checkbox" name="chk[]" value="<?php echo $info['order_id']; ?>" /><em></em></label></td>
									<td><?php echo $info['ins_dtm']; ?></td>
									<td class="f22"><a href=""><strong><?php echo $info['product_name']; ?></strong></a></td>
									<td>1</td>
									<td>1
										<input type="hidden" id="max_qty_<?php echo $info['order_id']; ?>" name="max_qty[]" value="1" />
									</td>
									<td><input type="text" id="req_qty_<?php echo $info['order_id']; ?>" a="<?php echo $info['order_id']; ?>" name="req_qty[]" class="inp1 text-center" style="width:75px" value="0" readonly ></td>
									<td>배송완료</td>
								</tr>
                        <?php
							}
							else {
								$idx = 0;
								foreach($info['list'] as $row) {
									$unit_price = $row['cit_sale_price'];
									if($info['order_type'] == 'billing') {
										$unit_price = $row['cit_subscribe_price'];
									}
							?>
								<tr>
									<td><label><input type="checkbox" class="checkbox" name="chk[]" value="<?php echo $row['cod_id']; ?>" /><em></em></label></td>
									<td><?php echo $info['ins_dtm']; ?></td>
									<td class="f22"><a href=""><strong><?php echo $row['cit_name']; ?></strong></a></td>
									<td><?php echo $row['qty']; ?></td>
									<td>
										<?php echo $row['qty']; ?>
										<input type="hidden" id="max_qty_<?php echo $row['cod_id']; ?>" name="max_qty[]" value="<?php echo $row['qty']; ?>" />
										<input type="hidden" name="cit_name[]" value="<?php echo $row['cit_name']; ?>" />
										<input type="hidden" name="unit_price[]" value="<?php echo $unit_price; ?>" />
										<input type="hidden" name="cod_id[]" value="<?php echo $row['cod_id']; ?>" />
									</td>
									<td><input type="text" id="req_qty_<?php echo $row['cod_id']; ?>" a="<?php echo $row['cod_id']; ?>" name="req_qty[]" class="inp1 text-center" style="width:75px" value="0" readonly ></td>
									<td>배송완료</td>
								</tr>
						<?php
								}
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
                    <?php
						if($info['order_type'] == 'starter') {
					?>
                            <li>
                                <div class="item">
                                    <div class="checks">
                                        <label><input type="checkbox" name="mo_chk[]" class="checkbox" value="<?php echo $info['order_id']; ?>"><em></em></label>
                                    </div>
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $info['product_name']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $info['ins_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>주문수량</dt>
                                            <dd>1</dd>
                                        </dl>
                                        <dl>
                                            <dt>가능수량</dt>
                                            <dd>
												1
                                            	<input type="hidden" name="mo_max_qty[]" value="1" />
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>취소수량</dt>
                                            <dd><input type="tel" name="mo_req_qty[]" id="mo_req_qty_<?php echo $info['order_id']; ?>" a="<?php echo $info['order_id']; ?>" class="inp1 text-center" value="0" style="width:50px" readonly></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>상태</dt>
                                            <dd>
                                                <span>배송완료</span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                    
                    <?php	
						}
						else {
							$idx = 0;
							foreach($info['list'] as $row) {
					?>
                            <li>
                                <div class="item">
                                    <div class="checks">
                                        <label><input type="checkbox" name="mo_chk[]" class="checkbox" value="<?php echo $row['cod_id']; ?>"><em></em></label>
                                    </div>
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['cit_name']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $info['ins_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>주문수량</dt>
                                            <dd><?php echo $row['qty']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>가능수량</dt>
                                            <dd>
												<?php echo $row['qty']; ?>
                                            	<input type="hidden" name="mo_max_qty[]" value="<?php echo $row['qty']; ?>" />
                                            </dd>
                                        </dl>
                                        <dl>
                                            <dt>취소수량</dt>
                                            <dd><input type="tel" name="mo_req_qty[]" id="mo_req_qty_<?php echo $row['cod_id']; ?>" a="<?php echo $row['cod_id']; ?>" class="inp1 text-center" value="0" style="width:50px" readonly></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>상태</dt>
                                            <dd>
                                                <span>배송완료</span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                    <?php
							}
						}
					?>
					</ul>
				</div>
				
				
				
				<h4 class="h4-my">사유선택</h4>
				
				<div class="cause-form">
					<div class="box1">
						<div>
							<select class="select" style="width:100%" name="reason_code">
								<option value="">교환 사유를 선택해주세요</option>
								<option value="1">상품이 마음에 들지 않음 (단순변심)</option>
								<option value="2">상품의 구성품/부속품이 들어있지 않음</option>
								<option value="3">상품이 설명과 다름</option>
								<option value="4">다른 상품이 배송됨</option>
								<option value="5">상품이 파손됨/기능 오동작</option>
							</select>
						</div>
						<div>
							<input type="text" name="reason_etc" class="inp1 block" placeholder="상세 사유를 입력해주세요 ">
						</div>
					</div>
					<div class="box2">
                    	<input type="file" id="add_file" style="display:none" multiple />
						<label class="btn-upload" for="add_file" style="cursor:pointer"><i class="xi-paperclip"></i> <span>사진 등록</span></label>
						<div class="files" id="files_wrap">
						</div>
					</div>
					<div class="desc">* 상품불량, 상품파손, 상품정보상이 의 사유일 경우는 받으신 상품 사진을 필히 첨부해 주시기 바랍니다.  </div>
				</div>
				
				
				
				<div class="refund-address mb80">
					<div class="box">
						<h4 class="h4-my">연락처</h4>
						<div class="refund-dl type3">
							<dl>
								<dt>구매자</dt>
								<dd><?php echo $info['recipient_name']; ?>
                                	<input type="hidden" name="recipient_name" value="<?php echo $info['recipient_name']; ?>" />
                                </dd>
							</dl>
							<dl>
								<dt>휴대폰</dt>
								<dd>
									<input type="tel" name="recipient_phone" class="inp1 block" maxlength="11" value="<?php echo $info['recipient_phone']; ?>" oninput="this.value=this.value.replace(/[^0-9]/g, '')" />
								</dd>
							</dl>
							<dl>
								<dt>연락처2</dt>
								<dd>
									<input type="tel" name="recipient_phone2" class="inp1 block" maxlength="11" oninput="this.value=this.value.replace(/[^0-9]/g, '')" />
								</dd>
							</dl>
						</div>
					</div>
					<div class="box">
						<h4 class="h4-my">주소</h4>
						<div class="refund-addr">
							<div class="inp-box2">
                            	<input type="text" name="recipient_zip" class="inp1 " value="<?php echo $info['recipient_zip'];?>" readonly> 
                            	<a href="#" onclick="javascript:execDaumPostcode($('input[name=recipient_zip]'), $('input[name=recipient_addr1]'), $('input[name=jibun_addr]') ); return false;" class="btn-under">주소찾기</a>
                            </div>
							<div class="inp-box1">
                            	<input type="text" name="recipient_addr1" class="inp1 block" value="<?php echo $info['recipient_addr1'];?>" readonly>
                            	<input type="hidden" name="jibun_addr" />
                            </div>
							<div class="inp-box1"><input type="text" name="recipient_addr2" class="inp1 block" value="<?php echo $info['recipient_addr2'];?>"></div>
						</div>
					</div>
				</div>

				<h4 class="h4-my">배송비 결제 방법</h4>
				
				<div class="baesong-choice mb40">
					<select class="select" name="delivery_way">
						<option value="">선택</option>
						<option value="환불금액에서 차감">환불금액에서 차감</option>
						<option value="직접송금">직접송금</option>
						<option value="택배상자에 동봉">택배상자에 동봉</option>
					</select>
					<span class="blue" >교환 배송비 : <span id="delivery_price">0</span>원</span>
				</div>
				
				<div class="terms1">
					<div>- 교환은 상품수령 후 7일 이내에 신청 가능하며, 7일 경과시 1:1 문의 또는 고객센터(1661-3297)로 문의하여 주시기 바랍니다. </div>
<div>- 고객변심으로 인한 교환 시 배송비는 고객부담 입니다.</div>
<div>- 교환 반품 시 주의 사항
    <p>- 동일 상품 동일 옵션에 한해서만 교환이 가능합니다.</p>
    <p>- 오배송 또는 불량인 상품이라 하여도 사용하신 경우에는 교환이나 반품이 불가능하오니 유의하시기 바랍니다.</p>
    <p>- 교환은 상품을 사용하지 않아야 가능하며, 그외 상품 부속물인 라벨,부품, 상품보호 비닐 등을 분실/제거하지 않아야 가능합니다.</p></div>
<div>- 패키지 상품, 묶음 상품, 특가 상품은 부분 반품이 불가하오니 양해 부탁드립니다.</div>
<div>- 박스단위 포장 상품은 제품의 일부를 개봉하여 취식한 후에는 교환 기간 내라도 부분교환이 불가하오니 양해 부탁드립니다</div>
				</div>
				
                    <input type="hidden" name="order_id" value="<?php echo $info['order_id']; ?>" />
                    <input type="hidden" name="reason" value="" />
                    <input type="hidden" name="action_type" value="change" />
                </form>
				
				
				<div class="btn-box-common1">
					<button class="btn btn-type2 btn-m" onclick="javascript:location.href='<?php echo $move; ?>';">취소</button>
					<button class="btn btn-type1 btn-m" onclick="javascript:fnReturn();">교환신청</button>
				</div>
                
            </div>
		</div>
	</div>
<style>
.bank_in {width:40% !important}
@media (max-width:900px)
{
	.bank_in {width:100% !important}
}
</style>
<script>
$(document).ready(function(e) {
    $('#chkAll').on('click', function() {
		if($(this).is(':checked')) {
			$('input[name="chk[]"]').attr('checked', true);
			$('input[name="mo_chk[]"]').attr('checked', true);
			$('input[name="req_qty[]"]').attr('readonly', false);
			$('input[name="mo_req_qty[]"]').attr('readonly', false);
		}
		else {
			$('input[name="chk[]"]').attr('checked', false);	
			$('input[name="mo_chk[]"]').attr('checked', false);	
			$('input[name="req_qty[]"]').attr('readonly', true);
			$('input[name="mo_req_qty[]"]').attr('readonly', true);
			$('input[name="req_qty[]"]').val('0');
			$('input[name="mo_req_qty[]"]').val('0');
		}
	});
	
	$('input[name="chk[]"]').on('click', function() {
		var bCheck = true;
		$('input[name="chk[]"]').each(function(index, element) {
            if(!$(this).is(':checked')) {
				bCheck = false;
			}
        });
		$('#chkAll').prop('checked', bCheck);

		$('#req_qty_' + $(this).val()).attr('readonly', !$(this).is(':checked'));
		$('#mo_req_qty_' + $(this).val()).attr('readonly', !$(this).is(':checked'));

		if(!$(this).is(':checked')) {
			$('#req_qty_' + $(this).val()).val('0');	
		}
		var idx = $('input[name="chk[]"]').index(this);
		$('input[name="mo_chk[]"]').eq(idx).prop('checked', $('input[name="chk[]"]').eq(idx).is(':checked'));
	});

	$('input[name="mo_chk[]"]').on('click', function() {
		$('#mo_req_qty_' + $(this).val()).attr('readonly', !$(this).is(':checked'));
		$('#req_qty_' + $(this).val()).attr('readonly', !$(this).is(':checked'));
		if(!$(this).is(':checked')) {
			$('#mo_req_qty_' + $(this).val()).val('0');	
			$('#req_qty_' + $(this).val()).val('0');	
		}
		var idx = $('input[name="mo_chk[]"]').index(this);
		$('input[name="chk[]"]').eq(idx).prop('checked', $('input[name="mo_chk[]"]').eq(idx).is(':checked'));

		var bCheck = true;
		$('input[name="chk[]"]').each(function(index, element) {
            if(!$(this).is(':checked')) {
				bCheck = false;
			}
        });
		$('#chkAll').prop('checked', bCheck);
	});
	
	$('input[name="req_qty[]"]').on('input', function() {
		var id = $(this).attr('a');
		var max_val = $('#max_qty_' + id).val();

		var val = $(this).val();
		val = val.replace(/[^0-9]/g, '');
		val = Number(val);
		if(val > max_val) val = max_val;
		$(this).val(val);
		$('#mo_req_qty_' + id).val(val);
		fnCalcPrice();
	});

	$('input[name="mo_req_qty[]"]').on('input', function() {
		var id = $(this).attr('a');
		var max_val = $('#max_qty_' + id).val();
		var val = $(this).val();
		val = val.replace(/[^0-9]/g, '');
		val = Number(val);
		if(val > max_val) val = max_val;

		$(this).val(val);
		$('#req_qty_' + id).val(val);
		fnCalcPrice();
	});

	$('select[name=reason_code]').on('change', function() {
		var delivery_price = 0;
		var msg = '원';
		if($(this).val() == '1') {
			delivery_price = 6000;	
		}
		$('input[name=reason]').val($('select[name=reason_code] option:selected').text());
		$('#delivery_price').html(commify(delivery_price));
		fnCalcPrice();
	});
	
	$('#add_file').on('change', function() {
		if($(this).val() == '') {
			return;	
		}
		var maxSize = 5 * 1024 * 1024; // 5MB
		var files = $('#add_file')[0].files;
		if(files.length > 20) {
			showAlert('error', '첨부파일은 한번에 20개까지만 등록가능합니다.');
			return;	
		}
		for(var i = 0; i < files.length; i++) {
			var ext = files[i].name.split('.').pop().toLowerCase();
			if($.inArray(ext, ['jpg', 'pdf', 'png', 'jpeg', 'gif']) == -1) {
				showAlert('error', '이미지 파일만 등록가능합니다.');
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

	  	formData.append('target', 'return');
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

function fnDeleteFile(obj)
{
	$(obj).parent().remove();
}

function fnCalcPrice()
{
	var total_price = 0;
	$('input[name="req_qty[]"]').each(function(index, element) {
        var qty = $(this).val();
		var price = $('input[name="unit_price[]"]').eq(index).val();
		console.log(price);
		total_price += qty * price;
    });
	$('#refund_price').html(commify(total_price) + '원');
}

function fnReturn()
{
	var msg = {msg : '교환 요청을 하시겠습니까?', cancel:'닫기', confirm : '교환'};
	showConfirm(msg, 
				function() {
						$.ajax({
							type:'POST',
							url:'/my/order/ajaxChange',
							data : $('#frmSave').serialize(),
							dataType:"json",
							success:function(res){
								if(res.status == 'succ') {
									showAlert('success', res.msg, function() {location.href='/my/order/order_detail/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>';}, res.msg2);
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
				});
}
</script>