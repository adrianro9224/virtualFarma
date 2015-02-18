/**
 * Created by Adrian on 12/02/2015.
 */

farmapp.controller('ProductListCtrl', ['$scope' ,'$log' ,'$rootScope' ,'$cookieStore' ,function( $scope ,$log ,$rootScope ,$cookieStore ){

    'use strict';

    var shoppingCartInCookie = $cookieStore.get('shoppingcart');

    if( shoppingCartInCookie != undefined ) {
        $scope.shoppingcart = shoppingCartInCookie;
    }


    $scope.addToShoppingCart = function(productId ,PLU ,barcode ,categoryId ,presentation ,cant ,price) {


        var quantity = parseInt(cant ,10);
        var priceUnit =  parseFloat( price );

        if( ($scope.shoppingcart == undefined) ) {

            $scope.shoppingcart = {};
            $scope.shoppingcart.products = [{}];
            $scope.shoppingcart.subtotal = 0;
            $scope.shoppingcart.shippingCharge = 0;
            $scope.shoppingcart.tax = 0;
            $scope.shoppingcart.total = 0;
            $scope.shoppingcart.numOfproductsSubtotal = 0;
            $scope.shoppingcart.numOfproductsTotal = 0;

            var product = new Object();

            product.id = productId;
            product.PLU = PLU;
            product.barcode = barcode;
            product.categoryId = categoryId;
            product.presentation = presentation;
            product.cant = quantity;
            product.price = priceUnit;

            $scope.shoppingcart.products[$scope.shoppingcart.numOfproductsSubtotal] = product;
            $scope.shoppingcart.numOfproductsSubtotal++;
            $scope.shoppingcart.numOfproductsTotal++;
            $scope.shoppingcart.status = 'WITH_PRODUCTS';

        } else {
            if ( ($scope.shoppingcart != undefined) && ($scope.shoppingcart.products != undefined) ) {

                var currentProduct = new Object();


                currentProduct.id = productId;
                currentProduct.PLU = PLU;
                currentProduct.barcode = barcode;
                currentProduct.categoryId = categoryId;
                currentProduct.presentation = presentation;
                currentProduct.cant = quantity;
                currentProduct.price = priceUnit;

                var products = $scope.shoppingcart.products;


                angular.forEach( products, function( product ,key ) {
                    if(product != undefined ){
                        if( (productId == product.id) && (PLU == product.PLU) ) {
                            $scope.shoppingcart.products[key].cant += quantity;
                            $scope.shoppingcart.numOfproductsTotal += quantity;
                        }else {
                            $scope.shoppingcart.products[$scope.shoppingcart.numOfproductsSubtotal] = currentProduct;
                            $scope.shoppingcart.numOfproductsSubtotal++;
                            $scope.shoppingcart.numOfproductsTotal++;
                        }
                    }
                });

            }
        }

        $rootScope.$broadcast('SHOPPINGCART_INITIALIZED', $scope.shoppingcart);

    }

}]);
