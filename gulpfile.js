var gulp = require('gulp');
var browserify = require('gulp-browserify');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var notify = require("gulp-notify");

gulp.task( 'vendors.css', function() {
	gulp.src([
		'node_modules/todomvc-common/base.css',
		'node_modules/todomvc-app-css/index.css'
	])
	.pipe(concat('vendors.min.css'))
	.pipe( minify() )
	.pipe(gulp.dest('./public/css'))
	.pipe(notify("Vendors css bundle has been successfully compiled!"));
});

gulp.task( 'vendors.js', function() {

	gulp.src( [ 
		'node_modules/vue/dist/vue.js', 
		'node_modules/vue-resource/dist/vue-resource.js', 
		'node_modules/todomvc-common/base.js',
	])
    .pipe(uglify())
	.pipe(concat('vendors.min.js'))
	.pipe(gulp.dest('./public/js'))
	.pipe(notify("Vendors jaavscript bundle has been successfully compiled!"));
});

gulp.task( 'css', function() {
	
	gulp.src('./resources/assets/css/style.css')
		.pipe( minify() )
		.pipe(rename('style.bundle.css'))
		.pipe(gulp.dest('./public/css'))
		.pipe(notify("Css bundle has been successfully compiled!"));

});

gulp.task( 'todos', function() {
	gulp.src('./src/Todos/js/App.js')
    .pipe(browserify( {
    	transform: [ 'babelify', 'vueify' ],
    }))
    .pipe(uglify())
	.pipe(rename('todos.bundle.js'))
	.pipe(gulp.dest('./public/js/todos'))
	.pipe(notify("Todos bundle has been successfully compiled!"));
});

gulp.task( 'watch-todos', function() {
	gulp.watch('src/Todos/js/App.js', ['todos']);
});

gulp.task( 'vendors', [ 'vendors.css', 'vendors.js' ] );
gulp.task( 'watch', [ 'watch-todos' ] );
gulp.task( 'default', [ 'watch' ] );

