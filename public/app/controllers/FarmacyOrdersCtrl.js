/**
 * Created by Adrian on 05/05/2015.
 */
farmapp.controller( 'FarmacyOrdersCtrl', ['$scope', '$http', '$window', 'UtilService', function( $scope, $http, $window, UtilService ){

    'use strict';

    $scope.identifyOrderPanel = function( orderId ) {

        var el = document.getElementById( "order_" + orderId );

        var iNowIt = angular.element(el).hasClass('identify');

        if ( iNowIt ) {
            angular.element(el).removeClass("identify");
        }else {
            angular.element(el).addClass("identify");
        }

    };


    $scope.openOrderDetails = function ( orderId ) {

        removeClassHiddenToOrderBox( orderId );

    };

    $scope.closeOrderDetails = function ( orderId ) {

        addClassHiddenToOrderBox( orderId );

    };

    function addClassHiddenToOrderBox( orderId ) {

        var el = document.getElementById( "order_" + orderId );
        angular.element(el).addClass("hidden");
    }

    function removeClassHiddenToOrderBox( orderId ) {

        var el = document.getElementById( "order_" + orderId );
        angular.element(el).removeClass("hidden");

    }

    $scope.markOrderLikeDeclined = function( orderId ) {

        var orderInfo = {};

        orderInfo.orderId = orderId;
        orderInfo.newOrderStatus = 'DECLINED';

        orderInfo.date = UtilService.getDateMySql();
        $scope.UpdatingOrderToSended = true;

        $http.post("http://virtualfarma.com.co/admin/change_order_status" , { data : orderInfo } )
            .success(function(data, status, headers, config) {
                console.info(data);

                if ( data == 'true' ) {
                    $scope.UpdatingOrderToSended = false;
                    $window.location.reload();
                }else {
                    $scope.UpdatingOrderToSended = false;
                }


            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });

    };

    $scope.markOrderLikeSended = function( orderId ) {

        var orderInfo = {};

        orderInfo.orderId = orderId;
        orderInfo.newOrderStatus = 'SENDED';

        orderInfo.date = UtilService.getDateMySql();
        $scope.UpdatingOrderToSended = true;

        $http.post("http://virtualfarma.com.co/admin/change_order_status" , { data : orderInfo } )
            .success(function(data, status, headers, config) {
                console.info(data);

                if ( data == 'true' ) {
                    $scope.UpdatingOrderToSended = false;
                    $window.location.reload();
                }else {
                    $scope.UpdatingOrderToSended = false;
                }


            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });
    }
}]);