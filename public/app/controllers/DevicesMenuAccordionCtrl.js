/**
 * Created by Adrian on 12/11/2014.
 */

farmapp.controller('DevicesMenuAccordionCtrl', ['$scope', '$rootScope', '$http', '$filter', function( $scope, $rootScope, $http, $filter ) {
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
            $('#sticky').addClass('stick');

            $rootScope.$broadcast("IS_STICKY");

        } else {
            $('#sticky').removeClass('stick');

            $rootScope.$broadcast("NO_STICKY");
        }
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });


}]);