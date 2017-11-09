<?php include 'common/header.php' ?> 
<!--address 开始-->
<div class="addressContent">
	<div class="addressInfo">
        <?php if ( Be_Libs_Tool::be_array($checkList) ) {
        foreach ( $checkList  as $key => $value ) { ?>
		<dl>
        <dt><?php echo $key?><em>· BEIJING</em></dt>
			<dd>
                <?php if ( Be_Libs_Tool::be_array($value) ) {
                foreach ( $value  as $k => $v ) { ?>
				<div class="specific">
                <h3><?php echo $v['name']?></h3>
                <span>联系地址：<?php echo $v['address']?></span>
                <span>联系电话：<?php echo $v['mobile']?></span>
				</div>
                <?php } ?>
                <?php } ?>
			</dd>
		</dl>
        <?php } ?>
        <?php } ?>
	</div>
</div>
<!--address 结束-->
<?php include 'common/footer.php' ?> 
