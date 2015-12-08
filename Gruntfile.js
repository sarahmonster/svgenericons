module.exports = function(grunt) {
	grunt.initConfig({
		// Make sure to load our config file
		pkg: grunt.file.readJSON('package.json'),

		// Set up SVGstore to make us an SVG sprite!
	  svgstore: {
	    options: {
	      prefix : 'icon-', // This will prefix each ID
	      svg: { // will add and overide the the default xmlns="http://www.w3.org/2000/svg" attribute to the resulting SVG
	        viewBox : '0 0 100 100',
	        xmlns: 'http://www.w3.org/2000/svg'
	      }
	    },
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
