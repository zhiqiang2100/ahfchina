<?php include 'common/header.php' ?> 
<div class="flexslider">
	<ul class="slides">
                    <?php if ( Be_Libs_Tool::be_array($lunboList) ) {
                    foreach ( $lunboList  as $key => $value ) { ?>
                        <li> <a href="<?php echo $value['linkurl']?>"><img src="<?php echo Be_Config::k('common.static_host').$value['url']?>"></a></li>
                    <?php } ?>
                    <?php } ?>
	</ul>
</div>
<!--banner 结束-->
<!--main 开始-->
<div class="content">
	<div class="newsCenter">
		<a href="/news" style="color:#fff;"><h2>新闻中心<em>NEWS  CENTER</em></h2></a>
		<div class="newsInfo clearfix">
			<div class="infoLeft fl">
				<div class="carouse" id="chiefMain">
					<ul>
                    <?php if ( Be_Libs_Tool::be_array($newsLunbo) ) {
                    foreach ( $newsLunbo  as $key => $value ) { ?>
                        <li>
                            <a href="#">
                            <img src="<?php echo Be_Config::k('common.static_host').$value['url']?>">
                            </a>
                            </li>
                    <?php } ?>
                    <?php } ?>
					</ul>
				</div>
			</div>
			<div class="infoRight fr">
				<ul>
                    <?php if ( Be_Libs_Tool::be_array($newsList) ) {
                        foreach ( $newsList  as $key => $value ) { ?>
					<li>
                    <a href="/detail?id=<?php echo $value['id']?>"><?php echo $value['title']?></a>
                    <p><?php echo Be_Libs_String::substr_cn($value['content'], 100)?><em><?php echo $value['dtime']?></em></p>
					</li>
                    <?php } ?>
                    <?php } ?>
				</ul>
				<a href="/news" class="more">更多 · more</a>
			</div>
		</div>
	</div>
	<div class="proControl">
		<div class="proControlInfo clearfix">
			<div class="project fl">
				<a href="/projects" style="color:#fff;"><h2>项目动态<em>PROJECT LIST</em></h2></a>
				<ul>
                    <?php if ( Be_Libs_Tool::be_array($xmList) ) {
                        foreach ( $xmList  as $key => $value ) { ?>
					<li>
                    <a href="/detail?id=<?php echo $value['id']?>" class="proImg fl"><img src="<?php echo $value['images'][0]?>" width="145" height="97"></a>
						<div class="listMain fl">
                            <h3><a href="/detail?id=<?php echo $value['id']?>"><?php echo $value['title']?></a></h3>
							<p><?php echo Be_Libs_String::substr_cn($value['content'], 100)?></p>
							<span><?php echo $value['dtime']?></span>
						</div>
					</li>
                    <?php } ?>
                    <?php } ?>
				</ul>
				<a href="/projects" class="more p0">更多 · more</a>
			</div>
			<div class="control fl">
				<a href="/knowledge" style="color:#fff;"><h2>防治知识<em>PREVENTION</em></h2></a>
				<ul>
                    <?php if ( Be_Libs_Tool::be_array($fzList) ) {
                        foreach ( $fzList  as $key => $value ) { ?>
					<li>
                        <a href="/detail?id=<?php echo $value['id']?>" class="proImg fl"><img src="<?php echo $value['images'][0]?>" width="145" height="97"></a>
						<div class="listMain fl">
                            <h3><a href="/detail?id=<?php echo $value['id']?>"><?php echo $value['title']?></a></h3>
							<p><?php echo Be_Libs_String::substr_cn($value['content'], 100)?></p>
							<span><?php echo $value['dtime']?></span>
						</div>
					</li>
                    <?php } ?>
                    <?php } ?>
				</ul>
				<a href="/knowledge" class="more p0">更多 · more</a>
			</div>
		</div>
	</div>
	<div class="detecPoint">
		<div class="pointMain clearfix">
			<a href="/checks" style="color:#fff;"><h2>检 测 点<em>TEST STATION</em></h2></a>
			<div class="address clearfix">
				<img src="<?php echo Be_Config::k('common.static_host')?>/static/images/mapPic.png" class="fl" width="525" height="433">
				<div class="addressWord fl">
                    <?php if ( Be_Libs_Tool::be_array($checkList) ) {
                        foreach ( $checkList  as $key => $value ) { ?>
					<div class="addressInfo">
                    <h4><?php echo $value['city']?></h4>
						<p>联系地址：<?php echo $value['address']?></p>
						<p>联系电话：<?php echo $value['mobile']?></p>
					</div>
                    <?php } ?>
                    <?php } ?>
					<a href="/checks" class="moreAdd">更多 · more</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'common/footer.php' ?> 
