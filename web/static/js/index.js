//二级菜单
$(function(){
    var nav = 0;
    $('.navMain li').hover(function(){
        $('.second',this).show();
    },function(){
        $('.second',this).hide();
    });
});

//新闻中心 轮播
$(function(){
    expertsRoll();  
});
 function expertsRoll(){
    /*轮播图片*/
    var contentHeight = $("#chiefMain").height(),
         len                     = $("#chiefMain ul li").length,
         index               = 0,
         picTimer            = 4,
         btnList             = '',
         showPics            = function (index) {        //自动循环function
            var nowTop = -index * contentHeight,
                  seepNum = Math.abs(index - $('.swichpag .Cur').index());

                $("#chiefMain ul").stop(true, false).animate({
                    "top" : nowTop
                },(seepNum * 200) + 200);
                $(".swichpag a").removeClass('Cur').eq(index).attr('class','Cur');
        };
         
    //循环button按钮
    for(var i=0; i < len; i++) {
        btnList += "<a href='javascript:;'>"+(i+1)+"</a>";
    }
    //自动生成button按钮  
    $("#chiefMain").parent().append($("<div class='swichpag tc' />").html(btnList));
    
    //按钮触发器
    $(".swichpag a").mouseover(function() {
        index = $(".swichpag a").index(this);
        showPics(index);
    })
    .eq(0).trigger("mouseover");//模拟鼠标移动
    
    //设置内容总高度
    $("#chiefMain ul").css("height", contentHeight * (len));
    $("#chiefMain").hover(
        function() {
            clearInterval(picTimer);
        }, 
        function() {
            picTimer = setInterval(function() {
                showPics(index);
                index++;
                if (index == len) index = 0;
            }, 5000);
        }
    ).trigger("mouseleave");//模拟鼠标移,触发自动切换
    
}