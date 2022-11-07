var config         = require('../config')
if(!config.tasks.html) return

var handleErrors   = require('../lib/handleErrors')
var browserSync    = require('browser-sync')
var data           = require('gulp-data')
var gulp           = require('gulp')
var gulpif         = require('gulp-if')
var prettify       = require('gulp-jsbeautifier')
var htmlmin        = require('gulp-htmlmin')
var validator      = require('gulp-w3cjs')
var path           = require('path')
var render         = require('gulp-nunjucks-render')
var fs             = require('fs')
var headerComment  = require('../lib/getHeaderComment')
var logger         = require("eazy-logger").Logger({
                       prefix: '[{blue:StarterKit}] ',
                       useLevelPrefixes: false
                     });

var exclude = path.normalize('!**/{' + config.tasks.html.excludeFolders.join(',') + '}/**')

var paths = {
  src: [path.join(config.root.src, config.tasks.html.src, '/**/*.html'), exclude],
  dest: path.join(config.root.dest, config.tasks.html.dest),
}

var getData = function(file) {
  var dataPath = path.resolve(config.root.src, config.tasks.html.src, config.tasks.html.dataFile)
  var data = JSON.parse(fs.readFileSync(dataPath, 'utf8'));
  data.file = file;
  data.ENV = process.env.NODE_ENV;
  data.filename = path.basename(file.path);
  data.headerComment = headerComment('html')

  // active menu item for menu
  data.isActiveMenuItem = function(file, item, filename) {
    if (file == filename || (item.sub && item.sub[filename])) {
      return true;
    }

    if(item.sub) {
      for(var fileSub in item.sub) {
        var itemSub = item.sub[fileSub];

        if (fileSub == filename || (itemSub.sub && itemSub.sub[filename])) {
          return true;
        }
      }
    }

    return false;
  }

  function workWithPlugins(val, plugins) {
    if(plugins == '*') {
      var plugins = [];
      for(var k in data.plugins) plugins.push(k);
    } else {
      plugins = plugins.split(',');
    }
    for(var k in plugins) {
      if(typeof data.plugins[plugins[k]] !== 'undefined') {
        data.plugins[plugins[k]] = val;
      }
    }
  }

  // enable plugin
  data.enablePlugins = function(plugins) {
    workWithPlugins(true, plugins);
  }

  // disable plugin
  data.disablePlugins = function(plugins) {
    workWithPlugins(false, plugins);
  }

  return data
}

var startedHTMLtask = -1;
var htmlTask = function() {
  render.nunjucks.configure([path.join(config.root.src, config.tasks.html.src)], {watch: false })

  if(startedHTMLtask < 0) {
    startedHTMLtask = 0;
  } else {
    logger.info("{cyan:HTML file changed");
  }
  startedHTMLtask++;

  return gulp.src(paths.src)
    .pipe(data(getData))
    .pipe(render())
    .on('error', handleErrors)
    //.pipe(gulpif(process.env.NODE_ENV === 'deploy', validator()))
    .pipe(gulpif(process.env.NODE_ENV === 'production', htmlmin(config.tasks.html.htmlmin)))
    .pipe(gulpif(process.env.NODE_ENV === 'deploy', prettify(config.tasks.html.prettify)))
    .pipe(gulp.dest(paths.dest))
    .on('end', function() {
      startedHTMLtask--;
      if(startedHTMLtask == 0) {
        browserSync.reload()
      }
    });
}

gulp.task('html', htmlTask)
module.exports = htmlTask
