        <div class="card_item weather">
			<div class="weather_top">
            <h2><?php echo $weather['city']?>  <span><?php echo $weather['week']?></span></h2>
            <span class="time"><?php echo $weather['uptime']?></span>
			</div>
			<div class="weather_middle">
				<div class="fl">
					<img src="<?php echo $weather['icon']?>" alt="" />
				</div>
				<div class="fr">
                    <h3><?php echo $weather['temp']?></h3>
                    <h3><?php echo $weather['desc']?> <?php echo $weather['power']?></h3>
                    <h3>
                    空气质量&nbsp;<?php echo $weather['pollution']['aqi']?>&nbsp;
                    <?php
                    $aci = $weather['pollution']['aqi'];
                    if ( $aci >= 0 && $aci <= 50 ) { 
                        $color_r = 'color_r1';
                    } else if ( $aci >= 51 && $aci <= 100 ) { 
                        $color_r = 'color_r2';
                    } else if ( $aci >= 101 && $aci <= 150 ) { 
                        $color_r = 'color_r3';
                    } else if ( $aci >= 151 && $aci <= 200 ) { 
                        $color_r = 'color_r4';
                    } else if ( $aci >= 201 && $aci <= 300 ) { 
                        $color_r = 'color_r5';
                    } else {
                        $color_r = 'color_r6';
                    }   
                    ?>
                    <span class="<?php echo $color_r?>"><?php echo $weather['pollution']['description']?></span>
                    </h3>
				</div>
			</div>
			<ul class="card_btm" data-sudaclick="myWeatherCard">
				<li><a href="http://weather.sina.cn">未来4天</a></li>
                <?php if ( Libs_Tool::isVisitor($ustatus) ) { ?>
                    <li><a href="<?php echo Model_Common::getLoginUrl();?>">分享</a></li>
				    <li><a href="<?php echo Model_Common::getLoginUrl();?>">置顶</a></li>
                <?php } else { ?>
				    <li><a href="<?php echo $weather['shareurl']?>">分享</a></li>
                    <li><a href="javascript:void(0);" class="j_gotop" data-url="<?php echo $seturl;?>">置顶</a></li>
                <?php } ?>
			</ul>
		</div>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：weather.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：
*/
