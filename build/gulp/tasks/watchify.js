/*
* Gulp Watchify
*
* Browserify/Watchify tasks to
* bundle JS as per entry/configs in
* meta object from index.js
*
*/

var gulp         = require('gulp'),
    bundleLogger = require('../util/bundleLogger'),
    fs           = require('fs'),
    browserify   = require('browserify'),
    watchify     = require('watchify'),
    source       = require("vinyl-source-stream"),
    _            = require("underscore");

module.exports = function(meta){


    /**
     * Bundle
     */
    var bundle = function(b, module, key){

        // Output time taken to bundle
        var method = module.watch ? "WATCHIFY" : "BROWSERIFY",
            output = key + ".js";

        bundleLogger.start(method + " - JS will compile " + output);

        return b.bundle()
            .on('error', function (err) {
                bundleLogger.msgRed(err);
                bundleLogger.msgRed("ERROR SEE ABOVE - Waiting for more changes")
            })
            .pipe(source(output))
            .pipe(gulp.dest(module.destination))
            .on('end', function () {
                bundleLogger.end(method + " - JS did compile " + output + " in");

                if(module.watch){
                    bundleLogger.msgBlue("WATCHIFY - Still Watching " + output)
                }
            });
    }


    /**
     * Add bundle properties
     */
    var addBundleProps = function(b, module){

        var bundler = b;

        for(var i = 0; i < module.input.length; i++){

            if(module.standalone){

                if(_.isUndefined(module.input[i].require)){
                    // External
                    bundler.external(module.input[i].external);
                }else{
                    // Expose
                    bundler.require(module.input[i].require, {
                        expose: module.input[i].expose
                    });
                }

            }else{

                // Just add
                bundler.add(module.input[i]);

                if(!_.isUndefined(module.depends)){
                    module.depends.forEach(function(external){
                        bundler.external(external.expose);
                    });
                }
            }
        }

        return bundler;
    }


    /**
     * Create single bundle using meta.js
     */
    var createBundle = function(module, key, watch) {

        var b = browserify({
            cache          : {},
            packageCache   : {},
            fullPaths      : false
        });

        bundler = addBundleProps(b, module);

        if(watch){
            module.watch = true;

            b = watchify(b);

            b.on('update', function(){
                bundle(b, module, key);
            });
        }

        return bundle(b, module, key);
    }


    /**
     * Create all bundles
     */
    var createBundles = function(bundles, watch){

        watch = typeof(watch) === "undefined" ? false : true;

        _.each(bundles, function(module, key){
            createBundle(module, key, watch);
        });

    }


    /**
     * Browserify
     */
    gulp.task('browserify', function(){
        createBundles(meta.js);
    });


    /**
     * Watchify
     */
    gulp.task('watchify', function(){
        createBundles(meta.js, "watch");
    });

}
