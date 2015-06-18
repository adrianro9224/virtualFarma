/**
 * Created by Adrian on 30/03/2015.
 */

/**
 * Created by adrian on 29/03/15.
 */

farmapp.factory('UtilService', function() {

    'use strict';

    var utilService = {};

    utilService.isInteger = function ( value ) {
        if( !(angular.isNumber( value )) || ( value < 1) )
            return false;

        return true;
    };

    utilService.getDateMySql = function () {

        var currentDate = new Date();

        return currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + ' ' + currentDate.getHours() + ':' + currentDate.getMinutes() + ':' + currentDate.getSeconds();

    };

    return utilService;
});

