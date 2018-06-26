var gulp = require('gulp');
var concat = require('gulp-concat');
var sass = require('gulp-sass');

var srcBasePath = './app/Resources/assets/';
var dstBasePath = './web/assets/';

var vendorJS = [
    './node_modules/jquery/dist/jquery.min.js',
    './node_modules/bootstrap/dist/js/bootstrap.min.js'
];

var vendorCSS = [
    './node_modules/bootstrap/dist/css/bootstrap.min.css'
];

gulp.task('vendorJS',function(){
    gulp.src(vendorJS)
        .pipe(concat('vendor.js'))
        .pipe(gulp.dest(dstBasePath + 'js'));
});

gulp.task('vendorCSS',function(){
    gulp.src(vendorCSS)
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest(dstBasePath + 'css'));
});

gulp.task('sass', function () {
    return gulp.src(srcBasePath + 'scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(srcBasePath + 'css'));
});

gulp.task('css', ['sass'], function(){
    gulp.src(srcBasePath + 'css')
        .pipe(concat('app.css'))
        .pipe(gulp.dest(dstBasePath + 'css'));
});

gulp.task('js',function(){
    gulp.src(srcBasePath + 'js/**/*.js')
        .pipe(concat('app.js'))
        .pipe(gulp.dest(dstBasePath + 'js'));
});

gulp.task('fonts', function () {
    gulp.src('./node_modules/bootstrap/dist/fonts/**/*')
        .pipe(gulp.dest(dstBasePath + 'fonts'));
});

gulp.task('build', ['vendor', 'fonts', 'css', 'js']);

gulp.task('vendor',['vendorJS','vendorCSS']);

gulp.task('watch', ['build'], function () {
    gulp.watch(srcBasePath + 'sass/*.scss', ['css']);
    gulp.watch(srcBasePath + 'js/*.js', ['js']);
});

gulp.task('default', ['build']);