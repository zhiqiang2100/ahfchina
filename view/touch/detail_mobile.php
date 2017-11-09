<?php include 'common/header_mobile.php' ?> 
<!--details 开始-->
<div class="mainDetails">
    <?php
        if ( in_array($detail['style'], array(2, 4, 5)) ) {
            $ahref = '/';
            $atitle = '首页';
            if ( $detail['style'] == 2 ) {
                $bhref = '/projects';
                $btitle = '项目动态';
            }
            if ( $detail['style'] == 4 ) {
                if ( $detail['type'] == 1 ) {
                    $bhref = '/news/ahf';
                    $btitle = 'AHF新闻';
                }
                if ( $detail['type'] == 2 ) {
                    $bhref = '/news/person';
                    $btitle = '人物新闻';
                }
                if ( $detail['type'] == 3 ) {
                    $bhref = '/news/rule';
                    $btitle = '政策法规';
                }
            }
            if ( $detail['style'] == 5 ) {
                $bhref = '/knowledge';
                $btitle = '防护知识';
            }
        }
    ?>
        <div class="location"><a href="<?php echo $ahref?>"><?php echo $atitle?></a>　>　<a href="<?php echo $bhref?>"><?php echo $btitle?></a>　>　<span>正文</span></div>
	<div class="specific">
    <h3><?php echo $detail['title']?></h3>
        <?php 
            $atime          = $detail['utime'] ? $detail['utime'] : $detail['ctime'];
            $dtime = date("Y/m/d", $atime);
        ?>
            <div class="timeing"><?php echo $dtime ?></div>
        <?php echo htmlspecialchars_decode($detail['content'])?>
	</div>
</div>
<!--details 结束-->
<?php include 'common/footer_mobile.php' ?> 
