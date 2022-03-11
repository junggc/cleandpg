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
				<h3 class="h3"><a href="/my/order" class="link m back">취소/환불 내역</a></h3>
				<h4 class="h5-history">전체 <?php echo $total;?>건</h4>
				<!-- pc -->
				<div class="table1 mb90 pc">
					<table>
						<thead>
							<tr>
								<th>날짜</th>
								<th>주문번호</th>
								<th>환불번호</th>
								<th>환불종류</th>
								<th>상품</th>
								<th>반품완료일</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
							if(count($list)) {
								foreach($list as $row) {
						?>
							<tr>
								<td><?php echo $row['ins_dtm']; ?></td>
								<td class="f15"><?php echo $row['order_id']; ?></td>
								<td class="f15"><?php echo $row['crf_id']; ?></td>
								<td><?php echo $row['refund_type_name']; ?></td>
								<td class="f22"><a href="/my/order/cancel_detail/<?php echo $offset;?>?seq=<?php echo $row['order_id']; ?>"><strong><?php echo $row['product_name']; ?></strong></a></td>
								<td><?php echo $row['cancel_complete_dtm']; ?></td>
								<td class="f20"><?php echo $row['status_name']; ?><!-- <div class="mt10"><a href="#" class="btn-under">문의</a></div>--></td>
							</tr>
                        
                        <?php
								}
							}
							else {
                        		echo '<tr><td colspan="100%">등록된 취소/환불내역이 없습니다.</td></tr>';
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
                        <?php 
							if(count($list)) {
								foreach($list as $row) {
						?>
                            <li>
                                <a href="/my/order/cancel_detail/<?php echo $offset;?>?seq=<?php echo $row['order_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['product_name']; ?></strong>
                                            <span class="prd"><?php echo $row['refund_type_name']; ?></span>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $row['ins_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>환불번호</dt>
                                            <dd><?php echo $row['crf_id']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>반품완료일</dt>
                                            <dd><?php echo $row['cancel_complete_dtm']; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>상태</dt>
                                            <dd>
                                                <span class="red"><?php echo $row['status_name']; ?></span>
                                                <!--<a href="#">문의</a>-->
                                            </dd>
                                        </dl>
                                    </div>
                                </a>
                            </li>
                        
                        <?php
								}
							}
							else {
                        		echo '<li style="text-align:center">등록된 취소/환불내역이 없습니다.</li>';
							}
						?>
						
					</ul>
				</div>
				
				<?php echo $pagination; ?>
                
				<div class="refund-desc">
					<div class="box">
						<h4 class="h4-my">환불종류</h4>
						<dl>
							<dt>구독취소</dt>
							<dd>구독상품을 취소 시 구독취소로 표기됩니다.  </dd>
						</dl>
						<dl>
							<dt>단품결제취소</dt>
							<dd>단품상품에 대해 취소 시 단품결제취소로 표기됩니다. </dd>
						</dl>
						<dl>
							<dt>반품환불</dt>
							<dd>구독상품 및 단품상품 반품 신청 후 반품 완료 시 표기됩니다. </dd>
						</dl>
					</div>
					<div class="box">
						<h4 class="h4-my">환불 절차에 따른 상태값 </h4>
						<dl>
							<dt>환불신청</dt>
							<dd>고객님의 환불신청이 접수되었습니다.</dd>
						</dl>
						<dl>
							<dt>환불처리중</dt>
							<dd>고객님의 환불건을 처리중입니다.</dd>
						</dl>
						<dl>
							<dt>환불완료</dt>
							<dd>고객님께 환불해드렸습니다.</dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>