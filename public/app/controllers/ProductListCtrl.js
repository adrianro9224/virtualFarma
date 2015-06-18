/**
 * Created by Adrian on 12/02/2015.
 */

farmapp.controller( 'ProductListCtrl', ['$scope' ,'$log' ,'$rootScope' ,'$cookies' ,'ConstantsService', 'UtilService', '$timeout', '$document', function( $scope ,$log ,$rootScope ,$cookies, ConstantsService, UtilService, $timeout, $document ){

    'use strict';

    var shoppingCartInCookie = $cookies.getObject( 'shoppingcart' );

    if( shoppingCartInCookie != undefined )
        $scope.shoppingcart = shoppingCartInCookie;


    $scope.addToShoppingCart = function( productId, name, PLU, barcode, categoryId, presentation, cant, price, discount, tax ) {

        var isNumber = UtilService.isInteger( cant );

        if ( isNumber ) {

            var quantity = parseInt(cant, 10);

            if (($scope.shoppingcart == undefined || !$scope.shoppingcart.haveProducts)) {

                $scope.shoppingcart = {};
                $scope.shoppingcart.products = [{}];
                $scope.shoppingcart.subtotal = 0;
                $scope.shoppingcart.shippingCharge = 0;
                $scope.shoppingcart.tax = 0;
                $scope.shoppingcart.total = 0;
                $scope.shoppingcart.numOfproductsSubtotal = 0;
                $scope.shoppingcart.numOfproductsTotal = 0;
                $scope.shoppingcart.limitOrderValueInvalid = false;
                $scope.shoppingcart.minimumOrderValueInvalid = false;
                $scope.shoppingcart.hasDiscount = false;
                $scope.shoppingcart.sended = false;

                var firtsProduct = _chargeProductObject(productId, name, PLU, barcode, categoryId, presentation, quantity, price, discount, tax);

                $scope.shoppingcart.products[$scope.shoppingcart.numOfproductsSubtotal] = firtsProduct;
                $scope.shoppingcart.numOfproductsSubtotal++;
                $scope.shoppingcart.numOfproductsTotal += quantity;
                $scope.shoppingcart.haveProducts = true;

            } else {
                if (($scope.shoppingcart != undefined) && ($scope.shoppingcart.products != undefined)) {

                    var currentProduct = _chargeProductObject(productId, name, PLU, barcode, categoryId, presentation, quantity, price, discount, tax);

                    var products = $scope.shoppingcart.products;
                    var quantityProductIncreased = false;

                    angular.forEach(products, function (product, key) {
                        if (product != undefined) {
                            if ((productId == product.id) && (PLU == product.PLU)) {
                                quantityProductIncreased = true;
                                $scope.shoppingcart.products[key].cant += quantity;
                                $scope.shoppingcart.numOfproductsTotal += quantity;
                            }

                        }
                    });

                    if (!quantityProductIncreased) {
                        $scope.shoppingcart.products[$scope.shoppingcart.numOfproductsSubtotal] = currentProduct;
                        $scope.shoppingcart.numOfproductsSubtotal++;
                        $scope.shoppingcart.numOfproductsTotal += quantity;
                    }

                }
            }

            $rootScope.$broadcast(ConstantsService.SHOPPINGCART_CHANGED, $scope.shoppingcart);
        }else {

        }

    };

    function _chargeProductObject( productId, name, PLU, barcode, categoryId, presentation, cant, price, discount, tax ) {

        var priceUnit =  parseFloat( price );
        var discount = parseInt( discount );
        var taxUnit = parseFloat( tax );

        var currentProduct = new Object();

        currentProduct.id = productId;
        currentProduct.PLU = PLU;
        currentProduct.name = name;
        currentProduct.barcode = barcode;
        currentProduct.categoryId = categoryId;
        currentProduct.presentation = presentation;
        currentProduct.cant = cant;
        currentProduct.tax = taxUnit == 0 ? 0 : taxUnit;
        currentProduct.price = priceUnit;
        currentProduct.discount = discount == 0 ? 0 : discount;

        return currentProduct;
    }

    angular.element(document).ready(function() {
        //charge_products();
    });

    function charge_products() {

        var productsEncoded = $scope.productsEncoded;

        if ( productsEncoded != undefined ) {
            var productsJSON = productsEncoded.replace(/cInit/g, "[").replace(/llInit/g, "{").replace(/llEnd/g, "}").replace(/coInit/g, ",").replace(/cEnd/g, "]").replace(/cDInit/g, "\"").replace(/dPoS/g, ":");

            var productsDecoded = angular.fromJson(productsJSON);

            $scope.productsDecoded = productsDecoded;

            //$emit('');
        }
        //angular.element(document).controller('ngModel').$render();
        $log.info( $scope.productsDecoded );

    }




}]);
