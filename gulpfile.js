/**
 *
 * Available gulp tasks:
 * gulp version -> changes the theme version in various files throught the project (prompt asks for new version)
 * gulp -> default task, minifies and concatenates css and js files
 * gulp prod -> changes the theme version, minifies and concatenates all CSS and JS files, creates the translations pot file, copies all files to dist folder (cleaning it up beforehand) and creates a new theme zip
 * and finally creates a new theme zip
 * gulp cssmin -> Autoprefixes and minifies all CSS files and adds font-family properties to all rules that contain object-fit, required by object-fit-images plugin
 * gulp cssconcat -> Concatenates all css files into all.css
 * gulp cssconcatmin -> Concatenates all minified css files into all.min.css
 * gulp css -> minifies and concatenates all css files
 * gulp jsconcat -> Concatenates all js files into all.js
 * gulp jsconcatmin -> Concatenates all minified js files into all.min.js
 * gulp jsmin -> minifies all js files
 * gulp clean -> deletes the dist folder
 * gulp cleanmin -> deletes all minified files (css and js) in the project
 * gulp copy -> copies all files to the dist folder (minifies resources and cleans the dist folder beforhand)
 * gulp zip -> creates the zip file for the theme from dist folder (runs gulp copy as a dependend task)
 * gulp pot -> generates the default.pot file for translations
 */

var gulp = require('gulp');
var autoprefixer = require('autoprefixer');
var postcss = require('gulp-postcss');
var cssnano = require('gulp-cssnano');
var objectfit = require('postcss-object-fit-images');
var zip = require('gulp-zip');
var rename = require('gulp-rename');
var watch = require('gulp-watch');
var del = require('del');
var runSequence = require('run-sequence');
var pot = require('gulp-wp-pot');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');

// Css Minimy
gulp.task('cssmin', function() {
    return gulp.src([
        'admin/assets/css/*.css',
        'assets/css/*.css'
        ])
        .pipe(cssnano())
        .pipe(rename(function (path) {
            path.extname = ".min.css"
        }))
        .pipe(gulp.dest(function(file) {
            return file.base;
        }));
});

/**
 * Minifies all unminified javascript files,
 * and copies them to dist folder
 */
gulp.task('jsmin', function () {
    return gulp.src([
        'admin/assets/js/*.js',
        'assets/js/*.js'
        ])
        .pipe(uglify())
        .pipe(rename(function (path) {
            path.extname = ".min.js"
        }))
        .pipe(gulp.dest(function(file) {
            return file.base;
        }));
});


/**
 * Deletes the dist folder
 */
gulp.task('clean', function () {
    return del(['dist/']);
});

/**
 * Deletes all minified files in the project
 */
gulp.task('cleanmin', function () {
    return del([
        'admin/assets/js/*.min.js',
        'admin/assets/css/*.min.css',
        'assets/js/*.min.js',
        'assets/css/*.min.css',
        '!node_modules/**/*'
    ]);
});

/**
 * Copies all files to the dist folder
 */
gulp.task('copy', function () {
    return gulp.src([
        '**/*',
        '!assets/css/elements-css',
        '!assets/css/elements-css/**',
        '!assets/js/elements-js',
        '!assets/js/elements-js/**',
        '!.gitignore',
        '!package.json',
        '!package-lock.json',
        '!gulpfile.js',
        '!dist/**/*',
        '!node_modules',
        '!node_modules/**/*'
    ])
    .pipe(gulp.dest('dist/exclusive-addons-for-elementor'));
});



/**
 * Creates the zip file for the theme from dist folder
 * (has task that copies all required theme files
 * to dist folder)
 */
gulp.task('zip', function () {
    return gulp.src('dist/**/*')
        .pipe(zip('exclusive-addons-for-elementor.zip'))
        .pipe(gulp.dest('dist'))
});

/**
 * Generates the default .pot
 * file for translations
 */
gulp.task('pot', function () {
    return gulp.src('**/*.php')
        .pipe(pot({
            domain: 'exclusive-addons-elementor',
            package: 'Exclusive Addons Elementor'
        }))
        .pipe(gulp.dest('languages/default.pot'));
});

/**
 * Changes the version, minifies and concatenates
 * all CSS and JS files, copies all files to
 * dist folder (cleaning it up beforehand),
 * and finally creates a new theme zip
 */
gulp.task('prod', function(callback) {
    return runSequence( 'clean', 'pot', 'copy', 'zip', callback);
});

/**
 * Concat Js
 */
gulp.task('jsconcat', function() {
    return gulp.src('assets/js/elements-js/*.js')
      .pipe(concat('exad-scripts.js'))
      .pipe(gulp.dest('./assets/js'));
});

/**
 * Concat Css
 */
gulp.task('cssconcat', function() {
    return gulp.src('assets/css/elements-css/*.css')
      .pipe(concat('exad-styles.css'))
      .pipe(gulp.dest('./assets/css'));
});

/**
 * Watch Gulp css and js concat
 */

gulp.task('watch', function () {
    gulp.watch('assets/css/elements-css/*.css', ['cssconcat']);
    gulp.watch('assets/js/elements-js/*.js', ['jsconcat']);
});

/**
 * Minifies and concatenates JS and CSS
 */
gulp.task('default', ['cssconcat', 'jsconcat'] );
