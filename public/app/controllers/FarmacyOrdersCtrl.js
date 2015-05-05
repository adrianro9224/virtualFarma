/**
 * Created by Adrian on 05/05/2015.
 */
farmapp.controller( 'FarmacyOrdersCtrl', ['$scope', '$http', function( $scope, $http ){

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

    $scope.markOrderLikeSended = function( orderId ) {

        var orderInfo = {};

        orderInfo.orderId = orderId;
        orderInfo.newOrderStatus = 'SENDED';

        var currentDate = new Date();

        orderInfo.date = currentDate.getFullYear() + '-' + currentDate.getMonth() + '-' + currentDate.getDate() + ' ' + currentDate.getHours() + ':' + currentDate.getMinutes() + ':' + currentDate.getSeconds();
        $scope.orderMarkedLikeSended = false;

        $http.post("http://virtualfarma.com.co/admin/change_order_status" , { data : orderInfo } )
            .success(function(data, status, headers, config) {
                console.info(data);

                if ( data == 'true' ) {
                    $scope.orderMarkedLikeSended = true;
                }else {
                    $scope.orderMarkedLikeSended = false;
                }


            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });
    }
}]);