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
				<h3 class="h3"><a href="<?php echo $move; ?>" class="link m back">반품/교환 상세</a></h3>
				
				<hr class="hr pc">
				<div class="flex reverse f18 mb20">
					<div>주문일 : <?php echo $info['ins_dtm']; ?>  |  주문번호 : <?php echo $info['order_id']; ?></div>	
					<div>교환할 상품을 먼저 선택하고 수량을 입력하세요.</div>	
				</div>
				
				<!-- pc -->
				<div class="table1 pc mb40">
					<table>
						<colgroup>
							<col style="">
							<col style="width:140px">
							<col style="width:120px">
							<col style="width:120px">
							<col style="width:120px">
							<col style="width:120px">
						</colgroup>
						<thead>
							<tr>
								<th>상품</th>
								<th>수량</th>
								<th>상품금액</th>
								<th>할인적용금액</th>
								<th>배송비</th>
                                <?php
									if($info['change_type'] == 'return') {
								?>
								<th>환불금액</th>
                                <?php
									}
								?>
								<th>상태</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							if($info['order_type'] == 'starter') {
								$org_price = 0;
								$items = array();
								foreach($info['changes'] as $row) {
									$org_price += $row['cit_price'] * $row['qty'];
									$items[] = $row['cit_name'] . (!empty($row['cde_title']) ? '(' . $row['cde_title'] . ')' : '');
								}
								$sum_price = $info['total_price'];
								$sum_dis = $org_price - $sum_price;
						?>
                                <tr>
                                    <td class="f22 text-left"><strong><?php echo $info['product_name']; ?></strong><p style="font-size:14px"><?php echo implode('<br>', $items); ?></p></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo number_format($org_price); ?>원</td>
                                    <td><?php echo number_format($sum_price); ?>원</td>
                                    <td><?php echo number_format($info['change_delivery_price']); ?>원</td>
                                    <?php
                                        if($info['change_type'] == 'return') {
                                    ?>
                                    <td><?php echo number_format($info['change_total_price']); ?>원</td>
                                    <?php
                                        }
                                    ?>
                                    <td><?php echo $info['status_name']; ?></td>
                                </tr>
                        <?php	
							}
							else {
								$idx = 0;
								foreach($info['changes'] as $row) {
						?>
                                <tr>
                                    <td class="f22 text-left"><strong><?php echo $row['cit_name']; ?></strong><p class="f18"><?php echo $row['cde_title']; ?></p></td>
                                    <td><?php echo $row['qty']; ?></td>
                                    <td><?php echo number_format($row['cit_price']); ?>원</td>
                                    <td><?php echo number_format($row['unit_price']); ?>원</td>
                                    <td><?php echo number_format($info['change_delivery_price']); ?>원</td>
                                    <?php
                                        if($info['change_type'] == 'return') {
                                    ?>
                                    <td><?php echo number_format($info['change_total_price']); ?>원</td>
                                    <?php
                                        }
                                    ?>
                                    <td><?php echo $info['status_name']; ?></td>
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
							$idx = 0;
							foreach($info['changes'] as $row) {
						?>
                        <li>
							<div class="item">
								<div class="subj">
									<div>
										<strong class="name"><?php echo $row['cit_name']; ?></strong>
										<p class="opt"><?php echo $row['cde_title']; ?></p>
									</div>
								</div>
								<div class="date"><?php echo $info['request_dtm']; ?></div>
								<div class="info1">
									<dl>
										<dt>상품금액</dt>
										<dd><strong class="f14"><?php echo number_format($row['cit_price']); ?>원</strong></dd>
									</dl>
									<dl>
										<dt>할인적용금액</dt>
										<dd><?php echo number_format($row['unit_price']); ?>원</dd>
									</dl>
									<dl>
										<dt>배송비</dt>
										<dd><?php echo number_format($info['change_delivery_price']); ?>원</dd>
									</dl>
                                    <?php
										if($info['change_type'] == 'return') {
									?>
									<dl>
										<dt>환불금액</dt>
										<dd><strong class="red f14"><?php echo number_format($info['change_total_price']); ?>원</strong></dd>
									</dl>
                                    <?php
										}
									?>
								</div>
								<div class="status">
									<dl>
										<dt>상태</dt>
										<dd>
											<span><?php echo $info['status_name']; ?></span>
										</dd>
									</dl>
								</div>
							</div>
						</li>
                        <?php
							}
						?>
					</ul>
				</div>
				
				
				
				<h4 class="h4-my">반품사유</h4>
				
				<div class="refund-user-msg">
					<div class="t1"><p><?php echo $info['change_reason_msg']; ?></p></div>
					<div class="t2"><?php echo $info['change_reason_etc']; ?></div>
                </div>
   				<div class="cause-form">
					<div class="box2">
						<label class="btn-upload" for="add_file"><i class="xi-paperclip"></i> <span>등록 사진</span></label>
						<div class="files" id="files_wrap">
                        <?php
							foreach($info['files'] as $row) {
						?>
               				<div style="margin-right:20px">
								<a class="btn-under" href="/common/img_view?img_path=<?php echo $row['new_filepath']; ?>&img_file=<?php echo $row['new_filename']; ?>" target="_blank"><?php echo $row['org_filename']; ?></a>
                            </div>
                        <?php
							}
						?>
						</div>
					</div>
				</div>
				
				
				<?php
					if($info['change_type'] == 'change') {
				?>
				<div class="refund-address mb80">
					<div class="box">
						<h4 class="h4-my">연락처</h4>
						<div class="refund-dl type3">
							<dl>
								<dt>구매자</dt>
								<dd><?php echo $info['recipient_name']; ?></dd>
							</dl>
							<dl>
								<dt>휴대폰</dt>
								<dd><?php echo $info['change_recipient_phone1']; ?></dd>
							</dl>
							<dl>
								<dt>연락처2</dt>
								<dd><?php echo $info['change_recipient_phone2']; ?></dd>
							</dl>
						</div>
					</div>
					<div class="box">
						<h4 class="h4-my">주소</h4>
						<div class="refund-dl type3">
							<dl>
								<dd><?php echo $info['recipient_zip'];?></dd>
							</dl>
							<dl>
								<dd><?php echo $info['recipient_addr1'];?></dd>
							</dl>
							<dl>
								<dd><?php echo $info['recipient_addr2'];?></dd>
							</dl>
						</div>
					</div>
				</div>

				<?php
					}
					else {
				?>
                <h4 class="h4-my">환불정보</h4>
				<div class="refund-dl mb50">
                    <dl>
                        <dt>환불은행</dt>
                        <dd><?php echo $info['refund_bank_name']; ?></dd>
                    </dl>
                    <dl>
                        <dt>예금주</dt>
                        <dd><?php echo $info['refund_bank_owner']; ?></dd>
                    </dl>
                    <dl>
                        <dt>계좌번호</dt>
                        <dd><?php echo $info['refund_bank_num']; ?></dd>
                    </dl>
				</div>
                <?php
					}
				?>
				<div class="btn-box-common1">
					<button class="btn btn-type2 btn-m" onclick="javascript:location.href='/';">메인</button>
					<button class="btn btn-type1 btn-m" onclick="javascript:location.href='<?php echo $move; ?>';">목록</button>
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
