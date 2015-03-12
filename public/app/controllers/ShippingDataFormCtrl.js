/**
 * Created by Adrian on 18/02/2015.
 */

farmapp.controller('ShippingDataFormCtrl', ['$scope' , function($scope){

    $scope.mouseover = false;

    $scope.showSubmitButtonTooltip = function() {
        $scope.mouseover = true;
    };

    $scope.hideSubmitButtonTooltip = function() {
        $scope.mouseover = false;
    }


}]);
