        <div class="card_item astro">
                <div class="astro_top">
                    <div class="astro_swipe">
                        <div class="astro_item">
                            <div class="astro_l">
                            <h2><?php echo $starinfo['name'];?></h2>
                            <img src="<?php echo $starinfo['img']?>" alt="" />
                            </div>
                            <div class="astro_r">
                            <h3>今日运势(<?php echo date("Y.m.d")?>)</h3>
                                <p><?php echo Be_Libs_String::substr_cn($starinfo['ys'], 140)?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="card_btm" data-sudaclick="myStarCard">
                    <?php if ( Libs_Tool::isVisitor($ustatus) ) { ?>
                        <li><a href="<?php echo Model_Common::getLoginUrl();?>">订制星座</a></li>
                        <li><a href="<?php echo Model_Common::getLoginUrl();?>">分享</a></li>
				        <li><a href="<?php echo Model_Common::getLoginUrl();?>">置顶</a></li>
                    <?php } else { ?>
                        <?php if ( $starinfo['user_set'] ) { ?>
                            <li><a href="http://dp.sina.cn/dpool/astro/starent/xingyun.php">更多运势</a></li>
                        <?php } else { ?>
                            <li><a href="http://dp.sina.cn/dpool/my/setUserInfo.php?set=birthday_gender&backUrl=http://my.sina.cn">订制星座</a></li>
                        <?php } ?>
                        <li><a href="<?php echo $starinfo['shareurl']?>">分享</a></li>
                        <li><a href="javascript:void(0);" class="j_gotop" data-url="<?php echo $seturl;?>">置顶</a></li>
                     <?php } ?>
                </ul>
        </div>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：star.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：
*/
