module.exports = function (grunt) {

	// Initialize configuration object
	grunt.initConfig({

		// Read in project settings
		pkg: grunt.file.readJSON('package.json'),
		
		cssmin: {
			options: {
	      		keepSpecialComments: 0
	    	},
			minify: {
			    expand: true,
			    cwd: 'app/assets/css/',
			    src: ['**/*.css', '!*.min.css'],
			    dest: 'public/css/',
			    ext: '.min.css'
		  	}
		},

	  	uglify: {
	  		options: {
    			mangle: false
    		},
	   		my_target: {
	      	files: [{
	          	expand: true,
	          	cwd: 'app/assets/js',
	          	src: ['**/*.js', '!*.min.js'],
	          	dest: 'public/js/',
	          	ext: '.min.js'
	      	}]
	    	}
	  	},

	  	watch: {
			csswatch: {
			    files: ['app/assets/css/**/*.css'],
			    tasks: ['cssmin'],
			    options: {
			      spawn: false,
			      interval: 500,
			    },
			},
			jswatch: {
			    files: ['app/assets/js/**/*.js'],
			    tasks: ['uglify'],
			    options: {
			      spawn: false,
			      interval: 500,
			    },
			},
		},

	});

	// Load npm tasks
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	// Register tasks
	grunt.registerTask('default', ['cssmin', 'uglify']); // Default task
}
