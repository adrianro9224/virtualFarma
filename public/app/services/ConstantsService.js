/**
 * Created by Adrian on 13/01/2015.
 */

farmapp.factory( 'ConstantsService', function(){ // no inject $scope dependency,

    'use strict';

    var constantService = [{}];

    var LIMIT_ORDER_VALUE = 2800000;
    var SHOPPINGCART_WITH_PRODUCTS = "WITH_PRODUCTS";
    var SHOPPINGCART_INITIALIZED = "SHOPPINGCART_INITIALIZED";
    var UPDATE_ORDER = "UPDATE_ORDER";

    constantService.getLimitOrderValue = function() {
        return LIMIT_ORDER_VALUE;
    };

    /**
     * @return {string}
     */
    constantService.SHOPPINGCART_WITH_PRODUCTS = function() {
        return SHOPPINGCART_WITH_PRODUCTS;
    };

    /**
     * @return {string}
     */
    constantService.SHOPPINGCART_INITIALIZED = function() {
        return SHOPPINGCART_INITIALIZED;
    };

    /**
     * @return {string}
     */
    constantService.UPDATE_ORDER = function() {
        return UPDATE_ORDER;
    };

    return constantService;

});




