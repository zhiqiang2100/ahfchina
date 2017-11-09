<?php if ( is_array($ydLists) && count($ydLists) > 0 ) {?>
<div class="card_item yuedu">
                <h3 class="read_title">新浪悦读</h3>
                <div class="read_top j_yuedu">
                    <div class="read_swipe">
                        <?php foreach ( $ydLists as $key => $value ) {
                            if ( $key % 3 == 0 || $key == 0 ) 
                                echo '<div class="read_item">';
                                $title      = $value['title'];
                                $img        = $value['pics'][0];
                                $link       = $value['link'];
                                $cmntNum    = $value['cmntNum'];
                                $cmntId     = $value['cmntId'];
                                $bigpic     = $value['bigpic'];
                                $cmntIds    = explode(':', $cmntId);
                                $ctId       = $cmntIds[1];
                                $cmntUrl    = 'http://site.proc.sina.cn/cmnt/list.php?product=wapread&index='.$ctId;
                                $source     = $value['source'];
                                if ( $bigpic ) {
                                    echo <<<LISTITEM
                                    <dl class="carditems_list_yd">
                                    <dd class="carditems_list_yd_dd">
                                    <h3 class="carditems_pics_title">$title</h3>
                                    <div class="carditems_pic">
                                        <a href="$link"><img alt="$title" src="$img"></a>
                                    </div>
                                    </dd>
                                </dl>
LISTITEM;
                                } else {
                                if ( $img ) {
                                echo <<<YDITEM
                            <dl class="carditems_list_yd">
                                <dt class="carditems_list_yd_dt">
                                    <a href="$link"><img alt="$title" src="$img">     
                                    </a>
                                </dt>
                                <dd class="carditems_list_yd_dd">
                                    <h3 class="carditems_list_yd_h3 pic_t_44">
                                        <a href="$link">$title</a>
                                    </h3>
                                    <p class="carditems_list_yd_op">
                                        <span class="op_ico from_mate fl">
                                            <a href="$link">$source</a>
                                        </span>
                                        <a href="$cmntUrl" class="op_ico cmnt fr">$cmntNum</a>
                                    </p>
                                </dd>
                            </dl>
YDITEM;
                                } else {
                                    echo <<<YDITEM
                            <dl class="carditems_list_yd">
                                <dd class="carditems_list_yd_dd">
                                    <h3 class="carditems_list_yd_h3">
                                        <a href="$link">$title</a>
                                    </h3>
                                    <p class="carditems_list_yd_op">
                                        <span class="op_ico from_mate fl">
                                            <a href="$link">$source</a>
                                        </span>
                                        <a href="$cmntUrl" class="op_ico cmnt fr">$cmntNum</a>
                                    </p>
                                </dd>
                            </dl>
YDITEM;
                                }
                                }
                            if ( ($key+1) % 3 == 0 && $key > 0 ) { 
                                echo '</div>';
                            }
                            }?>
                            <!--
                            <dl class="carditems_list_yd">
                                <dd class="carditems_list_yd_dd">
                                    <h3 class="carditems_pics_title">组图：汪小菲再晒爱女萌照为其拍嗝</h3>
                                    <div class="carditems_pics">
                                        <a href="#"><img src="images/book.png" alt=""></a>
                                        <a href="#"><img src="images/book.png" alt=""></a>
                                        <a href="#"><img src="images/book.png" alt=""></a>
                                    </div>
                                    <p class="carditems_list_yd_op">
                                        <span class="op_ico from_mate fl">
                                            <a href="http://yd.sina.cn/media/detail?m_id=zuiganhuo&vt=4">互联网干货</a>
                                        </span>
                                        <a href="#" class="op_ico cmnt fr">2000</a>
                                        <span class="op_ico picnum fr">12</span>                               
                                    </p>
                                </dd>
                            </dl>
                        -->
                    </div>
                </div>
                <ul class="card_btm">
                    <li><a href="javascript:void(0);">换一换</a></li>
                    <li><a href="http://yd.sina.cn/?vt=4" data-sudaclick="moreYdCard">更多</a></li>
                    <li><a href="javascript:void(0);" class="j_gotop" data-url="<?php echo $seturl?>">置顶</a></li>
                </ul>
            </div>
<?php } ?>
<?php
/**
 *   Copyright (C) 2014 All rights reserved.
 *
 *   FileName      ：yd.php
 *   Author        ：zhiqiang18
 *   Email         ：zhiqiang18@staff.sina.com.cn
 *   Date          ：2014年08月04日
 *   Description   ：
 */
