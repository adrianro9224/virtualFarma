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

    return utilService;
});

