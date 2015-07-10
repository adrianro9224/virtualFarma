/**
 * Created by Adrian on 16/06/2015.
 */


farmapp.controller('RequestProductCtrl', ['$scope', function( $scope ){



    $scope.showRequestProductForm = false;


    var currentDate = new Date();

    var dateFormatted = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate() + ' ' + currentDate.getHours() + ':' + currentDate.getMinutes() + ':' + currentDate.getSeconds();


    if ( dateFormatted != undefined )
        $scope.dateOfProductRequest = dateFormatted;

    console.info($scope.dateOfProductRequest);

    $scope.showForm = function () {
        $scope.showRequestProductForm = true;
    }

}]);
