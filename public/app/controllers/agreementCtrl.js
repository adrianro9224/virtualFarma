/**
 * Created by Adrian on 14/10/2015.
 */

farmapp.controller('agreementCtrl', ['$scope', '$http', '$cookies', '$window', '$timeout', function( $scope, $http, $cookies, $window, $timeout ){

    "use strict";

    $scope.sendCodeToUse = function( codeToUse ) {
        console.log( "code to use is: " + codeToUse );

        var shoppingCartInCookie = $cookies.getObject( 'shoppingcart' );

        console.info(shoppingCartInCookie);

        var post = {};

        post.code = codeToUse;
        post.productIds = getProductsIds( shoppingCartInCookie.products );

        console.log("info do post:");
        console.info(post);

        $http.post("http://virtualfarma.com.co/agreement/use_agreement_code", post )
            .success(function(data, status, headers, config) {

                console.info(data);

                var result = angular.fromJson( data );

                switch ( result.status ) {
                    case 'CODE_NOT_FOUND':
                        console.log("Agreement not found");
                        break;
                    case 'ENCODING_ERROR':
                        console.log("Encoding error : " + data.data);
                        $window.location.reload();
                        break;

                }


            }).
            error(function(data, status, headers, config) {

                console.info(data + ":(");
            });
    }

    function getProductsIds( products ) {

        var ids = [], i = 0;

        angular.forEach( products, function( value, key ){

            ids[i] = value.id;
            i++;

        });

        return ids;
    }

}]);
