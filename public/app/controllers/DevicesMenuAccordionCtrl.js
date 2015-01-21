/**
 * Created by Adrian on 12/11/2014.
 */

farmapp.controller('DevicesMenuAccordionCtrl', ['$scope', function($scope) {
    $scope.oneAtATime = true;
    $scope.menuStatus =false;

    $scope.activeMenu = function(){
        
        if($scope.menuStatus) {
            $scope.menuStatus = false;
        }else {
            $scope.menuStatus = true;
        }
    }


    function sticky_relocate() {
        var window_top = $(window).scrollTop();
        var div_top = $('#sticky-anchor').offset().top;
        if (window_top > div_top) {
            $('#sticky').addClass('stick');
        } else {
            $('#sticky').removeClass('stick');
        }
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });

}]);
