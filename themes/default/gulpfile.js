let gulp = require('gulp');
let data = require('gulp-data');
let stylus = require('gulp-stylus');

let sourcemaps = require('gulp-sourcemaps');

let directories = {
    stylus: {
        src: ['./src/stylus/app.styl'],
        dest: './assets/css',
    }
}

// Get one .styl file and render
gulp.task('compile:stylus', function () {
  return gulp.src(directories.stylus.src)
    .pipe(stylus({
        compress: true,
        linenos: true,
        'include css': true,
    }))
    .pipe(gulp.dest(directories.stylus.dest));
});

// Default Task
gulp.task('default', ['compile:stylus']);
