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
				<h3 class="h3"><a href="/my/order" class="link m back">반품/교환 내역</a></h3>
				
				<!-- pc -->
				<div class="table1 pc mb40">
					<table>
						<colgroup>
						</colgroup>
						<thead>
							<tr>
                            	<th>요청일</th>
								<th>주문일</th>
								<th>주문번호</th>
								<th>상품</th>
								<th>수량</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
							if(count($list)) {
								foreach($list as $row) {
						?>
							<tr>
                            	<td><?php echo $row['change_request_dtm']; ?>
								<td><?php echo $row['ins_dtm']; ?></td>
								<td class="f15"><?php echo $row['order_id']; ?></td>
								<td class="f22"><a href="/my/order/change_detail/<?php echo $offset;?>?seq=<?php echo $row['order_id']; ?>"><strong><?php echo $row['product_name']; ?></strong></a></td>
								<td><?php echo $row['change_cnt']; ?></td>
								<td class="f20"><?php echo $row['status_name']; ?><!-- <div class="mt10"><a href="#" class="btn-under">문의</a></div>--></td>
							</tr>
                        
                        <?php
								}
							}
							else {
                        		echo '<tr><td colspan="100%">등록된 반품/교환내역이 없습니다.</td></tr>';
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
                                <a href="/my/order/change_detail/<?php echo $offset;?>?seq=<?php echo $row['order_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['product_name']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $row['change_request_dtm']; ?></div>
                                    <div class="date"><?php echo $row['ins_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>수량</dt>
                                            <dd><?php echo $row['change_cnt']; ?></dd>
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
                        		echo '<li  style="text-align:center">등록된 반품/교환내역이 없습니다.</li>';
							}
						?>
					</ul>
				</div>
				
				<?php echo $pagination; ?>				
            </div>
		</div>
	</div>