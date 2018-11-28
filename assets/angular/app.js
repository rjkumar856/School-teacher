/**
 * @ngdoc overview
 * @name app
 * @description
 * # app
 *
 * Main module of the application.
 */
 var schoolApp;
(function() {
    'use strict';
    schoolApp = 
    angular
      .module('schoolApp', [
        'ngAnimate',
        'ui.bootstrap',
        'ngResource',
        'ngMaterial',
        'ngSanitize',
        'ngStorage',
      ]);
})();