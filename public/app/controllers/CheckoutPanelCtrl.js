/**
 * Created by Adrian on 17/02/2015.
 */

farmapp.controller('CheckoutPanelCtrl', ['$scope' ,'$rootScope' ,'$log' ,'$cookies' ,'ConstantsService' , function( $scope ,$rootScope ,$log ,$cookies, ConstantsService ) {

    "use strict";

    $scope.shippingData = true;
    $scope.paymentMethod = false;
    $scope.orderSummary = false;

    $scope.shippingDataComplete = false;
    $scope.paymentMethodComplete = false;
    $scope.orderSummaryEnable = false;

    var orderInCookie = $cookies.getObject("order");
    var shoppingcartInCookie = $cookies.getObject("shoppingcart");

    if( (orderInCookie != undefined) && (shoppingcartInCookie != undefined) ) {
            orderInCookie.shoppingcart = shoppingcartInCookie;
            $scope.order = orderInCookie;

            updateOrder( orderInCookie );

    }else {
        $scope.order = {};
        if ( shoppingcartInCookie != undefined )
            $scope.order.shoppingcart = shoppingcartInCookie;
        
        updateOrder( $scope.order );
    }

    $log.log($scope.order);

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

    $scope.openSection = function (panelSelectionName){
        switchCheckoutPanelSection( panelSelectionName )
    };

    $scope.stepCompleted = function ( checkoutFormSection, sectionName ) {
        switch ( sectionName ) {
            case "shippingData":
                updateOrder();

                $scope.shippingDataComplete = true;

                switchCheckoutPanelSection("paymentMethod");
            break;
            case "paymentMethod":
            break;
            case "orderSummary":
            break;
        }
    };

    function updateOrder ( order ){
        $cookies.putObject("order", order);
    }
}]);
