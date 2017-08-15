seajs.config({
	base: '/static/src/js',
	alias: {
    	'jquery': 'lib/jquery/jquery'

  	},
  	preload: ['jquery']
});