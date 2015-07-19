// Bundle Looger ========================
// 
// Gulp style logging for Browserify/Watchify bundle method

var gutil        = require('gulp-util'),
    prettyHrtime = require('pretty-hrtime'),
    startTime;

module.exports = {

    start: function(startMsg) {
        startTime = process.hrtime();
        gutil.log(gutil.colors.white.bgRed(startMsg + '...'));
    },

    end: function(endMsg) {
        var taskTime   = process.hrtime(startTime),
            prettyTime = prettyHrtime(taskTime);

        gutil.log(gutil.colors.white.bgBlue(endMsg +" "+ prettyTime));
    },

    msgBlue: function(msg) {
        gutil.log(gutil.colors.bgBlue(msg));
    },
    msgGreen: function(msg) {
        gutil.log(gutil.colors.bgGreen(msg));
    },
    msgRed: function(msg) {
        gutil.log(gutil.colors.bgRed(msg));
    }


};