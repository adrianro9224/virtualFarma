/**
 * Created by Adrian on 05/05/2015.
 */
farmapp.controller( 'FarmacyOrdersCtrl', ['$scope', '$http', '$window', 'UtilService', '$timeout', '$cookies', function( $scope, $http, $window, UtilService, $timeout, $cookies ){

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
                    doIt();
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

    angular.element(document).ready(function () {

        if ( $scope.numOfordersWithoutSend > 0 )
            initAlert();

        check_if_new_orders();

    });


    function initAlert() {
        $timeout( playSound, 1000);
    }

    function playSound() {
        var sound = document.getElementById("newOrderAlert");

        sound.play();

        if( !$scope.seeingStatusCheckbox )
            $timeout( playSound, 1000);
    }

    function check_if_new_orders() {
        $timeout( reload , 60000 );
    }

    function reload (){
        $window.location.reload();
    }

    $scope.changeSeeingStatus = doIt();


    function doIt(){

        if ( $scope.seeingStatusCheckbox )
            $scope.seeingStatusCheckbox = false;
        else
            $scope.seeingStatusCheckbox = true;
    }

}]);