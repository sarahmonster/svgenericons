module.exports = function(grunt) {
	grunt.initConfig({
		// Make sure to load our config file
		pkg: grunt.file.readJSON('package.json'),

		// Set up SVGstore to make us an SVG sprite!
	  svgstore: {
	    options: {
	      prefix : 'genericon-',
	      svg: {
	        xmlns: 'http://www.w3.org/2000/svg'
	      },
				cleanup : ['style', 'fill', 'id']
	    },

			// Default task compiles all svgs in the source folder to a single sprite
			default : {
		    files: {
		      'genericons/genericons.svg': ['source/*.svg'],
		    }
		  }
	  }
	});

	// Load our required plugins
	grunt.loadNpmTasks('grunt-svgstore');

	// Set up our default task
	grunt.registerTask('default', ['svgstore']);
}
