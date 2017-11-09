<?php include 'common/header.php' ?>    
<?php include 'common/nav.php' ?>    
<div class="banner">
    <h1>分享搞起来</h1>
    <h2>个人和团队一起成长</h2>
</div>
    <div class="container">
        <div class="section">
          <section id="dropdowns">
            <div class="page-header">
              <h2>添加分享</h2>
            </div>
            <form action="/add" method="post">
            <p>时间：<input type='text' name='time' value='' /></p>
            <p>地点：<input type='text' name='office' value='' /></p>
            <p>主题：<input type='text' name='title' value='' /></p>
            <p>主讲：<input type='text' name='author' value='' /></p>
            <p>描述：<textarea name='des' style="width:400px;height:80px;"></textarea></p>
            <input type="submit" name="submit" value="添加" class="btn" />
            </form>
          </section>
        </div>
    </div>
<?php include 'common/footer.php' ?>    
<?php
/**
*   Copyright (C) 2016 All rights reserved.
*
*   FileName      ：admin.php
*   Author        ：zhiqiang18
*   Email         ：zhiqiang18@staff.sina.com.cn
*   Date          ：2016年02月26日
*   Description   ：
*/
