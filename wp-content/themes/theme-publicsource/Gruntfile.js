module.exports = function(grunt) {
  'use strict';

  // Load all tasks
  require('load-grunt-tasks')(grunt);
  // Show elapsed time
  require('time-grunt')(grunt);

  // Force use of Unix newlines
  grunt.util.linefeed = '\n';

  // Find what the current theme's directory is, relative to the WordPress root
  var path = process.cwd().replace(/^[\s\S]+\/wp-content/, "\/wp-content");

  var cssLessFiles = {
    'css/style.css': 'less/style.less',
    'homepages/assets/css/homepage.css': 'homepages/assets/less/homepage.less'
  };

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    less: {
      compile: {
        options: {
          paths: ['less', '../largo/less/inc'],
          outputSourceFiles: true,
          sourceMapBasepath: path,
        },
        files: cssLessFiles
      }
    },

    watch: {
      less: {
        files: [
          'less/*.less',
          'homepages/assets/less/*.less'
        ],
        tasks: [
          'less:compile',
          'cssmin'
        ]
      }
    },

    cssmin: {
        target: {
            options: {
                report: 'gzip'
            },
            files: [{
                expand: true,
                cwd: 'css',
                src: ['*.css', '!*.min.css'],
                dest: 'css',
                ext: '.min.css'
            },
            {
                expand: true,
                cwd: 'homepages/assets/css',
                src: ['*.css', '!*.min.css'],
                dest: 'homepages/assets/css',
                ext: '.min.css'
            }]
        }
    }
  });

  // Build assets, docs and language files
  grunt.registerTask('build', 'Build less files', [
    'less', 'cssmin',
  ]);
}
