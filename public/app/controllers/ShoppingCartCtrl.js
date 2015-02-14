/**
 * Created by Adrian on 13/02/2015.
 */

farmapp.controller('ShoppingCartCtrl', ['$scope' ,'$rootScope', '$log' ,function( $scope ,$rootScope, $log ) {

    $scope.shoppingCartWithProducts = false;

    $rootScope.$on('SHOPPINGCART_INITIALIZED', function(event, data){

        $scope.shoppingCartWithProducts = true;

        $log.log(data, $scope.shoppingCartWithProducts);
    });

}]);
