define(function(require, exports, module) {

	function FormBeauty(options) {
		options = options || {};

		this.oBeautyWrap = null;

		this.oBeautyWrap = options.oWrap || $('[script-role = formBeautyBound]');

		this.itemRadioClass = options.itemRadioClass || '';

		this.itemCheckClass = options.itemCheckClass || '';

		this.defaultRaidoClass = options.defaultRaidoClass || 'beautyRadio';

		this.defaultCheckClass = options.defaultCheckClass || 'beautyCheck';
	}

	FormBeauty.prototype = {

		init: function() {
			var i,
				num,
				aEle;

			i = 0;

			aEle = this.oBeautyWrap.find('[is-form-beauty = true]');

			aEle.css({
				position: 'relative'
			});

			num = aEle.length;

			for (i = 0; i < num; i++) {
				this.jude($(aEle[i]));
			}
		},
		jude: function(ele) {
			var type;

			type = ele.attr('form-beauty-type');

			switch (type) {
				case 'radio':

					var aRadio = ele.find('input[type=radio]');

					this.beautyRadio(aRadio, 'radio', ele);

					break;

				case 'checkbox':

					var aCheckbox = ele.find('input[type=checkbox]');

					this.beautyRadio(aCheckbox, 'checkbox', ele);

					break;

				case 'select':

					break;
			}
		},
		beautyRadio: function(aRadio, sType, ele) {
			var left,
				top,
				oSapn,
				oParent,
				_this;

			_this = this;

			aRadio.each(function(i) {

				oParent = aRadio.eq(i).parent();

				aRadio.eq(i).css({
					visibility: 'hidden'
				})

				aRadio.eq(i).css({
					display: 'inline-block',
					width: '12px',
					height: '12px',
					'overflow': 'hidden'
				});

				left = Math.floor(aRadio.eq(i).position().left);

				top = Math.floor(aRadio.eq(i).position().top);

				_this.makeItem(oParent, i, top, left, aRadio.eq(i), sType);

			});

			if (sType == 'radio') {
				this.addRadioCheckEvent(ele, sType);
			} else if (sType == 'checkbox') {
				this.addRadioCheckEvent(ele, sType);
			}
		},
		makeItem: function(oWrap, index, top, left, oItem, sType) {
			var sClass = sType == 'radio' ? this.defaultRaidoClass : this.defaultCheckClass;

			var sAddedClass = sType == 'radio' ? this.itemRadioClass : this.itemCheckClass;

			var oSpan = $('<span tab-index=' + index + ' script-role="beauty_item" class=' + sClass + '></span>');

			if (oItem.attr('checked') == 'checked') oSpan.addClass(sAddedClass);

			oSpan.css({
				left: left,
				top: top,
				position: 'absolute',
				overflow: 'hidden',
				zIndex: 2,
				cursor: 'pointer'
			});

			oWrap.append(oSpan);
		},
		addRadioCheckEvent: function(oWrap, sType) {
			var aItem,
				aSpan,
				index,
				_this,
				sAddedClass;

			aItem = sType == 'radio' ? oWrap.find('input[type = radio]') : oWrap.find('input[type = checkbox]');

			sAddedClass = sType == 'radio' ? this.itemRadioClass : this.itemCheckClass;

			_this = this;

			aSpan = oWrap.find('[script-role = beauty_item]');

			oWrap.on('click', '[script-role = beauty_item]', function() {

				index = $(this).attr('tab-index');

				if (sType == 'radio') {
					aItem.attr('checked', false);

					aItem.eq(index).attr('checked', true);

					aSpan.removeClass(sAddedClass);

					$(this).addClass(sAddedClass);
				} else if (sType == 'checkbox') {
					if ($(this).hasClass(sAddedClass)) {
						$(this).removeClass(sAddedClass);

						aItem.eq(index).attr('checked', false);
					} else {
						$(this).addClass(sAddedClass);

						aItem.eq(index).attr('checked', true);
					}
				}

			});
		}
	}

	module.exports = FormBeauty;

});