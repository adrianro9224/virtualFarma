/**
 * Created by Adrian on 17/02/2015.
 */

farmapp.controller('CheckoutPanelCtrl', ['$scope' ,'$rootScope' ,'$log' ,'$cookieStore' , function($scope ,$rootScope ,$log ,$cookieStore) {

    "use strict";

    $scope.shippingData = true;
    $scope.paymentMethod = false;
    $scope.orderSummary = false;

    $scope.shippingDataComplete = false;
    $scope.paymentMethodComplete = false;
    $scope.orderSummaryEnable = false;

    var order = $cookieStore.get('order');

    if( order != undefined ) {
        $scope.order = order;
    }else {
        $scope.order = {};
    }


    function switchCheckoutPanelSection( panelSelection ) {

        switch (panelSelection) {
            case 'shippingData':
                if(!$scope.shippingData) {
                    $scope.shippingData = true;
                    $scope.paymentMethod = false;
                    $scope.orderSummary = false;
                }
                break;
            case 'paymentMethod':
                if(!$scope.paymentMethod) {
                    $scope.paymentMethod = true;
                    $scope.shippingData = false;
                    $scope.orderSummary = false;
                }
                break;
            case 'orderSummary':
                if(!$scope.orderSummary) {
                    $scope.orderSummary = true;
                    $scope.paymentMethod = false;
                    $scope.shippingData = false;
                }
                break;
        }

    };

    $scope.openSection = function (panelSelectionName){
        switchCheckoutPanelSection( panelSelectionName )
    };

    $scope.stepCompleted = function ( checkoutFormSection, sectionName ) {
        switch ( sectionName ) {
            case "shippingData":
                $cookieStore.put('order', checkoutFormSection);
                $scope.shippingDataComplete = true;
            break;
            case "paymentMethod":
            break;
            case "orderSummary":
            break;
        }
    };

}]);