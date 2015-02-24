/**
 * Created by Adrian on 13/01/2015.
 */

farmapp.factory( 'ConstantsService', function(){ // no inject $scope dependency,

    'use strict';

    var constantService = [{}];

    var LIMIT_ORDER_VALUE = 2800000;

    constantService.getLimitOrderValue = function() {
        return LIMIT_ORDER_VALUE;
    };

    return constantService;

});




