//加载动画
layui.use('layer', function(){
  var layer = layui.layer;
  $(window).load(function() {
    layer.close(index);
  }) 
  var index = layer.load(1);
});
//锚点平滑
$(document).ready(function(e) {
    $('a[href*=#]').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var $target = $(this.hash);
            $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
            if ($target.length) {
                var targetOffset = $target.offset().top;
                $('html,body').animate({
                    scrollTop: targetOffset
                },
                1000);
                return false;
            }
        }
    });
	
	
	$(".buttonckzt").click(function(e) {
        $("#ckzt,.lycx-t").slideDown(500);
		$("#fly,.lybx-t").slideUp(100);
    });
	$(".buttonfhly").click(function(e) {
        $("#fly,.lybx-t").slideDown(500);
		$("#ckzt,.lycx-t").slideUp(100);
    });
	
	//教师学生页 触碰图标动态
	
	// $(".grid-demo1").mouseenter(function(){ 
	// 	$("i[class='layui-icon 1']").addClass('layui-anim layui-anim-scaleSpring');
	// });
	// $(".grid-demo1").mouseleave(function(){ 
	// 	$("i[class='layui-icon 1 layui-anim layui-anim-scaleSpring']").removeClass('layui-anim layui-anim-scaleSpring');
	// });
	
	// $(".grid-demo2").mouseenter(function(){ 
	// 	$("i[class='layui-icon 2']").addClass('layui-anim layui-anim-scaleSpring');
	// });
	// $(".grid-demo2").mouseleave(function(){ 
	// 	$("i[class='layui-icon 2 layui-anim layui-anim-scaleSpring']").removeClass('layui-anim layui-anim-scaleSpring');
	// });
	
	// $(".grid-demo3").mouseenter(function(){ 
	// 	$("i[class='layui-icon 3']").addClass('layui-anim layui-anim-scaleSpring');
	// });
	// $(".grid-demo3").mouseleave(function(){ 
	// 	$("i[class='layui-icon 3 layui-anim layui-anim-scaleSpring']").removeClass('layui-anim layui-anim-scaleSpring');
	// });
	
	// $(".grid-demo4").mouseenter(function(){ 
	// 	$("i[class='layui-icon 4']").addClass('layui-anim layui-anim-scaleSpring');
	// });
	// $(".grid-demo4").mouseleave(function(){ 
	// 	$("i[class='layui-icon 4 layui-anim layui-anim-scaleSpring']").removeClass('layui-anim layui-anim-scaleSpring');
	// });
	

});
