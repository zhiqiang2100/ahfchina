<div class="card_item book">
			<div class="book_top j_switch">
				<div class="book_swipe">
                    <!-- item开始 -->
                    <?php if ( is_array($books) && count($books) > 0 ) {
                        
                        foreach ( $books as $key => $value ) {
                            $shareUrl   = $value['shareurl'];
                            $readurl    = $value['read_url'];
                            $title      = $value['title'];
                            $cover      = $value['cover'];
                            $author     = $value['author'];
                            $category   = $value['category'];
                            $status     = $value['status'];
                            $readCounts = $value['read_counts'];
                           echo <<<BOOKS
					<div class="book_item" data-url="$shareUrl">
						<div class="book_tp">
							<h2>$title</h2>
							<span class="source">新浪读书 热力推荐</span>
						</div>
						<div class="book_mid">
							<div class="fl">
								<img src="$cover" alt="" />
							</div>
							<div class="fr">
			                    <h3>作者：$author</h3>
			                    <h3>分类：$category</h3>
			                    <h3>状态：$status</h3>
			                    <h3>$readCounts人读过</h3>
			                    <a href="$readurl" data-sudaclick="myBooksCardClick" class="read">立即阅读</a>
							</div>
						</div>
					</div>
BOOKS;
                        }
?>
                    <!--item结束-->
				</div>
			</div>
			<ul class="card_btm" data-sudaclick="myBooksCard">
				<li><a href="javascript:void(0);">换一部</a></li>
                <?php if ( Libs_Tool::isVisitor($ustatus) ) { ?>
                    <li><a href="<?php echo Model_Common::getLoginUrl();?>">分享</a></li>
				    <li><a href="<?php echo Model_Common::getLoginUrl();?>">置顶</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo $books[0]['shareurl']?>">分享</a></li>
				    <li><a href="javascript:void(0);" class="j_gotop" data-url="<?php echo $seturl;?>">置顶</a></li>
                <?php } ?>
			</ul>
    <?php } ?>
		</div>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：books.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年04月09日
*   Description   ：
*/
