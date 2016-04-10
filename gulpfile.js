var gulp = require('gulp');
var watch = require('gulp-watch');
var shell = require('gulp-shell')
var notify = require('gulp-notify');
var plumber =  require('gulp-plumber');
gulp.task('phpunit', function() {
    gulp.src('./tests/*.php')
        .pipe(watch('./tests/*.php'))
        .pipe(notify('Running Unit tests...'))
        .on('change',()=>{ console.log('Changes on Test Cases')})
        .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
        .pipe(shell('phpunit --debug'))
        .pipe(notify('Test Successfull...'))
})
