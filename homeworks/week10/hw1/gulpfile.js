var gulp       = require('gulp'),
    sass       = require('gulp-sass'),
    babel      = require('gulp-babel'),
    minifyCSS  = require('gulp-minify-css'),
    uglify     = require('gulp-uglify'),
    rename     = require("gulp-rename"),
    clean      = require("gulp-clean");

gulp.task('css', ['clean'], function () {     // 定義 sass 的任務名稱
    return gulp.src('./source/scss/**/*.scss') // sass 的來源資料夾
    .pipe(sass().on('error', sass.logError))
    .pipe(minifyCSS())
    .pipe(rename(function(path) {
        path.basename += ".min";
        path.extname = ".css";
    }))
    .pipe(gulp.dest('./build/css/'));
  });

gulp.task('js', ['clean'], function () {     // 定義 babel 的任務名稱
    return gulp.src('./source/js/**/*.js') // js 的來源資料夾
    .pipe(babel())
    .pipe(uglify())
    .pipe(rename(function(path) {
        path.basename += ".min";
        path.extname = ".js";
    }))
    .pipe(gulp.dest('./build/js/'));
  });

  gulp.task('clean', function () {     // 定義 babel 的任務名稱
    return gulp.src('./build') // js 的來源資料夾
    .pipe(clean());
  });

gulp.task('default', ['css', 'js'])

