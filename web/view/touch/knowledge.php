<?php include 'common/header.php' ?> 
<!--listMain 开始-->
<div class="listContent">
    <?php if ( Be_Libs_Tool::be_array($lists) ) { ?>
	<div class="listConInfo">
		<h2><em>防治知识</em> · AHF PREVENTION</h2>
		<ul>
            <?php foreach ( $lists as $key => $value ) { ?>
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
<?php include 'common/footer.php' ?> 
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
