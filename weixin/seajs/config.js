seajs.config({
	base: '/static/js',
	alias: {
    	'zepto': 'lib/zepto/zepto'

  	},
  	preload: ['zepto']
});