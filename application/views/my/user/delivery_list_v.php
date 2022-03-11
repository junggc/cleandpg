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
				<h3 class="h3"><a href="/my/user" class="link m back">배송지 관리</a></h3>	
				
				<!-- pc -->
				<div class="table1 mb90  pc">
					<table>
						<colgroup>
							<col style="width:150px">
							<col style="width:120px">
							<col style="">
							<col style="width:150px">
							<col style="width:100px">
							<col style="width:150px">
						</colgroup>
						<thead>
							<tr>
								<th>배송지 설명</th>
								<th>받는 분</th>
								<th class="text-left">주소</th>
								<th>연락처</th>
								<th>기본배송지</th>
								<th>관리</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							if(count($list) > 0) {
								foreach($list as $row) {
						?>
   							<tr>
								<td><?php echo $row['mde_title']; ?></td>
								<td><?php echo $row['recipient_name']; ?></td>
								<td class="text-left f16">[<?php echo $row['zipcode']; ?>] <?php echo $row['road_addr']; ?> <?php echo $row['detail_addr']; ?></td>
								<td ><?php echo $row['recipient_phone']; ?></td>
                                <td><?php echo $row['is_default'] == 'y' ? '<i class="fa fa-check"></i>' : ''; ?></td>
								<td>
                                	<a href="#" class="btn-under" onclick="javascript:fnShowAddr('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;" >수정</a>
                                    <?php 
										if($row['is_default'] == 'n') {
									?>
									<a href="#" class="btn-under" onclick="javascript:fnDelete('<?php echo $row['mde_id']; ?>'); return false;">삭제</a>
                                    <?php
										}
									?>
                                </td>
							</tr>
						<?php
								}
							}
							else {
								echo '<tr><td colspan="100%">등록된 배송지가 없습니다.</td></tr>';	
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
                        <?php
							if(count($list) > 0) {
								foreach($list as $row) {
						?>
                            <li>
                                <div href="javascript:void(0);" class="item">
                                    <div class="subj">
                                        <div>
                                            <span class="prd"><?php echo $row['mde_title']; ?></span>
                                        </div>
                                    </div>
                                    <div class="addr">[<?php echo $row['zipcode']; ?>] <?php echo $row['road_addr']; ?> <?php echo $row['detail_addr']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>받는 분</dt>
                                            <dd><?php echo $row['recipient_name']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>연락처</dt>
                                            <dd><?php echo $row['recipient_phone']; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>관리</dt>
                                            <dd>
                                                <a href="#" data-toggle="modal" data-target="#modalBaesong" >수정</a>
												<?php 
                                                    if($row['is_default'] == 'n') {
                                                ?>
                                                <a href="#" onclick="javascript:fnDelete('<?php echo $row['mde_id']; ?>'); return false;">삭제</a>
                                                <?php
													}
												?>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
						<?php
								}
							}
							else {
								echo '<li>등록된 배송지가 없습니다.</li>';
							}
						?>
					</ul>
				</div>
				<?php echo $pagination; ?>
				<div class="text-right">
					<button class="btn btn-type1 btn-m " onclick="javascript:fnShowAddr(''); return false;">등록</button>
				</div>
            </div>
		</div>
		<!-- // 마이페이지 -->
	</div>
	<div class="modal fade" role="dialog" aria-labelledby="introHeader" aria-hidden="true" tabindex="-1" id="modalBaesong" data-backdrop="static">
		<div class="modal-dialog" style="max-width:830px; margin-top:100px;">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-msg1">
						<div class="h3 mb30">배송지 등록</div>
						<div class="baesong-form">
							<div class="mypage-modify">
								<dl>
									<dt>설명</dt>
									<dd>
                                    	<input type="text" class="inp1" id="add_title" style="width:60%" value="">
                                        <input type="hidden" id="add_mde_id" />
                                    </dd>
								</dl>
								<dl>
									<dt>받는분</dt>
									<dd><input type="text" class="inp1" id="add_recipient" style="width:60%" value=""></dd>
								</dl>
								<dl class="hp">
									<dt>휴대폰</dt>
									<dd><input type="text" class="inp1" id="add_phone" style="width:60%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11"  value=""></dd>
								</dl>
								<dl class="addr">
									<dt>주소</dt>
									<dd>
										<div class="addr-box">
											<div class="inp-box1">
                                            	<input type="text" class="inp1" id="add_zip" readonly  value=""> 
                                            	<a href="#" onclick="javascript:execDaumPostcode($('#add_zip'), $('#add_road'), $('#add_jibun') ); return false;" class="btn-under ml20">주소찾기</a>
                                            </div>
											<div class="inp-box2">
                                            	<input type="text" class="inp1 block" id="add_road" readonly value="">
                                            	<input type="hidden" class="inp1 block" id="add_jibun"  value="">
                                            </div>
											<div class="inp-box2"><input type="text" id="add_addr2" class="inp1 block"  value=""></div>
										</div>
									</dd>
								</dl>
								<dl>
									<dt>배송요청</dt>
									<dd><input type="text" class="inp1 block" id="add_memo"  value=""></dd>
								</dl>
							</div>
							<div class="text-center mb40">
								<label><input type="checkbox" id="add_default" class="checkbox" checked><em></em><span>기본 배송지로 지정합니다.</span></label>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button class="btn btn-type2 w280" data-dismiss="modal">취소</button>
					<button class="btn btn-type1 w280" onclick="javascript:fnPopupAddAddr();">확인</button>
				</div>
			</div>
		</div>
	</div>
<script>
function fnShowAddr(data) {
	if(data != '') {
		data = data.replace(/(\n|\r\n)/g, '<br>').replace(/\'/gi, "\"");
		data = JSON.parse(data); 
		
		$('#add_mde_id').val(data.mde_id);
		$('#add_title').val(data.mde_title);
		$('#add_recipient').val(data.recipient_name);
		$('#add_phone').val(data.recipient_phone);
		$('#add_zip').val(data.zipcode);
		$('#add_road').val(data.road_addr);
		$('#add_jibun').val(data.jibun_addr);
		$('#add_addr2').val(data.detail_addr);
		$('#add_memo').val(data.memo);
		$('#add_default').attr('checked', data.is_default == 'y' ? true : false);
	}
	else {
		$('#add_mde_id').val('');
		$('#add_title').val('');
		$('#add_recipient').val('');
		$('#add_phone').val('');
		$('#add_zip').val('');
		$('#add_road').val('');
		$('#add_jibun').val('');
		$('#add_addr2').val('');
		$('#add_memo').val('');
		$('#add_default').attr('checked', true);
	}
	$('#modalBaesong').modal('show');
}

function fnPopupAddAddr()
{
	var param = { mem_id : '<?php echo $user['mem_id']; ?>',
				mde_id : $('#add_mde_id').val(),
				mde_title : $('#add_title').val(),
				recipient_name : $('#add_recipient').val(),
				recipient_phone : $('#add_phone').val(),
				zipcode : $('#add_zip').val(),
				road_addr : $('#add_road').val(),
				jibun_addr : $('#add_jibun').val(),
				detail_addr : $('#add_addr2').val(),
				memo : $('#add_memo').val(),
				is_default : $('#add_default').is(':checked') ? 'y' : 'n' };
			
	var url = $('#add_mde_id').val() == '' ? '/cart/ajaxAddAddress' : '/cart/ajaxUpdateAddress2';	
	$.ajax({
		type:'POST',
		url:url,
		data : param,
		dataType:"json",
		success:function(data){
			if(data.status == 'succ') {
				showAlert('success', data.msg, function() { location.reload(); });
			}
			else if(res.status == 'login') {
				showAlert('error', res.msg, function() {location.href="/member/login";});
			}
			else {
				showAlert('error', data.msg);
			}
		},
		error:function(data){
			alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
		}
   });
}

function fnDelete(seq)
{
	var msg = {msg : '배송지를 삭제 하시겠습니까?', cancel:'닫기', confirm : '삭제'};
	showConfirm(msg, 
				function() {
						$.ajax({
							type:'POST',
							url:'/my/cart/ajaxDeleteAddr',
							data : $('#frmLeave').serialize(),
							dataType:"json",
							success:function(res){
								if(res.status == 'succ') {
									showAlert('success', res.msg, function() {location.reload();});
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