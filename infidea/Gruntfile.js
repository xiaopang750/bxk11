module.exports = function(grunt) {
    // 配置
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        copy: {
        	'复制压缩的inpirCss到lib目录': {
        		src: 'inspir.css',
        		dest: 'static/build/css/lib/inspir.css'

        	},
        	'复制img文件夹': {
        		expand: true,
        		cwd:'static/src/img',
        		src: '**/*.*',
        		dest: 'static/build/img'
        	},
        	'复制html': {
        		expand: true,
        		cwd:'static/src/views',
        		src: '**/*.*',
        		dest: 'static/build/views'
        	},
        	'复制concatTransport到buildJS': {
        		expand: true,
        		cwd:'concatTransport',
        		src: '**/*.js',
        		dest: 'static/build/js'
        	}
        },
	    transport: {
	    	'seajs转换': {
	    		expand : true,
                cwd: 'static/src/js',  
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
	    		src: 'static/src/css/lib/**/*.css',
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
                dest: 'static/build/js'
	    	}
	    },
	    cssmin: {
	    	options: {
                banner: '/*! version <%= pkg.version %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
	    	'css压缩': {
	    		expand: true,
	    		cwd : 'static/src/css',
                src: ['**/*.css'],
                dest: 'static/build/css'
	    	},
	    	'inspircss压缩': {
	    		src:'inspir_temp.css',
	    		dest: 'inspir.css'
	    	}
	    },
	    clean: {
	    	'删除cssBuildLib': [
	    		'static/build/css/lib'
	    	],
	    	'删除两个合并的tempCss': [
	    		'inspir.css',
	    		'inspir_temp.css'
	    	],
	    	'删除seajs过渡文件': [
		    	'seaTransport',
		    	'concatTransport'
	    	],
	    	'删除源代码目录':[
	    		'static/src'
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
			          match: /\<\?php\s+include\s+(\'|\")\.\.\/include\/globalcss\.php(\'|\")\s+\?\>/i,
			          replacement: '<link rel="stylesheet" href="../../css/lib/inspir.css">',
			          expression: true
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: 'static/build/views/main/**/*.php', 
			      	dest: 'static/build/views/main'
			      }
			    ]
		  	},
		  	'替换config': {
		  		options: {
			      patterns: [
			        {
			          match: '/static/src/js',
			          replacement: '/static/build/js'
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: 'seajs/config.js', 
			      	dest: 'seajs'
			      }
			    ]
		  	},
		  	'替换视图配置文件': {
		  		options: {
			      patterns: [
			        {
			          match: 'static/src/views',
			          replacement: 'static/build/views'
			        }
			      ],
			      usePrefix: false,
			    },
			    files: [
			      {	
			      	expand: true, 
			      	flatten: true,
			      	src: 'conf/config.php', 
			      	dest: 'conf'
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

    grunt.registerTask('default', [
    	'cssmin:css压缩',
    	'concat:cssLib合并',
    	'cssmin:inspircss压缩',
    	'clean:删除cssBuildLib',
    	'copy:复制压缩的inpirCss到lib目录',
    	'clean:删除两个合并的tempCss',
    	'transport',
    	'concat_cmd:seajs合并',
    	'copy:复制concatTransport到buildJS',
    	'uglify',
    	'clean:删除seajs过渡文件',
    	'copy:复制img文件夹',
    	'copy:复制html',
    	'replace:替换全局css',
    	'replace:替换config',
    	'replace:替换视图配置文件',
    	'clean:删除源代码目录'
    ]);

};

