// ========================= gulp commands =========================
/*
smartgrid - генерирует новую сетку
watcher - запускает HTML-сервер
less - перевод в CSS без оптимизаций
js - без оптимизации
minjs - минифицировать
img - оптимизация изображений
build - оптимизация под прожакшн
*/
// ========================= Vars =========================
const gulp = require('gulp');
const less = require('gulp-less');
const smartgrid = require('smart-grid');
const rename = require("gulp-rename");
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const gcmq = require('gulp-group-css-media-queries');

const uglify = require('gulp-uglify');
const concat = require('gulp-concat');

const imagemin = require('gulp-imagemin');
const imgCompress = require('imagemin-jpeg-recompress');

const browserSync = require('browser-sync').create();

// ========================= Smart-grid config =========================

const settings = {
	/* less || scss || sass || styl */
	outputStyle: 'less',
	/* number of grid columns */
	columns: 12,
	/* gutter width px || % || rem */
	offset: '20px',
	/* mobileFirst ? 'min-width' : 'max-width' */
	mobileFirst: false,
	container: {
		/* max-width оn very large screen */
		maxWidth: '1400px',
		fields: '10px'
	},
	breakPoints: {
		lg: {
			width: '1400px', 
			fields: '10px'
		},
		md: {
			width: '992px', //tablets
			fields: '10px'
		},
		sm: {
			width: '768px', //phones landscape
			fields: '10px'
		},
		xs: {
			width: '576px', //old phones and other
			fields: '10px'
		}
		/*
		some_name: {
		    width: 'Npx',
		    fields: 'N(px|%|rem)',
		    offset: 'N(px|%|rem)'
		}
		*/
	}
};

gulp.task('smartgrid', function () {
	smartgrid('./resources/less', settings);
})

// ========================= Tasks =========================

gulp.task('less', function () {
	return gulp.src('./resources/less/index.less') // gulp.src(cssFileSequence)
		.pipe(less())
		.pipe(rename('index.min.css'))
		.pipe(gulp.dest('./public/css/'))
});

gulp.task('js', function () {
	return gulp.src('./resources/js/index.js')
		.pipe(rename('index.min.js'))
		.pipe(gulp.dest('./public/js/'));
});


gulp.task('watcher', function () {
	browserSync.init({
		proxy: 'http://air.local/',
		online: false
	});

	gulp.watch([
		'./app/**/*',
		'./routes/**/*',
		'./resources/views/**/*',
	]).on('change', browserSync.reload);
	gulp.watch('./resources/less/**/*', gulp.series('less')).on('change', browserSync.reload);
	gulp.watch('./resources/js/index.js', gulp.series('js')).on('change', browserSync.reload);
	// gulp.watch('./resources/less/admin.less', gulp.series('less_admin')).on('change', browserSync.reload);
	// gulp.watch('./resources/js/admin.js', gulp.series('js_admin')).on('change', browserSync.reload);
	// gulp.watch(['./index.html', './html/*.html']).on('change', browserSync.reload);
});

// ========================= BUILD/RELEASE =========================

const build = gulp.series(build_JS, build_CSS);
exports.build = build;

function build_CSS() {
	return gulp.src('./resources/less/index.less')
		.pipe(less())
		.pipe(gcmq())
		.pipe(autoprefixer({
			cascade: true
		}))
		.pipe(cleanCSS({
			level: 2
		}))
		.pipe(rename('index.min.css'))
		.pipe(gulp.dest('./public/css/'));
}

function build_JS() {
	return gulp.src('./resources/js/index.js')
		.pipe(uglify({
			toplevel: false
		}))
		.pipe(rename('index.min.js'))
		.pipe(gulp.dest('./public/js/'))
}

gulp.task('img', function () {
	return gulp.src('./resources/img/**/*')
		.pipe(imagemin([
			imgCompress({
				loops: 4,
				min: 70,
				max: 80,
				quality: 'high'
			}),
			imagemin.gifsicle(),
			imagemin.optipng(),
			imagemin.svgo()
		]))
		.pipe(gulp.dest('./public/img/'));
});
