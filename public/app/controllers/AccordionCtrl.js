/**
 * Created by Adrian on 29/11/2014.
 */

farmapp.controller('AccordionCtrl', ['$scope', function($scope) {

    $scope.oneAtATime = true;

    $scope.status = {
        isFirstOpen: true,
        isFirstDisabled: false
    };
}]);