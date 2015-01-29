/**
 * Created by Adrian on 26/01/2015.
 */

farmapp.controller('MyDiagnosticCtrl' , ['$scope', function( $scope ){

    $scope.showPhatologyDescription = function( pathologyDescriptionId) {

        var el  = document.getElementById( pathologyDescriptionId );

        angular.element(el).removeClass("hidden");
    }

    $scope.closePhatologyDescription = function( pathologyDescriptionId) {

        var el  = document.getElementById( pathologyDescriptionId );

        angular.element(el).addClass("hidden");
    }


}]);