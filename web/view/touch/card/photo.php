		<div class="card_item slide">
			<h3>推荐图集</h3>
			<div class='slide_top j_swipe'>
				<div class="slide_swipe">
                    <?php if ( is_array($pics) && count($pics) > 0 ) {
                            $lineShow   = '';   
                        foreach ( $pics as $key => $value ) {
                            $shareUrl   = $value['shareurl'];
                            $title      = $value['title'];
                            $src        = $value['pic'];
                            $url        = $value['url'];
                            if ( $key == 0 ) 
                                $lineShow   .= '<li class="active">1</li>';
                            else
                                $lineShow   .= '<li>'.($key+1).'</li>';
                           echo <<<PICS
					<div class="slide_item" data-url="$shareUrl">
						<a href="$url">
						    <img src="$src" alt=""/>
							<span>$title</span>
						</a>
					</div>
PICS;
                        }
?>
				</div>
				<ul class="slide_num">
                    <?php echo $lineShow;?>
				</ul>
			</div>
			<ul class="card_btm" data-sudaclick="myPhotoCard">
				<li><a href="http://photo.sina.cn/?vt=4">更多图集</a></li>
                <?php if ( Libs_Tool::isVisitor($ustatus) ) { ?>
                    <li><a href="<?php echo Model_Common::getLoginUrl();?>">分享</a></li>
				    <li><a href="<?php echo Model_Common::getLoginUrl();?>">置顶</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo $pics[0]['shareurl']?>">分享</a></li>
				    <li><a href="javascript:void(0);" class="j_gotop" data-url="<?php echo $seturl;?>">置顶</a></li>
                <?php } ?>
			</ul>
            <?php
            } ?>
		</div>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：photo.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：
*/

