<?php include 'common/header_mobile.php' ?> 
<!--listMain 开始-->
<div class="listContent">
    <?php if ( Be_Libs_Tool::be_array($newsList) ) { ?>
	<div class="listConInfo">
		<h2><em>AHF新闻</em> · AHF NEWS</h2>
		<ul>
            <?php foreach ( $newsList as $key => $value ) { ?>
			<li>
            <h3><a href="/detail?id=<?php echo $value['id']?>"><?php echo $value['title']?></a></h3>
				<div class="contentDetails clearfix">
                <?php if ( $value['images'][0] ) { ?>
                <img src="<?php echo $value['images'][0]?>" width="240" height="160" class="fl">
                <?php } ?>
                <p><?php echo Be_Libs_String::substr_cn($value['content'], 320)?><a href="/detail?id=<?php echo $value['id']?>">[详细]</a></p>
				</div>
                <span class="times"><?php echo $value['dtime']?></span>
			</li>
            <?php } ?>
		</ul>
	</div>
    <?php } ?>
    <?php if ( Be_Libs_Tool::be_array($fzList) ) { ?>
	<div class="listConInfo">
		<h2><em>人物新闻</em> · PEOPLE NEWS</h2>
		<ul>
            <?php foreach ( $fzList as $key => $value ) { ?>
			<li class="borderNone">
            <h3><a href="/detail?id=<?php echo $value['id']?>"><?php echo $value['title']?></a></h3>
				<div class="contentDetails clearfix">
                <?php if ( $value['images'][0] ) { ?>
                <img src="<?php echo $value['images'][0]?>" width="240" height="160" class="fl">
                <?php } ?>
                <p><?php echo Be_Libs_String::substr_cn($value['content'], 320)?><a href="/detail?id=<?php echo $value['id']?>">[详细]</a></p>
				</div>
                <span class="times"><?php echo $value['dtime']?></span>
			</li>
            <?php } ?>
		</ul>
	</div>
    <?php } ?>
<?php if ( Be_Libs_Tool::be_array($ggList) ) { ?>
	<div class="listConInfo">
		<h2><em>政策法规</em> · POLICIES AND REGULATIONS</h2>
		<ul>
            <?php foreach ( $ggList as $key => $value ) { ?>
			<li>
            <h3><a href="/detail?id=<?php echo $value['id']?>"><?php echo $value['title']?></a></h3>
				<div class="contentDetails clearfix">
                <?php if ( $value['images'][0] ) { ?>
                <img src="<?php echo $value['images'][0]?>" width="240" height="160" class="fl">
                <?php } ?>
                <p><?php echo Be_Libs_String::substr_cn($value['content'], 320)?><a href="/detail?id=<?php echo $value['id']?>">[详细]</a></p>
				</div>
                <span class="times"><?php echo $value['dtime']?></span>
			</li>
            <?php } ?>
		</ul>
	</div>
<?php } ?>
</div>
<?php include 'common/footer_mobile.php' ?> 
<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：news.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年05月08日
*   Description   ：
*/
