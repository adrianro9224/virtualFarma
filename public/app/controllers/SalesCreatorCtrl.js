/**
 * Created by adrian on 25/03/15.
 */

farmapp.controller('SalesCreatorCtrl', ['$scope', '$http', '$filter', function( $scope, $http, $filter ){

    $scope.noResults = false;

    function load_products() {
        var json;
        $http.get("http://virtualfarma.com.co/admin/all_products")
            .success(function (data, status, headers, config) {
                var json = angular.fromJson(data);

                if ( json != undefined )
                    $scope.products = json;

            }).
            error(function (data, status, headers, config) {
                console.info(data + ":(");
            });



    }

    load_products();

    $scope.search = function( searchText ) {

        if ( searchText.length > 2){
            var result = $filter('filter')( $scope.products, searchText, undefined)

            if ( result.length > 0 )
                $scope.results = result;
            else
                $scope.noResults = true;
        }

    }


}]);
