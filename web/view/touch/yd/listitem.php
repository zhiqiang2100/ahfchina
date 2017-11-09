<?php if ( is_array($myLists) && count($myLists) > 0 ) {     
    foreach ( $myLists as $key => $value ) {
        $title  = $value['title'];
        $img    = $value['img'];
        $source = $value['source'];
        $link   = $value['link'];
        $imgHtml = '';
        if ( $img ) {
                $imgHtml = '<dt class="carditems_list_dt"><img src="'.$img.'" alt="'.$title.'">';
            if ( $rec ) 
                $imgHtml .= '<strong class="topline">精选</strong>';
            $imgHtml .= '</dt>';
        }
        $cmntNum    = $value['cmntNum'];
        $cmntId     = $value['cmntId'];
        $cmntIds    = explode(':', $cmntId);
        $ctId       = $cmntIds[1];
        $cmntUrl    = 'http://site.proc.sina.cn/cmnt/list.php?product=wapread&index='.$ctId;
        $bigpic     = $value['bigpic'];
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
        echo <<<LISTITEM
        <a href="$link">
				<dl class="carditems_list">
                    $imgHtml
					<dd class="carditems_list_dd">
						<h3 class="carditems_list_h3 pic_t_44">$title</h3>
						<p class="carditems_list_op">
							<span class="op_ico from_mate fl">$source</span>
                            <span class="op_ico num_ico fr">$cmntNum</span>
						</p>
					</dd>
				</dl>
			</a>
LISTITEM;
        }
    }
}
?>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：listitem.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年08月05日
*   Description   ：
*/
