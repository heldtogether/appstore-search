var fs           = require('fs'),
	scriptFilter = require('./util/scriptFilter'),
	tasks        = fs.readdirSync('./gulp/tasks/').filter(scriptFilter);


var rootDir = "../app/";

var meta = {
	assetsDir  : rootDir+"public/assets/",
	jsDir      : "./js/"
};


meta.js = {
	"main": {
		input       : [meta.jsDir + "app/main.js"],
		destination : meta.assetsDir + 'js-min/'
	}

}


/**
 * Task includes
 */
tasks.forEach(function(task){
	require('./tasks/' + task)(meta);
});


/**
 * User Commands/Tasklist
 */
require("./tasklist");
