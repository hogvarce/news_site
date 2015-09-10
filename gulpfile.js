var gulp = require('gulp'),
    gutil = require('gulp-util'),
    concat = require('gulp-concat'),
    sass = require('gulp-sass');

var jsSource = [
  'web/js/*.js'
];

var sassSource = [
  'web/scss/*.scss'
];

gulp.task('sass', function(){
  gulp.src(sassSource)
    .pipe(sass())
      .pipe(concat('styles.css'))
        .pipe(gulp.dest('web/css'))
});

gulp.task('js', function(){
  gulp.src(jsSource)
    .pipe(concat('global.js'))
      .pipe(gulp.dest('web/js'))
});

gulp.task("watch", function(){
  gulp.watch(sassSource, ['sass']);
  gulp.watch(jsSource, ['js']);
});

gulp.task('default', function() {
    gulp.start('watch', 'sass', 'js');
});
