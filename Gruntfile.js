// Gruntfile.js
// grunt watch:test
module.exports = function(grunt) {
    grunt.initConfig({
        phpunit: {
            classes: {
                dir: 'app/tests/'
            },
            options: {
                logTap: 'app/storage/logs/tests.log',
                colors: true
            }
        },
        /*phpmd: {
            application: {
                dir: 'app/models/*.*'
            },
            options: {
                rulesets: 'codesize,unusedcode,naming'
            }
        },*/
        watch: {
            test: {
                files: ['app/**/*.*'],
                tasks: ['phpunit'],
                //tasks: ['phpmd'],
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-phpunit');
    //grunt.loadNpmTasks('grunt-phpmd');
};