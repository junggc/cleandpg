                    <h3 class="h3"><a href="/my/subscribe/detail?seq=<?php echo $seq; ?>" class="link m">구독내역</a></h3>
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
<script>
function goPage(offset)
{
	$.ajax({
		url: "/my/subscribe/list_detail",
		type: 'POST',
		async: true,
		data: {csu_id : '<?php echo $csu_id; ?>', offset : offset},
		success: function(data, textStatus, jqXHR){
			$('#tab_wrap').html(data);
		},
		error: function(request,status,error){
			alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
		}
	});
}
</script>