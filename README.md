# HalloUrzond

[![Build Status](https://api.travis-ci.org/hallourzond/hallourzond.svg?branch=master)](https://travis-ci.org/hallourzond/hallourzond) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/hallourzond/hallourzond/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/hallourzond/hallourzond/?branch=master)

## HOW TO START USING VAGRANT

*Work in progress...*

```
cd /var/www
git clone git@github.com:hallourzond/hallourzond.git
cd /var/www/vm-hackathon16
vagrant up
cd /var/www/vm-hackathon16/hackathon16
git clone git@github.com:dariuszwrzesien/hackathon16.git .
composer install
```

Add this to hosts file:
`192.168.56.101 hackathon16.dev`

## DATABASE

### Drop current database

```
$: php bin/console doctrine:schema:drop --force
```

### Update database schema

```
$: php bin/console doctrine:schema:update --force
```

## FRONTEND

### Tech stack

We are creating a SPA using [React](https://facebook.github.io/react/) and [babel](https://babeljs.io/) for ES6 support
The application is bundled and minified using the [webpack](https://webpack.github.io/) bundler

### Building and developing the application

To build the application you need `node` and `npm` on your machine. Get node [here](https://nodejs.org/en/download/).

To build the front application, go to `./app-front` in shell of your choice and run command `npm i`. This will install latest `npm` dependencies and build the application.

To build the application without installing `node_modules` simply run `npm run build` in `./app-front`

When developing the application you don't have to build it every time after making changes. Run `npm run build:dev` - it will run the build on file changes in `./app-front`

## ADMINISTRATION PANEL

Go to url: ```/admin``` and login using credentials:
 
|Username|Password|Role|
|--------|--------|----|
|admin|admin|ROLE_ADMIN|
|worker|worker|ROLE_WORKER|
