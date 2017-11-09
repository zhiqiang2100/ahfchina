<?php if ( is_array($cmnt_lists['cmntlist']) && count($cmnt_lists['cmntlist']) > 0 ) { ?>
<?php foreach ( $cmnt_lists['cmntlist'] as $key => $value ) { ?>
    <div class="cmnt_item" data-mid="<?php echo $value['mid'];?>" data-newsid="<?php echo $value['newsid'];?>" data-channel="<?php echo $value['channel'];?>" data-parent="<?php echo $value['mid'];?>" >
		<p class="cmnt_top">
			<span>
				<img src="<?php echo $value['icon'];?>" alt="<?php echo $value['nick'];?>" />
                <i class="cmnt_nick"><?php echo $value['nick'];?><em><?php echo $value['area']?></em></i>
			</span>
	    </p>
        <?php if ( $action == 'my' ) { ?>
        <p class="cmnt_tit">我在<a href="<?php echo $value['url'];?>"><?php echo $value['wtitle']?></a>中评论</p>
        <?php } else { ?>
        <p class="cmnt_tit">在<a href="<?php echo $value['url'];?>"><?php echo $value['wtitle']?></a>中回复我</p>
        <?php } ?>
        <?php
        //整理楼层信息
        $replys     = $cmnt_lists['replydict'][$value['mid']];
        $replyCount = count($replys);
        ?>
        <?php if ($replyCount == 1) { ?>
		<div class="cmnt_base">
			<p class="cmnt_top">
				<span><?php echo $replys[0]['nick'];?>&nbsp;&nbsp;<?php echo $replys[0]['area']?></span>
                <span class="cmnt_source"><?php echo $replys[0]['ctime'];?></span>
				<code>1</code>
			</p>
			<p class="cmnt_text"><?php echo $replys[0]['content'];?></p>
		</div>
        <?php } ?>
        <?php if ($replyCount == 2) { ?>
		<div class="cmnt_base">
			<div class="cmnt_base">
				<p class="cmnt_top">
				    <span><?php echo $replys[0]['nick'];?></span>
				    <span class="cmnt_source"><?php echo $replys[0]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[0]['area']?></span>
				    <code>1</code>
				</p>
				<p class="cmnt_text"><?php echo $replys[0]['content'];?></p>
			</div>
			<p class="cmnt_top">
				<span><?php echo $replys[1]['nick'];?></span>
                <span class="cmnt_source"><?php echo $replys[1]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[1]['area']?></span>
				<code>2</code>
			</p>
			<p class="cmnt_text"><?php echo $replys[1]['content'];?></p>
		</div>
        <?php } ?>
        <?php if ($replyCount == 3) { ?>
		<div class="cmnt_base">
			<div class="cmnt_base">
				<div class="cmnt_base">
				    <p class="cmnt_top">
						<span><?php echo $replys[0]['nick'];?></span>
						<span class="cmnt_source"><?php echo $replys[0]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[0]['area']?></span>
						<code>1</code>
					</p>
					<p class="cmnt_text"><?php echo $replys[0]['content'];?></p>
				</div>
				<p class="cmnt_top">
                    <span><?php echo $replys[1]['nick'];?></span>
                    <span class="cmnt_source"><?php echo $replys[1]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[1]['area']?></span>
                    <code>2</code>
				</p>
				<p class="cmnt_text"><?php echo $replys[1]['content'];?></p>
			</div>
			<p class="cmnt_top">
				<span><?php echo $replys[2]['nick'];?></span>
				<span class="cmnt_source"><?php echo $replys[2]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[2]['area']?></span>
				<code>3</code>
		    </p>
			<p class="cmnt_text"><?php echo $replys[2]['content'];?></p>
		</div>
        <?php } ?>
        <?php if ($replyCount > 3) { ?>
        <div class="cmnt_base">
            <div class="cmnt_base">
                <div class="cmnt_base">
                    <p class="cmnt_top">
                        <span><?php echo $replys[0]['nick'];?></span>
                        <span class="cmnt_source"><?php echo $replys[0]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[0]['area']?></span>
                        <code>1</code>
                    </p>
                    <p class="cmnt_text"><?php echo $replys[0]['content'];?></p>
                </div>
                <p class="cmnt_top">
                    <span><?php echo $replys[1]['nick'];?></span>
                    <span class="cmnt_source"><?php echo $replys[1]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[1]['area']?></span>
                    <code>2</code>
                </p>
                <p class="cmnt_text"><?php echo $replys[1]['content'];?></p>
            </div>
            <a class="cmnt_unfold j_cmnt_unfold" href="javascript:void(0);"><i></i>点击展开隐藏楼层</a>
            <?php 
            $newReplys = array_slice($replys, 2, -1);
            $replys     = $cmnt_lists['replydict'][$value['mid']];
            if ( is_array($newReplys) ) {
                foreach ( $newReplys as $k => $v ) {
            ?> 
            <div class="hide">
                <p class="cmnt_top">
                    <span><?php echo $v['nick'];?></span>
                    <span class="cmnt_source"><?php echo $v['ctime'];?>&nbsp;&nbsp;<?php echo $v['area'];?></span>
                    <code><?php echo ($k + 3);?></code>
                </p>
                <p class="cmnt_text"><?php echo $v['content']?></p>
            </div>
            <?php } ?>
            <?php } ?>
            <p class="cmnt_top">
                <span><?php echo $replys[$replyCount-1]['nick'];?></span>
                <span class="cmnt_source"><?php echo $replys[$replyCount-1]['ctime'];?>&nbsp;&nbsp;<?php echo $replys[$replyCount-1]['area'];?></span>
                <code><?php echo $replyCount;?></code>
            </p>
		    <p class="cmnt_text"><?php echo $replys[$replyCount-1]['content'];?></p>
        </div>
        <?php } ?>
		<p class="cmnt_text"><?php echo $value['content'];?></p>
		<div class="cmnt_op_bottom clearfix">
		    <p class="cmnt_op_bottom_times"><?php echo $value['ctime'];?></p>
			<span class="cmnt_op">
                <a href="javascript:void(0);" title="赞" data-url="<?php echo Model_Common::getHostUrl() . '/aj/comment'?>?csrfcode=<?php echo $genData['csrfcode']?>&csrftime=<?php echo $genData['csrftime']?>" data-mid="<?php echo $value['mid'];?>" data-newsid="<?php echo $value['newsid'];?>" data-channel="<?php echo $value['channel'];?>"  class="good j_favor_single"><?php echo $value['agree'];?></a>
				<a href="javascript:void(0);" title="评论" class="cmntico j_cmnt_single"></a>
			</span>
		</div>
	</div>
<?php } ?>
<?php } ?>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：ajindex1.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年08月06日
*   Description   ：
*/
