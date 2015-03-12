/**
 * Created by Adrian on 09/12/2014.
 */


farmapp.controller('EditAccountForm', ['$scope' , '$log', function( $scope, $log ){

    $scope.mouseover = false;

    $scope.showSubmitButtonTooltip = function() {
        $scope.mouseover = true;
    };

    $scope.hideSubmitButtonTooltip = function() {
        $scope.mouseover = false;
    }
    
}]);