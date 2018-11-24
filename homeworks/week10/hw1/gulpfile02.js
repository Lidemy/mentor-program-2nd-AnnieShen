var gulp       = require('gulp'),
    sass       = require('gulp-sass'),
    babel      = require('gulp-babel'),
    concat     = require('gulp-concat'),
    minifyCSS  = require('gulp-minify-css'),
    uglify     = require('gulp-uglify'),
    rename     = require("gulp-rename");

//sass
gulp.task('sass', function () {     // 定義 sass 的任務名稱
    return gulp.src('./source/scss/**/*.scss') // sass 的來源資料夾
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest('./app/css')); // sass 編譯完成後的匯出資料夾
  });

//babel
gulp.task('es6', function () {     // 定義 babel 的任務名稱
    return gulp.src('./source/js/**/*.js') // js 的來源資料夾
    .pipe(babel())
    .pipe(gulp.dest('./app/js')); // js 編譯完成後的匯出資料夾
  });

//合併檔案
gulp.task('concat', function() {
    return gulp.src('./app/css/*.css')
        .pipe(concat('all.css'))
        .pipe(gulp.dest('./build/css/'));
});

//壓縮css
gulp.task('minify-css',['concat'], function() {
    return gulp.src('./build/css/all.css')
        .pipe(minifyCSS({
            keepBreaks: true,
        }))
        .pipe(rename(function(path) {
            path.basename += ".min";
            path.extname = ".css";
        }))
        .pipe(gulp.dest('./build/css/'));
});

//壓縮js
gulp.task('uglify', function() {
    return gulp.src('./app/js/*.js')
        .pipe(uglify())
        .pipe(rename(function(path) {
            path.basename += ".min";
            path.extname = ".js";
        }))
        .pipe(gulp.dest('./build/js/'));
});

// gulp.task('default',['minify-css','uglify']);
gulp.task('default', ['sass', 'es6', 'minify-css','uglify'])

