// Gruntfile.js
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
		watch: {
			test: {
				files: ['app/**/*.*'],
				tasks: ['phpunit']
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-phpunit');
};