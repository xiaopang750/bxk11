$(function() {
	$('#page').change(function() {
		var pid = $(this).val();
		$.ajax({
			url:option_url,
			type:"post",
			data:{id:pid},
			success:function(text){
				$("#module").empty();//清空area下拉框
				$("#module").append(text);//给area下拉框添加option
			}
		})
	})
	
	$('#select_model').click(function(){
		var id = $('#module').val();
		$.ajax({
			url:tab_url,
			type:"get",
			data:{'id':id},
			success:function(text){
				$("#ad_tab").empty();//清空area下拉框
				$("#ad_tab").append(text);//给area下拉框添加option
			}
		})	
	})
	
	/*删除前确认*/
	$('.is_del').click(function(){
		if(confirm('确定删除吗？') == false){
			return false;
		}
	})
	
	
	
	
	
	
	
	
	
})