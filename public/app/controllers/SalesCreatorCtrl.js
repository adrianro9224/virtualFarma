/**
 * Created by adrian on 25/03/15.
 */

farmapp.controller('SalesCreatorCtrl', ['$scope', '$http', '$filter', '$cookies', 'UtilService', function( $scope, $http, $filter, $cookies, UtilService ){

    'use strict';


    $scope.shippingData = true;
    $scope.productsToSale = false;
    $scope.orderSummary = false;

    $scope.shippingDataComplete = false;
    $scope.productsToSaleComplete = false;
    $scope.orderSummaryEnable = false;

    $scope.checkoutCurrentStep = "shippingData";

    $scope.mouseover = false;

    $scope.showSubmitButtonTooltip = function() {
        $scope.mouseover = true;
    };

    $scope.hideSubmitButtonTooltip = function() {
        $scope.mouseover = false;
    };

    var todayFull = new Date();
    var todayDay = todayFull.getDate();

    todayFull.setDate( todayDay + 1 );

    var cookiesOptions = { path: "/admin" , expires: todayFull };

    var currentSaleInCookie = $cookies.getObject('sale');

    if ( currentSaleInCookie != undefined ) {
        $scope.sale = currentSaleInCookie;

        switchCheckoutPanelSection( currentSaleInCookie.currentStep );
    }

    function load_products() {
        var json;
        $http.get("http://virtualfarma.com.co/admin/all_products")
            .success(function (data, status, headers, config) {
                var json = angular.fromJson(data);

                if ( json != undefined )
                    $scope.products = json;

            }).
            error(function (data, status, headers, config) {
                console.info(data + ":(");
            });



    }

    load_products();

    $scope.search = function( searchText ) {

        if ( searchText.length > 2 ){
            var result = $filter('filter')( $scope.products, searchText, undefined);

            if ( result.length > 0 )
                $scope.results = result;
            else
                $scope.results = false;
        }else {
            $scope.results = false;
        }


    }

    $scope.putSaveAndSound = function ( sale, IsValid ) {

        if ( arguments[2] == undefined ) {
            if (sale != undefined && IsValid)
                $cookies.putObject('sale', sale, cookiesOptions);
        }else if ( arguments[2] == 1 ) {
            $cookies.putObject('sale', sale, cookiesOptions);
        }

    }

    $scope.openSection = function ( panelSelectionName ){
        switchCheckoutPanelSection( panelSelectionName )
    };

    function switchCheckoutPanelSection( panelSelection ) {

        switch (panelSelection) {
            case "shippingData":
                if(!$scope.shippingData) {
                    $scope.shippingData = true;
                    $scope.productsToSale = false;
                    $scope.orderSummary = false;
                }
                break;
            case "productsToSale":
                if(!$scope.productsToSale) {
                    $scope.productsToSale = true;
                    $scope.shippingData = false;
                    $scope.orderSummary = false;
                }
                break;
            case "orderSummary":
                if(!$scope.orderSummary) {
                    $scope.orderSummary = true;
                    $scope.productsToSale = false;
                    $scope.shippingData = false;
                }
                break;
        }

    }

    function updateOrder ( sale ){
        $cookies.putObject( "sale", sale );
    }

    $scope.stepCompleted = function ( newOrder, sectionName ) {
        switch ( sectionName ) {
            case "shippingData":
                newOrder.shippingData.status = true;
                newOrder.currentStep = "productsToSale";
                $scope.shippingDataComplete = true;

                updateOrder( newOrder );
                switchCheckoutPanelSection( newOrder.currentStep );
                break;
            case "productsToSale":
                newOrder.productsToSale.status = true;
                newOrder.currentStep = "orderSummary";
                $scope.paymentMethodComplete = true;

                updateOrder( newOrder );
                switchCheckoutPanelSection( newOrder.currentStep );
                break;
            case "orderSummary":
                $scope.sendingOrder = true;
                var order = newOrder;

                $http.post("http://virtualfarma.com.co/checkout/create_order" , { data : order} )
                    .success(function(data, status, headers, config) {
                        newOrder.sended = true;
                        $scope.sendingOrder = false;

                        $cookies.remove('shoppingcart');
                        updateOrder( newOrder );
                    }).
                    error(function(data, status, headers, config) {
                        $location.reload();
                        console.info(data + ":(");
                    });


                break;
        }
    };

    $scope.addToShoppingCart = function( producToAdd ) {

        var isNumber = UtilService.isInteger( producToAdd.cant );

        if ( isNumber ) {

            var quantity = parseInt(producToAdd.cant, 10);

            if (($scope.sale.shoppingcart == undefined || !$scope.sale.shoppingcart.haveProducts)) {

                $scope.sale.shoppingcart = {};
                $scope.sale.shoppingcart.products = [{}];
                $scope.sale.shoppingcart.subtotal = 0;
                $scope.sale.shoppingcart.shippingCharge = 0;
                $scope.sale.shoppingcart.tax = 0;
                $scope.sale.shoppingcart.total = 0;
                $scope.sale.shoppingcart.numOfproductsSubtotal = 0;
                $scope.sale.shoppingcart.numOfproductsTotal = 0;
                $scope.sale.shoppingcart.limitOrderValueInvalid = false;
                $scope.sale.shoppingcart.sended = false;

                var firtsProduct = _chargeProductObject( producToAdd );

                $scope.sale.shoppingcart.products[$scope.sale.shoppingcart.numOfproductsSubtotal] = firtsProduct;
                $scope.sale.shoppingcart.numOfproductsSubtotal++;
                $scope.sale.shoppingcart.numOfproductsTotal += quantity;
                $scope.sale.shoppingcart.haveProducts = true;

            } else {
                if (($scope.sale.shoppingcart != undefined) && ($scope.sale.shoppingcart.products != undefined)) {

                    var currentProduct = _chargeProductObject( producToAdd );

                    var products = $scope.sale.shoppingcart.products;
                    var quantityProductIncreased = false;

                    angular.forEach(products, function (product, key) {
                        if (product != undefined) {
                            if ( producToAdd.PLU == product.PLU ) {
                                quantityProductIncreased = true;
                                $scope.sale.shoppingcart.products[key].cant += quantity;
                                $scope.sale.shoppingcart.numOfproductsTotal += quantity;
                            }

                        }
                    });

                    if (!quantityProductIncreased) {
                        $scope.sale.shoppingcart.products[$scope.sale.shoppingcart.numOfproductsSubtotal] = currentProduct;
                        $scope.sale.shoppingcart.numOfproductsSubtotal++;
                        $scope.sale.shoppingcart.numOfproductsTotal += quantity;
                    }

                }
            }

            console.info($scope.sale);
            //$rootScope.$broadcast(ConstantsService.SHOPPINGCART_CHANGED, $scope.shoppingcart);
        }else {

        }

    };

    function _chargeProductObject( productToAdd ) {
        console.info(productToAdd);
        var priceUnit =  parseFloat( productToAdd.price );
        var discount = parseInt( productToAdd.discount );
        var taxUnit = parseFloat( productToAdd.tax );

        var currentProduct = new Object();

        currentProduct.PLU = productToAdd.PLU;
        currentProduct.name = productToAdd.name;
        currentProduct.barcode = productToAdd.barcode;
        currentProduct.categoryId = productToAdd.category_id;
        currentProduct.presentation = productToAdd.presentation;
        currentProduct.cant = productToAdd.cant;
        currentProduct.tax = taxUnit == 0 ? 0 : taxUnit;
        currentProduct.price = priceUnit;
        currentProduct.discount = discount == 0 ? 0 : discount;

        return currentProduct;
    }

}]);
