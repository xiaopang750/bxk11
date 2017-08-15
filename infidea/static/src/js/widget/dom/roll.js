/**
 *description:roll
 *author:fanwei
 *date:2014/4/16
 */
define(function(require, exports, module){
	
	function Roll(opts) {

		this.oWrap = opts.oWrap || null;
		this.oRollWrap = this.oWrap.find('[script-role = widget-roll-wrap]');
		this.aList = this.oRollWrap.find('[script-role = widget-roll-list]');
		this.timer = null;
		this.fps = 28;

	}

	Roll.prototype = {

		init: function() {

			this.copy();

			var sum = this.calc();

			this.roll(sum);

		},
		calc: function() {

			var num,
				sum,
				aList;

			sum = 0;	
			aList = this.oWrap.find('[script-role = widget-roll-list]');	
			num = aList.length;
			
			aList.each(function(i){

		        sum += aList.eq(i).outerWidth(true);

		    });

		    this.oRollWrap.css('width', sum);

		    return sum;
		},
		copy: function() {

			this.aCopy = this.aList.clone();
			this.oRollWrap.append( this.aCopy );

		},
		roll: function(sum) {

			var dis,
				max,
				_this;

			dis = 0;
			
			max = this.oWrap.width() - sum;	
			_this = this;

		    this.timer = setInterval( function(){

		        dis --;

		        if ( dis < max ) {

		            _this.oRollWrap.css('left', 0);

		            dis = 0;

		        } else {

		        	_this.oRollWrap.css('left', dis);
		        }

		    },this.fps);

		}

	};

	module.exports = Roll;

});