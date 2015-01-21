/**
 * Created by Adrian on 10/12/2014.
 */


farmapp.controller('RegisterForm', ['$scope', function($scope) {

    $scope.mouseover = false;

    $scope.showSubmitButtonTooltip = function() {
        $scope.mouseover = true;
    }

    $scope.hideSubmitButtonTooltip = function() {
        $scope.mouseover = false;
    }

}]);