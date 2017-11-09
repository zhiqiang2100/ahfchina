<?php 
    $title = '我的收藏';
    require dirname(__FILE__) . '/../common/header.php';
    require dirname(__FILE__) . '/../common/snav.php';
?>
	<!-- p_article_t -->
    <?php if ( (int)$fav_lists['total'] > 0 ) {?>
	<div class="p_article_t">
	</div>
	
	<div class="p_items_wrap" data-sudaclick="myFavoriteWarp">
		<div class="p_items_news_item">
            <?php foreach ( $fav_lists['data'] as $key => $value ) { 
            ?>
            
            <div class="p_items_news_item_list" data-fid="<?php echo $value['id'];?>">
                <h3><?echo $value['cat']?><a href="<?php echo $value['url'];?>"><?php echo $value['title'];?></a></h3>
					<p class="form_mate">
                    <span><?php echo $value['ctime'];?></span>
						收藏于：<?php echo $value['addtime'];?>
					</p>
                        <a href="javascript:void(0);" data-url="<?php echo $value['delurl']?>" class="del j_add_del"></a>
				</div>
            <?php } ?>
		</div>
        <div class="loadingArt" style="display:none;"><i></i>正在加载</div>
        <?php if ( !$isend ) { ?>
        <div class="cmnt_more hide">
            <a data-page="2" data-type='favorite'  data-url="<?php echo $dataUrl?>" class="j_more_btn" href="javascript:void(0);">展开更多</a>
        </div>
        <?php } ?>
		
	</div>
    <?php } else { ?>
        <div class="no_result">你还没有任何收藏哦~赶快去收录喜欢的内容吧！</div>
    <?php } ?>
    <?php
        $js_array = Be_Config::getStatics('rss_js');
        require dirname(__FILE__) . '/../common/footer.php';
    ?>
