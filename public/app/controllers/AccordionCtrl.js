/**
 * Created by Adrian on 29/11/2014.
 */

farmapp.controller('AccordionCtrl', ['$scope', function($scope) {

    $scope.oneAtATime = true;

    $scope.groups = [
        {
            title: 'Dynamic Group Header - 1',
            content: 'Dynamic Group Body - 1'
        },
        {
            title: 'Dynamic Group Header - 2',
            content: 'Dynamic Group Body - 2'
        }
    ];

    $scope.items = ['Item 1', 'Item 2', 'Item 3'];

    $scope.status = {
        isFirstOpen: true,
        isFirstDisabled: false
    };
}]);