/**
 * Created by Adrian on 14/10/2015.
 */

farmapp.controller('agreementCtrl', ['$scope', '$http', '$cookies', '$window', '$timeout', '$rootScope', 'ConstantsService', function( $scope, $http, $cookies, $window, $timeout, $rootScope, ConstantsService ){

    "use strict";

    var shoppingCartInCookie = $cookies.getObject( 'shoppingcart' );

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
                        console.log("Agreement not exist");
                        break;
                    case 'ENCODING_ERROR':
                        console.log("Encoding error : " + data.data);
                        $window.location.reload();
                        break;
                    case 'PRODUCT_AGREEMENT_FOUNDED':
                        console.log("Product with agreement discount founded : " + data.data);
                        applyDiscount( data.data );
                        //$window.location.reload();
                        break;
                    case 'PRODUCT_AGREEMENT_NOT_FOUND':
                        console.log("Products without agreement discount: " + data.data);
                        //$window.location.reload();
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

    function applyDiscount( productIdsFounded ) {

        var orderInCookie = $cookies.getObject( 'order' );
        var shoppingCartInCookie = orderInCookie.shoppingcart;

        console.info( shoppingCartInCookie );

        angular.forEach( productIdsFounded, function( productFounded, key1 ){

            angular.forEach( shoppingCartInCookie.products, function( productShoppingcart, key2 ){

                if( productFounded.product_id == productShoppingcart.id ) {
                    shoppingCartInCookie.products[key2].discount = productFounded.discount;
                    shoppingCartInCookie.products[key2].hasAgreementDiscount = true;
                    shoppingCartInCookie.hasproductWithAgreementDiscount = true;
                }
            });

        });

        $rootScope.$broadcast( ConstantsService.SHOPPINGCART_CHANGED, shoppingCartInCookie );
    }

}]);
