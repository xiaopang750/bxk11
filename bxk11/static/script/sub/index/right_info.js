define(function(require, exports, module) {
	
	var template = require('../../lib/template/template.js');
	var request = require('../../lib/http/request.js');
	var saveData =require('../../lib/dom/saveData.js');

	var starId,
		designId,
		recId,
		questionId,
		oStarWrap,
		oDesignWrap,
		oRecWrap,
		oQuesWrap;

	starId = 'star178_tpl';
	designId = 'design178_tpl';	
	recId = 'rec178_tpl';	
	questionId = 'ques178_tpl';	

	oStarWrap = $('.index_right_content').find('[script-role=content_list_jia178]');
	oDesignWrap = $('[script-role=design_wrap]');
	oRecWrap = $('[script-role=recommend_wrap]');
	oQuesWrap = $('[script-role=question_wrap]');

	request({
		url: '/index.php/view/user/index_recommend',
		sucDo : function(data){
			
			/* star */
			var htmlStar = template.render(starId, data.data.todaystar);

			var str = oStarWrap.html();

			oStarWrap.html(str + htmlStar);

			saveData(oStarWrap, data.data.todaystar);

			/* design */

			/* rec */

			/* question */
			var htmlQues = template.render(questionId, data.data);

			oQuesWrap.html(htmlQues);			

		}
	});

});