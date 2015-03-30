/**
 * Created by adrian on 25/03/15.
 */

farmapp.controller('SalesCreatorCtrl', ['$scope', '$http', '$filter', '$cookies', function( $scope, $http, $filter, $cookies ){

    'use strict';


    $scope.shippingData = true;
    $scope.paymentMethod = false;
    $scope.orderSummary = false;

    $scope.shippingDataComplete = false;
    $scope.paymentMethodComplete = false;
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

    if ( currentSaleInCookie != undefined )
        $scope.sale = currentSaleInCookie;

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
                    $scope.paymentMethod = false;
                    $scope.orderSummary = false;
                }
                break;
            case "paymentMethod":
                if(!$scope.paymentMethod) {
                    $scope.paymentMethod = true;
                    $scope.shippingData = false;
                    $scope.orderSummary = false;
                }
                break;
            case "orderSummary":
                if(!$scope.orderSummary) {
                    $scope.orderSummary = true;
                    $scope.paymentMethod = false;
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
                newOrder.currentStep = "paymentMethod";
                $scope.shippingDataComplete = true;

                updateOrder( newOrder );
                switchCheckoutPanelSection( newOrder.currentStep );
                break;
            case "paymentMethod":
                newOrder.paymentMethod.status = true;
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



}]);
