<?php 
    if ( $action == 'rmy' ) 
        $title = '评论我的';
    else
        $title = '我的评论';
    require dirname(__FILE__) . '/../common/header.php';
    require dirname(__FILE__) . '/../common/snav.php';
?>

			<div class="p_guides comment">
                <a href="<?php Libs_Tool::getHostUrl()?>/comment/?action=rmy&vt=4"<?php if ($action == 'rmy') echo 'class="cur"'?>><span><?php echo (int)$userCounts['l_reply'];?></span><span class="title">评论我的</span></a>
				<a href="<?php Libs_Tool::getHostUrl()?>/comment/?action=my&vt=4"<?php if ($action == 'my') echo 'class="cur"'?>><span><?php echo (int)$userCounts['l_count'];?></span><span class="title">我的评论</span></a>
			</div>
			 
			<div class="cmnt_article">
				<div class="cmnt_list" id="j_newslist">
                    <?php require dirname(__FILE__) . '/ajindex.php'?>
				</div>
                <div class="loadingArt" style="display:none;"><i></i>正在加载</div>
                <?php if ( !$isend ) { ?>
                <div class="cmnt_more hide">
                    <a data-page="2" data-type='comment'  data-url="<?php echo $dataUrl?>" class="j_more_btn" href="javascript:void(0);">展开更多</a>
                </div>
                <?php  } ?>
			</div>
            
            <!-- footer -->
            <?php 
            $js_array = Be_Config::getStatics('personal_js');
            //换个账号登陆得地址
            $reLoginUrl = Model_Common::reLoginUrl();
            $logOutUrl  = Model_Common::getLogoutUrl('个人中心', Model_Common::getHostUrl()); 
            $loginUrl   = Model_Common::getLoginUrl();
            $isCmnt     = true;
            require dirname(__FILE__) . '/../common/footer.php';
            ?>
            <!-- /footer -->
