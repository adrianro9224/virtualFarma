/**
 * Created by Adrian on 13/01/2015.
 */

farmapp.factory( 'ConstantsService', function(){ // no inject $scope dependency,

    'use strict';

    var constantService = {
        LIMIT_PAYU_ORDER_VALUE : 2800000,
        LIMIT_FOR_FREE_SHIPPING : 50000,
        SHIPPING_CHARGE : 700,
        SHOPPINGCART_CHANGED : "SHOPPINGCART_CHANGED",
        UPDATE_ORDER : "UPDATE_ORDER"
    };

    return constantService;

});




