/**
 * Created by Adrian on 16/12/2014.
 */

farmapp.controller('LogInForm', ['$scope', function($scope) {

    $scope.mouseover = false;

    $scope.showSubmitButtonTooltip = function() {
        $scope.mouseover = true;
    }

    $scope.hideSubmitButtonTooltip = function() {
        $scope.mouseover = false;
    }

}]);
