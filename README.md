# Appstore Search


[![Build Status](https://travis-ci.org/heldtogether/appstore-search.svg)](https://travis-ci.org/heldtogether/appstore-search)

See [the app here](https://appstore-search.herokuapp.com/).


## Build

### PHP

From the `app` directory, run

    composer install

and then to run the tests

    phpunit


### Javascript

From the `build` directory, run

    npm install

to install dependencies, then run

    gulp

to start `gulp` watching. It will respond to changes in any
of the Javascript files and build and minify.


## Deploy

To deploy to Heroku use

    git subtree push --prefix app heroku master

to just deploy the `app` directory.
