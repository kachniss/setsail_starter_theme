const gulp = require('gulp');
const prettyError = require('gulp-prettyerror');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const rename = require('gulp-rename');
const cssnano = require('gulp-cssnano');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const eslint = require('gulp-eslint');
const browserSync = require('browser-sync');
const babel = require('gulp-babel');
const merge = require('merge-stream');


// Create basic Gulp tasks

gulp.task('sass', function () {
  const mainStyle = gulp
    .src([
      './sass/style.scss',
    ], { base: './sass/' }, { sourcemaps: true })
    .pipe(prettyError())
    .pipe(sass())
    .pipe(
      autoprefixer({
        browsers: ['last 2 versions']
      })
    )
    .pipe(gulp.dest('./'));

  const all = gulp
    .src([
      './sass/*.scss',
    ], { base: './sass/' }, { sourcemaps: true })
    .pipe(prettyError())
    .pipe(sass())
    .pipe(
      autoprefixer({
        grid: true, browsers: ['>1%']
      })
    )
    .pipe(cssnano())
    .pipe(rename({
      extname: '.min.css'
    }))
    .pipe(gulp.dest('./build/css'));

  return merge(mainStyle, all);
});

gulp.task('lint', function () {
  return gulp
    .src(['./js/*.js'])
    .pipe(prettyError())
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
});

gulp.task(
  'scripts',
  gulp.series('lint', function () {
    let main = gulp.src('./js/main/*.js')
      .pipe(babel())
      .pipe(uglify())
      .pipe(concat('scripts.js'))
      .pipe(
        rename({
          extname: '.min.js'
        })
      )
      .pipe(gulp.dest('./build/js'));


    return merge(main);
  })
);

// Set-up BrowserSync and watch

gulp.task('browser-sync', function () {
  const files = [
    './build/css/*.css',
    './build/js/*.js',
    './*.php',
    './**/*.php'
  ];

  browserSync.init(files, {
    proxy: 'localhost/Setsail_projects/edit_theme/'
  });

  gulp.watch(files).on('change', browserSync.reload);
});

gulp.task('watch', function () {
  gulp.watch('js/**/*.js', gulp.series('scripts'));
  gulp.watch('**/*.scss', gulp.series('sass'));
});

gulp.task('default', gulp.series('scripts', 'sass', gulp.parallel('browser-sync', 'watch')));