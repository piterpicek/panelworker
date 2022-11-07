var config       = require('../config')
var gulp         = require('gulp')
var gulpSequence = require('gulp-sequence')
var getEnabledTasks = require('../lib/getEnabledTasks')

var productionTask = function(cb) {
  process.env.NODE_ENV = process.env.NODE_ENV || 'production';
  var tasks = getEnabledTasks('production')
  gulpSequence('clean', tasks.assetTasks, tasks.codeTasks, 'static', cb)
}

gulp.task('production', productionTask)
module.exports = productionTask
