/**
 * Created by adrian on 25/03/15.
 */

farmapp.controller('SalesCreatorCtrl', ['$scope', '$http', function( $scope, $http ){

    function load_products() {
        
        $http.get("http://virtualfarma.com.co/admin/all_products")
            .success(function (data, status, headers, config) {
                json = angular.fromJson(data);
                $scope.products = json;
            }).
            error(function (data, status, headers, config) {
                console.info(data + ":(");
            });

    }

    load_products();


}]);
