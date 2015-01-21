/**
 * Created by Adrian on 01/12/2014.
 */

farmapp.controller('NotificationsCtrl', ['$scope', function($scope) {

    $scope.close = function ( errorId ){

        var errorElement = document.getElementById(errorId);
        angular.element(errorElement).addClass('hidden');

    };

}]);

