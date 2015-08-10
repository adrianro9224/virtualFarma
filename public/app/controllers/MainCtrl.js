    /**
 * Created by Adrian on 23/04/2015.
 */

farmapp.controller('MainCtrl', ['$scope' ,'$rootScope', 'ConstantsService', function( $scope, $rootScope, ConstantsService ){



    $scope.changeToOrderManualMode = function () {

        var checked = arguments[0];

        $scope.orderManual = checked;

    };


/*
    $scope.search = function( searchText ) {

        if (searchText != undefined) {

            if (searchText.length > 2) {
                var result = $filter('filter')($scope.products, searchText, undefined);

                if (result.length > 0)
                    $scope.results = result;
                else
                    $scope.results = false;
            } else {
                $scope.results = false;
            }
        }


    };

    function load_products() {
        var json = undefined;
        $scope.productsCharged= false;

        $http.get("http://virtualfarma.com.co/product/all_products")
            .success(function (data, status, headers, config) {
                var json = angular.fromJson(data);

                if ( json != 'NULL' ){
                    $scope.productsCharged= true;
                    $scope.products = json;
                }


            }).
            error(function (data, status, headers, config) {
                console.info(data + ":(");
            });



    }

    load_products();
*/
}]);
