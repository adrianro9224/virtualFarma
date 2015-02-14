/**
 * Created by Adrian on 12/02/2015.
 */

farmapp.controller('ProductListCtrl', ['$scope' ,'$log' ,'$rootScope' , function( $scope ,$log ,$rootScope ){

    'use strict';

    $scope.addToShoppingCart = function(productId ,PLU ,barcode ,categoryId ,presentation ,cant ,price) {

        if( ($scope.shoppingcart == undefined) ) {
            $log.log("1");
            $scope.shoppingcart = {};
            $scope.shoppingcart.products = [{}];

            var product = new Object();

            product.id = productId;
            product.PLU = PLU;
            product.barcode = barcode;
            product.categoryId = categoryId;
            product.presentation = presentation;
            product.cant = cant;
            product.price = price;

            $scope.shoppingcart.products[product.id] = product;
            $scope.shoppingcart.status = 'WITH_PRODUCTS';

            $log.log($scope.shoppingcart.products);//log

            $rootScope.$broadcast('SHOPPINGCART_INITIALIZED', $scope.shoppingcart);

        } else {
            if ( ($scope.shoppingcart != undefined) && ($scope.shoppingcart.products != undefined) ) {
                $log.log("2");
                var currentProduct = new Object();

                currentProduct.id = productId;
                currentProduct.PLU = PLU;
                currentProduct.barcode = barcode;
                currentProduct.categoryId = categoryId;
                currentProduct.presentation = presentation;
                currentProduct.cant = cant;
                currentProduct.price = price;

                $scope.shoppingcart.products[currentProduct.id] = currentProduct;
                $log.log($scope.shoppingcart.products);//log
            }
        }


    }
}]);
