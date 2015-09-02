/**
 * Created by Adrian on 12/11/2014.
 */

farmapp.controller('DevicesMenuAccordionCtrl', ['$scope', '$rootScope', '$http', '$filter', '$log', '$rootScope', 'ConstantsService', function( $scope, $rootScope, $http, $filter, $log, $rootScope, ConstantsService ) {

    $scope.oneAtATime = true;
    $scope.menuStatus =false;


    $scope.activeMenu = function(){

        if($scope.menuStatus) {
            $scope.menuStatus = false;
        }else {
            $scope.menuStatus = true;
        }
    }

    $rootScope.$on("IS_STICKY" , function() {

        var normalLogo = document.getElementById( "normal-logo" );
        angular.element(normalLogo).addClass("hidden");

        var stickyLogo = document.getElementById( "logo-for-sticky" );
        angular.element(stickyLogo).removeClass("hidden");

        var el = document.getElementById( "primary-nav" );
        angular.element(el).addClass("no-margin");

    });

    $rootScope.$on("NO_STICKY" , function() {

        var normalLogo = document.getElementById( "normal-logo" );
        angular.element(normalLogo).removeClass("hidden");

        var stickyLogo = document.getElementById( "logo-for-sticky" );
        angular.element(stickyLogo).addClass("hidden");

        var el = document.getElementById( "primary-nav" );
        angular.element(el).removeClass("no-margin");

    });

    function sticky_relocate() {
        var window_top = $(window).scrollTop();
        var div_top = $('#sticky-anchor').offset().top;
        if (window_top > div_top) {
            $('#search-nav').addClass('stick');

            $rootScope.$broadcast("IS_STICKY");

        } else {
            $('#search-nav').removeClass('stick');

            $rootScope.$broadcast("NO_STICKY");
        }
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });


    $scope.search = function( searchText, isValid ) {



        if (searchText != undefined && isValid) {
            /*
            var containSpaces =  searchText.search(" ");

            if ( containSpaces != -1 ) {

                var TextsToSearch = searchText.split(" ");

                searchText = toObject(TextsToSearch);

                $log.info(searchText);

            }*/

            var searchInfo = {
                textToSearch : searchText,
                inputStatus : isValid
            };

            $log.info(searchInfo);

            if ( $scope.products == undefined )
                load_products( searchInfo );
            else {
                var data = {
                    searchInfo: searchInfo,
                    products : $scope.products
                };
                search( data );
            }
            $scope.searching = true;

        }else{
            $scope.searching = false;
        }


    };

    function toObject(arr) {
        var rv = {};
        for (var i = 0; i < arr.length; ++i)
            rv[i] = arr[i];
        return rv;
    }

    function search ( data ) {

        //var isObject = angular.isObject(data.searchInfo.textToSearch);

        if ( data.searchInfo.textToSearch.length > 2 ) {
            var result = $filter('filter')(data.products, data.searchInfo.textToSearch, undefined);

            if ( result.length > 0 ) {

                var limit = 11;

                if (result.length > limit)
                    $scope.results = result.slice(0, limit);
                else
                    $scope.results = result;

            }else
                $scope.results = false;
        } else {
            $scope.results = false;
        }

    }

    $rootScope.$on( ConstantsService.PRODUCTS_CHARGED, function(event, data) {

        $log.info(data);



    });

    function load_products( searchInfo ) {
        var json;
        $scope.productsCharged = false;
        $http.get("http://virtualfarma.com.co/product/all_products_for_search_input")
            .success(function (data, status, headers, config) {

                //  console.info(data + ":(");

                if ( json != 'NULL' ){
                    var json = angular.fromJson(data);
                    $scope.productsCharged= true;
                    $scope.products = json;

                    var searchInfoData = {};
                        searchInfoData.products = json;
                        searchInfoData.searchInfo = searchInfo;

                    $rootScope.$broadcast(ConstantsService.PRODUCTS_CHARGED, searchInfoData);

                }else {
                    console.info(data + ":(");
                }

            }).
            error(function (data, status, headers, config) {
                console.info(data + ":(");
            });
    }


}]);