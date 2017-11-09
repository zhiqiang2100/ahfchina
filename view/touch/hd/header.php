<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="keywords" content="周三大奖 从天而降,马尔代夫游,手机新浪网,新浪首页,新闻资讯,新浪新闻，新浪无线" />
	<meta name="description" content="《周三大奖 从天而降》是手机新浪网举办的用户有奖互动活动，活动周期内登录参与评论或者分享,即有机会在周三获得马尔代夫游大奖。手机新浪网触屏版 - sina.cn" />
	<!-- 频道相关icon -->
	<link rel="apple-touch-icon" sizes="57x57" href="http://mjs.sinaimg.cn/wap/public/addToHome/201404101830/images/sinacn-57_57.png?pos=108&amp;vt=4" />
	<link rel="apple-touch-icon" sizes="72x72" href="" />
	<link data-logo="" rel="apple-touch-icon" sizes="114x114" href="http://mjs.sinaimg.cn/wap/public/addToHome/201404101830/images/sinacn-114_114.png?pos=108&amp;vt=4" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="http://mjs.sinaimg.cn/wap/dpool/sina_special/201405211040/css/style.min.css" />
    <title>周三大奖从天而降—手机新浪网</title>
</head>
<body>
	<!-- noscript -->
	<noscript><a class="noScript" href="#" title="页面需要开启JavaScript体验">页面需要开启JavaScript体验</a></noscript>
	
	<!-- header -->
	<header>
		<div class="sinaHead">
			<h2><a class="hIcon h_logo" href="http://sina.cn" title="手机新浪网">手机新浪网</a></h2>
			<a class="hIcon h_nav" title="网站导航" href="http://news.sina.cn/?sa=t124d8889597v84&pos=<?php echo Be_Config::k('personal.personal_pos_val');?>&vt=4" class="gIcon navBtn">网站导航</a>
			<a href="http://my.sina.cn" class="hIcon h_user" title="<?php echo $userInfo['screen_name'];?>"><img src="<?php echo $userInfo['profile_image_url']?>" alt="<?php echo $userInfo['screen_name'];?>"/></a>
		</div>
	</header>
	<!-- / header -->
	
	<!-- section -->
	<section>
		<div class="active_tips">
			<h3 class="tips_txt"><img src="http://mjs.sinaimg.cn/wap/dpool/sina_special/201405211040/images/tips_txt.png" alt="周三大奖从天而降" width="202" class="tips_animation"/></h3>
			<div class="tips_t">
            <?php 
                $currentCycle = $hdInfo['current_cycle'];
            ?>
            <p>本期开奖时间：<span>9月10日 11:30</span></p>
				<p>1周3天评论或分享每周三赢大奖哦！</p>
				<p>网页端与手机新浪网可同时参加</p>
			</div>
            
			<div class="tips_t2">
				<h4>上期获奖名单</h4>
                <?php
                $allUserPrize = $hdInfo['all_user_prizes'];
                $prevCycle = $hdInfo['prev_cycle'];
                $prizeUsers = $allUserPrize[$prevCycle];
                if ( is_array($prizeUsers) && count($prizeUsers) > 0 ) {
                    foreach ( $prizeUsers as $key => $val ) { 
                        $uStr .= "'" . $val['wb_screen_name'] ."'" . ' 获得 ' . $val['prize'] . '; ';
                }} ?>
                    <marquee scrollamount=4 behavior=alternate>
                        <p><?php echo $uStr;?></p>
                    </marquee>
			</div>
            
		</div>
		<p class="tips_line"></p>
	</section>
	<!-- / section -->
