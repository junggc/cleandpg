	
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
				<h3 class="h3"><a href="/my/survey" class="link m back">진단관리</a></h3>

				<!-- pc -->
				<div class="table1 mb90 f16 pc">
					<table>
						<colgroup>
							<col style="width:90px">
							<col style="width:160px">
							<col style="">
							<col style="width:120px">
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>진단일시</th>
								<th>진단명</th>
								<th>결과</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							$idx = 0;
							if(count($list) > 0) {
								foreach($list as $row) {
						?>
							<tr>
								<td><?php echo $total - $offset - $idx; ?></td>
								<td><?php echo date('Y/m/d', strtotime($row['ins_dtm'])); ?></td>
								<td class="f18 text-left"><?php echo $row['cdg_title']; ?></td>
								<td><a href="/diagnosis/detail?seq=<?php echo $row['cdg_id']; ?>" class="btn-under">결과보기</a></td>
							</tr>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<tr><td colspan="100%">진단 이력이 없습니다.</td></tr>';	
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
						if(count($list) > 0) {
							foreach($list as $row) {
					?>
						<li>
							<div class="item">
								<div class="subj">
									<div>
										<div class="opt">번호 <?php echo $total - $offset - $idx; ?></div>
										<strong class="name"><?php echo $row['cdg_title']; ?></strong>
									</div>
								</div>
								<div class="date mb50"><?php echo date('Y/m/d', strtotime($row['ins_dtm'])); ?></div>
								<div class="status">
									<dl>
										<dt>결과</dt>
										<dd>
											<a href="/diagnosis/detail?seq=<?php echo $row['cdg_id']; ?>">결과보기</a>
										</dd>
									</dl>
								</div>
							</div>
						</li>
                    <?php
								$idx++;
							}
						}
						else {
							echo '<li style="text-align:center">진단 이력이 없습니다.</li>';
						}
					?>
					</ul>
				</div>
				<?php echo $pagination; ?>
            </div>
		</div>
		<!-- // 마이페이지 -->
	</div>
