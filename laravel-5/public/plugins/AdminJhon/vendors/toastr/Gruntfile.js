module.exports = function(grunt) {
  grunt.initConfig({
    less: {
      dev: {
        files: {
          "toastr.css": "toastr.less"
        }
      },
      prod: {
        options: {
          yuicompress: true
        },
        files: {
          "toastr.min.css": "toastr.less"
        }
      }
    },

    uglify: {
      prod: {
        files: {
          "toastr.min.js": "toastr.js"
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('default', ['less', 'uglify']);
<<<<<<< HEAD
};
=======
};
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
