/**
 * Grunt Wrapper
 *
 * @param  object grunt Instance of Grunt
 * @return void
 */
module.exports = function(grunt) {

    /**
     * Given a path to a base external LESS file, figure out the destination
     * CSS file path to compile to.
     *
     * @param  {string} dest    Path of destination.
     * @param  {string} src     Path of source file.
     * @param  {object} options Various options for this files object such as cwd,
     *                          src, ext.
     * @return {string}         Path of where the destination JS should be
     *                          compiled to.
     */
    var renameDestFile = function renameDestFile(dest, src, options) {
        return dest + src.replace('.compile.less', '.css');
    };

    // Require the just in time plugin loader
    require('jit-grunt')(grunt);

    // Init the config object, define the less & watch options
    grunt.initConfig({
        less: {
            development: {
                options: {
                    compress: true,
                    yuicompress: true,
                    optimization: 2
                },
                files: [
                    {
                        expand: true, // Expand dynamic mapping
                        src: 'public/static/css/compile/*.compile.less', // Pattern to match
                        dest: 'public/static/css/stylesheets/', // Destination path prefix
                        flatten: true, // Remove all path parts from generated dest paths
                        rename: renameDestFile // Rename the dest file
                    }
                ]
            }
        },
        watch: {
            styles: {
                // Location of the less files on which we want to catch updates
                files: ['public/static/css/**/*.less'],
                tasks: ['less']
            }
        }
    });

    // Register the less and watch tasks by default
    grunt.registerTask('default', ['less', 'watch']);
};
