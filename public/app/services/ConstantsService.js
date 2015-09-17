/**
 * Created by Adrian on 13/01/2015.
 */

farmapp.factory( 'ConstantsService', function(){ // no inject $scope dependency,

    'use strict';

    var constantService = {
        MINIMUM_ORDER_VALUE : 10000,
        LIMIT_PAYU_ORDER_VALUE : 2800000,
        LIMIT_FOR_FREE_SHIPPING : 30000,
        SHIPPING_CHARGE : 1000,
        SHOPPINGCART_CHANGED : "SHOPPINGCART_CHANGED",
        UPDATE_ORDER : "UPDATE_ORDER",
        SALE_CHANGED : "SALE_CHANGED",
        POINTS_BASE : 0.02,
        PRODUCTS_CHARGED : 'PRODUCTS_CHARGED',
        CHARGE_ALL_VF_PATHOLOGIES : 'CHARGE_ALL_VF_PATHOLOGIES',
        CHARGE_EVERY_USER_ADDRESSES : 'CHARGE_EVERY_USER_ADDRESSES',
        CHARGE_PRODUCTS_MANUALLY : 'CHARGE_PRODUCTS_MANUALLY',
        GALERIAS_GEOMETRY_LOCATION :{ lat: 4.642956, lng: -74.0734688 },// id 0
        CAMPIN_GEOMETRY_LOCATION : { lat: 4.6436076, lng: -74.0763303 },// id 1
        PORCIUNCULA_GEOMETRY_LOCATION : { lat: 4.6592169, lng: -74.0567377 },// id 2
        ANDES_GEOMETRY_LOCATION : { lat:4.6871349, lng: -74.0692006 },// id 3
        CASTELLANA_GEOMETRY_LOCATION : { lat: 4.684235, lng: -74.060316 }// id 4
    };

    return constantService;

});




