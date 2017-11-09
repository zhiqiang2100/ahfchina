<?php 
    $title = '我的订阅';
    require dirname(__FILE__) . '/../common/header.php';
    require dirname(__FILE__) . '/../common/snav.php';
?>
		<p class="rss_state">
        <?php if ( $dyCount > 0 ) { ?>
        <a href="http://yd.sina.cn/my_rss_media.d.html?vt=4" class="rss_state_mate"><span><?php echo $dyCount;?></span> 个已订阅媒体</a>
        <?php } ?>
		</p>

		<!--列表-->
		<div id="j_items_list" class="carditems">
            <?php require dirname(__FILE__) . '/listitem.php'?>
		</div>
        <!-- 点击加载更多 -->
        <div class="loadingArt" style="display:none;"><i></i>正在加载</div>
        <?php if ( !$isend ) { ?>
        <div class="cmnt_more hide">
            <a data-page="2" data-type='rss'  data-url="<?php echo Libs_Tool::getHostUrl()?>/aj/yd" class="j_more_btn" href="javascript:void(0);">展开更多</a>
        </div>
        <?php } ?>
        <!-- 点击加载更多 -->
        <?php
            $js_array = array(Be_Config::getStatic('personal_js'));
            require dirname(__FILE__) . '/../common/footer.php';
        ?>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年08月05日
*   Description   ：
*/
