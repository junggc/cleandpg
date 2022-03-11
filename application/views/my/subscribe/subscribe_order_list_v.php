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
				
				<h3 class="h3"><a href="/my/subscribe/detail/0?seq=<?php echo $seq; ?>" class="link m back">구독내역</a></h3>
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
                                    <th>배송일자</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if(!empty($list)) {
                                    foreach($list as $order) {
                            ?>
                                <tr>
                                    <td><?php echo $order['ins_dtm']; ?></td>
                                    <td class="f20">구독상품</td>
                                    <td class="f15"><?php echo $order['order_id']; ?></td>
                                    <td class="f22"><a href="/my/subscribe/order_detail?seq=<?php echo $order['order_id']; ?>"><strong><?php echo $order['product_name']; ?></strong></a></td>
                                    <td class="f20"><?php echo number_format($order['total_price']); ?>원</td>
                                    <td class="f20"><?php echo $order['status_name']; ?></td>
                                    <td><?php echo $order['delivery_start_dtm']; ?></td>
                                </tr>
                            <?php
                                    }
                                }
                                else {
                                    echo '<tr><td colspan="100%">구독 이력이 없습니다.</td></tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- mobile -->
                    <div class="m-table1 mobile mb80">
                        <ul>
                            <?php
                                if(!empty($list)) {
                                    foreach($list as $order) {
                            ?>
                            <li>
                                <a href="/my/subscribe/order_detail?seq=<?php echo $order['order_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $order['product_name']; ?></strong>
                                            <span class="prd">구독상품</span>
                                        </div>
                                        <div class="price"><?php echo number_format($order['total_price']); ?>원</div>
                                    </div>
                                    <div class="date"><?php echo $order['ins_dtm']; ?></div>
                                    <div class="deli">
                                        <span><?php echo $order['status_name']; ?></span>
                                        <span><?php echo $order['delivery_start_dtm']; ?></span>
                                    </div>
                                </a>
                            </li>
                            <?php
                                    }
                                }
                                else {
                                    echo '<li>구독 이력이 없습니다.</li>';
                                }
                            ?>
                        </ul>
                    </div>
    
					<?php echo $pagination; ?>					
			</div>	
		</div>
		<!-- // 마이페이지 -->
	</div>
	<!-- // inner -->
<input type="hidden" name="offset" value="0" />
