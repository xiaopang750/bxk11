module.exports = function(grunt) {
     
    //config
    var config = {

    	lgwx: {

    		src: '../static/src/lgwx',
    		dest: '../static/build/lgwx'
    	},
    	wap: {

    		src: '../static/src/wap',
    		dest: '../static/build/wap'
    	}

    }

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        copy: {
        	'复制压缩的inpirCss到lib目录': {
        		src: 'inspir.css',
        		dest: config.lgwx.dest + '/css/lib/inspir.css'

        	},
        	'复制img文件夹': {
        		expand: true,
        		cwd: config.lgwx.src + '/img',
        		src: '**/*.*',
        		dest: config.lgwx.dest + '/img'
        	},
        	'复制html': {
        		expand: true,
        		cwd: config.lgwx.src + '/views',
        		src: '**/*.*',
        		dest: config.lgwx.dest + '/views'
        	},
        	'复制concatTransport到buildJS': {
        		expand: true,
        		cwd:'concatTransport',
        		src: '**/*.js',
        		dest: config.lgwx.dest + '/js'
        	},
        	'wap复制压缩的inpirCss到lib目录': {
        		src: 'inspir.css',
        		dest: config.wap.dest + '/global/css/lib/inspir.css'

        	},
        	'wap复制concatTransport到buildJS': {
        		expand: true,
        		cwd:'concatTransport',
        		src: '**/*.js',
        		dest: config.wap.dest
        	},
        	'wap复制img文件夹': {
        		expand: true,
        		cwd: config.wap.src,
        		src: ['**/*.jpg', '**/*.png', '**/*.gif'],
        		dest: config.wap.dest
        	},
        	'wap复制html': {
        		expand: true,
        		cwd: config.wap.src,
        		src: '**/*.php',
        		dest: config.wap.dest
        	}
        },
	    transport: {
	    	'seajs转换': {
	    		expand : true,
                cwd: config.lgwx.src + '/js',  
                src: '**/*.js',  
                dest: 'seaTransport'
	    	},
	    	'wapseajs转换': {
	    		expand : true,
                cwd: config.wap.src,  
                src: '**/*.js',  
                dest: 'seaTransport'
	    	}
	    },
	    concat_cmd: {
	    	options: {  
                include: 'all'  
            },
	    	'seajs合并': {
	    		expand : true,
                cwd: 'seaTransport',  
                src: '**/*.js',  
                dest: 'concatTransport'
	    	}
	    },
	    concat: {
	    	'cssLib合并': {
	    		src: config.lgwx.src + '/css/lib/**/*.css',
	    		dest: 'inspir_temp.css'
	    	},
	    	'wapcssLib合并': {
	    		src: config.wap.src + '/global/css/lib/**/*.css',
	    		dest: 'inspir_temp.css'
	    	}
	    },
	    uglify: {
	    	options: {
                banner: '/*! version <%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
	    	'压缩合并后的seajs': {
	    		expand: true,
                cwd: 'concatTransport',
                src: ['**/*.js'],
                dest: config.lgwx.dest + '/js'
	    	},
	    	'wap压缩合并后的seajs': {
	    		expand: true,
                cwd: 'concatTransport',
                src: ['**/*.js'],
                dest: config.wap.dest
	    	}
	    },
	    cssmin: {
	    	options: {
                banner: '/*! version <%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
	    	'css压缩': {
	    		expand: true,
	    		cwd : config.lgwx.src + '/css',
                src: ['**/*.css'],
                dest: config.lgwx.dest + '/css'
	    	},
	    	'inspircss压缩': {
	    		src:'inspir_temp.css',
	    		dest: 'inspir.css'
	    	},
	    	'wapcss压缩': {
	    		expand: true,
	    		cwd : config.wap.src,
                src: ['**/*.css'],
                dest: config.wap.dest
	    	}
	    },
	    clean: {
	    	'删除cssBuildLib': [
	    		config.lgwx.dest + '/css/lib'
	    	],
	    	'删除两个合并的tempCss': [
	    		'inspir.css',
	    		'inspir_temp.css'
	    	],
	    	'删除seajs过渡文件': [
		    	'seaTransport',
		    	'concatTransport'
	    	]
	    }/*,
	    htmlmin: {
	    	'压缩html': {
	    		options: {                                 
			        removeComments: true,
			        collapseWhitespace: true,
			        removeCommentsFromCDATA:true,
			        removeCDATASectionsFromCDATA: true,
			        collapseWhitespace: true,
			        useShortDoctype: true,
			        removeEmptyAttributes: true,
			        removeEmptyElements: true
			    }
	    	}
	    }*/,
	    replace: {
	    	'替换全局css': {
			    options: {
			      patterns: [
			        {
			          match: /\<\?php\s+include\s+APP_STATIC\.(\'|\")views\/include\/globalcss\.php(\'|\")\s+\?\>/i,
			          replacement: '<link rel="stylesheet" href="<?php echo APP_LINK; ?>/css/lib/inspir.css">',
			          expression: true
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: config.lgwx.dest + '/views/main/**/*.php', 
			      	dest: config.lgwx.dest + '/views/main'
			      }
			    ]
		  	},
		  	'替换config': {
		  		options: {
			      patterns: [
			        {
			          match: '/lgwx/static/src/lgwx/js',
			          replacement: '/lgwx/static/build/lgwx/js'
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: '../seajs/config.js', 
			      	dest: '../seajs'
			      }
			    ]
		  	},
		  	'替换视图配置文件': {
		  		options: {
			      patterns: [
			        {
			          match: 'static/src',
			          replacement: 'static/build'
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: '../application/config/constants.php', 
			      	dest: '../application/config'
			      }
			    ]
		  	},
		  	'wap替换全局css': {
			    options: {
			      patterns: [
			        {
			          match: /\<\?php\s+include\s+APP_STATIC\.(\'|\")global\/include\/globalcss\.php(\'|\")\s+\?\>/i,
			          replacement: '<link rel="stylesheet" href="<?php echo APP_LINK; ?>/global/css/lib/inspir.css">',
			          expression: true
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: '../static/build/wap/model/type1/views/*.php', 
			      	dest: '../static/build/wap/model/type1/views/',
			      }
			    ]
		  	},
		  	'wap替换config': {
		  		options: {
			      patterns: [
			        {
			          match: '/lgwx/static/src/wap',
			          replacement: '/lgwx/static/build/wap'
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: '../seajs/configWap.js', 
			      	dest: '../seajs'
			      }
			    ]
		  	},
		  	'wap替换视图配置文件': {
		  		options: {
			      patterns: [
			        {
			          match: 'static/src',
			          replacement: 'static/build'
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: '../application/config/constants.php', 
			      	dest: '../application/config'
			      }
			    ]
		  	}
	    }
		      
    });

    grunt.loadNpmTasks("grunt-contrib-copy");
    grunt.loadNpmTasks("grunt-cmd-transport");
    grunt.loadNpmTasks("grunt-cmd-concat");
    grunt.loadNpmTasks("grunt-contrib-uglify");
    grunt.loadNpmTasks("grunt-contrib-clean");
    grunt.loadNpmTasks("grunt-contrib-concat");
    grunt.loadNpmTasks("grunt-contrib-cssmin");
    grunt.loadNpmTasks("grunt-replace");
   /* grunt.loadNpmTasks('grunt-contrib-htmlmin');*/

    grunt.registerTask('lgwx', [
    	'cssmin:css压缩',
    	'concat:cssLib合并',
    	'cssmin:inspircss压缩',
    	/*'clean:删除cssBuildLib',*/
    	'copy:复制压缩的inpirCss到lib目录',
    	'clean:删除两个合并的tempCss',
    	'transport:seajs转换',
    	'concat_cmd:seajs合并',
    	'copy:复制concatTransport到buildJS',
    	/*'uglify:压缩合并后的seajs',*/
    	'clean:删除seajs过渡文件',
    	'copy:复制img文件夹',
    	'copy:复制html',
    	'replace:替换全局css',
    	'replace:替换config',
    	'replace:替换视图配置文件'
    ]);

    grunt.registerTask('wap', [
    	'cssmin:wapcss压缩',
    	'concat:wapcssLib合并',
    	'cssmin:inspircss压缩',
    	'copy:wap复制压缩的inpirCss到lib目录',
    	'clean:删除两个合并的tempCss',
    	'transport:wapseajs转换',
    	'concat_cmd:seajs合并',
    	'copy:wap复制concatTransport到buildJS',
    	/*'uglify:wap压缩合并后的seajs',*/
    	'clean:删除seajs过渡文件',
    	'copy:wap复制img文件夹',
    	'copy:wap复制html',
    	'replace:wap替换全局css',
    	'replace:wap替换config',
    	'replace:wap替换视图配置文件'
    ]);

};

