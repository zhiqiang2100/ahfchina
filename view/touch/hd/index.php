
<?php require dirname(__FILE__) . '/header.php';?>
	
	<!-- 登陆 -->
	<article>
		<div class="login_wrap">
			<h4 class="login_h4">
				<a href="#" class="hIcon login_user" title="<?php echo $userInfo['screen_name'];?>"><img src="<?php echo $userInfo['profile_image_url']?>" alt="<?php echo $userInfo['screen_name'];?>"/></a>
			<?php echo $userInfo['screen_name'];?>
			</h4>
			<div class="login_tips" style="display:none">
				<!-- 获奖提示信息 -->
				<?php if( !empty($user_prize) ) echo '<h3 class="login_tips_h3">恭喜您获得 <strong>'.$user_prize['prize'].'</strong> 一'.$hdInfo['prize_info'][$user_prize['prize']]['unit'].'！</h3>';?>
				<div class="login_trophy_cont">
					<span><img src="<?php echo $userInfo['profile_image_url']?>" alt="<?php echo $userInfo['screen_name'];?>" /></span>
				</div>
			</div>
			<!-- 获奖用户未提交过地址信息 -->
			<?php if( $type =='modify' || (!empty($user_prize) && !$hdInfo['user_info_submit']) ){
			?>
				<div class="login_from">
					
					<ul class="login_from_items">
						<li>
							<input type="text" placeholder="我的姓名" name="loginName" id="loginName" class="login_input_t" >
						</li>
						<li>
							<input type="text" placeholder="我的手机号码" name="loginPhone" id="loginPhone" class="login_input_t" >
						</li>
						<li>
							<input type="text" placeholder="我的邮政编码" name="loginNum" id="loginNum" class="login_input_t" >
						</li>
						<li>
							<input type="text" placeholder="我的收货地址" name="loginAddress" id="loginAddress" class="login_input_t" >
						</li>
					</ul>
					<p class="login_btn_t">
						<input type="submit" class="login_btn" id="login_SbumitBtn" value="OK 提交">
					</p>
				</div>
				<!-- share -->
				<?php require dirname(__FILE__) . '/share.php';?>
				<!-- /share -->
			<?php
				}else{
			?>
				<ul class="user_items"  style="display:none">
	                <?php 
	                    $count = 0;
	                    $curCle = $hdInfo['all_user_info'][$currentCycle];
	                    if ( is_array($curCle) && count($curCle) > 0 ) {
	                        foreach ( $curCle as $k2 => $v2 ) {
	                            if ( is_array($v2) && !empty($v2) ) 
	                                $count ++;
	                        }
	                    }
	                    $cday = $count;
	                    $day = 3 - $cday;
	                    if ( $day <= 0 )
	                        $day = 0;
	                ?>
	                <?php if ( $cday > 2 ) { ?>
					<li class="on">活动进度</li>
					<li class="on">活动进度</li>
					<li class="on">活动进度</li>
	                <?php } elseif ( $cday == 2 ) { ?>
					<li class="on">活动进度</li>
					<li class="on">活动进度</li>
					<li>活动进度</li>
	                <?php } elseif ( $cday == 1 ) { ?>
					<li class="on">活动进度</li>
					<li>活动进度</li>
					<li>活动进度</li>
	                <?php } else { ?>
					<li>活动进度</li>
					<li>活动进度</li>
					<li>活动进度</li>
	                <?php } ?>
				</ul>
				<div class="user_tips">
	                    <!--
						<?php if ( $cday > 2 ) { ?>
	                        <strong>任务达成！</strong>您有机会获得大奖了！
	                    <?php } else { ?>
	                        还差 <strong><?php echo $day?>天评论或分享</strong> 就有新的机会获得大奖啦！
	                    <?php } ?>
	                    开奖日期：<?php echo date("n月j日 11:30", (strtotime($currentCycle))+7*24*60*60)?>
	                	-->
	                    此活动已于2014年9月10日结束。
				</div>
			<?php
				}
			?>
		</div>
	</article>
	<?php if( $hdInfo['user_info_submit'] )
		{
	?>
	<p class="user_btn_t"><a class="user_btn" title="修改我的手机号/收货地址等信息" href="/hd?type=modify">修改我的手机号/收货地址等信息</a></p>
	<?php 
		}
	?>
	<!-- 奖品 -->
	<article>
		<div class="trophy_cont">
			<h4 class="bt_txt"><strong>本期奖品</strong></h4> 
			<ul class="trophy_items">
                <?php if ( is_array($hdInfo) && count($hdInfo) > 0 ) { 
                $allPrizes = $hdInfo['all_prizes'][$currentCycle];
                $ap = array_unique($allPrizes);
                $aps = array();
                foreach ( $ap as $kk => $vv ) {
                    $aps[$vv] = array('num' => 0);
                }
                foreach ( $allPrizes as $k1 => $v1 ) {
                    if ( in_array($v1, $ap) ) {
                        $aps[$v1]['num'] ++;
                    }
                }
                foreach ( $aps as $key => $value ) { 
                    if ( $key == '马尔代夫' ) 
                        continue;
                ?> 
				<li>
                    <?php 
                        $picArr = $hdInfo['prize_info'];
                        $picUrl = $picArr[$key]['img_url_1'];
                        $price  = $picArr[$key]['price'];
                        $unit   = $picArr[$key]['unit'];
                        $num    = $value['num'];
                    ?>
                        <p class="trophy_pic"><img src="<?php echo $picUrl;?>" alt="<?php echo $key?>" /></p>
					<p class="trophy_txt">
                    <strong><?php echo $key . ' ' . $num . $unit; ?></strong>
                    <span><?php echo '价值' . $price . '元'?></span>
					</p>
				</li>
                <?php } ?>
                <?php } ?>
			</ul>
		</div>
	</article>
	
	<!-- 本期 -->
	<article>
		 <div class="special_cont">
		 	<h3 class="special_h3"><strong>特别奖!</strong></h3>
			<div class="special_c">
				<div class="special_c_list"><img src="http://u1.sinaimg.cn/upload/2014/0520/19/b9a619d4.jpg" alt="马尔代夫游" /></div>
				<h2 class="special_c_h2">价值 <strong>18,800</strong> 元的马尔代夫游</h2>
				<h4 class="special_c_num">共 4 个</h4>
			</div>
			<ul class="special_list">
				<li>
					<p class="s_cont_l"><span class="f_y_14">开奖日期</span></p>
					<p class="s_cont_r"><span class="f_y_14">参与周期</span></p>
				</li>
				<li>
					<p class="s_cont_l"><span class="f_w_14">6月18日</span></p>
					<p class="s_cont_r"><span class="f_w_14">5月21日－6月17日</span></p>
				</li>
				<li>
					<p class="s_cont_l"><span class="f_w_14">7月16日</span></p>
					<p class="s_cont_r"><span class="f_w_14">6月18日－7月15日</span></p>
				</li>
				<li>
					<p class="s_cont_l"><span class="f_w_14">8月13日</span></p>
					<p class="s_cont_r"><span class="f_w_14">7月16日－8月12日</span></p>
				</li>
				<li>
					<p class="s_cont_l"><span class="f_w_14">8月20日</span></p>
					<p class="s_cont_r"><span class="f_w_14">8月13日-8月19日</span></p>
				</li>
			</ul>
			<div class="special_tips">
				每个参与周期内 <strong>分享或评论次数达到前5000名</strong> 的用户将有机会获得马尔代夫特别奖。
		 	</div>
		 </div>
	</article>
	
	<!-- 规则 -->
	<article>
		<div class="rule_cont">
			<div class="rule_tips">活动规则</div>
			<p>1. 参加方法：用户通过网页端、新闻客户端或手机新浪网（sina.cn）登录新浪网，评论或分享正文页或高清图内容。</p>
			<p>2. <strong>一周（周三0点至下周二24点）之内任意3天参加评论或分享</strong>，即有机会获奖。我们会在符合资格的用户中随机抽取，参与越多，获奖几率越大。
</p>
			<p>3. 开奖时间：<strong>每周三上午11:30开奖。</strong></p>
			<p>4. 查看结果：开奖后，我们会在本页面公布中奖名单并通过微博私信进行通知，用户也可以在本页面查看中奖信息并提交联系方式。我们会在核对确认中奖用户个人信息后的五个工作日之内将奖品以邮寄方式寄出。
</p>
			<p>
			<strong>温馨提示</strong>：<br/>
			1. 对于恶意灌水等违规行为，一经发现取消中奖资格。<br/>
			2. 自开奖时间起两周内未在本页面提交联系方式视为放弃奖项。本活动解释权归新浪网所有。
			</p>
		</div>
	</article>
	
	<!-- 获奖 -->
    
	<article>
		<div class="ranking_cont">
			<h2 class="ranking_h2">上期获奖名单</h2>
            <?php if ( is_array($prizeUsers) && count($prizeUsers) > 0 ) {
                foreach ( $prizeUsers as $key => $val ) { ?>
			<dl class="ranking_items">
            <dt><a href="#" class="hIcon ranking_user" title="<?php echo $val['wb_screen_name']?>"><img src="<?php echo $val['wb_profile_img']?>" alt="<?php echo $val['wb_screen_name']?>"/></a></dt>
				<dd>
					<span><?php echo $val['wb_screen_name']?></span> 获得 <strong><?php echo $val['prize']?></strong>
				</dd>
			</dl>
            <?php } ?>
            <?php  } ?>
			<a href="/hd?type=cyclelist" title="往期获奖用户名单" class="ranking_btn">往期获奖用户名单</a>
		</div>
	</article>
	
	<!-- share -->
	<?php require dirname(__FILE__) . '/share.php';?>
	<!-- /share -->
	
	<!-- footer -->
	<?php require dirname(__FILE__) . '/footer.php';?>
	<!-- /footer -->
	
	<!-- 弹层 -->
	<aside id="marker_suc" style="display:none">
		<div class="tk_bg show"></div>
		<div class="marker_t tk_animation">
			<h3 class="marker_t_h3">信息提交成功！</h3>
			<p>感谢您的参与，工作人员会在两个工作日内与您取得联系。</p>
			<p class="marker_btn_t"><a href="#" title="" class="marker_btn_suc">确定</a></p>
		</div>
	</aside>
	<!-- / 弹层 -->
	
	<!-- 弹层 -->
	<aside id="marker_wrong" style="display:none">
		<div class="tk_bg show"></div>
		<div class="marker_t tk_animation">
			<h3 class="marker_t_h3">信息提交失败！</h3>
			<p>恭喜您中奖! 请正确输入您的个人信息，以便我们及时与您联系，</p>
			<p class="marker_btn_t"><a href="#" title="" class="marker_btn">确定</a></p>
		</div>
	</aside>
	<!-- / 弹层 -->
	
	<!-- 弹层 -->
	<aside id="marker_suc2" style="display:none">
		<div class="tk_bg show"></div>
		<div class="marker_t tk_animation">
			<h3 class="marker_t_h3">信息提交失败！</h3>
			<p>抱歉，信息提交失败，请稍后重试！</p>
			<p class="marker_btn_t"><a href="#" title="" class="marker_btn">确定</a></p>
		</div>
	</aside>
	<!-- / 弹层 -->

	<!-- JS -->
	<script src="http://mjs.sinaimg.cn/wap/public/basejs/201312161436/zepto.js"></script>
    <script src="http://mjs.sinaimg.cn/wap/dpool/public/201404231350/js/header.footer.min.js"></script>
    <script src="http://mjs.sinaimg.cn/wap/dpool/sina_special/201405271330/js/address.js"></script>
</body>
</html>
<?php
/**
*   Copyright (C) 2014 All rights reserved.
*
*   FileName      ：index.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2014年05月20日
*   Description   ：
*/
