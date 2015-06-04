/**
 * Created by Adrian on 29/05/2015.
 */

farmapp.controller('ShoppingCartAxuCtrl', ['$scope', '$window', '$log', function( $scope, $window, $log ){

    $scope.show = false;

    $scope.showShoppingCartAux = function() {


        if ( $scope.show ){
            $scope.show = false;
            $log.info('1');
        }else {
            $scope.show = true;
            $log.info('2');
        }


    }

}]);