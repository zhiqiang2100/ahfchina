	<div class="share_cont">
    <?php 
        $url        = 'http://my.sina.cn/hd?vt=4';
        $backurl    = $url;
        $content    = '#新浪新闻有奖分享#新浪给大家送福利咯！5月21日起，登录新浪网每周评论或分享文章达3天，即有机会获得马尔代夫游、iPhone5s、iPad mini、自拍神器、智能手机等大奖，小伙伴们赶快来参加！猛戳：';
        $shareurl   = Be_Libs_Weibo::buildShareUrl($content, $url, 'http://u1.sinaimg.cn/upload/2014/0521/11/865e6551.png', $backurl, 0);
    ?>
        <a href="<?php echo $shareurl?>" title="去微博秀秀我的大奖">
			<div class="share_cont_btn">
				<h3 class="share_cont_h3">去微博邀请小伙伴!</h3> 
				<h3 class="share_cont_h3">都来攒人品～！！</h3>
			</div>
		</a>
	</div>
