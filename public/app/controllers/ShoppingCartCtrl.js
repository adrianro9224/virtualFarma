/**
 * Created by Adrian on 13/02/2015.
 */

farmapp.controller('ShoppingCartCtrl' ,['$scope', '$rootScope', '$log', '$cookieStore', '$http', '$window', 'ConstantsService', '$location', '$anchorScroll' ,function( $scope, $rootScope, $log, $cookieStore, $http, $window, ConstantsService, $location, $anchorScroll, $locationProvider ) {

    'use strict';

    $scope.shoppingCartWithProducts = false;

    $scope.subtotal = 0;
    $scope.shippingCharge = "Gratis";
    $scope.tax = 0;
    $scope.total = 0;
    $scope.limitOrderValueInvalid = false;

    $scope.shoppingcart = undefined;

    var constantService = ConstantsService;

    var limitOrderValue = constantService.getLimitOrderValue();

    if( limitOrderValue != undefined )
        $scope.limitOrderValue = limitOrderValue;




    $rootScope.$on('SHOPPINGCART_INITIALIZED', function(event, data){
        $scope.shoppingcart = data;

        if($scope.shoppingcart.status == 'WITH_PRODUCTS') {

            $scope.shoppingCartWithProducts = true;
            $scope.shoppingcart.subtotal = calculateSubtotal($scope.shoppingcart.products);

            $scope.subtotal = $scope.shoppingcart.subtotal;

            $scope.shoppingcart.total = $scope.shoppingcart.subtotal + $scope.shoppingcart.tax;

            if( $scope.limitOrderValue != undefined ) {
                if( $scope.shoppingcart.total > $scope.limitOrderValue ){
                    $scope.limitOrderValueInvalid = true;
                    $scope.shoppingcart.limitOrderValueInvalid = true;

                    $location.hash('button-payment'); $anchorScroll();
                }
            }

            $scope.total = $scope.shoppingcart.total;

            $cookieStore.put('shoppingcart', $scope.shoppingcart);

        }

    });

    var shoppingCartInCookie = $cookieStore.get('shoppingcart');

    if( shoppingCartInCookie != undefined ) {

        $scope.shoppingCartWithProducts = true;

        $scope.shoppingcart = shoppingCartInCookie;
        $scope.subtotal = $scope.shoppingcart.subtotal;
        $scope.tax = $scope.shoppingcart.tax;
        $scope.total = $scope.shoppingcart.total;
        $scope.limitOrderValueInvalid = $scope.shoppingcart.limitOrderValueInvalid;
    }

    function calculateSubtotal( products ) {
        var subtotal = 0;

        angular.forEach( products, function(value ,key) {
                subtotal += value.price * value.cant;
        });

        return subtotal;
    }

    $scope.createShoppingcartToken = function ( shoppingCart ) {
        var obj = shoppingCart;

        $http.post("http://virtualfarma.com.co/checkout/save_spc" , {"data" : obj} )
            .success(function(data, status, headers, config) {

                window.location ="/checkout";

            }).
            error(function(data, status, headers, config) {
                console.info(data + ":(");
            });

    };


}]);
