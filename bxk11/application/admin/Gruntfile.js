module.exports = function(grunt) {
    // 配置
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        watch:{
            livereload: {
                options:{
                    livereload: true
                },
                files: [
                    'static/src/**/*.*'
                ]
            }
        }
    });

   
    grunt.loadNpmTasks('grunt-livereload');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch','livereload']);

};