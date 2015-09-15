/**
 * Created by adrian on 25/03/15.
 */

farmapp.controller('SalesCreatorCtrl', ['$scope', '$rootScope', '$http', '$filter', '$cookies', 'UtilService', 'ConstantsService', '$location', function( $scope, $rootScope, $http, $filter, $cookies, UtilService, ConstantsService, $location ){

    'use strict';

    $scope.productsToSale = true;
    $scope.shippingData = false;
    $scope.orderSummary = false;

    $scope.productsToSaleComplete = false;
    $scope.shippingDataComplete = false;
    $scope.orderSummaryEnable = false;

    $scope.checkoutCurrentStep = "shippingData";

    var limitPayuOrderValue = ConstantsService.LIMIT_PAYU_ORDER_VALUE;
    var minimumOrderValue = ConstantsService.MINIMUM_ORDER_VALUE;
    var limitForFreeShipping = ConstantsService.LIMIT_FOR_FREE_SHIPPING;
    var pointsBase = ConstantsService.POINTS_BASE;

    var origins = [
        new google.maps.LatLng(ConstantsService.GALERIAS_GEOMETRY_LOCATION.lat, ConstantsService.GALERIAS_GEOMETRY_LOCATION.lng),
        new google.maps.LatLng(ConstantsService.CAMPIN_GEOMETRY_LOCATION.lat, ConstantsService.CAMPIN_GEOMETRY_LOCATION.lng),
        new google.maps.LatLng(ConstantsService.PORCIUNCULA_GEOMETRY_LOCATION.lat, ConstantsService.PORCIUNCULA_GEOMETRY_LOCATION.lng),
        new google.maps.LatLng(ConstantsService.ANDES_GEOMETRY_LOCATION.lat, ConstantsService.ANDES_GEOMETRY_LOCATION.lng),
        new google.maps.LatLng(ConstantsService.CASTELLANA_GEOMETRY_LOCATION.lat, ConstantsService.CASTELLANA_GEOMETRY_LOCATION.lng)
    ];

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

    var currentSaleInCookie = $cookies.getObject("sale");

    if ( currentSaleInCookie != undefined ) {
        $scope.sale = currentSaleInCookie;
        $scope.subtotal = currentSaleInCookie.shoppingcart.subtotal;
        $scope.shippingCharge = currentSaleInCookie.shoppingcart.shippingCharge;
        $scope.tax = currentSaleInCookie.shoppingcart.tax;
        $scope.total = currentSaleInCookie.shoppingcart.total;

        console.info(currentSaleInCookie);

        switchCheckoutPanelSection( currentSaleInCookie.currentStep );
    }

    function load_products() {
        var json;
        $scope.productsCharged = false;
        $http.get("http://virtualfarma.com.co/admin/all_products")
            .success(function (data, status, headers, config) {

                //  console.info(data + ":(");

                if ( json != 'NULL' ){
                    var json = angular.fromJson(data);
                    $scope.productsCharged= true;
                    $scope.products = json;
                }else {
                    console.info(data + ":(");
                }

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


    };

    $scope.putSaveAndSound = function ( sale, IsValid ) {

        if ( arguments[2] == undefined ) {

            if (sale != undefined && IsValid){
                updateOrder(sale);
            }

        }else if ( arguments[2] == 1 ) {
            updateOrder(sale);
        }

    };

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

    $scope.doNewOrder = function() {
        $cookies.remove('sale');

        window.location = "admin/admin_login";
    }

    $scope.stepCompleted = function ( newOrder, sectionName ) {
        switch ( sectionName ) {
            case "productsToSale":
                newOrder.shoppingcart.products.status = true;
                newOrder.currentStep = "shippingData";
                $scope.paymentMethodComplete = true;

                updateOrder( newOrder );
                switchCheckoutPanelSection( newOrder.currentStep );
                break;
            case "shippingData":
                newOrder.shippingData.status = true;
                newOrder.currentStep = "orderSummary";
                $scope.shippingDataComplete = true;

                updateOrder( newOrder );
                switchCheckoutPanelSection( newOrder.currentStep );
                break;

            case "orderSummary":
                $scope.sendingOrder = true;
                var order = newOrder;

                order.date = UtilService.getDateMySql();

                order.from = 'CALL_CENTER';

                order.points = order.shoppingcart.subtotal * ConstantsService.POINTS_BASE;

                $http.post("http://virtualfarma.com.co/checkout/create_order" , { data : order} )
                    .success(function(data, status, headers, config) {

                        if ( data == "true" ) {
                            newOrder.sended = true;
                            $scope.sendingOrder = false;
                            $cookies.remove('sale');
                            updateOrder( newOrder );
                        }else{
                            $scope.sendingOrder = false;
                            console.info(data);
                        }

                    }).
                    error(function(data, status, headers, config) {

                        console.info(data + ":(");
                    });


                break;
        }
    };

    $scope.addToShoppingCart = function( producToAdd ) {

        var isNumber = UtilService.isInteger( producToAdd.cant );

        if ( isNumber ) {

            var quantity = parseInt(producToAdd.cant, 10);

            if (($scope.sale == undefined || !$scope.sale.shoppingcart.haveProducts)) {

                $scope.sale = {};
                $scope.sale.paymentMethod = {};
                $scope.sale.paymentMethod.selectedPaymentMethod = 1;
                $scope.sale.shoppingcart = {};
                $scope.sale.shoppingcart.manual = false;
                $scope.sale.shoppingcart.products = [{}];
                $scope.sale.shoppingcart.subtotal = 0;
                $scope.sale.shoppingcart.shippingCharge = 0;
                $scope.sale.shoppingcart.tax = 0;
                $scope.sale.shoppingcart.total = 0;
                $scope.sale.shoppingcart.numOfproductsSubtotal = 0;
                $scope.sale.shoppingcart.numOfproductsTotal = 0;
                $scope.sale.shoppingcart.limitOrderValueInvalid = false;
                $scope.sale.shoppingcart.minimumOrderValueInvalid = false;
                $scope.sale.shoppingcart.hasDiscount = false;
                $scope.sale.shoppingcart.pointsBase = ( pointsBase != undefined ) ? pointsBase : ConstantsService.POINTS_BASE;
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
            $rootScope.$broadcast(ConstantsService.SALE_CHANGED, $scope.sale);
        }else {

        }

    };

    function _chargeProductObject( productToAdd ) {
        console.info(productToAdd);
        var priceUnit =  parseFloat( productToAdd.price );
        var discount = productToAdd.discount == null ? 0 : parseInt( productToAdd.discount );
        var taxUnit = productToAdd.tax == null ? 0 : parseFloat( productToAdd.tax );

        var currentProduct = new Object();

        currentProduct.PLU = (productToAdd.PLU == undefined) ? 123456 : productToAdd.PLU;
        currentProduct.name = productToAdd.name;
        currentProduct.barcode = ( productToAdd.barcode == undefined) ? 123456789 : productToAdd.barcode;
        currentProduct.categoryId = ( productToAdd.category_id == undefined ) ? 123456789 : productToAdd.category_id;
        currentProduct.presentation = productToAdd.presentation;
        currentProduct.cant = productToAdd.cant;
        currentProduct.tax = taxUnit == 0 ? 0 : taxUnit;
        currentProduct.price = priceUnit;
        currentProduct.discount = discount == 0 ? 0 : discount;

        return currentProduct;
    }

    $rootScope.$on( ConstantsService.SALE_CHANGED, function(event, data){
        $scope.sale = data;

        var shoppingCartSubtotals;

        shoppingCartSubtotals = calculateShoppingcartSubtotals( $scope.sale.shoppingcart.products );

        $scope.sale.shoppingcart.subtotal = shoppingCartSubtotals.productsSubtotal;
        $scope.sale.shoppingcart.tax = shoppingCartSubtotals.productsTaxTotal;

        var auxSubtotal = $scope.sale.shoppingcart.subtotal;

        if ( $scope.sale.shoppingcart.hasDiscount ) {
            $scope.sale.shoppingcart.subtotal -= $scope.sale.shoppingcart.pointsDoDiscount;

            auxSubtotal += $scope.sale.shoppingcart.pointsDoDiscount;
        }

        var shippingCharge = getShippingCharge(auxSubtotal);

        $scope.sale.shoppingcart.shippingCharge = shippingCharge;

        if( angular.isString( shippingCharge ) ) {
            $scope.sale.shoppingcart.total = $scope.sale.shoppingcart.subtotal;
            $scope.sale.shoppingcart.shippingFree = true;
        }else {
            $scope.sale.shoppingcart.total = $scope.sale.shoppingcart.subtotal + $scope.sale.shoppingcart.shippingCharge;
            $scope.sale.shoppingcart.shippingFree = false;
        }


        $scope.shippingCharge = $scope.sale.shoppingcart.shippingCharge;
        $scope.subtotal = $scope.sale.shoppingcart.subtotal;


        if (minimumOrderValue != undefined) {

            $scope.sale.shoppingcart.minimumOrderValue = minimumOrderValue;

            if ($scope.sale.shoppingcart.subtotal < minimumOrderValue)
                $scope.sale.shoppingcart.minimumOrderValueInvalid = true;
            else
                $scope.sale.shoppingcart.minimumOrderValueInvalid = false;

        }


        if( limitPayuOrderValue != undefined ) {
            if( $scope.sale.shoppingcart.total > limitPayuOrderValue )
                $scope.sale.shoppingcart.limitOrderValueInvalid = true;
        }

        if ( limitForFreeShipping != undefined )
            $scope.sale.shoppingcart.limitForFreeShipping = limitForFreeShipping;

        $scope.total = $scope.sale.shoppingcart.total;

        $cookies.putObject('sale', $scope.sale, cookiesOptions);


    });


    function getShippingCharge ( subtotal ) {

        var shippingCharge;

        if ( subtotal >= ConstantsService.LIMIT_FOR_FREE_SHIPPING )
            shippingCharge = "Sin costo";
        else
            shippingCharge = ConstantsService.SHIPPING_CHARGE;

        return shippingCharge;
    }

    function calculateShoppingcartSubtotals( products ) {

        var subtotal = 0;
        var tax = 0;

        angular.forEach( products, function(value ,key) {
            subtotal += ( value.price * value.cant );
            tax += ( value.tax * value.price );
        });

        var shoppingCartSubtotals = { productsSubtotal : subtotal,  productsTaxTotal : tax };

        return shoppingCartSubtotals;
    }

    $scope.removeProduct = function ( key ) {

        if ( $scope.sale.shoppingcart.products[key].cant > 1 ) {
            $scope.sale.shoppingcart.products[key].cant--;
            $scope.sale.shoppingcart.numOfproductsTotal--;
        }else {
            $scope.sale.shoppingcart.products.splice( key, 1 );
            $scope.sale.shoppingcart.numOfproductsTotal--;
            $scope.sale.shoppingcart.numOfproductsSubtotal--;
        }

        if ( $scope.sale.shoppingcart.numOfproductsTotal == 0 ){
            $scope.sale.shoppingcart.haveProducts = false;

        }

        $rootScope.$broadcast( ConstantsService.SALE_CHANGED, $scope.sale );

    };

    /**
     *  Update the every shoppingcart values
     * @param param0 the key of a product to change
     * @param param1 the type of change ('increase', 'decrease', 'delete') or default
     */
    $scope.recalculateTotals = function () {
        //var regex = /\./;

        if( (arguments != undefined) ) {
            switch ( arguments[1] ) {

                case 'decrease':
                    decreaseShoppingCart( arguments[0] );
                    break;
                case 'increase':
                    increaseShoppingCart( arguments[0] );
                    break;
                case 'delete':
                    deleteShoppingCartProduct( arguments[0] );
                    break;
                default:
                    if( !(angular.isNumber( $scope.sale.shoppingcart.products[ arguments[0] ].cant )) || ($scope.sale.shoppingcart.products[ arguments[0] ].cant < 1) )
                        $scope.sale.shoppingcart.products[ arguments[0] ].cant = 1;
            }

            if ($scope.sale.shoppingcart.numOfproductsTotal == 0)
                $scope.sale.shoppingcart.haveProducts = false;
        }

        $rootScope.$broadcast( ConstantsService.SALE_CHANGED, $scope.sale );
    };


    function decreaseShoppingCart( key ) {

        if ( $scope.sale.shoppingcart.products[key].cant > 1 ) {
            $scope.sale.shoppingcart.products[key].cant--;
            $scope.sale.shoppingcart.numOfproductsTotal--;
        }

    }

    function increaseShoppingCart( key ) {

        $scope.sale.shoppingcart.products[key].cant++;
        $scope.sale.shoppingcart.numOfproductsTotal++;

    }

    function deleteShoppingCartProduct( key ){

        $scope.sale.shoppingcart.products.splice( key, 1 );
        $scope.sale.shoppingcart.numOfproductsTotal--;
        $scope.sale.shoppingcart.numOfproductsSubtotal--;
    }

    $scope.reedemPoints = function( Points ) {


        console.info( Points );

        var PointsInt = parseInt(Points);

        var residue = PointsInt % 100;

        var pointsToUse = PointsInt - residue;

        if ( $scope.sale.shoppingcart.hasDiscount ) {

            $scope.sale.shoppingcart.hasDiscount = false;
            $scope.sale.shoppingcart.subtotal += pointsToUse;

        }else {
            $scope.sale.shoppingcart.pointsDoDiscount = pointsToUse;
            $scope.sale.shoppingcart.hasDiscount = true;
        }

        $rootScope.$broadcast( ConstantsService.SALE_CHANGED, $scope.sale );
    }

    $scope.DoGeoCoding = function( addressToGeoencoding) {


        $http.get("http://maps.googleapis.com/maps/api/geocode/json?address=" + addressToGeoencoding )
            .success(function(data, status, headers, config) {

                if ( data.status == "OK" ) {
                    //console.info(data.results[0].geometry.location);
                    var destination = {lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng};
                    calculateDistances( destination );
                    renderMap( data.results[0].geometry.location.lat, data.results[0].geometry.location.lng );
                }

            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });

    }

    function renderMap ( addressLat, addressLng ) {
        var map;
        function initialize() {
            map = new google.maps.Map(document.getElementById('my-map'), {
                zoom: 16,
                center: {lat: addressLat, lng: addressLng}
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize());
    }

    function calculateDistances ( destination ) {

        var destinationLatLng = new google.maps.LatLng( destination.lat, destination.lng );

        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
            {
                origins: origins,
                destinations: [destinationLatLng],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                durationInTraffic: true,
                avoidHighways: true,
                avoidTolls: true
            }, searchMoreNearby);

        function searchMoreNearby(response, status) {

            if (status === "OK") {

                console.info(response.rows);

                var values = getValues( response.rows );

                Array.prototype.max = function() {
                    return Math.max.apply(null, this);
                };

                Array.prototype.min = function() {
                    return Math.min.apply(null, this);
                };

                var min = values.min();
                var minKey = undefined;

                angular.forEach( response.rows, function(value ,key) {

                    if( value.elements[0].status === "OK"){

                        if ( value.elements[0].distance.value == min )
                            minKey = key;

                    }
                });

                //console.info(minKey + ' ' + min);

                $scope.sale.shippingData.FarmacyNearbyId = minKey;

                updateOrder($scope.sale);

            }

        }

        function getValues( rows ) {

            var result = [];

            angular.forEach( rows, function(value ,key) {

                if ( value.elements[0].status === "OK" ) {
                    result[key] = value.elements[0].distance.value;
                }

            });

            return result;
        }



/*
        var lats = origin.lat - destination.lat;
        var lngs = origin.lng - destination.lng;

        var latm = lats *60 * 1852;
        var lngm = (lngs * Math.cos(origin.lat * Math.PI / 180)) * 60 * 1852;

        var distInMeters = Math.sqrt(Math.pow(latm, 2) + Math.pow(lngm, 2));*/

        /*
        var r = 6378.7;// radio de la tierra
        var d = r * Math.acos(Math.sin(origin.lat) * Math.sin(destination.lat) + Math.cos(origin.lat) * Math.cos(destination.lat) * Math.cos(destination.lng - origin.lng));*/

        //console.info(distInMeters);

    }




}]);