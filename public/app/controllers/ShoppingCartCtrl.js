/**
 * Created by Adrian on 13/02/2015.
 */

farmapp.controller('ShoppingCartCtrl', ['$scope' ,'$rootScope', '$log' ,'$cookies' ,'$http' ,'$window', 'ConstantsService' ,function( $scope ,$rootScope, $log ,$cookies ,$http ,$window, ConstantsService) {

    'use strict';

    $scope.shoppingCartWithProducts = false;

    var todayFull = new Date();
    var todayDay = todayFull.getDate();

    todayFull.setDate( todayDay + 3 );

    var cookiesOptions = { path: "/" , expires: todayFull };

    $scope.subtotal = 0;
    $scope.shippingCharge = 600;
    $scope.tax = 0;
    $scope.total = 0;
    $scope.limitOrderValueInvalid = false;
    $scope.limitOrderValue = ConstantsService.getLimitOrderValue();

    $rootScope.$on( ConstantsService.SHOPPINGCART_INITIALIZED, function(event, data){
        $scope.shoppingcart = data;

        if ( $scope.shoppingcart.status == ConstantsService.SHOPPINGCART_WITH_PRODUCTS ) {

            $scope.shoppingCartWithProducts = true;
            $scope.shoppingcart.subtotal = calculateSubtotal($scope.shoppingcart.products);

            $scope.subtotal = $scope.shoppingcart.subtotal;

            $scope.shoppingcart.total = $scope.shoppingcart.subtotal + $scope.shoppingcart.tax + $scope.shippingCharge;

            if( $scope.limitOrderValue != undefined ) {
                if( $scope.shoppingcart.total > $scope.limitOrderValue ){
                    $scope.limitOrderValueInvalid = true;
                    $scope.shoppingcart.limitOrderValueInvalid = true;
                }
            }

            $scope.total = $scope.shoppingcart.total;

            $cookies.putObject('shoppingcart', $scope.shoppingcart, cookiesOptions);

        }

    });

    var shoppingCartInCookie = $cookies.getObject( 'shoppingcart' );

    if( shoppingCartInCookie != undefined ) {

        $scope.shoppingCartWithProducts = true;

        $scope.shoppingcart = shoppingCartInCookie;
        $scope.subtotal = $scope.shoppingcart.subtotal;
        $scope.tax = $scope.shoppingcart.tax;
        $scope.total = $scope.shoppingcart.total;

        if($scope.total > $scope.limitOrderValue )
            $scope.limitOrderValueInvalid = true;


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
