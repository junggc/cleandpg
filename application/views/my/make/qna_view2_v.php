	<div class="sub-head mypage-head">
		<div class="inner">
			<h2 class="h2">마이 클린디</h2>
		</div>
	</div>
	
	<div class="inner">
		<div class="mypage">
			<?php $this->load->view('common/myNav'); ?>
            <div class="container">
                <h3 class="h3"><a href="<?php echo $move;?>" class="link m back">나의 문의</a></h3>
                <div class="request-form" style="border-bottom: 1px solid #999; padding-bottom:50px;">
                    <dl>
                        <dt>문의제목</dt>
                        <dd><?php echo $info['cqa_title']; ?></dd>
                    </dl>
                    <dl class="last mb10">
                        <dt>문의내용</dt>
                        <dd>
                            <textarea class="textarea" readonly><?php echo nl2br($info['cqa_content']); ?></textarea>
                        </dd>
                    </dl>
                    <dl>
                        <dt>&nbsp;</dt>
                        <dd>
                            <div class="file-box">
                                <div class="files" id="files_wrap" style="margin-top:10px;">
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
                        </dd>
                    </dl>
                </div>
                <div class="request-form mt50">
                    <dl class="last mb50">
                        <dt>답변내용</dt>
                        <dd>
                            <?php echo nl2br($info['cqa_answer_content']); ?>
                        </dd>
                    </dl>
                </div>
                <div class="btn-box-common1">
                    <button class="btn btn-type2 btn-m" onclick="javascript:location.href='<?php echo $move;?>';">목록</button>
                </div>
            </div>
        </div>
	</div>
