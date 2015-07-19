// Main

'use strict';

var $             = require("jquery"),
	_             = require("underscore");

var indexController = require("./controllers/index.js");


$(document).ready(function () {

	indexController.init();

});
