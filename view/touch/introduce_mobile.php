<?php include 'common/header_mobile.php' ?> 
<!--details 开始-->
<div class="mainDetails">
<!--<div class="location"><a href="/news">新闻中心</a>　>　<a href="#">AHF新闻</a>　>　<span>正文</span></div> -->
	<div class="specific">
    <!--
    <h3><?php echo $detail['title']?></h3>
        <?php 
            $atime          = $detail['utime'] ? $detail['utime'] : $detail['ctime'];
            $dtime = date("Y/m/d", $atime);
        ?>
            <div class="timeing"><?php echo $dtime ?></div>
    -->
        <?php echo htmlspecialchars_decode($detail['content'])?>
	</div>
</div>
<!--details 结束-->
<?php include 'common/footer_mobile.php' ?> 
<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：introduce.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月14日
*   Description   ：
*/
