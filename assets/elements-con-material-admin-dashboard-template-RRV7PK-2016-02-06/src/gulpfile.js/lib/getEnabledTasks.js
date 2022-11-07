var config = require('../config')
var compact = require('lodash/array/compact')

// Grouped by what can run in parallel
var assetTasks = ['images']
var codeTasks = ['html', 'css', 'js']

module.exports = function(env) {
  return {
    assetTasks: compact(assetTasks),
    codeTasks: compact(codeTasks)
  }
}
