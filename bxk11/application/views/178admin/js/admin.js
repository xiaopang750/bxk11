$(function() {
	/* 横栏工具的显示 */
	$('#topmenu dl').mouseover(function() { $(this).find('dd').show(); })
	$('#topmenu dl').mouseout(function() { $(this).find('dd').hide(); })
	/*刷新、返回iframe页面*/
	$('#reload').on("click",function(){window.frames["main"].location.reload();})
	$('#goback').on("click",function(){window.frames["main"].history.go(-1);})
	 
	// 横栏链接目标设置为main
	$('#topmenu').find('a').attr('target','main');
	
	
	/* 竖栏分工具栏的显示 */
	$('.has_sub').find('.tit').click(function() {
		$(this).next('ul').toggle();
		$(this).find('.arrow').toggleClass('arrow_down');
		$(this).find('.arrow').toggleClass('arrow_top');
	})

	/* 竖栏工具高度的设定 */
	$('#leftbar').height(getH());
	
	/*设置右栏目高度、宽度*/
	/*$('#middle').width(getW());*/
	$('#middle').height(getH());
	$('#right').height(getH());
	$('#right').width(getW()-190);

	$(window).resize(function(){

		//$('#right').height(getH());
		$('#right').width(getW()-190);
		$('#leftbar').height(getH());

	});
	
	$('#leftbar').find('a').attr('target','main');
	$('.to_index a').click(function(e){
		e.preventDefault();
		$.ajax({
			type:"GET",
			url:$(this).attr('href'),
			success:function(){
				to_index();
			},
			 error: function(XMLHttpRequest, textStatus, errorThrown) {  //#3这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
                 alert(XMLHttpRequest.status);
                 alert(XMLHttpRequest.readyState);
                 alert(textStatus); // paser error;
             },
		})
	})
	



})

var getH = function() {
	var h1 = $(window).height() - 40;
	var h2 = document.body.scrollHeight - 40;
	var h = h1 > h2 ? h1 : h2;
	return h;
}

var getW = function() {
	var w = $(window).width();
	return w;
}

var to_index = function(){
	top.location.href= domain;
}
