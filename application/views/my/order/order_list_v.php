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
				<h3 class="h3 pc mb10"><a href="/my/order" class="link m back">주문내역</a></h3>
				<h3 class="h3 mobile"><a href="/my/order" class="link m back">주문내역</a></h3>
				<div class="mb20 text-right pc">
					<a href="/my/order/cancel_list" class="btn-under">취소/환불 내역</a>
					<a href="/my/order/change_list" class="btn-under ml30">반품/교환 내역</a>
				</div>

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
							if(count($list) > 0) {
								foreach($list as $row) {
						?>
							<tr>
                            	<td><?php echo $row['ins_dtm']; ?></td>
								<td class="f20"><?php echo $row['order_type'] == 'billing' ? '구독상품' : '1회구매'; ?></td>
								<td class="f15"><?php echo $row['order_id']; ?></td>
								<td class="f22"><a href="/my/order/order_detail/<?php echo $offset; ?>?seq=<?php echo $row['order_id']; ?>"><strong><?php echo $row['product_name']; ?> </strong></a></td>
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
				<div class="m-table1 border-bottom-none mobile mb80">
					<ul>
                        <?php
							if(count($list) > 0) {
								foreach($list as $row) {
						?>
                            <li>
                                <a href="/my/order/order_detail?seq=<?php echo $row['order_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['product_name']; ?></strong>
                                            <span class="prd"><?php echo $row['order_type'] == 'billing' ? '구독상품' : '1회구매'; ?></span>
                                        </div>
                                        <div class="price"><?php echo number_format($row['total_price']); ?> 원</div>
                                    </div>
                                    <div class="date"><?php echo $row['ins_dtm']; ?></div>
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
								echo '등록된 주문내역이 없습니다.';
								echo '</li>';
							}
						?>
					</ul>
				</div>
				<?php echo $pagination; ?>				
			</div>
		</div>
	</div>