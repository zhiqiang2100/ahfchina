
<?php require dirname(__FILE__) . '/header.php';?>
	<!-- 获奖 -->
	<article>
		<h2 class="ranking_before_h2">往期获奖用户名单</h2>
		<div class="ranking_cont">
			<?php
			 if(isset($hdInfo['all_user_prizes']) && is_array($hdInfo['all_user_prizes'])){
			 	$i = count($hdInfo['all_user_prizes']); 
			 	$all_user_prizes = $hdInfo['all_user_prizes'];
			 	krsort($all_user_prizes);
			 	foreach ($all_user_prizes as $key => $cycleldata) {
			 		if( empty($cycleldata) ){
			 			$i--;
			 			continue;
			 		}
			 		$y = substr($key, 0,4);
			 		$m = substr($key, 4,2);
			 		$d = substr($key, 6,2);
			 		$date = date('n月j日',mktime(0,0,0,$m,$d+7,$y));
			 		echo '<h3 class="before_tips">第 '.$i.' 期('.$date.'开奖)</h3>';
			 		foreach ($cycleldata as $k => $user) {
			 			echo '<dl class="ranking_items">
								<dt><a href="javascript:void(0)" class="hIcon ranking_user" title="'.$user['wb_screen_name'].'"><img src="'.$user['wb_profile_img'].'" alt="'.$user['wb_screen_name'].'"/></a></dt>
								<dd>
									<span>'.$user['wb_screen_name'].'</span> 获得 <strong>'.$user['prize'].'</strong>
								</dd>
							  </dl>';
			 		}
			 		$i--;
			 	}
			 }
			?>
			<h3 class="before_tips"><a href="/hd?vt=4">查看活动详情</a></h3>
		</div>

	</article>

	<!-- share -->
	<?php require dirname(__FILE__) . '/share.php';?>
	<!-- /share -->
<?php require dirname(__FILE__) . '/footer.php';?>
<!-- JS -->
	<script src="http://mjs.sinaimg.cn/wap/public/basejs/201312161436/zepto.js"></script>
    <script src="http://mjs.sinaimg.cn/wap/dpool/public/201404231350/js/header.footer.min.js"></script>
</body>
</html>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年05月20日
*   Description   ：
*/
