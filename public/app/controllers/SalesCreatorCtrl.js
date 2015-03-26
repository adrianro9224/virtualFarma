/**
 * Created by adrian on 25/03/15.
 */

farmapp.controller('SalesCreatorCtrl', ['$scope', '$http', function( $scope, $http ){

    $scope.test = function() {
        $http.get("http://virtualfarma.com.co/admin/all_products")
            .success(function (data, status, headers, config) {
                console.log(data);
                var json = angular.fromJson(data);
                console.log(json);
                console.log(status);
                console.log(headers);
                console.log(config);
            }).
            error(function (data, status, headers, config) {

                console.info(data + ":(");
            });
    }
}]);
