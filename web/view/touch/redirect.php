<?php echo Libs_Render::header($vt, true, array('title'=>'提示页-手机新浪网', 'refresh'=>Libs_Tool::createRefresh()));?>
<style type="text/css">
body{margin:0;padding:0;color:#333}
*{line-height:1.4em;font-size:18px;}
p,ul,dl,dt,dd,h1,h2,form{margin:0;padding:0}
img{border:0}
li{list-style:none}
a{color:#039;text-decoration:underline}
a:hover{color:#f00;text-decoration:none}
p,dl,li{padding:0 3px}
#wrap{width:98%;background:#f5f8fd;border:2px solid #c8d8f2;margin:0 auto;}
h1,h2{margin:10 5px;border-bottom:0px solid #bec8d8;font-weight:normal}
h1{text-align:center;line-height:25px;}
h3{margin:0 5px;border-bottom:1px solid #bec8d8;padding-top:5px;font-weight:normal}
li,dt{color:#666}
dt{background:url(http://rimg.sina.cn/3g/image/upload/0/3/30/19074/bb8ccfcd.gif) no-repeat 0 50%;padding-left:8px}
dd{padding-bottom:5px;}
textarea {font-size: 12px;width: 93%;}
.p{background:url(http://rimg.sina.cn/3g/image/upload/0/229/29/19074/ab88457c.gif) #c2d9ff repeat-x;line-height:25px;border:solid #88aae1;border-width:1px 0 1px 0;padding-left:3px;}
.p,.p a{color:#575757}
.p a:hover{color:#f00}
.dpading{padding:5px 0 0 3px;}
.f{border:1px solid #c8d8f2;padding:3px;margin:3px 5px}
.i_t{border:1px solid #b3b9c3}
.b1{background:url(http://rimg.sina.cn/3g/image/upload/0/42/30/19074/2bb29284.jpg) no-repeat;width:46px;height:19px;border:none;cursor:pointer}
/*
.top{text-align:center}
.foot{background:#c8d8f2;text-align:center;padding:10px 0;color:#747474}
.foot a{color:#000}
.foot a:hover{color:#f00}
*/
.foot{background:#C8D8F2;text-align:center;color:#747474;line-height:1.4em;padding:10px 0;margin:0;}
.foot a:link{ text-decoration: none;color: #000}
.foot a:hover{ text-decoration: none;color: #ff0000}
.foot a:visited{text-decoration: none;}
.gt{text-align:center;height:27px;margin:3px 0;}.gt img{display:block;margin:0 auto;}
.gt a{color:#003399;text-decoration:none;}
.gt a:hover, a:active, a:focus {color: #f00;text-decoration:none;}     
.top {text-align:center;height:1.1em;}

.f1{font-family:Arial}
.ul2 li{background:url(http://rimg.sina.cn/3g/image/upload/0/102/112/19075/8505d96f.gif) 5px 50% no-repeat;padding-left:13px}
.n1 a,.n2 a,.n3 a,.n4 a,.n5 a,.n6 a{text-decoration:none;}
.n1{border:1px solid #d9d9d9; background:#fcfcfc url(http://rimg.sina.cn/3g/image/upload/0/90/232/19057/242fa080.gif) repeat-x;  color:#666;}
.n1 a{color:#666;}
.mL{text-align:left;color:#faa7a7;padding-top:10px}
.mL a{color:#666}
.mL a:hover{color:#f00}
.level{border-bottom:1px dashed #999;padding:0 3px 3px 3px;margin-top:5px;}
.cb{clear:both;background:#F4F3EE; border:1px solid #CDCCC8; padding:2px;}
.cb2{clear:both;background:#F4F3EE; margin-top:3px;border-right:1px solid #CDCCC8; border-bottom:1px solid #CDCCC8; border-left:1px solid #CDCCC8; padding:0 2px 2px}
.clb{clear:both;}
.tempright{float:right;}
</style>
</head>
<body>
<div id="wrap">

<h1>提示页-手机新浪网</h1>
<br />
<?php if(!empty($msg)){?><p><?php echo $msg;?></p><?php }?>
<p><a href="<?php echo $redirectUrl?>"><?php if(empty($backLink)){?>点击手动返回<?php }else{?><?php echo $backLink;?><?php }?></a></p>

<?php echo Be_Libs_Render::footer($vt, array(1, 3, 4), true);?>