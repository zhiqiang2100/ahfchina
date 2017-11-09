<?php require dirname(__FILE__) . '/common/header.php';?>
</head>
<body>
	<!-- noscript -->
	<noscript><a class="artBt noScript" href="#">页面需要开启JavaScript体验 &gt;</a></noscript>

	<!-- header 初始 -->
    <?php require dirname(__FILE__) . '/common/nav.php';?>
	<!-- / header -->
	
	<div class="p_main_unlogin">
		<h3 class="p_guide">登录个人中心，定制自己的专属空间,<br>您可以？</h3>
		<div class="p_menus">
			<a href="<?php echo Model_Common::getLoginUrl();?>" class="menu_01"><span>查看我的城市天气</span></a>
			<a href="<?php echo Model_Common::getLoginUrl();?>" class="menu_02"><span>收藏我喜爱的图书</span></a>
			<a href="<?php echo Model_Common::getLoginUrl();?>" class="menu_03"><span>关注我看好的股票</span></a>
			<a href="<?php echo Model_Common::getLoginUrl();?>" class="menu_04"><span>推荐我喜爱的图集</span></a>
			<a href="<?php echo Model_Common::getLoginUrl();?>" class="menu_05"><span>关注我的每日星运</span></a>
			<a href="<?php echo Model_Common::getLoginUrl();?>" class="menu_06"><span>手机实时收发邮件</span></a>
		</div>
	</div>

	<!-- footer -->
    <?php 
    $is_index = false;
    $is_pers  = true;
    require dirname(__FILE__) . '/common/footer.php';
    ?>
	<!-- /footer -->
</body>
</html>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：intro.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：
*/
