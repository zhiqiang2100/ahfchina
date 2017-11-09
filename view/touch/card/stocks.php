		<div class="card_item stock">
			<div class="stock_top j_switch">
				<div class="stock_swipe">
                    <!--股票item开始-->
                    <?php if ( is_array($stocks) && count($stocks) > 0 ) {
                        
                        if ( count($stocks) == 1 ) {
                            $onlyOne = true;
                        }
                        foreach ( $stocks as $key => $value ) {
                            $shareUrl   = $value['shareurl'];
                            $name       = $value['name'];
                            $uptime     = $value['updatetime'];
                            $zuixin     = $value['zuixin'];
                            $zhangdiee  = $value['zhangdiee'];
                            $zhangdiefu = $value['zhangdiefu'];
                            $code       = $value['code'];
                            $type       = $value['type'];
                            $color      = $value['color'];
                           echo <<<BOOKS
					<div class="stock_item" data-url="$shareUrl">
						<div class="stock_tp">
							<h2>{$name}[{$code}]</h2>
							<h3>最后更新  $uptime</h3>
							<a href="javascript:void(0);" class="j_refresh" data-sudaclick="myStockRefresh" data-type="$type" data-code="$code"><i></i>刷新股价</a>
						</div>
						<div class="stock_mid $color">
			                <span>$zuixin<i>$zhangdiee<br>$zhangdiefu</i></span>
						</div>
					</div>
BOOKS;
                        }
?>
                    <!--股票item结束-->
				</div>
			</div>
			<ul class="card_btm" data-sudaclick="myStockCard">
                <?php if ( Libs_Tool::isVisitor($ustatus) ) { ?>
				    <li><a href="<?php echo Model_Common::getLoginUrl();?>">定制个股</a></li>
                    <li><a href="<?php echo Model_Common::getLoginUrl();?>">分享</a></li>
				    <li><a href="<?php echo Model_Common::getLoginUrl();?>">置顶</a></li>
                <?php } else { ?>
                    <?php if ( $onlyOne ) { ?>
				        <li><a href="http://stocks.sina.cn/mystock/?type=sh">定制个股</a></li>
                    <?php } else { ?>
				        <li><a href="javascript:void(0);">换一股</a></li>
                    <?php } ?>
                    <li><a href="<?php echo $stocks[0]['shareurl']?>">分享</a></li>
                    <li><a href="javascript:void(0);" class="j_gotop" data-url="<?php echo $seturl;?>">置顶</a></li>
                <?php } ?>
			</ul>
    <?php } ?>
		</div>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：stocks.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：
*/
