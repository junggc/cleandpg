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
				<h3 class="h3"><a href="/my/order/order_list" class="link m">주문내역</a></h3>

				<!-- pc -->
				<div class="table1 mb90 pc">
					<table>
						<thead>
							<tr>
								<th>날짜</th>
								<th>종류</th>
								<th>주문번호</th>
								<th>상품종류</th>
								<th>주문금액</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							if(count($order) > 0) {
								foreach($order as $row) {
						?>
							<tr>
								<td><?php echo $row['ins_dtm']; ?></td>
								<td class="f20"><?php echo $row['product_name']; ?></td>
								<td class="f15"><?php echo $row['order_id']; ?></td>
								<td class="f22"><a href="/my/order/order_detail/0?seq=<?php echo $row['order_id']; ?>"><strong><?php echo $row['order_type'] == 'billing' ? '정기구독' : '단품구매'; ?></strong></a></td>
								<td class="f20"><?php echo number_format($row['total_price']); ?>원</td>
								<td class="f20"><?php echo $row['status_name']; ?></td>
							</tr>
                        <?php
								}
							}
							else {
								echo '<tr>';
								echo '<td colspan="100%">등록된 주문내역이 없습니다.</td>';
								echo '</tr>';	
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile mb80">
					<ul>
                        <?php
							if(count($order) > 0) {
								foreach($order as $row) {
						?>
						<li>
							<a href="/my/order/order_detail/0?seq=<?php echo $row['order_id']; ?>" class="item">
								<div class="subj">
									<div>
										<strong class="name"><?php echo $row['product_name']; ?></strong>
										<span class="prd"><?php echo $row['order_type'] == 'billing' ? '정기구독' : '단품구매'; ?></span>
									</div>
									<div class="price"><?php echo number_format($row['total_price']); ?> 원</div>
								</div>
								<div class="date"><?php echo $row['ins_dtm']; ?></div>
								<div class="deli">
									<span><?php echo $row['status_name']; ?></span>
									<span><?php echo $row['delivery_start_dtm']; ?></span>
								</div>
							</a>
						</li>
                        <?php
								}
							}
							else {
								echo '<li style="text-align:center">';
								echo '등록된 주문내역이 없습니다.';
								echo '</li>';	
							}
						?>
					</ul>
				</div>
				
				
				
				<h3 class="h3"><a href="/my/order/cancel_list" class="link m">취소/환불 내역</a></h3>

				<h4 class="h5-history">전체 <?php echo $cancelCnt;?>건</h4>
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
							if(count($cancel) > 0) {
								foreach($cancel as $row) {
						?>
							<tr>
								<td><?php echo $row['cancel_complete_dtm']; ?></td>
								<td class="f15"><?php echo $row['order_id']; ?></td>
                                <td class="f15"><?php echo $row['crf_id']; ?></td>
								<td><?php echo $row['refund_type_name']; ?></td>                                
								<td class="f22"><a href="/my/order/cancel_detail/0?seq=<?php echo $row['order_id']; ?>"><?php echo $row['product_name']; ?></a></td>
								<td><?php echo $row['cancel_complete_dtm']; ?></td>
								<td class="f20"><?php echo $row['status_name']; ?></td>
							</tr>
                        <?php
								}
							}
							else {
								echo '<tr>';
								echo '<td colspan="100%">등록된 취소/환불내역이 없습니다.</td>';
								echo '</tr>';	
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
                        <?php
							if(count($cancel) > 0) {
								foreach($cancel as $row) {
						?>
                            <li>
                                <a href="/my/order/cancel_detail/0?seq=<?php echo $row['order_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['product_name']; ?></strong>
                                            <span class="prd"><?php echo $row['refund_type']; ?></span>
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
                                                <span><?php echo $row['status_name']; ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </a>
                            </li>
                        <?php
								}
							}
							else {
								echo '<li style="text-align:center">';
								echo '등록된 취소/환불내역이 없습니다.';
								echo '</li>';	
							}
						?>
						
					</ul>
				</div>
				
				<h3 class="h3"><a href="/my/order/change_list" class="link m">반품/교환 내역</a></h3>
				<!-- pc -->
				<div class="table1 mb90 pc">
					<table>
						<thead>
							<tr>
								<th>요청일</th>
								<th>주문번호</th>
								<th>상품</th>
								<th>수량</th>
								<th>상태</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							if(count($change) > 0) {
								foreach($change as $row) {
						?>
							<tr>
								<td><?php echo $row['change_request_dtm']; ?></td>
								<td class="f15"><?php echo $row['order_id']; ?></td>
								<td class="f22"><a href="/my/order/change_detail/0?seq=<?php echo $row['order_id']; ?>"><?php echo $row['product_name']; ?></a></td>
								<td><?php echo $row['change_cnt']; ?></td>
								<td class="f20"><?php echo $row['status_name']; ?></td>
							</tr>
                        <?php
								}
							}
							else {
								echo '<tr>';
								echo '<td colspan="100%">등록된 반품/교환내역이 없습니다.</td>';
								echo '</tr>';	
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
                        <?php
							if(count($change) > 0) {
								foreach($change as $row) {
						?>
                            <li>
                                <a href="/my/order/change_detail/0?seq=<?php echo $row['order_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['product_name']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $row['change_request_dtm']; ?></div>
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
                                                <span><?php echo $row['status_name']; ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </a>
                            </li>
                        <?php
								}
							}
							else {
								echo '<li style="text-align:center">';
								echo '등록된 반품/교환내역이 없습니다.';
								echo '</li>';	
							}
						?>
						
					</ul>
				</div>
            </div>
		</div>
		<!-- // 마이페이지 -->
	</div>