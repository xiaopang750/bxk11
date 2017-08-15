define(function(require, exports, module) {

	function placeholder(aInput, options) {	
		var name,
			aText,
			color;

		if(!options) options = {};

		color = options.color || '#bbb'	

		aInput.each(function(i){

			name = aInput.eq(i).attr('text');

			var oSpan = $('<span></span>');
			var left = aInput.eq(i).attr('left') + 'px';
			var top = aInput.eq(i).attr('top') + 'px';
			var oInput = aInput.eq(i);

			if(aInput.eq(i).val()) oSpan.hide();

			oSpan.html(name);
			oSpan.css('color',color);

			oInput.parent().css({
				position: 'relative'
			});

			oSpan.css({
				position:'absolute',
				top: top,
				left: left
			});

			oInput.after(oSpan);

			oInput.focus(function(){

				oSpan.css({visibility: 'hidden'})

			});

			oInput.blur(function(){

				if(!oInput.val())
				{
					oSpan.css({visibility: 'visible'});	
				}
			});

			oSpan.click(function(){

				oInput.trigger('focus');

			});

		});

	}

	return placeholder;

});