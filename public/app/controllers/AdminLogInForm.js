/**
 * Created by Adrian on 18/03/2015.
 */

farmapp.controller('AdminLogInForm', ['$scope' , function( $scope ){

    $scope.mouseover = false;

    $scope.showSubmitButtonTooltip = function() {
        $scope.mouseover = true;
    };

    $scope.hideSubmitButtonTooltip = function() {
        $scope.mouseover = false;
    }

}]);
